<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ResponseBuyer;
use App\Mail\ResponseSeller;
use App\Mail\ResponseSellerReturn;
use App\Mail\ResponseBuyerReturn;

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
use App\PackPack;
use App\Question;
use App\Answer;
use App\Rason;
use App\ReturnImg;
use App\Devolution;
use App\User;
use App\Status;


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

        $orders    = null;
        $pending   = null;
        $finalized = null;
        $canceled  = null;
    	$user      = Auth::User();

    	$orders = DB::table($this->table)
                    //->join('fashionrecovery.GR_022', 'GR_021.OrderID', '=', 'GR_022.OrderID')
                    ->join('fashionrecovery.GR_013', 'GR_021.OrderStatusID', '=', 'GR_013.OrderStatusID')
                    ->where('UserID',Auth::User()->id)
                    ->select('GR_021.TotalAmount','GR_021.OrderID','GR_013.Name')
                    ->get();

        $pending   = $orders->where('Name','!==','Entregado')
                            ->where('Name','!==','Cancelado')
                            ->where('Name','!==','Devuelto')
                            ->where('Name','!==','Confirmado')
                            ->where('Name','!==','Devolución entregada'); 
        $finalized = $orders->where('Name','!==','Cancelado')
                            ->where('Name','!==','Solicitado')
                            ->where('Name','!==','Devuelto')
                            ->where('Name','!==','Devolución entregada'); 
        $canceled  = $orders->where('Name','Cancelado');  
        $return    = $orders->where('Name','!==','Entregado')
                            ->where('Name','!==','Cancelado')
                            ->where('Name','!==','Confirmado'); 

        
        $keys = $orders->groupBy('OrderID')->keys();

		$items = DB::table($this->detail)
		            ->join('fashionrecovery.GR_029', 'GR_022.ItemID', '=', 'GR_029.ItemID')
                   	->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
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
                             'GR_022.UpdateDate'
                    )->get();
                    
        $items = $items->map(function ($item, $key) use ($user){

            $devolution = Devolution::where('OrderID',$item->OrderID)->first();

            $item->IsReturn      = isset($devolution->ReturnID);
            $item->ThumbPath     = $user->getThumbPath($item);
            $item->BrandID       = $user->getBrand($item);
            $item->SizeID        = $user->getSize($item);
            $item->CreationDate  = $this->formatDate("d F Y", $item->CreationDate);
            $item->update        = $this->formatDate("d F Y", $item->UpdateDate);
            $current             = strtotime(date("Y-m-d H:i:s"));
            $update              = strtotime(date("Y-m-d H:i:s",strtotime($item->UpdateDate)));
            $segs         = $current - $update;
            $hrs          = $segs / 3600;

            $item->isTime = $hrs < 24; // corregir con negativos

            return $item;

        })->groupBy('OrderID');

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

    public function formReturn($ReturnID) {
        //Validar cuando ya se envio la evidencia
        $OrderID = Devolution::findOrFail($ReturnID)->OrderID;

        return view('sells.form-return',compact('ReturnID'));

    }

    public function sendAnswer(Request $request, $ReturnID) {

        //Validar cuando ya se envio la evidencia
        $return = Devolution::findOrFail($ReturnID);

        if(!isset($return->ReturnID)) {
            abort(403);
        }

        $return->Answer = $request->Comments;
        $return->UpdateDate = date("Y-m-d H:i:s");
        $return->save();

        foreach ($request->Photos as $key => $value) {

            $data = $this->saveImg($value, $key, $return->ReturnID);

            $img = new ReturnImg;
            $img->ReturnID = $ReturnID;
            $img->ReturnUrl = $data[0]['name'];
            $img->ReturnThumb = $data[0]['thumb'];
            $img->IsBuyer = false;
            $img->save();
        }

        Session::flash('success','Se ha enviado correctamente la evidencia de la prenda. La revisaremos y te daremos respuesta lo más pronto posible.');
        return Redirect::to('sales');
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

        $rasons = Rason::all();

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

        if (Gate::denies('show-users')) {
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
        $buyer      = User::findOrFail($order->UserID)->Alias;
        $seller     = User::findOrFail($OwnerID);
        
        $data = [
            'return'    => $return,
            'infoOrder' => $infoOrder,
            'images'    => $images,
            'buyer'     => $buyer,
            'seller'    => $seller->Alias,
            'email'    => $seller->email
        ];

        return view('orders.show-return',compact('data'));
    }

    public function confirmReturn($ReturnID,$type) {

        $return     = Devolution::findOrFail($ReturnID);
        $order      = Order::findOrFail($return->OrderID);
        $infoOrder  = InfoOrder::where('OrderID',$return->OrderID)->first();
        $item       = Item::findOrFail($infoOrder->ItemID);
        $buyer      = User::findOrFail($order->UserID);
        $seller     = User::findOrFail($item->OwnerID);
        $msg        = $type == "true" ? 'aprobada' : 'cancelada';
        
        /* if($infoOrder->OrderStatusID !== 9) {
            abort(403);
        } */

        $return->Approved = $type;
        $return->save();

        if($type == "true") {

            $order->OrderStatusID = 10;
            $order->save(); 

            $infoOrder->OrderStatusID = 10;
            $infoOrder->IsReturn = $type;
            $infoOrder->save(); 

            //correo para vendedor
            Mail::to($seller->email)
            ->send(new ResponseSellerReturn($type));
        }

        //correo para comprador
        Mail::to($buyer->email)
            ->send(new ResponseBuyerReturn($type));

        Session::flash('success','Se ha '.$msg.' la solicitud.');
        return Redirect::to('returns');
    }

    public function confirmPreReturn($ReturnID,$type) {

        $return     = Devolution::findOrFail($ReturnID);
        $rason      = Rason::findOrFail($return->RasonID)->Rason;
        $order      = Order::findOrFail($return->OrderID);
        $infoOrder  = InfoOrder::where('OrderID',$return->OrderID)->first();
        $item       = Item::findOrFail($infoOrder->ItemID);
        $buyer      = User::findOrFail($order->UserID);
        $seller     = User::findOrFail($item->OwnerID);
        $msg        = $type ? 'pre-aprobado' : 'cancelado';
        
        if($infoOrder->OrderStatusID !== 4) {
            abort(403);
        }

        $return->PreApproved = $type;
        $return->save();

        if($type == "true") {

            $order->OrderStatusID = 5;
            $order->save(); 

            $infoOrder->OrderStatusID = 5;
            $infoOrder->IsReturn = $type;
            $infoOrder->TrackingURL = Null;
            $infoOrder->PackingOrderID = Null;
            $infoOrder->GuideID = Null;
            $infoOrder->GuideURL = Null;
            $infoOrder->PackingName = Null;
            $infoOrder->TrackingURL = Null;
            $infoOrder->save(); 

            //correo para vendedor
            Mail::to($seller->email)
            ->send(new ResponseSeller($type, $rason));
        }

        //correo para comprador
        Mail::to($buyer->email)
            ->send(new ResponseBuyer($type, $rason));

        Session::flash('success','Se ha '.$msg.' la solicitud.');
        return Redirect::to('returns');
    }

    public function saveReturn(Request $request, $NoOrder) {

        if(!$this->isReturnTime($NoOrder)){
            abort(403);
        }

        $this->validator($request);

        $OrderID = InfoOrder::where('NoOrder',$NoOrder)->first()->OrderID;

        $return = new Devolution;
        $return->RasonID = $request->RasonID;
        $return->Comment = $request->Comments;
        $return->OrderID = $OrderID;
        $return->CreatedDate = date("Y-m-d H:i:s");
        $return->save();

        foreach ($request->Photos as $key => $value) {

            $data = $this->saveImg($value, $key, $return->ReturnID);

            $img = new ReturnImg;
            $img->ReturnID = $return->ReturnID;
            $img->ReturnUrl = $data[0]['name'];
            $img->ReturnThumb = $data[0]['thumb'];
            $img->IsBuyer = true;
            $img->save();
        }

        Session::flash('success','Se ha enviado correctamente tu solicitud de devolución. La revisaremos y te daremos respuesta lo más pronto posible.');
        return Redirect::to('orders');
    }

    public function saveImg($value, $key, $ReturnID) {
        $date   = date("Ymd-His");
        $dir = 'return/';
        $name = $ReturnID.'-'.$date.'-'.$key.'.jpg';
        $names = [];

        $realImg = Image::make($value->getRealPath())
                        ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
        })->orientate();

        $realImg->stream();
        $img = Image::make($value->getRealPath())->orientate()->fit(200);
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
        $tracking = $packpack['map'];
        $status   = $packpack['status'];
                
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
                'https://pp-users-integrations-api-prod.herokuapp.com'.$url.$info->PackingOrderID,[
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
        'https://pp-users-integrations-api-prod.herokuapp.com/signin/email',
        [
            'form_params' => [
                'email' => env('ALGOLIA_EMAIL'),
                'password' => env('ALGOLIA_PASSWORD')

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
        $response = $client->request('GET', 'https://pp-users-integrations-api-prod.herokuapp.com/keys/'.$userData->key->_id.'/verify');

        return json_decode($response->getBody());
    }
}
