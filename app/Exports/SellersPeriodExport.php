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

        return $sellers->map(function ($user, $key) use ($orders) {
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
        
        return $sellers->map(function ($user, $key) use ($orders, $ini, $end) {

            $sells = 0;
            $gain  = 0;
            $total = 0;

            foreach ($user->allItems as $key => $item) {
                $isSold = $user->allItems->where('IsSold',true);
                $sells  = $isSold->count();
    
                $items = $isSold->map(function ($item, $key) use ($orders, $ini, $end) {
                    $isPeriod = $ini !== null && $end !== null;
                    $ini      = '2020-01-01';
                    $end      = '2020-08-01';

                    $order = $isPeriod ?
                             $orders->where('ItemID',$item->ItemID)
                                    ->whereBetween('UpdateDate',[$ini,$end])
                                    ->first() :
                             $orders->where('ItemID',$item->ItemID)->first();
                    $item->GainFR = isset($order->GainFR) ? $order->GainFR : 0;
                        
                    return $item;
                });
    
                $total = $this->getGain($items,'ActualPrice');
                $gain  = $this->getGain($items,'GainFR');
            }

            return [
                'alias'  => $user->Alias,
                'gender' => $user->Gender,
                'age'    => date("Y") - date("Y", strtotime($user->Birthdate)),
                'sells'  => $sells,
                'total'  => $sells > 0 ? $total : 0,
                'gain'   => $gain
            ];
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
}
