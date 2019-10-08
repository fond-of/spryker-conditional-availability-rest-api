<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer;

class ConditionalAvailabilityResourceMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper\ConditionalAvailabilityResourceMapper
     */
    protected $conditionalAvailabilityResourceMapper;

    /**
     * @var array
     */
    protected $results;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->results = [
            'period' => [
                ["test"],
            ],
        ];

        $this->conditionalAvailabilityResourceMapper = new ConditionalAvailabilityResourceMapper();
    }

    /**
     * @return void
     */
    public function testMapConditionalAvailabilityResultToResponseTransfer(): void
    {
        $this->assertInstanceOf(RestConditionalAvailabilityPeriodResponseTransfer::class, $this->conditionalAvailabilityResourceMapper->mapConditionalAvailabilityResultToResponseTransfer($this->results));
    }

    /**
     * @return void
     */
    public function testMapConditionalAvailabilityResultToResponseTransferEmpty(): void
    {
        $this->assertInstanceOf(RestConditionalAvailabilityPeriodResponseTransfer::class, $this->conditionalAvailabilityResourceMapper->mapConditionalAvailabilityResultToResponseTransfer([]));
    }
}
