<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class ReportNinePointOneExportFile implements WithStrictNullComparison,FromView,ShouldAutoSize,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Transaction::all();
    // }

    // public function headings(): array
    // {
    //     return ["ID", "Name", "Email"];
    // }

    public function view(): View
    {
        return view('reports.report_nine_point_one', [
            'transactions' => Transaction::all()
        ]);
    }
    public function title(): string
    {
        return "Government Of the people's Republic of bangladesh national Board of Revenue value added tax return form";
    }
}
