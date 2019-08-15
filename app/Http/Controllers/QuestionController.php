<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use Redirect;

class QuestionController extends Controller
{
	protected $table = 'fashionrecovery.GR_039';

    public function question(Request $request) {

    	//$this->validator($request);

    	$data = $this->getData($request->toArray());

        DB::table($this->table)->insert($data);

        //email
        
        dd('Sí');
    }


    /**
     * Validate the brand request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validator($request)
    {
        return $request->validate([
            'question' => ['required']
        ]);
    }


    public function getData($data) {

        return [
             'UserID' 		=> Auth::User()->id,
             'ItemID'   	=> $data['id'],
             'ParentID' 	=> Null,
             'IsParent' 	=> true,
             'Question'     => $data['question'],
             'CreationDate' => date("Y-m-d H:i:s")
        ];
    }
}
