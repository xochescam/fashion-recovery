<?php

namespace App\Exports;

use App\InfoOrder;
use App\Order;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReturnsPeriodExport implements FromView
{
    public function __construct($ini, $end)
    {
        $this->ini = $ini;
        $this->end  = $end;
    }
    
    public function view(): View
    {
        return view('excel.returns', [
            'data' => $this->getReturns()

        ]);
    }

    public function getReturns() {
        $ordersKeys  = Order::all()->groupBy('UserID')->keys();
        $orders  = InfoOrder::whereBetween('UpdateDate',[$this->ini,$this->end])
                                ->where('OrderStatusID',5)->get();
        $users  = User::whereIn('id',$ordersKeys)->get();

        $grouped = $orders->map(function ($item, $key) {

            $item->UserID = $item->order->UserID;
            return $item;

        })->groupBy('UserID');

        $result = $users->map(function ($user, $key) use ($grouped) {

            $returns = 0;

            foreach ($grouped as $key => $item) { //Revisar

                if($key === $user->id) {
                    $returns = $item->count();
                }
            }

            return [
                'alias'    => $user->Alias,
                'gender'   => $user->Gender,
                'age'      => date("Y") - date("Y", strtotime($user->Birthdate)),
                'returns'  => $returns,
            ];
            
        })->sortByDesc('returns');

        return $result->filter(function ($item, $key) {

            return $item['returns'] > 0;
        });
    }
}
