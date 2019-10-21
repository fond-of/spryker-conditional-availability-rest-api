<?php

declare(strict_types = 1);

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
     * @return \FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper\ConditionalAvailabilityResourceMapperInterface
     */
    public function createConditionalAvailabilityResourceMapper(): ConditionalAvailabilityResourceMapperInterface
    {
        return new ConditionalAvailabilityResourceMapper();
    }

    /**
     * @return \FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\ConditionalAvailability\ConditionalAvailabilityReaderInterface
     */
    public function createConditionalAvailabilityReader(): ConditionalAvailabilityReaderInterface
    {
        return new ConditionalAvailabilityReader(
            $this->getConditionalAvailabilityClient(),
            $this->createConditionalAvailabilityResourceMapper(),
            $this->getResourceBuilder()
        );
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface
     */
    public function getConditionalAvailabilityClient(): ConditionalAvailabilityClientInterface
    {
        return $this->getProvidedDependency(ConditionalAvailabilityRestApiDependencyProvider::CLIENT_CONDITIONAL_AVAILABILITY);
    }
}
