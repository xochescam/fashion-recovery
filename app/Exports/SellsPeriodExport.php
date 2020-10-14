<?php

namespace App\Exports;

use App\InfoOrder;
use App\Item;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class SellsPeriodExport implements FromView
{
    public function __construct($ini, $end)
    {
        $this->ini = $ini;
        $this->end  = $end;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('excel.sells', [
            'data' => $this->getSells()

        ]);
    }

    public function getSells() {

        //$end         = '2020-08-01';
        $InfoOrders  = DB::table('fashionrecovery.GR_022')
                         //->where('OrderStatusID',8) habilitar para los envios confirmados
                        ->whereBetween('UpdateDate',[$this->ini,$this->end])
                        ->get()->groupBy('ItemID')->keys(); 

        $itemsSold   = Item::whereIn('ItemID',$InfoOrders)->get();

        return $itemsSold->map(function ($item, $key) {

            $user         = $item->User->first();
            $seller       = $user->infoSeller;
            $comission    = User::getCommission($user);
            $level        = $this->getLevel($comission);
            $currentPrice = floatval(str_replace(',','',ltrim($item->ActualPrice,'$')));
            $commisionFR  =  $currentPrice  * $comission;
            $order        = InfoOrder::where('ItemID',$item->ItemID)->first()->order;
            $shipping     = floatval(str_replace(',','',ltrim($order->ShippingAmount,'$')));;

            return [
                'date' => $this->formatDate("d F Y", $order->CreationDate),
                'alias' => $user->Alias,
                'level' => $level,
                'gender' => $user->Gender,
                'age' => date("Y") - date("Y", strtotime($user->Birthdate)),
                'livein' => $seller->LiveIn,
                'type' => $item->clothingType->ClothingTypeName,
                'import' => $item->ActualPrice,
                'comission' => $commisionFR,
                'gainSeller' => $currentPrice - $commisionFR,
                'transaction' => '0', //mercado pago
                'shipping' => $order->ShippingAmount,
                'gainFR' => $commisionFR - ($shipping + 0) //el segundo parametro es el de mp
            ];
        });
    }

    public function getLevel($comission) {
        $levels = [
            0.18 => 'Eco-friendly',
            0.19 => 'Green',
            0.2 => 'Básico'
        ];

        return $levels[$comission];
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
