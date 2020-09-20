<?php

namespace App\Exports;

use App\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ShippingExport implements FromView
{
    public function view(): View
    {
        return view('excel.shipping', [
            'data' => $this->getshippingProm()
        ]);
    }

    public function getshippingProm() {

        $orders      = Order::all();

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
