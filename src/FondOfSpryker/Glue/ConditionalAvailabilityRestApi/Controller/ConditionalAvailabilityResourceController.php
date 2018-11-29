<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Controller;

use Generated\Shared\Transfer\RestCustomersAttributesTransfer;
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
     * @param \Generated\Shared\Transfer\RestCustomersAttributesTransfer $restCustomersAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(RestRequestInterface $restRequest, RestCustomersAttributesTransfer $restCustomersAttributesTransfer): RestResponseInterface
    {
        return $this->getFactory()
            ->createCustomersWriter()
            ->registerCustomer($restCustomersAttributesTransfer);
    }
}
