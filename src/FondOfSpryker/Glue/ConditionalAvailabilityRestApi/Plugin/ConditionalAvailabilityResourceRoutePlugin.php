<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Plugin;

use FondOfSpryker\Glue\ConditionalAvailabilityRestApi\ConditionalAvailabilityRestApiConfig;
use Generated\Shared\Transfer\RestConditionalAvailabilityRequestTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \FondOfSpryker\Glue\ConditionalAvailabilityRestApi\ConditionalAvailabilityRestApiFactory getFactory()
 */
class ConditionalAvailabilityResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection
            ->addGet('get', false);

        return $resourceRouteCollection;
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return ConditionalAvailabilityRestApiConfig::RESOURCE_CONDITIONAL_AVAILABILITY;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return 'conditional-availability-resource';
    }

    /**
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestConditionalAvailabilityRequestTransfer::class;
    }
}
