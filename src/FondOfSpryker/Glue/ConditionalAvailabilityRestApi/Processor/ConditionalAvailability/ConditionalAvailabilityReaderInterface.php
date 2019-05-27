<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\ConditionalAvailability;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface ConditionalAvailabilityReaderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function searchRequest(RestRequestInterface $restRequest): RestResponseInterface;
}
