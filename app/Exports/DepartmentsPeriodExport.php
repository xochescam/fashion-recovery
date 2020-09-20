<?php

namespace App\Exports;

use App\Department;
use App\InfoOrder;
use App\Item;

use DB;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DepartmentsPeriodExport implements FromView
{
    public function __construct($ini, $end)
    {
        $this->ini = $ini;
        $this->end  = $end;
    }
    
    public function view(): View
    {
        return view('excel.departments', [
            'data' => $this->getGroupedDep()
        ]);
    }

    public function getGroupedDep() {

        $departments = Department::all();
        $orders      = DB::table('fashionrecovery.GR_022')
                         //->where('OrderStatusID',8) habilitar para los envios confirmados
                         ->whereBetween('UpdateDate',[$this->ini,$this->end])
                         ->get(); 
        $ItemKeys    = $orders->groupBy('ItemID')->keys();
        $items       = Item::whereIn('ItemID',$ItemKeys)->get();

        $items = $items->map(function ($item, $key) use ($orders) {

            $order = $orders->where('ItemID',$item->ItemID)->first();
            $item->GainFR = isset($order->GainFR) ? $order->GainFR : 0;
        
            return $item;
        })->groupBy('DepartmentID');

        return $departments->map(function ($item, $key) use ($items) {

            $has   = isset($items[$item->DepartmentID]);
            $sells = $has ? $items[$item->DepartmentID]->count() : 0;
            $gain  = $has ? $this->getGain($items[$item->DepartmentID],'GainFR') : 0;

            return [
                'name' => $item->DepName,
                'gain' => $gain,
                'sells' => $sells,                
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
