<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Session;
use Redirect;

use App\Order;
use App\InfoOrder;
use App\States;
use App\User;
use App\Seller;
use App\Question;
use App\Answer;
use App\Devolution;
use App\PackPack;
use App\Wallet;

class SellController extends Controller
{
    public function index() { //ordenar pedidos por usuarios

        //Auth::loginUsingId(174);
        $evaluations = 0;
        $ranking = 0;
        $orders    = null;
        $pending   = null;
        $finalized = null;
        $canceled  = null;
        $user      = Auth::User();
        $pendingWallet   = 0;
        $avaliableWallet = 0;
        $ranking     = [0,0,0,0,0]; 
        $commission = User::getCommission(Auth::User());

    	$itemIds = DB::table('fashionrecovery.GR_029')
                    ->where('GR_029.OwnerID',Auth::User()->id)
                    ->where('GR_029.IsSold',true)
                    ->get()->groupBy('ItemID')->keys();

    	$sells = DB::table('fashionrecovery.GR_029')
                        ->join('fashionrecovery.GR_022', 'GR_029.ItemID', '=', 'GR_022.ItemID')
                        ->join('fashionrecovery.GR_021', 'GR_022.OrderID', '=', 'GR_021.OrderID')
                        ->join('fashionrecovery.GR_001', 'GR_021.UserID', '=', 'GR_001.id')
                        ->join('fashionrecovery.GR_013', 'GR_022.OrderStatusID', '=', 'GR_013.OrderStatusID')
                        ->whereIn('GR_029.ItemID',$itemIds)
                        ->select('GR_029.ItemID',
                                 'GR_029.OffSaleID',
                                 'GR_029.ItemDescription',
                                 'GR_029.OriginalPrice',
                                 'GR_029.ActualPrice',
                                 'GR_029.SizeID',
                                 'GR_029.BrandID',
                                 'GR_021.TotalAmount',
                                 'GR_022.NoOrder',
                                 'GR_022.CreationDate',
                                 'GR_022.UpdateDate',
                                 'GR_022.FolioID',
                                 'GR_001.Alias as Buyer',
                                 'GR_013.Name',
                                 'GR_022.OrderID',
                                 'GR_022.GuideID',
                                 'GR_022.GuideURL',
                                 'GR_022.TrackingURL',
                                 'GR_022.PackingOrderID',
                                 'GR_022.IsReturn',
                                 'GR_029.IsPaid',
                                 'GR_013.Name as StatusName'
                             )->get();
        
        

        $sells = $sells->map(function ($item, $key) use ($user, $commission){


            /*             if($item->StatusName === 'Transito' || $item->StatusName === 'Devuelto') {
 */         if($item->StatusName === 'Transito' ) {

                $tracking   = PackPack::tracking($item->PackingOrderID);
                $last       = collect($tracking)->last()['status'];
                $status     = $item->StatusName === 'Transito' ? 4 : 9;
                $statusName = $item->StatusName === 'Transito' ? 'Entregado' : 'Devolución entregada';

                if($last === 'Entregado') {
                    $this->UpdateOrderStatus($item->OrderID, $status);
                    $item->StatusName = $statusName;
                    $item->Name = $statusName;

                    $existsWallet = Wallet::where('UserID',Auth::User()->id)->first();

                    if(isset($existsWallet->Amount)) {

                        $Amount = str_replace(',', '', ltrim($existsWallet->Amount, '$'));
                        $ActualPrice = str_replace(',', '', ltrim($item->ActualPrice, '$'));

                        $existsWallet->Amount = $Amount + ($ActualPrice - ($ActualPrice * $commission));
                        $existsWallet->save();
                        
                    } else {

                        $ActualPrice = str_replace(',', '', ltrim($item->ActualPrice, '$'));

                        $wallet = new Wallet;
                        $wallet->UserID = Auth::User()->id;
                        $wallet->CreatedDate = date("Y-m-d H:i:s");
                        $wallet->Amount = $ActualPrice - ($ActualPrice * $commission);
                        $wallet->save();
                    }
                }
            }

            $current = str_replace(',', '', substr($item->ActualPrice, 1));
            $devolution = Devolution::where('OrderID',$item->OrderID)->first();
            
            $item->ThumbPath     = $user->getThumbPath($item);
            $item->BrandID       = $user->getBrand($item);
            $item->SizeID        = $user->getSize($item);
            $item->CreationDate  = $this->formatDate("d F Y", $item->CreationDate);
            $item->update        = $this->formatDate("d F Y", $item->UpdateDate);
            $item->Gain          = $current - ($current * User::getCommission($user));
            $item->ReturnID      = isset($devolution->ReturnID) ? $devolution->ReturnID : Null;

            return $item;
        });

        $pending   = $sells->where('Name','!==','Entregado')
                            ->where('Name','!==','Cancelado')
                            ->where('Name','!==','Devuelto')
                            ->where('Name','!==','Reembolsado')
                            ->where('Name','!==','Confirmado')
                            ->where('Name','!==','Devolución entregada')
                            ->where('Name','!==','Devolución confirmada');
        $finalized = $sells->where('Name','!==','Cancelado')
                            ->where('StatusName','!==','Transito')
                            ->where('Name','!==','Solicitado')
                            ->where('Name','!==','Devuelto')
                            ->where('Name','!==','Devolución entregada')
                            ->where('Name','!==','Devolución confirmada');
        $canceled  = $sells->where('Name','Cancelado');
        $return    = $sells->where('StatusName','!==','Transito')
                            ->where('Name','!==','Entregado')
                            ->where('Name','!==','Cancelado')
                            ->where('Name','!==','Confirmado'); 

        $pendingWallet = $sells->where('Name','!==','Cancelado')
                               ->where('Name','!==','Devuelto')
                               ->where('Name','!==','Reembolsado');
        
        $pendingWallet = $pendingWallet->filter(function ($item, $key) {
        
            $current = strtotime(date("Y-m-d H:i:s"));
            $update  = strtotime(date("Y-m-d H:i:s",strtotime($item->UpdateDate)));
            $segs    = $current - $update;
            $hrs     = $segs / 3600;

            return $hrs < 24 && !$item->IsPaid;

        })->sum('Gain'); 

        $avaliableWallet = $finalized->filter(function ($item, $key) {

            $current = strtotime(date("Y-m-d H:i:s"));
            $update  = strtotime(date("Y-m-d H:i:s",strtotime($item->UpdateDate)));            
            $segs    = $current - $update;
            $hrs     = $segs / 3600;
            
            return $hrs > 24 && !$item->IsPaid;

        })->sum('Gain');  
        
        $wallet = Wallet::where('UserID',Auth::User()->id)->first();
        $IsTransfer = $wallet ? $wallet->IsTransfer : false;
        //$IsTransfer = Seller::where('UserID',Auth::User()->id)->first()->IsTransfer;

        $items = DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_032', 'GR_029.ItemID', '=', 'GR_032.ItemID')
                    ->where('GR_032.IsCover',true)
                    ->where('GR_029.OwnerID',Auth::User()->id)
                    ->select('GR_032.ThumbPath','GR_029.ItemID')
                    ->count();

        $seller = DB::table('fashionrecovery.GR_001')
                    ->join('fashionrecovery.GR_033', 'GR_001.id', '=', 'GR_033.UserID')
                    ->where('GR_001.Alias',Auth::User()->Alias)
                    ->where('GR_001.Confirmed',1)
                    ->where('GR_001.ProfileID',2)
                    ->select('GR_001.Alias',
                             'GR_001.Name',
                             'GR_001.Lastname',
                             'GR_033.Greeting',
                             'GR_033.AboutMe',
                             'GR_033.LiveIn',
                             'GR_033.WorkIn',
                             'GR_033.TotalEvaluations',
                             'GR_033.ItemsSold',
                             'GR_033.ItemsReturned',
                             'GR_033.Ranking',
                             'GR_033.SelfiePath',
                             'GR_033.SelfieThumbPath',
                             'GR_001.id',
                             'GR_033.SellerSince',
                             'GR_033.UserID',
                             'GR_033.Phone',
                             'GR_033.IdentityDocumentPath')
                    ->first();

        $sellerSince = $this->formatDate("d F Y", $seller->SellerSince);
        $states      = States::get();
        $questions   = Question::where('Active',true)->get();
        $answers     = Answer::whereIn('ItemID',$itemIds)->get();

        if(count($answers) > 0) {
            $evaluations = $answers->groupBy('ItemID')->count();
            $mean        = $answers->where('QuestionID',1);
            $result      = round($mean->sum('Answer')/$mean->count());
    
            for ($i=0; $i < $result; $i++) { 
                $ranking[$i] = 1;
            }
    
            $answers = $answers->map(function ($item, $key) use ($questions) {
                $ranking = [0,0,0,0,0]; 
    
                for ($i=0; $i < $item->Answer; $i++) { 
                    $ranking[$i] = 1;
                }
    
                $item->Answer = is_numeric($item->Answer) ? $ranking :$item->Answer;
                $item->QuestionID = $questions->where('QuestionID',$item->QuestionID)
                                                ->first()->Question;
                return $item;

            })->groupBy('ItemID');
        }

    	return view('sells.index',
            compact(
                    'states',
                    'pending',
                    'finalized',
                    'canceled',
                    'sells',
                    'seller',
                    'items',
                    'sellerSince',
                    'pendingWallet',
                    'avaliableWallet',
                    'IsTransfer',
                    'questions',
                    'ranking',
                    'evaluations',
                    'answers',
                    'return',
                    'wallet'));
    }

    public function UpdateOrderStatus($OrderID, $status) {

        $order = Order::findOrFail($OrderID);
        $order->OrderStatusID = $status;
        $order->save();

        $info = InfoOrder::where('OrderID',$OrderID)->first();
        $info->OrderStatusID = $status;
        $info->UpdateDate    = date("Y-m-d H:i:s");
        $info->save();
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

    public function update(Request $request, $id) {

        DB::table('fashionrecovery.GR_021')
                ->where('OrderID',$id)
                ->update(['OrderStatusID' => $request->OrderID]);

        Session::flash('success','Se ha actualizado correctamente el estado de la venta.');
        return Redirect::to('sells');
    }
}
