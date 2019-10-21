<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper\ConditionalAvailabilityResourceMapperInterface;
use Spryker\Glue\Kernel\Container;

class ConditionalAvailabilityRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ConditionalAvailabilityRestApi\ConditionalAvailabilityRestApiFactory
     */
    protected $conditionalAvailabilityRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface
     */
    protected $conditionalAvailabilityClientInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityClientInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityRestApiFactory = new ConditionalAvailabilityRestApiFactory();
        $this->conditionalAvailabilityRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateConditionalAvailabilityResourceMapper(): void
    {
        $this->assertInstanceOf(ConditionalAvailabilityResourceMapperInterface::class, $this->conditionalAvailabilityRestApiFactory->createConditionalAvailabilityResourceMapper());
    }

    /**
     * @return void
     */
    public function testGetConditionalAvailabilityClient(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(ConditionalAvailabilityRestApiDependencyProvider::CLIENT_CONDITIONAL_AVAILABILITY)
            ->willReturn($this->conditionalAvailabilityClientInterfaceMock);

        $this->assertInstanceOf(ConditionalAvailabilityClientInterface::class, $this->conditionalAvailabilityRestApiFactory->getConditionalAvailabilityClient());
    }
}
