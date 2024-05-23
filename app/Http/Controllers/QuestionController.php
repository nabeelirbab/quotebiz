<?php

namespace Acelle\Http\Controllers;

use Acelle\Model\Question;
use Acelle\Model\QuestionChoice;
use Acelle\Model\Category;
use Acelle\Model\Setting;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resourcRVe.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $categories = Category::where('cat_parent','1')->orderBy('category_name','desc')->paginate(10);
    //     $questionsCount = Question::where('subdomain',Setting::subdomain())->where('parent','1')->count();
    //      return view('questions.questions',compact('categories','questionsCount'));
    // }
    public function index(){
        return view('questions.questionsvue');
       } 

   public function vuedata(){
    $categories = Category::with('questions','subquestions','questions.choices')->where('subdomain',Setting::subdomain())->where('cat_parent','1')->where('cat_parent_id',0)->orderBy('category_name','desc')->get();
    $categories = json_decode($categories);
    // dd($categories);
    return $categories;
   } 

   public function categoriesbyid($account,$id){

        if($id == 0){
            $categories = Category::with('questions','subquestions','questions.choices')->where('subdomain',Setting::subdomain())->where('cat_parent_id',0)->orderBy('category_name','asc')->get();
            $subcategories = [];
        }
        else{

            $categories = Category::with('questions','subquestions','questions.choices')->where('cat_parent','1')->where('id',$id)->orderBy('category_name','asc')->get();
            $subcategories = Category::where('cat_parent_id',$id)->where('cat_parent','1')->orderBy('category_name','desc')->get();
        }

        $categories = json_decode($categories);
      
        return ['categories' => $categories, 'subcat' => $subcategories];
   }

  public function subcategoriesbyid($account, $id)
    {
        if ($id == 0) {
            $subcategories = Category::with('questions', 'subquestions', 'questions.choices', 'subquestions.choices')
                ->where('cat_parent', '1')
                ->orderBy('category_name', 'desc')
                ->get();
        } else {
            $subcategories = Category::with('questions', 'subquestions', 'questions.choices', 'subquestions.choices')
                ->where('cat_parent', '1')
                ->where('id', $id)
                ->orderBy('category_name', 'desc')
                ->get();
        }

        $subcategories = json_decode($subcategories);

        // Check if questions and subquestions are empty, then get main category questions
        foreach ($subcategories as $subcategory) {
            if (empty($subcategory->questions) && empty($subcategory->subquestions)) {
                // Get main category questions
                $mainCategoryQuestions = Category::with('questions', 'questions.choices')
                    ->where('id', $subcategory->cat_parent_id)
                    ->orderBy('category_name', 'desc')
                    ->first(); // Use first() to get the first item of the collection

                // Merge the main category questions into the current subcategory
                $subcategory->subquestions = $mainCategoryQuestions->questions;
            }
        }

        return $subcategories;
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
            $question->subcategory_id = $request->sub_category_id;
            $question->user_id = $request->user()->id;
            $question->choice_selection = $que;
            $question->parent = '1';
            $question->subdomain = Setting::subdomain();
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
            $question->subdomain = Setting::subdomain();
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

    public function editquestion($account,$id){
       $questions = Question::with('choices')->where('category_id',$id)->where('subcategory_id',0)->get();
       $category_id = $id;
       return view('questions.questionappend',compact('questions','category_id'));
    }

    public function subeditquestion($account,$id){
       $category_id = '';
       $questions = Question::with('choices')->where('subcategory_id',$id)->get();
       $catDate = Category::where('id',$id)->first();
       $subcategory_id = $id;
       if($catDate){
          $category_id = $catDate->cat_parent_id;
          if(count($questions) < 1){
             $questions = Question::with('choices')->where('category_id',$category_id)->where('subcategory_id',0)->get();
             return view('questions.maintosubquestionappend',compact('questions','category_id','subcategory_id'));
          }
       }
       
       return view('questions.subquestionappend',compact('questions','category_id','subcategory_id'));
    }
    public function deletequestion($account,$id){
        Question::where('id',$id)->delete();
        return  redirect()->back();
    }
    public function deleteoption($account,$id){
         QuestionChoice::where('id',$id)->delete();
         return  redirect()->back();
    }
    public function deletechoice($account,$id){
        QuestionChoice::where('question_id',$id)->delete();
        return  redirect()->back();
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
