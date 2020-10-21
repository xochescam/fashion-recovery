<?php

namespace App\Exports;

use App\InfoOrder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

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

        $orders  = InfoOrder::whereBetween('CreationDate',[$this->ini,$this->end])->get();

        return $orders->map(function ($item, $key) {

            //Ajustar la cantidad de cobro de la guia generada en 022 para guardar una cantidad por prenda
            $amount = str_replace(',','',ltrim($item->order->ShippingAmount,'$'));
            $buyer = $item->order->user->id;
            $status = DB::table('fashionrecovery.GR_013')
                        ->where('OrderStatusID',$item->OrderStatusID)
                        ->first()->Name;
            $destino = DB::table('fashionrecovery.GR_002')
                        ->where('ShippingAddID',$item->order->ShippingID)
                        ->first()->State;
            return [
                'date' => $this->formatDate("d F Y", $item->CreationDate),
                'origen' => $item->Item->owner->infoSeller->LiveIn,
                'destino' => $destino,
                'packaging' => $item->PackingName,
                'ShippingAmount' => $amount + 60,
                'status' => $status
            ];
        });
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
