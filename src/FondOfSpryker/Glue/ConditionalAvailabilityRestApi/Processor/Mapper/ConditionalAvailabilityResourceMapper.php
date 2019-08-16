<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\ConditionalAvailabilityRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestConditionalAvailabilityPeriodItemTransfer;
use Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer;

class ConditionalAvailabilityResourceMapper implements ConditionalAvailabilityResourceMapperInterface
{
    /**
     * @uses \Spryker\Client\Search\Plugin\Elasticsearch\ResultFormatter\SortedResultFormatterPlugin::NAME
     */
    protected const SORT_NAME = 'sort';

    protected const SEARCH_KEY = 'period';

    /**
     * @param array $result
     *
     * @return \Generated\Shared\Transfer\RestConditionalAvailabilityPeriodResponseTransfer
     */
    public function mapConditionalAvailabilityResultToResponseTransfer(
        array $result
    ): RestConditionalAvailabilityPeriodResponseTransfer {
        $transfer = new RestConditionalAvailabilityPeriodResponseTransfer();
        $transfer->fromArray($result, true);

        if (!array_key_exists(static::SEARCH_KEY, $result)) {
            return $transfer;
        }

        foreach ($result[static::SEARCH_KEY] as $period) {
            $restConditionalAvailabilityPeriodItemTransfer = (new RestConditionalAvailabilityPeriodItemTransfer())
                ->fromArray($period, true);

            $transfer->addPeriods($restConditionalAvailabilityPeriodItemTransfer);
        }

        return $transfer;
    }
}
