<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\TurnoverM;

/**
 * Turnover Export controller class
 *
 * Prepare csv file using the blade view file
 *   
 */
class TurnoverExportClass implements FromView
{
    /**
     * Prepare csv view file
     *      
     * @return string prepared csv file from the blade view file
     */
    public function view(): View
    {
        (object) $turnover = new TurnoverM();
        (array) $data = $turnover->collectData();
        return view('turnover-export', $data);
    }
}
