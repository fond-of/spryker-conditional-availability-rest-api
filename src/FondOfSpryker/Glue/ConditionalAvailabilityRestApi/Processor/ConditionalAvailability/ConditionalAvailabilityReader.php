<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\ConditionalAvailability;

use DateTimeImmutable;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityRestApi\ConditionalAvailabilityRestApiConfig;
use FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper\ConditionalAvailabilityResourceMapperInterface;
use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ConditionalAvailabilityReader implements ConditionalAvailabilityReaderInterface
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface
     */
    protected $conditionalAvailabilityClient;

    /**
     * @var \FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper\ConditionalAvailabilityResourceMapperInterface
     */
    protected $conditionalAvailabilityResourceMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface $conditionalAvailabilityClient
     * @param \FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper\ConditionalAvailabilityResourceMapperInterface $conditionalAvailabilityResourceMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        ConditionalAvailabilityClientInterface $conditionalAvailabilityClient,
        ConditionalAvailabilityResourceMapperInterface $conditionalAvailabilityResourceMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->conditionalAvailabilityClient = $conditionalAvailabilityClient;
        $this->conditionalAvailabilityResourceMapper = $conditionalAvailabilityResourceMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @throws
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function searchRequest(RestRequestInterface $restRequest): RestResponseInterface
    {

        $result = $this->conditionalAvailabilityClient->conditionalAvailabilitySkuSearch(
            $this->getSearchString($restRequest),
            $this->getRequestParameters($restRequest)
        );

        $responseTransfer = $this
            ->conditionalAvailabilityResourceMapper
            ->mapConditionalAvailabilityResultToResponseTransfer($result);

        return $this->buildConditionalAvailabilityResponse($responseTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param string $parameterName
     *
     * @return bool
     */
    protected function hasRequestParameter(RestRequestInterface $restRequest, string $parameterName): bool
    {
        $parameterValue = $this->getRequestParameter($restRequest, $parameterName);

        return $parameterValue !== null && $parameterValue !== '';
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return string|null
     */
    protected function getSearchString(RestRequestInterface $restRequest): ?string
    {
        return $this->getRequestParameter($restRequest, ConditionalAvailabilityRestApiConfig::QUERY_SKU);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param string $parameterName
     *
     * @return string|null
     */
    protected function getRequestParameter(RestRequestInterface $restRequest, string $parameterName): ?string
    {
        return $restRequest->getHttpRequest()->query->get($parameterName);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @throws
     *
     * @return array
     */
    protected function getRequestParameters(RestRequestInterface $restRequest): array
    {
        $requestParameters = [];

        if ($this->hasRequestParameter($restRequest, ConditionalAvailabilityRestApiConfig::QUERY_WAREHOUSE)) {
            $requestParameters[ConditionalAvailabilityConstants::PARAMETER_WAREHOUSE]
                = $this->getRequestParameter($restRequest, ConditionalAvailabilityRestApiConfig::QUERY_WAREHOUSE);
        }

        if ($this->hasRequestParameter($restRequest, ConditionalAvailabilityRestApiConfig::QUERY_START_AT)) {
            $requestParameters[ConditionalAvailabilityConstants::PARAMETER_START_AT]
                = new DateTimeImmutable($this->getRequestParameter($restRequest, ConditionalAvailabilityRestApiConfig::QUERY_START_AT));
        }

        if ($this->hasRequestParameter($restRequest, ConditionalAvailabilityRestApiConfig::QUERY_END_AT)) {
            $requestParameters[ConditionalAvailabilityConstants::PARAMETER_END_AT]
                = new DateTimeImmutable($this->getRequestParameter($restRequest, ConditionalAvailabilityRestApiConfig::QUERY_END_AT));
        }

        if ($this->hasRequestParameter($restRequest, ConditionalAvailabilityRestApiConfig::PAGINATION_PARAMETER_NAME_PAGE)) {
            $requestParameters[ConditionalAvailabilityRestApiConfig::PAGINATION_PARAMETER_NAME_PAGE]
                = $this->getRequestParameter($restRequest, ConditionalAvailabilityRestApiConfig::PAGINATION_PARAMETER_NAME_PAGE);
        }

        if ($this->hasRequestParameter($restRequest, ConditionalAvailabilityRestApiConfig::PAGINATION_ITEMS_PER_PAGE_PARAMETER_NAME)) {
            $requestParameters[ConditionalAvailabilityRestApiConfig::PAGINATION_ITEMS_PER_PAGE_PARAMETER_NAME]
                = $this->getRequestParameter($restRequest, ConditionalAvailabilityRestApiConfig::PAGINATION_ITEMS_PER_PAGE_PARAMETER_NAME);
        }

        $requestParameters[ConditionalAvailabilityConstants::PARAMETER_CUSTOMER_TRANSFER] = (new CustomerTransfer())
            ->setCustomerReference($restRequest->getRestUser()->getNaturalIdentifier())
            ->setIdCustomer($restRequest->getRestUser()->getSurrogateIdentifier());

        return $requestParameters;
    }

    /**
     * @param \Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer $conditionalAvailabilityRequestTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function buildConditionalAvailabilityResponse(RestConditionalAvailabilityPeriodResponseTransfer $conditionalAvailabilityRequestTransfer): RestResponseInterface
    {
        $restResource = $this->restResourceBuilder->createRestResource(
            ConditionalAvailabilityRestApiConfig::RESOURCE_CONDITIONAL_AVAILABILITY,
            null,
            $conditionalAvailabilityRequestTransfer
        );

        $response = $this->restResourceBuilder
            ->createRestResponse()
            ->addResource($restResource);

        return $response;
    }
}
