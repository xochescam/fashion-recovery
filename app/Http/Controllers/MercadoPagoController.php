<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use MercadoPago;

use App\Mail\SoldItem;

use Auth;
use DB;
use Session;
use Mail;
use Redirect;

use App\Item;
use App\Order;
use App\InfoOrder;
use App\PackPack;
use App\Address;
use App\Devolution;
use App\Wallet;
use App\User;


class MercadoPagoController extends Controller {

    public function paymentCard(Request $request) {

        $delivery = Address::findOrFail($request->shipping)->ZipCode;
        //$shippingCost = PackPack::quotation($delivery);
        $shippingCost = 60;

        $subtotal   = Auth::User()->getTotal();
        $devTotal   = null;
        $total      = $subtotal + $shippingCost;

        if($request->amount && isset($devolution->Amount)) {

            $devolution   = Wallet::where('UserID',Auth::User()->id)->first();
            $wallet       = str_replace(',', '', ltrim($devolution->Amount, '$'));
            $paymentTotal = $subtotal + $shippingCost;
            $total        = $wallet > $paymentTotal ? 0 : $paymentTotal - $devTotal;

            $devolution->Amount = $wallet > $paymentTotal ? ($wallet - $paymentTotal) : 0;
            $devolution->save();
        }  

        MercadoPago\SDK::setAccessToken(env('MP_SECRET'));

        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = $total; 
        $payment->token = $request->token;
        $payment->payment_method_id = $request->paymentMethodId;
        $payment->installments= 1;
        $payment->payer = array(
            "email" => Auth::User()->email
        );

        //Restar ese saldo en cartera para la siguiente compra

        if ($payment->save()) {

            return response()->json($this->getMessages($payment));

          } else {
            return response()->json($payment->error);
          }

        return response()->json($payment);
    }

    public function getMessages($payment) {
        $messages = [
            'accredited'                           => "Listo, se acreditó tu pago!",
            'pending_contingency'                  => "Estamos procesando el pago. En menos de 2 días hábiles te enviaremos por e-mail el resultado.",
            'pending_review_manual'                => "Estamos procesando el pago. En menos de 2 días hábiles te diremos por e-mail si se acreditó o si necesitamos más información.",
            'cc_rejected_bad_filled_card_number'   => "Revisa el número de tarjeta.",
            'cc_rejected_bad_filled_date'          => "Revisa la fecha de vencimiento.",
            'cc_rejected_bad_filled_other'         => "Revisa los datos.",
            'cc_rejected_bad_filled_security_code' => "Revisa el código de seguridad.",
            'cc_rejected_blacklist'                => "No pudimos procesar tu pago.",
            'cc_rejected_call_for_authorize'       => "Debes autorizar ante tu entidad emisora de tarjeta el total de pago a Mercado Pago",
            'cc_rejected_card_disabled'            => "Necesitas activar tu tarjeta.",
            'cc_rejected_card_error'               => "No pudimos procesar tu pago.",
            'cc_rejected_duplicated_payment'       => "Ya hiciste un pago por ese valor. Si necesitas volver a pagar usa otra tarjeta u otro medio de pago.",
            'cc_rejected_high_risk'                => "Tu pago fue rechazado.",
            'cc_rejected_insufficient_amount'      => "Tu tarjeta no tiene fondos suficientes.",
            'cc_rejected_invalid_installments'     => "Tu tarjeta no acepta pago por cuotas.",
            'cc_rejected_max_attempts'             => "Llegaste al límite de intentos permitidos.",
            'cc_rejected_other_reason'             => "No se procesó el pago.",
        ];

        return [
            'status'  => $payment->status,
            'message' => $messages[$payment->status_detail]
        ]; 
    }

    public function payment($ShippingAddID, $IsBuy) {

        $user = Auth::User();
        $amount = isset($user->wallet->Amount) ? $user->wallet->Amount : 0;

        if($IsBuy === "true") {
            $item = $this->getItem($ShippingAddID);

            if(!isset($item->ItemID)) {
    
                Session::flash('warning',$item['message']);
                return Redirect::back();
            }

        }

        //cuando no hay direccion // pasar a agregar la dirección
        //cuando hay dirección y no hay nada en el carrito // tomar la dirección default y agregar al carrito
        //cuando hay dirección y ya hay items en el carrito // tomar la dirección default y agregar al carrito que ya tiene items
        $address = $user->getDefaultAddress() !== null ? $user->getDefaultAddress() : false;
        $addToCart  = $this->addToCart($ShippingAddID, $user);
        
        /* if (!$addToCart && $IsBuy === "true") {
            Session::flash('warning','La prenda ya está en el carrito.');
            return Redirect::to('shopping-cart');
        } */

        if($address) {

            //$shippingCost = PackPack::quotation($address->ZipCode);

            $shippingCost = 60;

            $subtotal   = Auth::User()->getTotal();
            $devTotal   = null;
            $total      = $subtotal;

            $wallet = Wallet::where('UserID',Auth::User()->id)->first();
            $devTotal = isset($wallet->Amount) ? str_replace(',', '', ltrim($wallet->Amount, '$')) : 0;

            return view('payment.index',compact('address','IsBuy','ShippingAddID','shippingCost','subtotal','devTotal','total','amount'));

        } else {

            return Redirect::to('address');
        }
    }

    public function getItem($ItemID) {

        $item = DB::table('fashionrecovery.GR_029')
                        ->join('fashionrecovery.GR_032', 'GR_029.ItemID', '=', 'GR_032.ItemID')
                        ->where('GR_029.ItemID',$ItemID)
                        ->select('GR_029.ItemID',
                                 'GR_029.OffSaleID',
                                 'GR_029.ItemDescription',
                                 'GR_029.OriginalPrice',
                                 'GR_029.ActualPrice',
                                 'GR_029.SizeID',
                                 'GR_029.BrandID',
                                 'GR_032.PicturePath',
                                 'GR_032.ThumbPath',
                                 'GR_029.OwnerID'
                             )->get()->first();

        if(!isset($item)) {
            return [
                'message' => 'La prenda no está disponible.'
            ];

        } else if($item->OwnerID === Auth::User()->id){

            return [
                'message' => 'No puedes adquirir una prenda de tu colección.'
            ];
        }

        return $item;
    }


    public function getAddress($ShippingAddID, $user) {
        return $user->getShippingAddress()
                ->where('ShippingAddID',$ShippingAddID)
                ->first();
    }

    public function addToCart($ShippingAddID, $user) {

        if ($this->existsInCart($ShippingAddID)) {

            return false;

        } else {

            DB::table('fashionrecovery.GR_041')
            ->insert([
                'UserID'       => $user->id,
                'ItemID'       => $ShippingAddID,
                'CreationDate' => date("Y-m-d H:i:s")
            ]);

            return true;
        }

    }

    public function existsInCart($ItemID) {

        return DB::table('fashionrecovery.GR_041')
                    ->where('ItemID',$ItemID)
                    ->where('UserID',Auth::User()->id)
                    ->first();
    }

    public function summary($ShippingAddID) {

        //$ShippingAmount = Order::where('ShippingID',$ShippingAddID)
        //                    ->get();
        //$ShippingAmount = str_replace(',', '', substr($ShippingAmount, 1));
        $ShippingAmount = 60;
        $items   = Auth::User()->getOrdered();

        $address = Auth::User()->getShippingAddress()
                                ->where('ShippingAddID',$ShippingAddID)
                                ->first();

        return view('payment.confirmation',compact('items','address','ShippingAmount'));
    }

    public function confirmation($ShippingAddID) {

        DB::beginTransaction();

        try {

            $delivery = Address::findOrFail($ShippingAddID)->ZipCode;
            $shippingCost = PackPack::quotation($delivery);
            $shippingCost = ($shippingCost - 60) < 0 ? 0 : ($shippingCost - 60);
    
            $user    = Auth::User();
            $items   = $user->getItems();
            $total   = Auth::User()->getTotal();
            $arrayIt = []; 
            
            $order = new Order;
            $order->UserID = $user->id;
            $order->OrderStatusID = 3;
            $order->ShippingID = $ShippingAddID;
            $order->TotalAmount =  $total;
            $order->ShippingAmount = $shippingCost;
            $order->PaymentOptionID = 2;
            $order->CreationDate = date("Y-m-d H:i:s");
            $order->save();
    
            foreach ($items as $key => $value) {
    
                $s = strtoupper(substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5));
    
                DB::table('fashionrecovery.GR_022')
                    ->insert([
                        'OrderID'       => $order->OrderID,
                        'NoOrder'       => $s.$order->OrderID,
                        'OrderStatusID' => 3,
                        'ItemID'        => $value->ItemID,
                        'GainFR'        => $total * User::getCommission(Auth::User()),
                        'IsCanceled'    => false,
                        'CreationDate'  => date("Y-m-d H:i:s")
                    ]);
                
                $item = Item::findOrFail($value->ItemID);
                $item->IsSold  = true;
                $item->save();
    
                $item->unsearchable();
            }
    
            DB::delete('DELETE FROM fashionrecovery."GR_041" WHERE "UserID"='.$user->id);
    
            $address = Auth::User()->getShippingAddress()
                                    ->where('ShippingAddID',$ShippingAddID);
    
            Mail::to(Auth::User()->email)
                ->send(new SoldItem(Auth::User(), $order, $items, $address));
            
            DB::commit();
            

            return response()->json('success');

        } catch (\Exception $ex) {

    
            return response()->json($ex->getResponse());
            DB::rollback();
        }
    }
}