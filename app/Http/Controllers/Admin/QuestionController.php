<?php

namespace Acelle\Http\Controllers\Admin;

use Acelle\Http\Controllers\Controller;
use Acelle\Model\Question;
use Acelle\Model\QuestionChoice;
use Acelle\Model\Category;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::orderBy('id','desc')->get();
        // dd($questions);
         return view('admin.questions.questions',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.questions.addquestion');
        
    }

    public function searchcategory(Request $request){
        if(!$request->id){
        $questions = Question::orderBy('id','desc')->get();

        }else{

        $questions = Question::where('category_id',$request->id)->orderBy('id','desc')->get();
        }
        return view('admin.questions.questionsFilter',compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $choices = array_values($request->choice);
        $choice_icon = $request->choice_icon;
        // dd($choice_icon);

        foreach (array_values($request->check) as $key => $que) {

            $question = new Question;

            $question->category_id = $request->category_id;
            $question->user_id = $request->user()->id;
            $question->choice_selection = $que;
            $question->question = $request->question[$key];
            $question->save();

          foreach ($choices[$key] as $key1 => $value) {

            $question_choice = new QuestionChoice;

            $question_choice->question_id = $question->id;
            $question_choice->category_id = $request->category_id;
            $question_choice->user_id = $request->user()->id;
            $question_choice->choice= $value;

            if($choice_icon[$key][$key1] != 'input' && $choice_icon[$key][$key1] != 'datepicker'){
                
                $image = $choice_icon[$key][$key1];
                $new_image = time().$image->getClientOriginalName();
                $destination = 'frontend-assets/images/categories';
                $image->move(public_path($destination),$new_image);
                $question_choice->icon = $new_image;
            }else{
             
                $question_choice->icon = $choice_icon[$key][$key1];

            }

            $question_choice->save();

            } 
             
        }
           return redirect('admin/questions')->withSuccess(['Success Message here!']);


    }

    public function formstore(Request $request){
       dd($request->all()); 
    }
    /**
     * Display the specified resource.
     *
     * @param  \Acelle\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Acelle\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Acelle\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Acelle\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();
        return redirect()->back()->with('success', 'your message,here'); 
    }
}
