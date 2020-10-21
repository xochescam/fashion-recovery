<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ResponseBuyer;
use App\Mail\ResponseSeller;
use App\Mail\ResponseSellerReturn;
use App\Mail\ResponseBuyerReturn;
use App\Mail\ResponseReturn;

use DB;
use Redirect;
use Session;
use Auth;
use Gate;
use Image;
use Mail;

use App\Order;
use App\InfoOrder;
use App\Item;
use App\ItemInfo;
use App\PackPack;
use App\Question;
use App\Answer;
use App\Rason;
use App\ReturnImg;
use App\Devolution;
use App\User;
use App\Status;
use App\ReturnComments;
use App\Wallet;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class OrderController extends Controller
{
	protected $table = 'fashionrecovery.GR_021';
	protected $detail = 'fashionrecovery.GR_022';

    public function index() { //ordenar pedidos por usuarios

        if (Gate::denies('show-orders')) {
            abort(403);
        }

    	$user      = Auth::User();

    	$orders = DB::table($this->table)
                    ->join('fashionrecovery.GR_013', 'GR_021.OrderStatusID', '=', 'GR_013.OrderStatusID')
                    ->where('UserID',Auth::User()->id)
                    ->select('GR_021.TotalAmount','GR_021.OrderID','GR_013.Name')
                    ->get();

        $keys = $orders->groupBy('OrderID')->keys();

		$items = DB::table($this->detail)
		            ->join('fashionrecovery.GR_029', 'GR_022.ItemID', '=', 'GR_029.ItemID')
                    ->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
                    ->join('fashionrecovery.GR_013', 'GR_022.OrderStatusID', '=', 'GR_013.OrderStatusID')
                    ->whereIn('GR_022.OrderID',$keys)
                    ->select('GR_029.ItemID',
                             'GR_029.ItemDescription',
                             'GR_029.SizeID',
                             'GR_029.BrandID',
                             'GR_029.ActualPrice',
                             'GR_001.Alias',
                             'GR_022.OrderID',
                             'GR_022.GuideID',
                             'GR_022.PackingOrderID',
                             'GR_022.FolioID',
                             'GR_022.GuideURL',
                             'GR_022.TrackingURL',
                             'GR_022.NoOrder',
                             'GR_022.IsReturn',
                             'GR_022.CreationDate',
                             'GR_022.UpdateDate',
                             'GR_013.Name as StatusName',
                             'GR_013.Name'
                    )->get();
                    
        $items = $items->map(function ($item, $key) use ($user){

/*             if($item->StatusName === 'Transito' || $item->StatusName === 'Devuelto') {
 */            if($item->StatusName === 'Transito' ) {

                $tracking   = PackPack::tracking($item->PackingOrderID);
                $last       = collect($tracking)->last()['status'];
                $status     = $item->StatusName === 'Transito' ? 4 : 9;
                $statusName = $item->StatusName === 'Transito' ? 'Entregado' : 'Devolución entregada';
                /* $last = 'Entregado'; */
                if($last === 'Entregado') {
                    $this->UpdateOrderStatus($item->OrderID, $status);
                    $item->StatusName = $statusName ;
                    $item->Name = $statusName ;
                }
            }

            $devolution = Devolution::where('OrderID',$item->OrderID)->first();

            $item->IsReturn      = isset($devolution->ReturnID) ? $devolution->ReturnID : Null;
            $item->ReturnID      = isset($devolution->ReturnID) ? Devolution::where('OrderID',$item->OrderID)->first()->ReturnID : Null;
            $item->ThumbPath     = $user->getThumbPath($item);
            $item->BrandID       = $user->getBrand($item);
            $item->SizeID        = $user->getSize($item);
            $item->CreationDate  = $this->formatDate("d F Y", $item->CreationDate);
            $item->update        = $this->formatDate("d F Y", $item->UpdateDate);
            $current             = strtotime(date("Y-m-d H:i:s"));
            $update              = strtotime(date("Y-m-d H:i:s",strtotime($item->UpdateDate)));
            $segs                = $current - $update;
            $hrs                 = $segs / 3600;

            $item->isTime = $hrs < 24; // corregir con negativos

            return $item;

        });

        $pending   = $items->where('StatusName','!==','Entregado')
                            ->where('StatusName','!==','Cancelado')
                            ->where('StatusName','!==','Devuelto')
                            ->where('StatusName','!==','Confirmado')
                            ->where('StatusName','!==','Devolución entregada')
                            ->where('StatusName','!==','Devolución confirmada');

        $finalized = $items->where('StatusName','!==','Transito')
                            ->where('StatusName','!==','Cancelado')
                            ->where('StatusName','!==','Solicitado')
                            ->where('StatusName','!==','Devuelto')
                            ->where('StatusName','!==','Devolución entregada')
                            ->where('StatusName','!==','Devolución confirmada');

        $canceled  = $items->where('StatusName','Cancelado');
        $return    = $items->where('StatusName','!==','Transito')
                            ->where('StatusName','!==','Entregado')
                            ->where('StatusName','!==','Cancelado')
                            ->where('StatusName','!==','Confirmado');


        $questions  = Question::where('Active',true)->get();

    	return view('orders.index',
            compact('orders',
                    'pending',
                    'finalized',
                    'canceled',
                    'items',
                    'questions',
                    'return'));
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

    public function returnDelivered($OrderID) {

        $order     = Order::findOrFail($OrderID);
        $infoOrder = InfoOrder::where('OrderID',$OrderID)->first();
        $item      = Item::findOrFail($infoOrder->ItemID);

        if($order->OrderStatusID === 10 || 
           Auth::User()->id !== $item->OwnerID) {
            abort(403);
        }
        
        $order->OrderStatusID = 10;
        $order->save();

        $infoOrder->OrderStatusID = 10;
        $infoOrder->save();

        $existsWallet = Wallet::where('UserID',$order->UserID)->first();

        if(isset($existsWallet->Amount)) {

            $Amount = str_replace(',', '', ltrim($existsWallet->Amount, '$'));
            $ActualPrice = str_replace(',', '', ltrim($item->ActualPrice, '$'));

            $existsWallet->Amount = $Amount + $ActualPrice;
            $existsWallet->save();
            
        } else {

            $wallet = new Wallet;
            $wallet->UserID = $order->UserID;
            $wallet->CreatedDate = date("Y-m-d H:i:s");
            $wallet->Amount = $item->ActualPrice;
            $wallet->save();
        }

        Session::flash('success','Se ha confirmado la devolución correctamente.');
        return Redirect::back();
    }

    public function buyerReturn(Request $request, $ReturnID) {

        $isAdmin = Auth::User()->isAdmin();

        //permisos solo puede contestar el comprador y el admin
        $comments   = ReturnComments::where('ReturnID',$ReturnID)->get();
        $ParentID   = $comments->where('IsParent',true)->first();
        $user       = User::findOrFail($ParentID->UserID);

        if(!isset($request->Approved)) {
            $comment = new ReturnComments;
            $comment->UserID = Auth::User()->id;
            $comment->ReturnID = $ReturnID;
            $comment->Comment = $request->Comment;
            $comment->CreationDate = date("Y-m-d H:i:s");
            $comment->IsParent = false;
            $comment->ParentID = $ParentID->CommentID;
            $comment->IsBuyer = true;
            $comment->save();
        }

        if($isAdmin && isset($request->Approved)) {
            //Respuesta de la petición y validar si ya va a evaluar el pedido o únicamente contestar
            $this->confirmReturn($request, $ReturnID);

        } else if($isAdmin && !isset($request->Approved)){

            $return     = Devolution::findOrFail($ReturnID);
            $infoOrder  = InfoOrder::where('OrderID',$return->OrderID)->first();
            $item       = Item::findOrFail($infoOrder->ItemID);
            $rason      = Rason::findOrFail($return->RasonID)->Rason;
            $item->ThumbPath = ItemInfo::where('ItemID',$item->ItemID)
                                        ->where('IsCover',true)
                                        ->get()->first()->ThumbPath; 

            Mail::to($user->email)
                ->send(new ResponseBuyerReturn($item,$rason,null,$request->Comment,$ReturnID));
        }

        if(isset($request->Photos)) {
            foreach ($request->Photos as $key => $value) {

                $data = $this->saveImg($value, $key, $ReturnID);

                $img = new ReturnImg;
                $img->ReturnID = $ReturnID;
                $img->ReturnUrl = $data[0]['name'];
                $img->ReturnThumb = $data[0]['thumb'];
                $img->CommentID = $comment->CommentID;
                $img->save();
            }
        }

        Session::flash('success','Se ha enviado la respuesta exitosamente.');
        return Redirect::back();
    }

    public function sellerReturn(Request $request, $ReturnID) {
        $isAdmin = Auth::User()->isAdmin();

        //permisos solo puede contestar el vendedor y el admin
        $comments   = ReturnComments::where('ReturnID',$ReturnID)->get();
        $return     = Devolution::findOrFail($ReturnID);
        $infoOrder  = InfoOrder::where('OrderID',$return->OrderID)->first();
        $item       = Item::findOrFail($infoOrder->ItemID);
        $seller     = User::findOrFail($item->OwnerID);

        $sellerComments = count($comments->where('UserID',$seller->id));
        $IsParent = $sellerComments  === 0 ? true : false;
        
        if($sellerComments > 0) {
            $ParentID   = $comments->where('IsParent',true)->first();
            $user       = User::findOrFail($ParentID->UserID);
        } 

        if(!isset($request->Approved)) {
            $comment = new ReturnComments;
            $comment->UserID = Auth::User()->id;
            $comment->ReturnID = $ReturnID;
            $comment->Comment = $request->Comment;
            $comment->CreationDate = date("Y-m-d H:i:s");
            $comment->IsParent = $IsParent;
            $comment->ParentID = $IsParent ? Null : $ParentID->CommentID;
            $comment->IsBuyer = false;
            $comment->save();
        }

        if($isAdmin && isset($request->Approved)) {
            //Respuesta de la petición y validar si ya va a evaluar el pedido o únicamente contestar
            $this->confirmReturn($request, $ReturnID);

        } else if($isAdmin && !isset($request->Approved)){

            $rason = Rason::findOrFail($return->RasonID)->Rason;
            $item->ThumbPath = ItemInfo::where('ItemID',$item->ItemID)
                                    ->where('IsCover',true)
                                    ->get()->first()->ThumbPath;

            Mail::to($seller->email)
                ->send(new ResponseSellerReturn($item,$rason,null,$request->Comment,$ReturnID));
        }

        if(isset($request->Photos)) {
            foreach ($request->Photos as $key => $value) {

                $data = $this->saveImg($value, $key, $ReturnID);

                $img = new ReturnImg;
                $img->ReturnID = $ReturnID;
                $img->ReturnUrl = $data[0]['name'];
                $img->ReturnThumb = $data[0]['thumb'];
                $img->CommentID = $comment->CommentID;
                $img->save();
            }
        }

        Session::flash('success','Se ha enviado la respuesta exitosamente.');
        return Redirect::back();
    }
    public function survey(Request $request, $NoOrder) {

        $questions = Question::where('Active',true)->get(['QuestionID','Slug']);
        $order = DB::table('fashionrecovery.GR_022')
                    ->join('fashionrecovery.GR_021', 'GR_022.OrderID', '=', 'GR_021.OrderID')
                    ->where('GR_022.NoOrder',$NoOrder)
                    ->where('GR_021.UserID',Auth::User()->id)
                    ->first();
                    
        if(!$order) {
            abort(403);
        }

        
        foreach ($questions as $value) {
           if($request->get($value->Slug)) {
                $answer = new Answer;
                $answer->QuestionID = $value->QuestionID;
                $answer->UserID = Auth::User()->id;
                $answer->ItemID = $order->ItemID;
                $answer->Answer = $request->get($value->Slug);
                $answer->save();

            } 
        }

        DB::table('fashionrecovery.GR_022')
            ->where('PackingOrderID','=',$order->PackingOrderID)
            ->update(["OrderStatusID" => 8,
                      "UpdateDate"=> date("Y-m-d H:i:s")]);
        
        DB::table('fashionrecovery.GR_021')
            ->where('OrderID','=',$order->OrderID)
            ->update(["OrderStatusID" => 8]);

        Session::flash('success','Has evaluado el pedido exitosamente.');
        return Redirect::to('orders');
    }

    public function return($NoOrder) {

        if(!$this->isReturnTime($NoOrder)){
            abort(403);
        }

        $rasons = Rason::where('Active',true)->get();

        return view('orders.return',compact('rasons','NoOrder'));
    }

    public function isReturnTime($NoOrder) {

        $UpdateDate = InfoOrder::where('NoOrder',$NoOrder)->first()->UpdateDate;

        $current = strtotime(date("Y-m-d H:i:s"));
        $update  = strtotime(date("Y-m-d H:i:s",strtotime($UpdateDate)));
        $segs    = $current - $update;
        $hrs     = $segs / 3600;

        return $hrs < 24;
    }

    public function returns() {

        if (!Auth::User()->isAdmin()) {
            abort(403);
        }

        $returns = Devolution::all();

        $returns = $returns->map(function ($item, $key) {

            $userId = Order::findOrFail($item->OrderID)->UserID;
            $user = User::findOrFail($userId);

            $item->RasonID = Rason::findOrFail($item->RasonID)->Rason;
            $item->CreationDate = $this->formatDate("d F Y", $item->CreatedDate);
            $item->Buyer = $user->Alias;
            return $item;
        });

        return view('orders.returns',compact('returns'));
    }

    public function showReturn($ReturnID) {

        if(!Auth::User()->isAdmin()) {
            abort(403);
        }

        $return               = Devolution::findOrFail($ReturnID);
        $return->CreatedDate  = $this->formatDate("d F Y", $return->CreatedDate);
        $return->UpdateDate  = $this->formatDate("d F Y", $return->UpdateDate);
        $return->RasonID      = Rason::where('RasonID',$return->RasonID)->first()->Rason;

        $order      = Order::findOrFail($return->OrderID);
        $infoOrder  = InfoOrder::where('OrderID',$return->OrderID)->first();

        $infoOrder->UpdateDate  = $this->formatDate("d F Y", $infoOrder->UpdateDate);
        $infoOrder->CreationDate  = $this->formatDate("d F Y", $infoOrder->CreationDate);
        $infoOrder->OrderStatusID  = Status::findOrfail($infoOrder->OrderStatusID)->Name;

        $images     = ReturnImg::where('ReturnID',$return->ReturnID)->get();
        $OwnerID    = Item::findOrFail($infoOrder->ItemID)->OwnerID;
        $buyer      = User::findOrFail($order->UserID);
        $seller     = User::findOrFail($OwnerID);
        $destino    = DB::table('fashionrecovery.GR_002')
                        ->where('ShippingAddID',$order->ShippingID)
                        ->first()->State;
        
        $data = [
            'return'    => $return,
            'infoOrder' => $infoOrder,
            'images'    => $images,
            'buyer'     => $buyer->Alias,
            'seller'    => $seller->Alias,
            'email'     => $seller->email,
            'origen'    => $seller->infoSeller->LiveIn,
            'destino'   => $destino
        ];

        return view('orders.show-return',compact('data'));
    }

    public function confirmReturn($request, $ReturnID) {

        //permisos de admin

        $return     = Devolution::findOrFail($ReturnID);
        $approved   = $request->Approved == "1" ? true : false;
        $order      = Order::findOrFail($return->OrderID);
        $infoOrder  = InfoOrder::where('OrderID',$return->OrderID)->first();
        $item       = Item::findOrFail($infoOrder->ItemID);
        $buyer      = User::findOrFail($order->UserID);
        $seller     = User::findOrFail($item->OwnerID);
        $msg        = $approved ? 'aprobada' : 'cancelada'; 
        $rason      = Rason::findOrFail($return->RasonID)->Rason;
        $item->ThumbPath = ItemInfo::where('ItemID',$item->ItemID)
                                    ->where('IsCover',true)
                                    ->get()->first()->ThumbPath;       

        $return->Approved = $approved ? true : false;
        $return->Comment = $request->Comment;
        $return->save();

        if($approved) {

            $order->OrderStatusID = 5;
            $order->save(); 

            $infoOrder->OrderStatusID = 5;
            $infoOrder->IsReturn = $approved;
            $infoOrder->save(); 
        }

        //correo para vendedor
        Mail::to($seller->email)
        ->send(new ResponseSellerReturn($item,$rason,$approved,$request->Comment,$ReturnID));

        //correo para comprador
        Mail::to($buyer->email)
            ->send(new ResponseBuyerReturn($item,$rason,$approved,$request->Comment,$ReturnID));

      /*   Session::flash('success','Se ha '.$msg.' la solicitud.');
        return Redirect::to('show-return/'.$ReturnID); */
    }

    public function saveReturn(Request $request, $NoOrder) {

        if(!$this->isReturnTime($NoOrder)){
            abort(403);
        }

        $this->validator($request);

        $info   = InfoOrder::where('NoOrder',$NoOrder)->first();
        $item   = Item::findOrFail($info->ItemID);
        $seller = User::findOrFail($item->OwnerID);
        $item->ThumbPath = ItemInfo::where('ItemID',$info->ItemID)
                                    ->where('IsCover',true)
                                    ->get()->first()->ThumbPath;
        

        $return = new Devolution;
        $return->RasonID = $request->RasonID;
        $return->OrderID = $info->OrderID;
        $return->ItemID  = $info->ItemID;
        $return->Amount  = $item->ActualPrice; //Precio o menos la comisión de FR
        $return->UserID  = Auth::User()->id;
        $return->CreatedDate = date("Y-m-d H:i:s");
        $return->save();

        $comments = new ReturnComments;
        $comments->UserID = Auth::User()->id;
        $comments->ReturnID = $return->ReturnID;
        $comments->Comment = $request->Comments;
        $comments->CreationDate = date("Y-m-d H:i:s");
        $comments->IsParent = true;
        $comments->IsBuyer = Auth::User()->id === $seller->id ? false : true;
        $comments->save();

        
        $rason      = Rason::findOrFail($request->RasonID)->Rason;

        foreach ($request->Photos as $key => $value) {

            $data = $this->saveImg($value, $key, $return->ReturnID);

            $img = new ReturnImg;
            $img->ReturnID = $return->ReturnID;
            $img->ReturnUrl = $data[0]['name'];
            $img->ReturnThumb = $data[0]['thumb'];
            $img->CommentID = $comments->CommentID;
            $img->save();
        }

        Mail::to($seller->email)
         ->send(new ResponseSeller($item, 
                                   $rason, 
                                   $request->Comments, 
                                   $return->ReturnID));

        Session::flash('success','Se ha enviado correctamente tu solicitud de devolución. La revisaremos y te daremos respuesta lo más pronto posible.');
        return Redirect::to('orders');
    }

    public function saveImg($value, $key, $ReturnID) {
        $date   = date("Ymd-His");
        $dir = 'return/';
        $name = $ReturnID.'-'.$date.'-'.$key.'.jpg';
        $names = [];

        $realImg = Image::make($value->getRealPath())
                        ->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
        })->orientate();

        $realImg->stream();
        $img = Image::make($value->getRealPath())->orientate()->fit(40);
        $img->stream();


        \Storage::disk('public')->put($dir.$name,  $realImg, 'public');
        \Storage::disk('public')->put($dir.'thumb-'.$name, $img, 'public');

        $items = [
            'name' => $dir.$name,
            'thumb' => $dir.'thumb-'.$name
        ];

        array_push($names,$items);

        return $names;
    }

    public function validator($request)
    {
        $data = ['RasonID'  => ['required']];

/*         foreach ($request->Photos as $key => $value) {            
            $data['Photos'][$key] = 'mimes:jpeg,png,jpg';
        }
         */
        return $request->validate($data);
    }

    public function returnPermission($buyer, $seller, $IsBuyer) {

        $isAdmin = Auth::User()->isAdmin();
        $buy = Auth::User()->id == $buyer->id;
        $sell = Auth::User()->id == $seller->id;

        return $isAdmin ? true : ($IsBuyer === "true" ? $buy : $sell);
    }

    public function isTime($date) {
        $current    = strtotime(date("Y-m-d H:i:s"));
        $create     = strtotime(date("Y-m-d H:i:s",strtotime($date)));
        $segs       = $current - $create;
        $hrs        = $segs / 3600;
        return $hrs < 24;
    }

    public function showCommentsReturn($ReturnID,$IsBuyer) {

        $comments   = [];
        $ParentID = '';
        $return     = Devolution::findOrFail($ReturnID);
        $rason      = Rason::findOrFail($return->RasonID)->Rason;
        $images     = ReturnImg::where('ReturnID',$ReturnID)->get();
        $order      = Order::findOrFail($return->OrderID);
        $infoOrder  = InfoOrder::where('OrderID',$return->OrderID)->first();
        $item       = Item::findOrFail($infoOrder->ItemID);
        $buyer      = User::findOrFail($order->UserID);
        $seller     = User::findOrFail($item->OwnerID);
        $opposite   = $IsBuyer === 'true' ? $seller->id : $buyer->id;
        $firstComment = [];
        
        if(!$this->returnPermission($buyer, $seller, $IsBuyer) || $order->OrderStatusID === 10) {
            abort(403);
        }

        $all = ReturnComments::where('ReturnID',$ReturnID)->get();

        if(count($all) > 0) {
            $firstComment = $all->where('UserID',$buyer->id)->first();
            $firstComment->images = $images->where('CommentID',$firstComment->CommentID);
        }
        
        $sellerComments = count($all->where('UserID',$seller->id));
        $isTime  = $IsBuyer === 'true' ? true : 
                    (!$this->isTime($return->CreatedDate) && $sellerComments === 0 ? false : true) ;

        if(Auth::User()->id === $seller->id && $sellerComments === 0) {
            return view('orders.comments-return',
                    compact(
                        'firstComment',
                        'isTime',
                        'sellerComments',
                        'comments',
                        'ParentID',
                        'rason',
                        'buyer',
                        'seller',
                        'return',
                        'IsBuyer'
                    ));
        }
        
        $comments = $all->where('IsBuyer',$IsBuyer === 'true' ? true : false);
        $ParentID = count($comments) > 0 ? $comments->where('IsParent',true)->first()->CommentID : '';

        $comments = $comments->map(function ($item, $key) use ($images,$buyer,$seller) {

            $item->images = $images->where('CommentID',$item->CommentID);
            $item->date = $this->formatDate("d F Y", $item->CreationDate);
            $item->user = $buyer->id === $item->UserID ? 'Comprador' : 
                         ($seller->id === $item->UserID ? 'Vendedor' : 'Fashion Recovery');

            return $item;
        })->sortBy('CreationDate');

        return view('orders.comments-return',
            compact('firstComment',
                    'isTime',
                    'comments',
                    'ParentID',
                    'rason',
                    'buyer',
                    'seller',
                    'return',
                    'IsBuyer',
                    'sellerComments'));
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

    public function tracking($PackPackID) {
        $packpack = PackPack::tracking($PackPackID);
        $tracking = $packpack;
                
        return view('orders.tracking',compact('tracking','status'));
    }

    public function cancel($OrderID) {

        $info = InfoOrder::where('NoOrder',$OrderID)->first();

        $info->IsCanceled = true;
        $info->save();

        $item = Item::find($info->ItemID);
        $item->IsSold = false;
        $item->save(); 
        $item->searchable();

        $orderId = DB::table('fashionrecovery.GR_022')
                    ->where('PackingOrderID','=',$info->PackingOrderID)
                    ->update(["OrderStatusID" => 6]);

        if(isset($info->FolioID)) {

            $data = $this->login();
            $url  = '/orders/cancel/';
            $body = '{}';
            $key  = '';

            if($data->success) {

                $key = $this->key($data, $url, $body);

                $client = new Client();

                $response = $client->request('PUT', 
                'https://pp-users-integrations-api-test.herokuapp.com'.$url.$info->PackingOrderID,[
                    'headers' => [
                        'user_id' => $data->data->user_id,
                        'token' => $key
                    ]
                ]);

                return response()->json($response->getStatusCode());
            }
        }

        return response()->json('success');
    }

    public function login() {

        $res = '';
        $client = new Client();
        
        $response = $client->request('POST', 
        'https://pp-users-integrations-api-test.herokuapp.com/signin/email',
        [
            'form_params' => [
                'email' => env('PACK_EMAIL'),
                'password' => env('PACK_PASSWORD')

            ]
        ]);

        if($response->getStatusCode() == 200) {
            $res = $this->validateKey($response);
        }

        return $res->success ? $res : json_decode($response->getBody())->success;
    }

    public function key($response, $url, $body) {
        
        $key    = $response->data->key;
        $result = $body.$url.$key;
        $hash   = hash('sha256', $result);

        return $hash;
    }

    public function validateKey($user) {
        
        $userData = json_decode($user->getBody());

        $client = new Client(); 
        $response = $client->request('GET', 'https://pp-users-integrations-api-test.herokuapp.com/keys/'.$userData->key->_id.'/verify');

        return json_decode($response->getBody());
    }
}
