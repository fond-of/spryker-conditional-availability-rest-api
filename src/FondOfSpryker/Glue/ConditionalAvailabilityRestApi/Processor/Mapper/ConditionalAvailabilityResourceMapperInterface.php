<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer;

interface ConditionalAvailabilityResourceMapperInterface
{
    /**
     * @param array $result
     *
     * @return \Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer
     */
    public function mapConditionalAvailabilityResultToResponseTransfer(
        array $result
    ): RestConditionalAvailabilityPeriodResponseTransfer;
}
