<?php

namespace App\Exports;

use App\User;
use App\InfoOrder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class SellersPeriodExport implements FromView
{
    public function __construct($ini, $end)
    {
        $this->ini = $ini;
        $this->end  = $end;
    }
    
    public function view(): View
    {
        return view('excel.sellers', [
            'data' => $this->getSellers()
        ]);
    }

    public function getSellers()  {

        $orders  = DB::table('fashionrecovery.GR_022')
                        //->where('OrderStatusID',8) habilitar para los envios confirmados
                        ->whereBetween('UpdateDate',[$this->ini,$this->end])->get(); 
        $users        = User::all();

        $sellers = $users->where('ProfileID',2);

        $result = $sellers->map(function ($user, $key) use ($orders) {
            $sells = 0;
            $gain  = 0;
            $total = 0;

            $keys = $orders->groupBy('ItemID')->keys();
            $items = $user->allItems->whereIn('ItemID',$keys);

            $items = $items->map(function ($item, $key) use ($orders) {
                $GainFR = $orders->where('ItemID',$item->ItemID)->first()->GainFR;
                $item->GainFR = $GainFR;

                return $item;
            });

            $total = $this->getGain($items,'ActualPrice');
            $gain  = $this->getGain($items,'GainFR');
            $sells = $items->count();
            
            return [
                'alias'  => $user->Alias,
                'gender' => $user->Gender,
                'age'    => date("Y") - date("Y", strtotime($user->Birthdate)),
                'sells'  => $sells,
                'total'  => $sells > 0 ? $total : 0,
                'gain'   => $sells > 0 ? $gain : 0
            ];
        });

        return $result->filter(function ($item) {
            return $item['sells'] > 0;
        });
    }

    public function getGain($orders, $keyGain) {
        $total = 0;

        foreach ($orders as $key => $item) {

            $replace = str_replace(',','',ltrim($item[$keyGain],'$'));
            $total += floatval($replace);
        }

        return $total;
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
