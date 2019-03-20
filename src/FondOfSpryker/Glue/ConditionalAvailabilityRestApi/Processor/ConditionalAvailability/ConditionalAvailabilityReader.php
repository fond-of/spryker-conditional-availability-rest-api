<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\ConditionalAvailability;

use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityRestApi\ConditionalAvailabilityRestApiConfig;
use FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper\ConditionalAvailabilityResourceMapperInterface;
use FondOfSpryker\Shared\ConditionalAvailability\ConditionalAvailabilityConstants;
use Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer;
use Generated\Shared\Transfer\RestConditionalAvailabilityRequestTransfer;
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
     * @param \Generated\Shared\Transfer\RestConditionalAvailabilityRequestTransfer $restConditionalAvailabilityRequestTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     * @throws \Exception
     */
    public function searchRequest(
        RestRequestInterface $restRequest,
        RestConditionalAvailabilityRequestTransfer $restConditionalAvailabilityRequestTransfer
    ): RestResponseInterface {
        $searchParameters = [];
        if ($restConditionalAvailabilityRequestTransfer->getWarehouse() !== null) {
            $searchParameters[ConditionalAvailabilityConstants::PARAMETER_WAREHOUSE] = $restConditionalAvailabilityRequestTransfer->getWarehouse();
        }

        if ($restConditionalAvailabilityRequestTransfer->getDate() !== null) {
            $searchParameters[ConditionalAvailabilityConstants::PARAMETER_DATE] = new \DateTimeImmutable($restConditionalAvailabilityRequestTransfer->getDate());
        }

        $result = $this->conditionalAvailabilityClient->conditionalAvailabilitySkuSearch(
            $restConditionalAvailabilityRequestTransfer->getSku(),
            $searchParameters
        );

        $responseTransfer = $this
            ->conditionalAvailabilityResourceMapper
            ->mapConditionalAvailabilityResultToResponseTransfer($result);

        return $this->buildConditionalAvailabilityResponse($responseTransfer);
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
