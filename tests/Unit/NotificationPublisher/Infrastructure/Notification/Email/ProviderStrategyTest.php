<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Email;

use App\NotificationPublisher\Infrastructure\Notification\Exception\AllProvidersNotWorkingException;
use PHPUnit\Framework\TestCase;

class EmailProviderTest extends TestCase
{
    private $provider;

    protected function setUp(): void
    {
        $config = [
            'email' => [
                'aws_ses' => [
                    'name' => 'aws_ses',
                    'retries' => 3,
                ],
                'mailgun' => [
                    'name' => 'mailgun',
                    'retries' => 2,
                ],
            ],
            'sms' => [
                'twilio' => [
                    'name' => 'twilio',
                    'retries' => 3,
                ],
            ],
            'push' => [
                'pushy' => [
                    'name' => 'pushy',
                    'retries' => 3,
                ],
            ],
        ];
        $this->provider = new ProviderStrategy($config);
    }

    public function testFirstProvider()
    {
        $lastProviderName = null;
        $retries = 0;
        $expectedResult = ProviderEnum::from('aws_ses');

        $result = $this->provider->next($lastProviderName, $retries);

        $this->assertEquals($expectedResult, $result);
    }

    public function testFirstProviderSecondTime()
    {
        $lastProviderName = "aws_ses";
        $retries = 1;
        $expectedResult = ProviderEnum::from('aws_ses');

        $result = $this->provider->next($lastProviderName, $retries);

        $this->assertEquals($expectedResult, $result);
    }

    public function testSwitchingToSecondProvider()
    {
        $lastProviderName = "aws_ses";
        $retries = 4;
        $expectedResult = ProviderEnum::from('mailgun');

        $result = $this->provider->next($lastProviderName, $retries);

        $this->assertEquals($expectedResult, $result);
    }

    public function testSecondProvider()
    {
        $lastProviderName = "mailgun";
        $retries = 0;
        $expectedResult = ProviderEnum::from('mailgun');

        $result = $this->provider->next($lastProviderName, $retries);

        $this->assertEquals($expectedResult, $result);
    }

    public function testNoMoreProvidersExpectException()
    {
        $lastProviderName = "mailgun";
        $retries = 3;

        $this->expectException(AllProvidersNotWorkingException::class);

        $this->provider->next($lastProviderName, $retries);

    }

}