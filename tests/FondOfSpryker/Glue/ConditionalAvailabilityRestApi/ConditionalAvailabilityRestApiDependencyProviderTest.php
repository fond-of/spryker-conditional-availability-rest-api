<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi;

use Codeception\Test\Unit;
use Spryker\Glue\Kernel\Container;

class ConditionalAvailabilityRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ConditionalAvailabilityRestApi\ConditionalAvailabilityRestApiDependencyProvider
     */
    protected $conditionalAvailabilityRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityRestApiDependencyProvider = new ConditionalAvailabilityRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $this->assertInstanceOf(Container::class, $this->conditionalAvailabilityRestApiDependencyProvider->provideDependencies($this->containerMock));
    }
}
