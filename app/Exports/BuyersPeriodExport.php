<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;

class BuyersPeriodExport implements FromView
{
    public function __construct($ini, $end)
    {
        $this->ini = $ini;
        $this->end  = $end;
    }

    /**
     * @return Builder
     */
    public function view(): View
    {
        return view('excel.buyers', [
            'data' => $this->getBuyers()
        ]);
    }

    public function getBuyers() {
        $users    = User::all();
        $buyers   = $users->where('ProfileID',1);
        $ini      = $this->ini;
        $end      = $this->end;
        $isPeriod = $ini !== null && $end !== null;

        return $buyers->map(function ($user, $key) use ($isPeriod, $ini, $end) {

            $buys  = 0;
            $gain  = 0;
            $total = 0;

            foreach ($user->order as $key => $item) {

                $info = $isPeriod ? 
                        $item->info->whereBetween('UpdateDate',[$ini,$end]) : 
                        $item->info;

                $buys     = $info->count();
                $gain     = $this->getGain($info,'GainFR');
                $replace  = str_replace(',','',ltrim($item['TotalAmount'],'$'));
                $total   += $buys > 0 ? floatval($replace) : 0;
            }

            return [
                'alias'  => $user->Alias,
                'gender' => $user->Gender,
                'age'    => date("Y") - date("Y", strtotime($user->Birthdate)),
                'buys'   => $buys,
                'total'  => $total,
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
