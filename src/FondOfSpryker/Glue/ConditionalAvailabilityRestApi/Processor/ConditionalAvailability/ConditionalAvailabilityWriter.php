<?php

namespace FondOfSpryker\Glue\CustomersRestApi\Processor\Customers;

use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
use Generated\Shared\Transfer\RestConditionalAvailabilityRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

class ConditionalAvailabilityWriter implements ConditionalAvailabilityWriterInterface
{
    /**
     * @var \Spryker\Glue\CustomersRestApi\Dependency\Client\CustomersRestApiToCustomerClientInterface
     */
    protected $conditionalAvailabilityClient;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \Spryker\Glue\CustomersRestApi\Processor\Mapper\CustomersResourceMapperInterface
     */
    protected $customersResourceMapper;

    /**
     * @param \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface $conditionalAvailabilityClient
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        ConditionalAvailabilityClientInterface $conditionalAvailabilityClient,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->conditionalAvailabilityClient = $conditionalAvailabilityClient;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\RestConditionalAvailabilityRequestTransfer $conditionalAvailabilityRequestTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function searchRequest(RestConditionalAvailabilityRequestTransfer $conditionalAvailabilityRequestTransfer): RestResponseInterface
    {
        $response = $this->restResourceBuilder->createRestResponse();
        $resultSet = $this->conditionalAvailabilityClient->searchQueryString('ssss');

        \var_dump($resultSet);
        exit;

        return $response->addResource($restResource);
    }
}
