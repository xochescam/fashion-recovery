<?php

namespace App\Exports;

use App\InfoOrder;
use App\Order;
use App\User;
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
        $orders  = InfoOrder::all()->where('OrderStatusID',5);
        $users = User::all()->whereIn('id',Order::all()->groupBy('UserID')->keys());

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
