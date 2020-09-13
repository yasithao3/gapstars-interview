<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TurnoverExportClass;
use App\TurnoverM;

/**
 * Turnover Export controller class
 *
 * Download as a csv report
 *   
 */
class TurnoverExport extends Controller
{
    /**
     * Downloadable csv file of the weekly report
     *      
     * @return download the csv file created with the blade view file refer: Exports/TurnoverExportClass
     */
    public function export()
    {
        return Excel::download(new TurnoverExportClass, 'documents-report.csv');
    }
}
