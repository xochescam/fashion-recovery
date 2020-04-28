<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\NewQuestion;
use App\Mail\AnswerQuestion;

use App\Item;

use DB;
use Auth;
use Session;
use Redirect;
use Mail;
use Gate;

class QuestionController extends Controller
{
	protected $table = 'fashionrecovery.GR_039';

    public function question(Request $request) {

        $owner = Item::findOrfail($request->ItemID)->OwnerID;

        if(Auth::User()->id  === $owner) { //modificar
            return response()->json([
                'status' => 205,
                'error' => 'warning',
                "message" => 'No puedes realizar preguntas en tus prendas.'
            ]);
        }

        $data = $this->getData($request,true);

        DB::table($this->table)->insert($data);

        $question = $this->getLast();

        $user = $this->getUser($request->ItemID);

        $this->saveNotifications($user, $question, 'question');

        Mail::to($user)
            ->send(new NewQuestion($user, Auth::User(), $question));

        return response()->json($question);
    }

    public function answer($QuestionID, $type) {

        if (Gate::denies('answer-comments')) {
            abort(403);
        }

        $question = $this->getQuestion($QuestionID, $type);

        if(!$question) {
            Session::flash('warning','No tienes permisos de contestar la pregunta.');
            return Redirect::back();
        }

        $question = $this->getAnswerQuestion($question, $QuestionID);

        return view('questions.answer',compact('question','type'));
    }

    public function storeAnswer(Request $request, $type) {

        if (Gate::denies('answer-comments')) {
            abort(403);
        }

        $data = $this->getData($request, false);

        DB::table($this->table)->insert($data);

        $answer = $this->getLast();

        $user = $type == 'answer' ?
                DB::table('fashionrecovery.GR_001')
                    ->where('GR_001.id',$request->questionUser)
                    ->select('GR_001.email','GR_001.Alias','GR_001.id')
                    ->first() : $this->getUser($request->ItemID);
            

        $this->saveNotifications($user, $answer, 'answer');

        Mail::to($user)
            ->send(new AnswerQuestion($user, Auth::User(), $answer, $type));


        return response()->json($answer);
    }

    public function saveNotifications($user, $answer, $type) {

        DB::table('fashionrecovery.GR_040')->insert([
            'Type'        => $type,
            'UserID'      => $user->id,
            'TableID'     => $type == 'answer' ? $answer->ParentID : $answer->QuestionID,
            'TableNameID' => 'QuestionID',
            'TableName'   => 'GR_039'
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

        $question->filterAnsw = [];

        if(count($question->answers) > 1) {
            $answers = $question->answers->toArray();
            $question->filterAnsw = $answers;
            array_shift($question->filterAnsw);
        }

        return $question;
    }

    public function getUser($ItemID) {

        return DB::table('fashionrecovery.GR_029')
                    ->join('fashionrecovery.GR_001', 'GR_029.OwnerID', '=', 'GR_001.id')
                    ->where('GR_029.ItemID',$ItemID)
                    ->select('GR_001.email','GR_001.Alias','GR_001.id')
                    ->first();
    }

    public function getLast() {

        $answer = DB::table($this->table)
                    ->join('fashionrecovery.GR_001', 'GR_039.UserID', '=', 'GR_001.id')
                    ->where('GR_039.UserID',Auth::User()->id)
                    ->select("GR_039.*",'GR_001.Name','GR_001.ProfileID','GR_001.Alias')
                    ->orderBy('GR_039.CreationDate', 'desc')
                    ->first();

        $answer->date = $this->getDate($answer->CreationDate);
        $answer->answers = [];

        return $answer;
    }

    public function getDate($date) {
        $meses = array(
            "enero",
            "febrero",
            "marzo",
            "abril",
            "mayo",
            "junio",
            "julio",
            "agosto",
            "septiembre",
            "octubre",
            "noviembre",
            "diciembre");


        $year  = date('Y', strtotime($date));
        $month = date('n', strtotime($date));
        $day   = date('j', strtotime($date));

        return $day.' de '.$meses[$month - 1].' '.$year;
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
             'ItemID'   	=> $data->ItemID,
             'ParentID' 	=> $isParent ? Null : $data->QuestionID,
             'IsParent' 	=> $isParent,
             'Question'     => $isParent ? $data->question : $data->answer,
             'CreationDate' => date("Y-m-d H:i:s")
        ];
    }
}
