<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper;

use Elastica\ResultSet;
use Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer;

interface ConditionalAvailabilityResourceMapperInterface
{
    /**
     * @param \Elastica\ResultSet $resultSet
     *
     * @return \Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer
     */
    public function mapConditionalAvailabilityResultToResponseTransfer(ResultSet $resultSet): RestConditionalAvailabilityPeriodResponseTransfer;
}
