<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Turnover model class
 *
 * Fetch data and prapare for export and on screen visuals
 *   
 */
class TurnoverM extends Model
{
    /**
     * The table name related with this model file
     * 
     * @var string $table
     */
    protected $table = 'gmv';
    /**
     * Fetch data from database
     *
     * @param string $startDate Report start date
     * @param string $endDate Report end date
     * 
     * @return array $result the data set fetched within the start and end date
     */
    public function getReportData($startDate, $endDate): ?array
    {
        $startDateC = Carbon::parse($startDate);
        $endDateC = Carbon::parse($endDate);
        $query = TurnoverM::query();
        $query->select('name', 'date', 'turnover');
        $query->whereRaw('date >= ?', [$startDateC->format('Y-m-d')]);
        $query->whereRaw('date <= ?', [$endDateC->format('Y-m-d')]);
        $query->join('brands', 'gmv.brand_id', '=', 'brands.id');
        (array)  $result = $query->get()->toArray();
        return $result;
    }
    /**
     * format data for the presentation
     *
     * @param string $startDate Hard coded date string
     * @param string $endDate Hard coded date string
     * @param array $dataset Fetched data from the database
     * @param array $collection Laravel collection
     * @param array $grouped Laravel collection grouped by the brand name column
     * @param array $newDataset array to hold the formated data set
     * @return array $data return the formated data to the controller
     */
    public function collectData(): ?array
    {
        (string) $startDate = '01-05-2018';
        (string) $endDate = '07-05-2018';
        (array) $dataset = $this->getReportData($startDate, $endDate);
        $collection = collect($dataset);
        (array) $grouped = $collection->groupBy('name')->toArray();
        (array) $newDataset = [];
        if (!empty($grouped)) {
            foreach ($grouped as $key => $val) {
                $newDataset[$key]['data'] = $val;
                $newDataset[$key]['weeklySum'] = collect($val)->sum('turnover');
                $newDataset[$key]['excVat'] = collect($val)->sum('turnover') / 1.21;
            }
        }
        $data['dataset'] = $newDataset;
        $data['from'] = $startDate;
        $data['to'] = $endDate;
        return $data;
    }
}
