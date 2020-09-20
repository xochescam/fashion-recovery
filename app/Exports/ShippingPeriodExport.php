<?php

namespace App\Exports;

use App\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ShippingPeriodExport implements FromView
{
    public function __construct($ini, $end)
    {
        $this->ini = $ini;
        $this->end  = $end;
    }
    
    public function view(): View
    {
        return view('excel.shipping', [
            'data' => $this->getshippingProm()
        ]);
    }

    public function getshippingProm() {

        $orders  = Order::whereBetween('CreationDate',[$this->ini,$this->end])->get();


        $shippingProm = $orders->map(function ($item, $key) {

            return [
                'ShippingAmount' => $item->ShippingAmount
            ];
        })->groupBy('ShippingAmount');

        return $shippingProm->map(function ($item, $key) {
            return [
                'ShippingAmount' => $item->first()['ShippingAmount'],
                'count' => $item->count()
            ];
        });
    }
}
