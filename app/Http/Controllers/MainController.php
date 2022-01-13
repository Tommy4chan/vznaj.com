<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Questions;
use App\Comments;
use App\User;
use App\Answear;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(){
        $questions = new Questions();
        return view('home', ['questions' => $questions -> orderBy('id', 'desc') -> get()]);
    }

    public function subject($subject){
        $questions = new Questions();
        if ($subject == 'math')
            return view('subject', ['questions' => $questions -> where('subject','=', $subject)->orderBy('id', 'desc')->get()])->with('subject','Математика');
        elseif ($subject == 'literature')
            return view('subject', ['questions' => $questions -> where('subject','=', $subject)->orderBy('id', 'desc')->get()])->with('subject','Література');
        else{
            return abort(404);
        }
    }

    public function task($subject, $id){

        
        $comments = Comments::where('postId','=', $id) -> where('type','=', '0')->get();
        $questions = Questions::where('id','=', $id) -> get();
        $answears = Answear::where('postId','=', $id) -> get();
        
        if ($questions === null) {
            return abort(404);
        }
        else{
            return view('task')->with('comments',$comments) -> with('questions', $questions) -> with('answears', $answears);
        }

        
    }

    public function review(){
        $reviews = new Contact();
        return view('review', ['reviews' => $reviews -> all()]);
    }



    public function review_check(Request $request){
        $valid = $request->validate([
            'email' => 'required|min:4|max:100',
            'subject' => 'required|min:4|max:100',
            'message' => 'required|min:15|max:500'
        ]);

        $review = new Contact();
        $review -> email = $request->input('email');
        $review -> subject = $request->input('subject');
        $review -> message = $request->input('message');

        $review->save();

        return redirect()->route('review');
    }


    public function comment(Request $request){
        $valid = $request->validate([
            'message' => 'required|min:5|max:500',
        ]);

        $comment = new Comments();
        $comment -> text = $request->input('message');
        $comment -> userId = $request->input('userId');
        $comment -> postId = $request->input('postId');
        $comment -> type = $request->input('type');
        $comment -> name = $request->input('name');
        $comment->save();
        $returnPage = "/task/" . $request->input('subject') . "/" . $request->input('postId');
        return redirect($returnPage);
    }

    public function answear(Request $request){
        $valid = $request->validate([
            'message' => 'required|min:5|max:500',
        ]);

        $answear = new Answear();
        $answear -> text = $request->input('message');
        $answear -> userId = $request->input('userId');
        $answear -> postId = $request->input('postId');
        $answear -> name = $request->input('name');
        $answear->save();
        $returnPage = "/task/" . $request->input('subject') . "/" . $request->input('postId');
        return redirect($returnPage);
    }


    public function profile($id){
        $answears = Answear::where('userId','=', $id) -> orderBy('id', 'desc') -> get();
        $data = array();
        $questions = array();
        foreach($answears as $el){
            $data[] = Questions::where('id','=', $el -> postId) -> get();
        }

        foreach($data as $array)
        {
            foreach($array as $val)
            {
                array_push($questions, $val);
            }    
        }
        

        return view('profile') -> with('questions', $questions);
    }
}
