<?php

namespace Ensembl260\SDK\Auth;

use Ensembl260\SDK\Client;
use Ensembl260\SDK\Exceptions\OAuthException;
use Ensembl260\SDK\Exceptions\RequestException;
use Ensembl260\SDK\TokenStorage\InMemoryTokenStorage;
use Ensembl260\SDK\TokenStorage\TokenStorageInterface;
use Psr\Log\LoggerInterface;

class OAuth
{
    public const TOKEN_ENDPOINT = '/oauth/v2/token';
    public const GRANT_REFRESH = 'refresh_token';
    public const GRANT_PASSWORD = 'password';
    public const GRANT_EXTERNAL = 'urn:external';
    public const GRANT_CLIENT_CREDENTIALS = 'client_credentials';

    private string $clientId;
    private string $clientSecret;
    private Client $client;
    private TokenStorageInterface $storage;
    private LoggerInterface $logger;

    public function __construct(Client $client, $clientId, $clientSecret, TokenStorageInterface $storage = null, $options = [])
    {
        $this->client = $client;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->storage = $storage ?: new InMemoryTokenStorage();
        $this->logger = $client->getLogger();
    }

    /**
     * @throws OAuthException
     */
    public function loginWithCredentials(string $email, string $password): bool
    {
        $this->logMessage('Logging in with credentials', [
            'grant_type' => self::GRANT_PASSWORD,
            'username' => $email,
        ]);

        return $this->requestAccessToken(self::GRANT_PASSWORD, [
            'username' => $email,
            'password' => $password,
        ]);
    }

    /**
     * @throws OAuthException
     */
    public function loginWithExternalToken(string $type, string $token): bool
    {
        $this->logMessage('Logging in with external token', [
            'grant_type' => self::GRANT_EXTERNAL,
            'type' => $type,
            'token' => $token,
        ]);

        return $this->requestAccessToken(self::GRANT_EXTERNAL, [
            'type' => $type,
            'token' => $token,
        ]);
    }

    public function login(): bool
    {
        $this->logMessage('Logging in as client', [
            'grant_type' => self::GRANT_CLIENT_CREDENTIALS,
        ]);

        return $this->requestAccessToken(self::GRANT_CLIENT_CREDENTIALS);
    }

    public function logout()
    {
        $this->storage->remove($this->client->getTokenCacheKey());

        $this->logMessage('Logging out');
    }

    public function getToken(): array
    {
        if ($this->hasToken()) {
            return $this->storage->get($this->client->getTokenCacheKey());
        }

        // Force the fact that the token is expired
        return [
            'access_token' => null,
            'refresh_token' => null,
            'expires_at' => time() - 10000,
            'expires_in' => -10000,
        ];
    }

    public function hasToken(): bool
    {
        return $this->storage->has($this->client->getTokenCacheKey());
    }

    /**
     * @throws \OAuthException
     */
    public function getAccessToken(): ?string
    {
        if (!$this->hasToken()) {
            $this->logMessage('User does not have an token. Logging in ...');
            $this->login();

            return $this->getToken()['access_token'];
        }

        if ($this->checkLifetime()) {
            return $this->getToken()['access_token'];
        }

        $this->logMessage('Token has expired');
        $token = $this->getToken();
        if ($token['refresh_token']) {
            $this->logMessage('Refreshing token...', ['old_token' => $token]);
            $isSaved = $this->requestAccessToken(self::GRANT_REFRESH, ['refresh_token' => $token['refresh_token']]);
            if (!$isSaved) {
                $this->logMessage('Error on save access token in storage');
                throw new RequestException('Error on save access token in storage');
            }

            return $this->getToken()['access_token'];
        }

        $this->logMessage('User does not have an refresh token. Logging in...');
        $this->login();

        return $this->getToken()['access_token'];
    }

    /**
     * @throws LogicException
     */
    public function checkLifetime(): bool
    {
        if (!$this->hasToken()) {
            throw new \LogicException('No token is registered.');
        }

        return time() < $this->getToken()['expires_at'];
    }

    /**
     * @throws OAuthException
     */
    private function requestAccessToken(string $grant, array $credentials = []): bool
    {
        $credentials = array_merge([
            'grant_type' => $grant,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ], $credentials);

        $this->logMessage('Generating new credentials key', [
            'session_id_name' => $this->client->getTokenCacheKey(),
            'credentials' => $credentials,
        ]);

        $response = $this->client->request()->execute('POST', self::TOKEN_ENDPOINT, [], $credentials, [
            'authentification' => true,
            'form-data' => true,
        ]);

        if (200 !== $response->getStatusCode()) {
            $this->logMessage('Error when getting token', ['error' => (string) $response->getContent()]);

            throw new OAuthException($response);
        }

        $data = json_decode($response->getContent(), true);
        $isSaved = $this->storage->save($this->client->getTokenCacheKey(), [
            'access_token' => $data['access_token'],
            'refresh_token' => isset($data['refresh_token']) ? $data['refresh_token'] : null,
            'expires_at' => isset($data['expires_in']) ? time() + $data['expires_in'] : null,
            'expires_in' => isset($data['expires_in']) ? $data['expires_in'] : null,
        ]);

        $this->logMessage('Saving access token', [
            'is_saved' => $isSaved,
            'access_token' => $data['access_token'],
            'refresh_token' => isset($data['refresh_token']) ? $data['refresh_token'] : null,
            'expires_at' => isset($data['expires_in']) ? time() + $data['expires_in'] : null,
            'expires_in' => isset($data['expires_in']) ? $data['expires_in'] : null,
        ]);

        return $isSaved;
    }

    private function logMessage(string $message, $params = []): void
    {
        if (!$this->logger) {
            return;
        }

        $this->logger->debug($message, array_merge($params, [
            'session_id' => $this->client->getTokenCacheKey(),
            'token' => $this->getToken(),
        ]));
    }
}
