<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper;

use Elastica\ResultSet;
use Generated\Shared\Transfer\RestConditionalAvailabilityPeriodItemTransfer;
use Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer;

class ConditionalAvailabilityResourceMapper implements ConditionalAvailabilityResourceMapperInterface
{
    /**
     * @uses \Spryker\Client\Search\Plugin\Elasticsearch\ResultFormatter\SortedResultFormatterPlugin::NAME
     */
    protected const SORT_NAME = 'sort';

    /**
     * @param \Elastica\ResultSet $resultSet
     *
     * @return \Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer
     */
    public function mapConditionalAvailabilityResultToResponseTransfer(ResultSet $resultSet): RestConditionalAvailabilityPeriodResponseTransfer
    {
        $transfer = new RestConditionalAvailabilityPeriodResponseTransfer();

        if ($resultSet->count() > 0) {
            foreach ($resultSet->getResults() as $item) {
                $transfer->addPeriods((new RestConditionalAvailabilityPeriodItemTransfer())->fromArray($item->getData(), true));
            }
        }

        $transfer->setTotal(\count($transfer->getPeriods()));

        return $transfer;
    }
}
