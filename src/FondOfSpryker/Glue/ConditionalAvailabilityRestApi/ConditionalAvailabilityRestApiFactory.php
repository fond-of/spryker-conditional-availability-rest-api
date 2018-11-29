<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi;

use FondOfSpryker\Client\ConditionalAvailability\ConditionalAvailabilityClientInterface;
use FondOfSpryker\Glue\CustomersRestApi\Processor\Customers\ConditionalAvailabilityWriter;
use Spryker\Glue\CustomersRestApi\Processor\Customers\CustomersWriter;
use Spryker\Glue\CustomersRestApi\Processor\Customers\CustomersWriterInterface;
use Spryker\Glue\CustomersRestApi\Processor\Mapper\CustomersResourceMapper;
use Spryker\Glue\CustomersRestApi\Processor\Mapper\CustomersResourceMapperInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class ConditionalAvailabilityRestApiFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Glue\CustomersRestApi\Processor\Customers\CustomersWriterInterface
     */
    public function createCustomersWriter(): CustomersWriterInterface
    {
        return new ConditionalAvailabilityWriter(
            $this->getCustomerClient(),
            $this->getResourceBuilder(),
            $this->createCustomersResourceMapper()
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
     * @return \Spryker\Glue\CustomersRestApi\Processor\Mapper\CustomersResourceMapperInterface
     */
    public function createCustomersResourceMapper(): CustomersResourceMapperInterface
    {
        return new CustomersResourceMapper(
            $this->getResourceBuilder()
        );
    }
}
