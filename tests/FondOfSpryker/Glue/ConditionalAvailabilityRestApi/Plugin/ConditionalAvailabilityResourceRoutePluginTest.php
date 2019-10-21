<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\ConditionalAvailabilityRestApi\ConditionalAvailabilityRestApiConfig;
use Generated\Shared\Transfer\RestConditionalAvailabilityRequestTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class ConditionalAvailabilityResourceRoutePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Plugin\ConditionalAvailabilityResourceRoutePlugin
     */
    protected $conditionalAvailabilityResourceRoutePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resourceRouteCollectionInterfaceMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityResourceRoutePlugin = new ConditionalAvailabilityResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->assertInstanceOf(ResourceRouteCollectionInterface::class, $this->conditionalAvailabilityResourceRoutePlugin->configure($this->resourceRouteCollectionInterfaceMock));
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertSame(ConditionalAvailabilityRestApiConfig::RESOURCE_CONDITIONAL_AVAILABILITY, $this->conditionalAvailabilityResourceRoutePlugin->getResourceType());
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertSame('conditional-availability-resource', $this->conditionalAvailabilityResourceRoutePlugin->getController());
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertSame(RestConditionalAvailabilityRequestTransfer::class, $this->conditionalAvailabilityResourceRoutePlugin->getResourceAttributesClassName());
    }
}
