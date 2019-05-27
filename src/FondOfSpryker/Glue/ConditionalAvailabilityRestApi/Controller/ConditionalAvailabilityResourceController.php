<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Controller;

use Generated\Shared\Transfer\RestConditionalAvailabilityRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \FondOfSpryker\Glue\ConditionalAvailabilityRestApi\ConditionalAvailabilityRestApiFactory getFactory()
 */
class ConditionalAvailabilityResourceController extends AbstractController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        return $this->getFactory()
            ->createConditionalAvailabilityReader()
            ->searchRequest($restRequest);
    }
}
