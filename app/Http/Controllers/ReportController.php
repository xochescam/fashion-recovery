<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\SellsExport;
use App\Exports\BuyersExport;
use App\Exports\DepartmentsExport;
use App\Exports\ReturnsExport;
use App\Exports\SellersExport;
use App\Exports\ShippingExport;
use App\Exports\SellsPeriodExport;
use App\Exports\BuyersPeriodExport;
use App\Exports\DepartmentsPeriodExport;
use App\Exports\ReturnsPeriodExport;
use App\Exports\SellersPeriodExport;
use App\Exports\ShippingPeriodExport;
use Maatwebsite\Excel\Facades\Excel;

use DB;
use Auth;
use Session;
use Redirect;
use Gate;

use App\User;
use App\Seller;
use App\Wallet;
use App\Item;
use App\Order;
use App\InfoOrder;
use App\Department;

class ReportController extends Controller
{
    public function getSellsExcel() {
        return Excel::download(new SellsExport, 'Ventas.xlsx');
    }

    public function getSellsPeriodExcel($ini, $end) {
        return Excel::download(new SellsPeriodExport($ini,$end), 'Ventas por periodo.xlsx');
    }

    public function getBuyersExcel() {
        return Excel::download(new BuyersExport, 'Compradores.xlsx');
    }

    
    public function getBuyersPeriodExcel($ini, $end) {
        return Excel::download(new BuyersPeriodExport($ini,$end), 'Compradores por periodo.xlsx');
    }

    public function getDepartmentsExcel() {
        return Excel::download(new DepartmentsExport, 'Departamentos.xlsx');
    }

    public function getDepartmentsPeriodExcel($ini, $end) {
        return Excel::download(new DepartmentsPeriodExport($ini,$end), 'Departamentos por periodo.xlsx');
    }

    public function getReturnsExcel() {
        return Excel::download(new ReturnsExport, 'Devoluciones.xlsx');
    }

    public function getReturnsPeriodExcel($ini, $end) {
        return Excel::download(new ReturnsPeriodExport($ini,$end), 'Devoluciones por periodo.xlsx');
    }

    public function getSellersExcel() {
        return Excel::download(new SellersExport, 'Vendedores.xlsx');
    }

    public function getSellersPeriodExcel($ini, $end) {
        return Excel::download(new SellersPeriodExport($ini,$end), 'Vendedores por periodo.xlsx');
    }

    public function getShippingExcel() {
        return Excel::download(new ShippingExport, 'Costos de envio.xlsx');
    }

    public function getShippingPeriodExcel($ini, $end) {
        return Excel::download(new ShippingPeriodExport($ini,$end), 'Costos de envio por periodo.xlsx');
    }

    public function DepartmentsByDate(Request $request) {

        if(!Auth::User()->isAdmin()) {
            abort(403);
        }

        $ini         = $request->ini;
        $end         = $request->end;
        //$end         = '2020-08-01';
        $departments = Department::all();
        $InfoOrders  = DB::table('fashionrecovery.GR_022')
                         //->where('OrderStatusID',8) habilitar para los envios confirmados
                         ->whereBetween('UpdateDate',[$ini,$end])
                         ->get(); 
        $ItemKeys    = $InfoOrders->groupBy('ItemID')->keys();
        $items       = Item::whereIn('ItemID',$ItemKeys)->get();
        
        return [
            'message' => 'success',
            'data' => $this->getGroupedDep($departments, $items, $InfoOrders)
        ];
    }

    public function BuyersByDate(Request $request) {

        if(!Auth::User()->isAdmin()) {
            abort(403);
        }

        $ini         = $request->ini;
        $end         = $request->end;
        //$end         = '2020-08-01';
        $users       = User::all();

        return [
            'message' => 'success',
            'data'    => $this->getBuyers($users, $ini, $end)->toArray()
        ];
    }

    public function SellsByDate(Request $request) {

        if(!Auth::User()->isAdmin()) {
            abort(403);
        }

        $ini         = $request->ini;
        $end         = $request->end;
        //$end         = '2020-08-01';
        $InfoOrders  = DB::table('fashionrecovery.GR_022')
                         //->where('OrderStatusID',8) habilitar para los envios confirmados
                        ->whereBetween('UpdateDate',[$ini,$end])
                        ->get()->groupBy('ItemID')->keys(); 
        $itemsSold   = Item::whereIn('ItemID',$InfoOrders)->get();
        
        return [
            'message' => 'success',
            'data'    => $this->getSells($itemsSold)->toArray()
        ];
    }

    public function SellersByDate(Request $request) {

        if(!Auth::User()->isAdmin()) {
            abort(403);
        }

        $ini         = $request->ini;
        $end         = $request->end;
        //$end         = '2020-08-01';
        $InfoOrders  = DB::table('fashionrecovery.GR_022')
                         //->where('OrderStatusID',8) habilitar para los envios confirmados
                         ->whereBetween('UpdateDate',[$ini,$end])->get(); 
        $users        = User::all();

        return [
            'message' => 'success',
            'data'    => $this->getSellers($users, $InfoOrders, $ini, $end)->toArray()
        ];
    }

    public function ReturnsByDate(Request $request) {

        if(!Auth::User()->isAdmin()) {
            abort(403);
        }

        $ini         = $request->ini;
        $end         = $request->end;
        $ordersKeys  = Order::all()->groupBy('UserID')->keys();
        $InfoOrders  = InfoOrder::whereBetween('UpdateDate',[$ini,$end])
                                ->where('OrderStatusID',5)->get();
        $buyerUsers  = User::whereIn('id',$ordersKeys)->get();

        return [
            'message' => 'success',
            'data'    =>  $this->getReturns($InfoOrders, $buyerUsers)->toArray()

        ];
    }

    public function ShippingByDate(Request $request) {

        if(!Auth::User()->isAdmin()) {
            abort(403);
        }

        $ini     = $request->ini;
        $end     = $request->end;
        //$end         = '2020-07-01';
        $orders  = Order::whereBetween('CreationDate',[$ini,$end])->get();

        return [
            'message' => 'success',
            'data'    =>  $this->getshippingProm($orders)
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::User()->isAdmin()) {
            abort(403);
        }

        $items       = Item::all();
        $users       = User::all();
        $InfoOrders  = InfoOrder::all();
        $orders      = Order::all();
        $departments = Department::all();
        $itemsSold   = $items->where('IsSold',true);
        $ordersFin   = $InfoOrders->where('OrderStatusID',8); //cambiar a las orders finalized
        $buyerUsers  = $users->whereIn('id',$orders->groupBy('UserID')->keys());
        $sellerUsers = $users->whereIn('id',$itemsSold->groupBy('OwnerID')->keys());
        $departments = $this->getGroupedDep($departments, $itemsSold, $InfoOrders)->toArray();
        $buyersList  = $this->getBuyers($users, null, null)->toArray();
        $sellersList = $this->getSellers($users, $InfoOrders, null, null)->toArray();
        $returnList  = $this->getReturns($InfoOrders->where('OrderStatusID',5), $buyerUsers)->toArray();
        $shippingCost = $this->getshippingProm($orders);
        $sells        = $this->getSells($itemsSold)->toArray();

        $date = [
            'year'  => date("Y"),
            'month' => date("m"),
            'day'   => date("d"),
        ];

        $data = [
            'gain'          => $this->getGain($InfoOrders,'GainFR'),
            'sold'          => $itemsSold->count(),
            'users'         => $users->count(),
            'devolutions'   => $orders->where('OrderStatusID',5)->count(),
            'department'    => $this->getDepartment($itemsSold),
            'clothingType'  => $this->getClothingType($itemsSold),
            'buyers'        => $users->where('ProfileID',1)->count(),
            'ageBuyers'     => $this->getAge($buyerUsers),
            'genderBuyers'  => $this->getGender($buyerUsers),
            'sellers'       => $users->where('ProfileID',2)->count(),
            'ageSellers'    => $this->getAge($sellerUsers),
            'genderSellers' => $this->getGender($sellerUsers),
            'shippingProm'  => $shippingCost->first()['ShippingAmount'],
        ];

        return view('reports.index',compact(
            'data','date','departments','buyersList','sellersList','returnList','shippingCost','sells'
        ));
    }

    public function getSells($itemsSold) {
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

    public function getshippingProm($orders) {

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

    public function getReturns($orders, $users) {

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

    public function getSellers($users, $orders, $ini, $end)  {
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

    public function getBuyers($users, $ini, $end) {
        $buyers = $users->where('ProfileID',1);
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

    public function getGroupedDep($departments, $items, $orders) {

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

    public function getAge($users) {

        return $users->map(function ($item, $key) {
            return date("Y") - date("Y", strtotime($item->Birthdate));
        })->avg();
    }

    public function getGender($users) {

        $gender = [
            'male'   => $users->where('Gender','Masculino')->count(),
            'female' => $users->where('Gender','Femenino')->count(),
        ];

        return $gender['male'] > $gender['female'] ? 'Masculino' : 'Femenino';
    }

    public function getDepartment($itemsSold) {

        $grouped = $itemsSold->groupBy('DepartmentID');

        $departments = $grouped->map(function ($item, $key) {
            
            return [
                'item'=> $item->first()->Department->DepName,
                'count'=> $item->count()
            ];

        })->sortByDesc('count');

        return $departments->first()['item'];
    }

    public function getClothingType($itemsSold) {

        $grouped = $itemsSold->groupBy('ClothingTypeID');

        $clothingTypes = $grouped->map(function ($item, $key) {
            
            return [
                'item'=> $item->first()->clothingType->ClothingTypeName,
                'count'=> $item->count()
            ];

        })->sortByDesc('count');

        return $clothingTypes->first()['item'];
    }
}
