<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class ConditionalAvailabilityRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_CONDITIONAL_AVAILABILITY = 'conditional-availability';
    public const QUERY_WAREHOUSE = 'warehouse';
    public const QUERY_SKU = 'sku';
    public const QUERY_START_AT = 'start_at';
    public const QUERY_END_AT = 'end_at';
}
