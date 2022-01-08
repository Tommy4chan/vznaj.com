<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Questions;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(){
        $questions = new Questions();
        return view('home', ['questions' => $questions -> all()]);
    }

    public function subject($subject){
        $questions = new Questions();
        if ($subject == 'math')
            return view('subject', ['questions' => $questions -> where('subject','=', $subject)->get()])->with('subject','Математика');
        elseif ($subject == 'literature')
            return view('subject', ['questions' => $questions -> where('subject','=', $subject)->get()])->with('subject','Література');
        else{
            return abort(404);
        }
    }

    public function task($subject, $id){
        $exist = Questions::where('id', '=', $id)->first();
        if ($exist === null) {
            return abort(404);
        }
        else{
            $questions = new Questions();
            if ($subject == 'math')
                return view('task', ['questions' => $questions -> where('id','=', $id)->get()]);
            elseif ($subject == 'literature')
                return view('task', ['questions' => $questions -> where('id','=', $id)->get()]);
            else{
                return abort(404);
            }
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
}
