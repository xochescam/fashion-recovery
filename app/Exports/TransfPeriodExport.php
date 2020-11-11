<?php

namespace App\Exports;

use App\Wallet;
use App\Item;
use App\User;
use App\Bank;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransfPeriodExport implements FromView
{
    public function __construct($ini, $end)
    {
        $this->ini = $ini;
        $this->end  = $end;
    }
    
    public function view(): View
    {
        return view('excel.bank', [
            'data' => $this->getBank()
        ]);
    }

    public function getBank() {

        $trans  = Wallet::whereBetween('TransferDate',[$this->ini,$this->end])->get();


        return $trans->map(function ($item, $key) {

            $user = User::where('id',$item->UserID)->first();
            $bank = DB::table('fashionrecovery.GR_053')
                     ->where('UserID',$item->UserID)->first();
            $BankDesc = Bank::where('BankID',$bank->Bank)->first()->BankDesc;

            return [
                'transDate' => $this->formatDate("d F Y", $item->TransferDate),
                'paidDate' => $this->formatDate("d F Y", $item->PaidDate),
                'alias' => $user->Alias,
                'name' => $user->Name .' '.$user->Lastname,
                'clabe' => $bank->Clabe,
                'bank' => $BankDesc,
                'amount' => $item->Amount
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
