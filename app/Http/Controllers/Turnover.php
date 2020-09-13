<?php

namespace App\Http\Controllers;

use App\TurnoverM;

/**
 * Turnover controller class
 *
 * Fetch data from the model class and prepare the view
 *   
 */
class Turnover extends Controller
{
    /**
     * Make the on screen view of the weekly report
     *
     * @param string $startDate Report start date
     * @param string $endDate Report end date
     * 
     * @return string return the prpared view
     */
    public function show(): ?string
    {
        (object) $turnover = new TurnoverM();
        (array) $data = $turnover->collectData();
        return view('turnover', $data);
    }
}
