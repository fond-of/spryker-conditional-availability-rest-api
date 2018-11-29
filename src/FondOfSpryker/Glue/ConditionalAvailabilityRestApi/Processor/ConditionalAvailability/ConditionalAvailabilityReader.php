<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\ConditionalAvailability;

use DateTime;
use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityRestApi\ConditionalAvailabilityRestApiConfig;
use FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper\ConditionalAvailabilityResourceMapperInterface;
use Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer;
use Generated\Shared\Transfer\RestConditionalAvailabilityRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\Page;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ConditionalAvailabilityReader implements ConditionalAvailabilityReaderInterface
{
    /**
     * @uses \Spryker\Client\Catalog\Plugin\Config\CatalogSearchConfigBuilder::DEFAULT_ITEMS_PER_PAGE;
     */
    protected const DEFAULT_ITEMS_PER_PAGE = 100;

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
     */
    public function searchRequest(
        RestRequestInterface $restRequest,
        RestConditionalAvailabilityRequestTransfer $restConditionalAvailabilityRequestTransfer
    ): RestResponseInterface {

        // search
        // crap switch - only testing!
        if (!empty($restConditionalAvailabilityRequestTransfer->getWarehouse())) {
            $result = $this->conditionalAvailabilityClient->conditionalAvailabilitySearchWarehouse(
                $restConditionalAvailabilityRequestTransfer->getWarehouse()
            );
        } else {
            $result = $this->conditionalAvailabilityClient->conditionalAvailabilitySearch(
                $restConditionalAvailabilityRequestTransfer->getSku(),
                new DateTime($restConditionalAvailabilityRequestTransfer->getDate())
            );
        }

        $responseTransfer = $this
            ->conditionalAvailabilityResourceMapper
            ->mapConditionalAvailabilityResultToResponseTransfer($result);

        return $this->buildConditionalAvailabilityResponse($restRequest, $responseTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer $conditionalAvailabilityRequestTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function buildConditionalAvailabilityResponse(
        RestRequestInterface $restRequest,
        RestConditionalAvailabilityPeriodResponseTransfer $conditionalAvailabilityRequestTransfer
    ): RestResponseInterface {
        $restResource = $this->restResourceBuilder->createRestResource(
            ConditionalAvailabilityRestApiConfig::RESOURCE_CONDITIONAL_AVAILABILITY,
            null,
            $conditionalAvailabilityRequestTransfer
        );

        //$response = $this->restResourceBuilder->createRestResponse($conditionalAvailabilityRequestTransfer->getPagination()->getNumFound());
        $response = $this->restResourceBuilder->createRestResponse();
        if (!$restRequest->getPage()) {
            $restRequest->setPage(new Page(0, static::DEFAULT_ITEMS_PER_PAGE));
        }

        return $response->addResource($restResource);
    }
}
