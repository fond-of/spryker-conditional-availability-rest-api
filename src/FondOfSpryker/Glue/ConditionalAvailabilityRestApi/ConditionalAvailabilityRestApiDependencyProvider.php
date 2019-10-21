<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi;

use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class ConditionalAvailabilityRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_CONDITIONAL_AVAILABILITY = 'CLIENT_CONDITIONAL_AVAILABILITY';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addConditionalAvailabilityClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addConditionalAvailabilityClient(Container $container): Container
    {
        $container[static::CLIENT_CONDITIONAL_AVAILABILITY] = function (Container $container) {
            return $container->getLocator()->conditionalAvailability()->client();
        };

        return $container;
    }
}
