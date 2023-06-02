<?php

namespace App\Tests\Unit\NotificationPublisher\Infrastructure\Notification;

use App\NotificationPublisher\Infrastructure\Notification\ProviderStrategyInterface;
use PHPUnit\Framework\TestCase;
use App\NotificationPublisher\Infrastructure\Notification\TypeProviderStrategyBuilder;
use App\NotificationPublisher\Domain\Notification\NotificationType;


class TypeProviderStrategyBuilderTest extends TestCase
{
    private $strategies = [];

    protected function setUp(): void
    {
        $this->strategies = [
            $this->createMock(ProviderStrategyInterface::class),
            $this->createMock(ProviderStrategyInterface::class),
            $this->createMock(ProviderStrategyInterface::class)
        ];
    }

    public function testBuildWithValidType(): void
    {
        $type = NotificationType::EMAIL;
        $strategy = $this->strategies[0];
        $strategy->expects($this->once())
            ->method('getType')
            ->willReturn($type);

        $builder = new TypeProviderStrategyBuilder($this->strategies);
        $result = $builder->build($type);

        $this->assertSame($strategy, $result);
    }

    public function testBuildSecnodWithValidType(): void
    {
        $type1 = NotificationType::EMAIL;
        $strategy = $this->strategies[0];
        $strategy->expects($this->once())
            ->method('getType')
            ->willReturn($type1);

        $type2 = NotificationType::SMS;
        $strategy2 = $this->strategies[1];
        $strategy2->expects($this->once())
            ->method('getType')
            ->willReturn($type2);

        $builder = new TypeProviderStrategyBuilder($this->strategies);
        $result = $builder->build($type2);

        $this->assertSame($strategy2, $result);
    }

    public function testBuildWithInvalidType(): void
    {
        $type = NotificationType::SMS;

        foreach ($this->strategies as $strategy) {
            $strategy->expects($this->once())
                ->method('getType')
                ->willReturn(NotificationType::EMAIL);
        }

        $builder = new TypeProviderStrategyBuilder($this->strategies);

        $this->expectException(\Exception::class);
        $builder->build($type);
    }

    public function testBuildWithEmptyStrategies(): void
    {
        $type = NotificationType::EMAIL;

        $builder = new TypeProviderStrategyBuilder([]);

        $this->expectException(\Exception::class);
        $builder->build($type);
    }

    public function testBuildWithNullType(): void
    {
        $builder = new TypeProviderStrategyBuilder($this->strategies);

        $this->expectException(\TypeError::class);
        $builder->build(null);
    }
}