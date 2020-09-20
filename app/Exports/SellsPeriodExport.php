<?php

namespace App\Exports;

use App\InfoOrder;
use Maatwebsite\Excel\Concerns\FromCollection;

class SellsPeriodExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return InfoOrder::all();
    }
}
