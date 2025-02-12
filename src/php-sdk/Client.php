<?php

namespace Ensembl260\SDK;

use GuzzleHttp\HandlerStack;
use Ensembl260\SDK\Auth\OAuth;
use Ensembl260\SDK\Endpoints\Endpoint;
use Ensembl260\SDK\TokenStorage\TokenStorageInterface;
use Ensembl260\SDK\Transport\Request;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Client
{
    public const OPT_FOLLOW_LOCATION = 'follow_location';
    public const OPT_ERRMODE_EXCEPTION = 'errmode_exception';

    private Request $request;
    private OAuth $auth;
    private array $cachedEndpoints = [];
    private LoggerInterface $logger;
    private string $tokenCacheKey;
    private array $options = [];

    public function __construct(
        string $host,
        string $clientId,
        string $clientSecret,
        string $tokenCacheKey,
        TokenStorageInterface $storage = null,
        LoggerInterface $logger = null,
        HandlerStack $handlerStack = null,
        array $options = []
    ) {
        $this->logger = $logger ?: new NullLogger();
        $this->auth = new OAuth($this, $clientId, $clientSecret, $storage, $options);
        $this->request = new Request($this, $host, $handlerStack);
        $this->tokenCacheKey = $tokenCacheKey;
        $this->options = $options;
    }

    public function me(): Endpoint
    {
        return $this->getEndpoint(Endpoints\MeEndpoint::class);
    }

    public function users(): Endpoint
    {
        return $this->getEndpoint(Endpoints\UserEndpoint::class);
    }

    public function forgetPassword()
    {
        return $this->getEndpoint(Endpoints\ForgotPasswordEndpoint::class);
    }

    public function groups()
    {
        return $this->getEndpoint(Endpoints\GroupEndpoint::class);
    }

    public function associations()
    {
        return $this->getEndpoint(Endpoints\AssociationEndpoint::class);
    }

    public function hallNumerics()
    {
        return $this->getEndpoint(Endpoints\HallNumericEndpoint::class);
    }

    public function markets()
    {
        return $this->getEndpoint(Endpoints\MarketEndpoint::class);
    }

    public function shops()
    {
        return $this->getEndpoint(Endpoints\ShopEndpoint::class);
    }

    public function cityHalls()
    {
        return $this->getEndpoint(Endpoints\CityHallEndpoint::class);
    }

    public function places()
    {
        return $this->getEndpoint(Endpoints\PlaceEndpoint::class);
    }

    public function categories()
    {
        return $this->getEndpoint(Endpoints\CategoryEndpoint::class);
    }

    public function roles()
    {
        return $this->getEndpoint(Endpoints\RoleEndpoint::class);
    }

    public function members()
    {
        return $this->getEndpoint(Endpoints\MemberOfEndpoint::class);
    }

    public function topics()
    {
        return $this->getEndpoint(Endpoints\TopicEndpoint::class);
    }

    public function likes()
    {
        return $this->getEndpoint(Endpoints\LikeEndpoint::class);
    }

    public function follows()
    {
        return $this->getEndpoint(Endpoints\FollowEndpoint::class);
    }

    public function participates()
    {
        return $this->getEndpoint(Endpoints\ParticipateEndpoint::class);
    }

    public function comments()
    {
        return $this->getEndpoint(Endpoints\CommentEndpoint::class);
    }

    public function demands()
    {
        return $this->getEndpoint(Endpoints\DemandEndpoint::class);
    }

    public function donations()
    {
        return $this->getEndpoint(Endpoints\DonationEndpoint::class);
    }

    public function events()
    {
        return $this->getEndpoint(Endpoints\EventEndpoint::class);
    }

    public function pushs()
    {
        return $this->getEndpoint(Endpoints\PushEndpoint::class);
    }

    public function polls()
    {
        return $this->getEndpoint(Endpoints\PollEndpoint::class);
    }

    public function news()
    {
        return $this->getEndpoint(Endpoints\NewsEndpoint::class);
    }

    public function help()
    {
        return $this->getEndpoint(Endpoints\HelpEndpoint::class);
    }

    public function alerts()
    {
        return $this->getEndpoint(Endpoints\AlertEndpoint::class);
    }

    public function recommendations()
    {
        return $this->getEndpoint(Endpoints\RecommendationEndpoint::class);
    }

    public function shares()
    {
        return $this->getEndpoint(Endpoints\ShareEndpoint::class);
    }

    public function trades()
    {
        return $this->getEndpoint(Endpoints\TradeEndpoint::class);
    }

    public function transactions()
    {
        return $this->getEndpoint(Endpoints\TransactionEndpoint::class);
    }

    public function services()
    {
        return $this->getEndpoint(Endpoints\ServiceEndpoint::class);
    }

    public function serviceWorkflows()
    {
        return $this->getEndpoint(Endpoints\ServiceWorkflow::class);
    }

    public function medias()
    {
        return $this->getEndpoint(Endpoints\MediaEndpoint::class);
    }

    public function newsletters()
    {
        return $this->getEndpoint(Endpoints\NewsletterEndpoint::class);
    }

    public function widgets()
    {
        return $this->getEndpoint(Endpoints\WidgetEndpoint::class);
    }

    public function publications()
    {
        return $this->getEndpoint(Endpoints\PublicationEndpoint::class);
    }

    public function profiles()
    {
        return $this->getEndpoint(Endpoints\ProfileEndpoint::class);
    }

    public function sitemap()
    {
        return $this->getEndpoint(Endpoints\SitemapEndpoint::class);
    }

    public function lendObjects()
    {
        return $this->getEndpoint(Endpoints\LendObjectEndpoint::class);
    }

    public function joinRequests()
    {
        return $this->getEndpoint(Endpoints\JoinRequestEndpoint::class);
    }

    public function contacts()
    {
        return $this->getEndpoint(Endpoints\ContactEndpoint::class);
    }

    public function customers()
    {
        return $this->getEndpoint(Endpoints\CustomerEndpoint::class);
    }

    public function invitations()
    {
        return $this->getEndpoint(Endpoints\InvitationEndpoint::class);
    }

    public function teams()
    {
        return $this->getEndpoint(Endpoints\TeamEndpoint::class);
    }

    public function blacklists()
    {
        return $this->getEndpoint(Endpoints\BlackListEndpoint::class);
    }

    public function moderation()
    {
        return $this->getEndpoint(Endpoints\ModerationEndPoint::class);
    }

    public function notifications()
    {
        return $this->getEndpoint(Endpoints\NotificationEndpoint::class);
    }

    public function card()
    {
        return $this->getEndpoint(Endpoints\CardEndpoint::class);
    }

    public function bookmarks()
    {
        return $this->getEndpoint(Endpoints\BookmarkEndpoint::class);
    }

    public function features()
    {
        return $this->getEndpoint(Endpoints\FeatureEndpoint::class);
    }

    public function endpoints(string $type): Endpoint
    {
        if (method_exists($this, $type)) {
            return call_user_func_array([$this, $type], []);
        }

        if (isset($this->cachedEndpoints[$type])) {
            return $this->cachedEndpoints[$type];
        }

        $toCamelCase = function ($name) {
            return lcfirst(preg_replace_callback('/(^|_|\.)+(.)/', function ($match) {
                return ('.' === $match[1] ? '_' : '') . strtoupper($match[2]);
            }, $name));
        };

        $typeCamelCase = $toCamelCase($type);
        if (method_exists($this, $typeCamelCase)) {
            return call_user_func_array([$this, $typeCamelCase], []);
        }

        $typePlural = ('s' != substr($type, -1)) ? sprintf('%ss', $type) : rtrim($type, 's');
        if (method_exists($this, $typePlural)) {
            return call_user_func_array([$this, $typePlural], []);
        }

        if (isset($this->cachedEndpoints[$typePlural])) {
            return $this->cachedEndpoints[$typePlural];
        }

        $typePluralCamelCase = $toCamelCase($typePlural);
        if (method_exists($this, $typePluralCamelCase)) {
            return call_user_func_array([$this, $typePluralCamelCase], []);
        }

        throw new \InvalidArgumentException("Unknown endpoint type $type");
    }

    private function getEndpoint(string $class): Endpoint
    {
        $endpoint = $class::getBaseUri();
        if (!isset($this->cachedEndpoints[$endpoint])) {
            $this->cachedEndpoints[$endpoint] = new $class($this->request);
        }

        return $this->cachedEndpoints[$endpoint];
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function auth(): OAuth
    {
        return $this->auth;
    }

    public function getTokenCacheKey(): string
    {
        return $this->tokenCacheKey;
    }

    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    public function setOption(string $option, string $value): Client
    {
        $this->options[$option] = $value;

        return $this;
    }

    public function getOption(string $option): ?array
    {
        return isset($this->options[$option]) ? $this->options[$option] : null;
    }

    public function withOptions(array $options, callable $fn)
    {
        $result = null;
        try {
            $previous = [];
            foreach ($options as $key => $value) {
                $previous[$key] = $this->getOption($key);
                $this->setOption($key, $value);
            }

            $result = $fn();
        } catch (\Exception $e) {
            throw $e;
        } finally {
            foreach ($previous as $key => $value) {
                $this->setOption($key, $value);
            }
        }

        return $result;
    }
}
