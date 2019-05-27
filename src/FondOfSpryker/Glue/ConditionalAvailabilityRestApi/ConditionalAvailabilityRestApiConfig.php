<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class ConditionalAvailabilityRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_CONDITIONAL_AVAILABILITY = 'conditional-availability';
    public const WAREHOUSE_PARAMETER = 'warehouse';
    public const SKU_PARAMETER = 'sku';
    public const DATE_PARAMETER = 'date';
}
