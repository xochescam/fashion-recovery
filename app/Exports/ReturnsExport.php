<?php

namespace App\Exports;

use App\InfoOrder;
use App\Order;
use App\User;
use App\Rason;
use App\Devolution;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReturnsExport implements FromView
{
    public function view(): View
    {
        return view('excel.returns', [
            'data' => $this->getReturns()

        ]);
    }

    public function getReturns() {

        $rasons = Rason::all();
        $devolutions = Devolution::all();

        return $devolutions->map(function ($item, $key) use ($rasons) {
            
            $rason = $rasons->where('RasonID',$item->RasonID)->first()->Rason;

            return [
                'alias' => $item->user->Alias,
                'date' => $this->formatDate("d F Y", $item->CreatedDate),
                'monto' => $item->Amount,
                'rason' => $rason

            ];
        })->sortBy('alias');
    }

    protected function formatDate($format, $date) {

        $date    = date($format, strtotime($date));
        $explode = explode(" ", $date);
        $format = [];

        $months = [
                'January'   =>'enero',
                'February'  =>'febrero',
                'March'     =>'marzo',
                'April'     =>'abril',
                'May'       =>'Mayo',
                'June'      =>'junio',
                'July'      =>'julio',
                'August'    =>'agosto',
                'September' =>'septiembre',
                'October'   =>'octubre',
                'November'  =>'noviembre',
                'December'  =>'diciembre',
            ];

        return $explode[0].' de '.$months[$explode[1]].' '.$explode[2];
    }
}
