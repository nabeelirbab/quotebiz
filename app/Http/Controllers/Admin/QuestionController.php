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
        $categories = Category::where('cat_parent','0')->orderBy('category_name','desc')->paginate(10);
        $questionsCount = Question::where('parent','0')->count();
        // dd($questionsCount);
         return view('admin.questions.questions',compact('categories','questionsCount'));
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
       
        $categories = Category::where('cat_parent','0')->where('id',$request->id)->orderBy('id','desc')->get();
        
        return view('admin.questions.questionsFilter',compact('categories'));
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
        $choices = $request->choice;
        $choice_icon = $request->choice_icon;
        // dd($choice_icon[0][1]);
        if(isset($request->check)){
        foreach ($request->check as $key => $que) {

            if($request->question_id[$key] == null){

            $question = new Question;

            $question->category_id = $request->category_id;
            $question->user_id = $request->user()->id;
            $question->choice_selection = $que;
            $question->question = $request->question[$key];
            $question->save();

        if($question->choice_selection != 'input' && $question->choice_selection != 'datepicker' && isset($choices[$key])){
          foreach ($choices[$key] as $key1 => $value) {

            
                $question_choice = new QuestionChoice;

                $question_choice->question_id = $question->id;
                $question_choice->category_id = $request->category_id;
                $question_choice->user_id = $request->user()->id;
                $question_choice->choice= $value;

                if(isset($choice_icon[$key][$key1])){
                    $image = $choice_icon[$key][$key1];
                    $new_image = time().$image->getClientOriginalName();
                    $destination = 'frontend-assets/images/categories';
                    $image->move(public_path($destination),$new_image);
                    $question_choice->icon = $new_image; 
                }
                
                $question_choice->save();
            }


            }

            }else{

             $question = Question::find($request->question_id[$key]);

            $question->category_id = $request->category_id;
            $question->user_id = $request->user()->id;
            $question->choice_selection = $que;
            $question->question = $request->question[$key];
            $question->save();

        if($question->choice_selection != 'input' && $question->choice_selection != 'datepicker' && isset($choices[$key])){
          foreach ($choices[$key] as $key1 => $value) {
            
            if(isset($request->choice_id[$key][$key1]) == null){
                $question_choice = new QuestionChoice;

                $question_choice->question_id = $question->id;
                $question_choice->category_id = $request->category_id;
                $question_choice->user_id = $request->user()->id;
                $question_choice->choice= $value;

                if(isset($choice_icon[$key][$key1])){
                    $image = $choice_icon[$key][$key1];
                    $new_image = time().$image->getClientOriginalName();
                    $destination = 'frontend-assets/images/categories';
                    $image->move(public_path($destination),$new_image);
                    $question_choice->icon = $new_image; 
                }
                
                $question_choice->save();
            }else{
                
             if(isset($request->choice_id[$key][$key1])){
                $question_choice = QuestionChoice::find($request->choice_id[$key][$key1]);
                 if($question_choice){

                $question_choice->question_id = $question->id;
                $question_choice->category_id = $request->category_id;
                $question_choice->user_id = $request->user()->id;
                $question_choice->choice= $value;

                if(isset($choice_icon[$key][$key1])){
                    $image = $choice_icon[$key][$key1];
                    $new_image = time().$image->getClientOriginalName();
                    $destination = 'frontend-assets/images/categories';
                    $image->move(public_path($destination),$new_image);
                    $question_choice->icon = $new_image; 
                }

                $question_choice->save();

            }
        }
 
            } 
        }
        }
    }
    }
    }
           return redirect('admin/questions')->withSuccess(['Success Message here!']);


    }

    public function editquestion($id){
       $questions = Question::with('choices')->where('category_id',$id)->get();
       return view('admin.questions.questionappend',compact('questions'));
    }
    public function deletequestion($id){
        return Question::where('id',$id)->delete();
    }
    public function deleteoption($id){
        return QuestionChoice::where('id',$id)->delete();
    }
    public function deletechoice($id){
        return QuestionChoice::where('question_id',$id)->delete();
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
