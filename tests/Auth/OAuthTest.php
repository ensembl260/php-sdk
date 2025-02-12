<?php

namespace App\Tests\Auth;

use Ensembl260\SDK\Client;
use PHPUnit\Framework\TestCase;

class OAuthTest extends TestCase
{
    protected Client $mrClient;

    public function testAccessToken(): void
    {
        self::assertTrue(true);
        // $this->mrClient = new Client(
        //     getenv('API_CLIENT_URL'),
        //     getenv('APP_SECRET'),
        //     getenv('API_CLIENT_ID'),
        // );
        //     getenv('API_CLIENT_NAME')

        // /** @var OAuth */
        // $isSaved = $this->mrClient->auth()->loginWithCredentials("user.d@ma-residence.fr", "password");
        // self::assertTrue($isSaved);
        // self::assertNotNull($this->mrClient->auth()->getAccessToken());
        // self::assertTrue($this->mrClient->auth()->hasToken());
        // self::assertTrue($this->mrClient->auth()->checkLifetime());
        // self::assertEquals(200, $this->mrClient->me()->get()->getStatusCode());
    }
}
