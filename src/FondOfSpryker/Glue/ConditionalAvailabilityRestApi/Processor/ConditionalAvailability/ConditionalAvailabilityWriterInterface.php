<?php

namespace FondOfSpryker\Glue\CustomersRestApi\Processor\Customers;

use Generated\Shared\Transfer\RestConditionalAvailabilityRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface ConditionalAvailabilityWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestConditionalAvailabilityRequestTransfer $requestTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function searchRequest(RestConditionalAvailabilityRequestTransfer $requestTransfer): RestResponseInterface;
}
