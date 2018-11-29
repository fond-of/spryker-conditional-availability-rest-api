<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi;

use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\ConditionalAvailability\ConditionalAvailabilityReader;
use FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\ConditionalAvailability\ConditionalAvailabilityReaderInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper\ConditionalAvailabilityResourceMapper;
use FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper\ConditionalAvailabilityResourceMapperInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class ConditionalAvailabilityRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\ConditionalAvailability\ConditionalAvailabilityReaderInterface
     */
    public function createConditionalAvailabilityWriter(): ConditionalAvailabilityReaderInterface
    {
        return new ConditionalAvailabilityReader(
            $this->getConditionalAvailability(),
            $this->createConditionalAvailabilityResourceMapper(),
            $this->getResourceBuilder()
        );
    }

    /**
     * @return \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface
     */
    public function getConditionalAvailability(): ConditionalAvailabilityClientInterface
    {
        return $this->getProvidedDependency(ConditionalAvailabilityRestApiDependencyProvider::CLIENT_CONDITIONAL_AVAILABILITY);
    }

    /**
     * @return \FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper\ConditionalAvailabilityResourceMapperInterface
     */
    public function createConditionalAvailabilityResourceMapper(): ConditionalAvailabilityResourceMapperInterface
    {
        return new ConditionalAvailabilityResourceMapper();
    }
}
