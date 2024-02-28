<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportNinePointOneExcel extends Controller
{
    private $excel;
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    public function excelReport()
    {
        return view('reports.pdf.reportninepoint1');
        // return view('reports.report_nine_point_one');
        // return $this->excel->download(new ReportNinePointOneExportFile, 'nine_point_one.xlsx');
    }
}
