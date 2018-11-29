<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\ConditionalAvailability;

use Generated\Shared\Transfer\RestConditionalAvailabilityRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface ConditionalAvailabilityReaderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestConditionalAvailabilityRequestTransfer $restConditionalAvailabilityRequestTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function searchRequest(
        RestRequestInterface $restRequest,
        RestConditionalAvailabilityRequestTransfer $restConditionalAvailabilityRequestTransfer
    ): RestResponseInterface;
}
