<?php

namespace App\Analytics\Domain\Traits;

use Illuminate\Support\Facades\DB;

trait AdStatistics
{
    /**
     * Index Visitors statistics data grouped by
     *
     * @param string $table name of the original table to select from
     * @param string $pivot name of the pivot table
     *
     * @return Object object consists of the groupedby value and it's visitors number
     */
    public function indexVisitorsStats($table, $pivot)
    {
        return DB::table($table)
        ->join(
            $pivot,
            $pivot . '.' . $this->getPivotForeignKey($pivot),
            '=',
            $table . '.id'
        )
        ->selectRaw('
            value,
            sum(visitors_number) as visitors_number
        ')
        ->groupBy(
            $pivot . '.' . $this->getPivotForeignKey($pivot)
        )
        ->whereRaw(
            $this->whereClause()
        )->get();
    }

    public function storeStatistics(array $googleAnalyticsData, Object $relatedModel, array $pivotUpdates = [])
    {
        if (!empty($googleAnalyticsData)) {
            foreach ($googleAnalyticsData as $data) {
                // value to fetch or create new record with
                $value = [
                    'value' => $data['value'],
                ];
                // crete stats record in the related table
                $record = $relatedModel->firstorCreate($value);
                // attach the main model to related model if they aren't attached yet
                if (!$record->{$this->mainModel . 's'}
                      ->contains($this->{$this->mainModel}->id)
                ) {
                    $record->{$this->mainModel . 's'}()
                      ->attach($this->{$this->mainModel}->id);
                }
                // update the picote table to add visitors_number and advertiser_id
                $record->{$this->mainModel . 's'}()
                    ->updateExistingPivot(
                        $this->{$this->mainModel}->id,
                        array_merge(
                            [
                                'visitors_number' => $data['visitors_number']
                            ],
                            $pivotUpdates
                        )
                    );
            }
        }
    }

    protected function getPivotForeignKey(string $pivot = '')
    {
        $pivotForeignKey = substr($pivot, 0, strrpos($pivot, '_', -1)) . '_id';

        return $pivotForeignKey;
    }

    public function whereClause()
    {
        return $this->whereClause;
    }
}
