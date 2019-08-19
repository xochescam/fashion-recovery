<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\NewQuestion;
use App\Mail\AnswerQuestion;


use DB;
use Auth;
use Session;
use Redirect;
use Mail;

class QuestionController extends Controller
{
	protected $table = 'fashionrecovery.GR_039';

    public function question(Request $request) {

    	$this->validator($request, true);

        DB::beginTransaction();

        try {

            $data = $this->getData($request->toArray(),true);

            DB::table($this->table)->insert($data);

            $question = $this->getLast();

            $user = $this->getUser($request->id);

            $this->saveNotifications($user, $question, 'question');

            Mail::to($user)
                 ->send(new NewQuestion($user, Auth::User(), $question));

            DB::commit();

            Session::flash('success','Se ha enviado tu pregunta.');
            return Redirect::to('/items/'.$request->id.'/public');

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('/items/'.$request->id.'/public');
        }
    }

    public function answer($QuestionID, $type) {

        $question = $this->getQuestion($QuestionID, $type);

        if(!$question) {
            Session::flash('warning','No tienes permisos de contestar la pregunta.');
            return Redirect::to('items');
        }

        $question = $this->getAnswerQuestion($question, $QuestionID);

        return view('questions.answer',compact('question','type'));
    }

    public function storeAnswer(Request $request, $type) {

        $this->validator($request, false);

        DB::beginTransaction();

        try {

            $data = $this->getData($request->toArray(), false);

            DB::table($this->table)->insert($data);

            $answer = $this->getLast();

            $user = $type == 'answer' ?
                    DB::table('fashionrecovery.GR_001')
                        ->where('GR_001.id',$request->questionUser)
                        ->select('GR_001.email','GR_001.Alias')
                        ->first() : $this->getUser($request->id);

            $this->saveNotifications($user, $answer, 'answer');

            Mail::to($user)
                ->send(new AnswerQuestion($user, Auth::User(), $answer, $type));

            DB::commit();

            Session::flash('success','Se ha enviado tu respuesta.');
            return Redirect::to('/question/'.$answer->ParentID.'/'.$type);

        } catch (\Exception $ex) {

            DB::rollback();

            Session::flash('warning','Ha ocurrido un error, inténtalo nuevamente');
            return Redirect::to('/question/'.$answer->ParentID.'/'.$type);
        }

    }

    public function saveNotifications($user, $answer, $type) {

        DB::table('fashionrecovery.GR_040')->insert([
            'Type'      => $type,
            'UserID'    => $user->id,
            'TableID'   => $type == 'answer' ? $answer->ParentID : $answer->QuestionID,
            'TableName' => 'GR_039'
        ]);

        DB::table('fashionrecovery.GR_001')
            ->where('id', $user->id)
            ->update(['Notifications' => True]);

        return true;
    }

    public function getQuestion($QuestionID, $type) {

        $column        = $type == 'answer' ? 'GR_029.OwnerID' : 'GR_039.UserID';
        $temporalyUser =  $type == 'answer' ? 135 : 118;

        return DB::table($this->table)
                        ->join('fashionrecovery.GR_001', 'GR_039.UserID', '=', 'GR_001.id')
                        ->join('fashionrecovery.GR_029', 'GR_039.ItemID', '=', 'GR_029.ItemID')
                        ->where('GR_039.QuestionID',$QuestionID)
                        //->where($column,$temporalyUser)
                        ->where($column,Auth::User()->id)
                        ->where('GR_039.IsParent',true)
                        ->select('GR_039.*','GR_001.Name','GR_001.ProfileID','GR_001.Alias','GR_001.id')
                        ->first();
    }

    public function getAnswerQuestion($question, $QuestionID) {

        $question->date = $this->getDate($question->CreationDate);

        $all = DB::table($this->table)
                    ->join('fashionrecovery.GR_001', 'GR_039.UserID', '=', 'GR_001.id')
                    ->where('ParentID',$QuestionID)
                    ->select('GR_039.*','GR_001.Name','GR_001.ProfileID','GR_001.Alias')
                    ->get();

        $sons = $all->map(function ($item, $key) {

            $item->date = $this->getDate($item->CreationDate);
            return $item;

        })->sortBy('CreationDate')->groupBy('ParentID');

        $question->answers = isset($sons[$QuestionID]) ?
                             $sons[$QuestionID] :
                             [];

        $question->filterAnsw = $question->answers !== [] ?
            $question->answers->filter(function ($value, $key) {
                return $key > 0;
            }) : [];

        return $question;
    }

    public function getUser($id) {

        return DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
                    ->where('GR_029.ItemID',$id)
                    ->select('GR_001.email','GR_001.Alias','GR_001.id')
                    ->first();
    }

    public function getLast() {

        return DB::table($this->table)
                    ->where('UserID',Auth::User()->id)
                    ->orderBy('CreationDate', 'desc')
                    ->first();
    }

    public function getDate($date) {
        $year  = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $day   = date('j', strtotime($date));

        return $day.'/'.$month.'/'.$year;
    }

    /**
     * Validate the brand request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validator($request, $isParent)
    {
        $input = $isParent ? 'question' : 'answer';

        return $request->validate([
            $input => ['required']
        ]);
    }


    public function getData($data, $isParent) {

        return [
             'UserID' 		=> Auth::User()->id,
             'ItemID'   	=> $data['id'],
             'ParentID' 	=> $isParent ? Null : $data['QuestionID'],
             'IsParent' 	=> $isParent,
             'Question'     => $isParent ? $data['question'] : $data['answer'],
             'CreationDate' => date("Y-m-d H:i:s")
        ];
    }
}
