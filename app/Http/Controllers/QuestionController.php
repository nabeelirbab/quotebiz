<?php

namespace Acelle\Http\Controllers;

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
    // public function index()
    // {
    //     $categories = Category::where('cat_parent','1')->orderBy('category_name','desc')->paginate(10);
    //     $questionsCount = Question::where('subdomain',request('account'))->where('parent','1')->count();
    //      return view('questions.questions',compact('categories','questionsCount'));
    // }
    public function index(){
        return view('questions.questionsvue');
       } 

   public function vuedata(){
    $categories = Category::with('questions','questions.choices')->where('subdomain',request('account'))->where('cat_parent','1')->orderBy('category_name','desc')->get();
    $categories = json_decode($categories);
    // dd($categories);
    return $categories;
   } 

   public function categoriesbyid($account,$id){
   
    $categories = Category::with('questions','questions.choices')->where('id',$id)->orderBy('category_name','desc')->get();
    $categories = json_decode($categories);
    // dd($categories);
    return $categories;
   }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('questions.addquestion');
        
    }

    public function searchcategory(Request $request){
       
        $categories = Category::where('cat_parent','1')->where('id',$request->id)->orderBy('id','desc')->get();
        
        return view('questions.questionsFilter',compact('categories'));
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
            $question->parent = '1';
            $question->subdomain = request('account');
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
            $question->parent = '1';
            $question->subdomain = request('account');
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
           return redirect('questions')->withSuccess(['Success Message here!']);


    }

    public function editquestion($account,$id){
       $questions = Question::with('choices')->where('category_id',$id)->get();
       return view('questions.questionappend',compact('questions'));
    }
    public function deletequestion($account,$id){
        return Question::where('id',$id)->delete();
    }
    public function deleteoption($account,$id){
        return QuestionChoice::where('id',$id)->delete();
    }
    public function deletechoice($account,$id){
        return QuestionChoice::where('question_id',$id)->delete();
    }

    public function updateOrder(Request $request)
        {
            // return $request->all();
            $this->validate($request, [
                'questions.*.re_order' => 'required',
            ]);

                foreach($request->questions as $tasksNew) {
                   $question =  Question::find($tasksNew['id']);
                   $question->re_order = $tasksNew['re_order'];
                   $question->save();
                   
                
            }

            return response('Updated Successfully.', 200);
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
