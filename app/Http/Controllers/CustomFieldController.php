<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Acelle\Model\CustomField;
use Acelle\Model\CustomFieldChoice;
use Acelle\Model\Category;
use Acelle\Model\CustomFieldAnswer;
use Acelle\Model\CustomFieldTitle;
use Acelle\Model\Setting;
use Auth;

class CustomFieldController extends Controller
{
    public function addCustomField(Request $request){
    	return view('custom_fields.add_custom_fields');
    }

     public function index(){
        return view('custom_fields.customsvue');
       } 

   public function vuedata(){
    $categories = Category::with('customs','subcustoms','customs.choices','customtitles')->where('subdomain',Setting::subdomain())->where('cat_parent','1')->where('cat_parent_id',0)->orderBy('category_name','desc')->get();
    $categories = json_decode($categories);
    // dd($categories);
    return $categories;
   } 

   public function categoriesbyid($account,$id){

        if($id == 0){
            $categories = Category::with('customs','subcustoms','customs.choices')->where('subdomain',Setting::subdomain())->where('cat_parent_id',0)->orderBy('category_name','asc')->get();
            $subcategories = [];
        }
        else{

            $categories = Category::with('customs','subcustoms','customs.choices')->where('cat_parent','1')->where('id',$id)->orderBy('category_name','asc')->get();
            $subcategories = Category::where('cat_parent_id',$id)->where('cat_parent','1')->orderBy('category_name','desc')->get();
        }

        $categories = json_decode($categories);
      
        return ['categories' => $categories, 'subcat' => $subcategories];
   }

  public function subcategoriesbyid($account, $id)
    {
        if ($id == 0) {
            $subcategories = Category::with('customs', 'subcustoms', 'customs.choices', 'subcustoms.choices')
                ->where('cat_parent', '1')
                ->orderBy('category_name', 'desc')
                ->get();
        } else {
            $subcategories = Category::with('customs', 'subcustoms', 'customs.choices', 'subcustoms.choices')
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
                $mainCategoryQuestions = Category::with('customs', 'customs.choices')
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
        
       return view('custom_fields.addcustomfields');
        
    }

    public function searchcategory(Request $request){
       
        $categories = Category::where('cat_parent','1')->where('id',$request->id)->orderBy('id','desc')->get();
        
        return view('custom_fields.customsFilter',compact('categories'));
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
        $icon_options = $request->icon_option;
        // dd($icon_options);
        if(isset($request->check)){
        foreach ($request->check as $key => $que) {
        	if(isset($icon_options[$key])){

              $icon_option = array_values($icon_options[$key]);
        	}


            if($request->custom_field_id[$key] == null){

            $question = new CustomField;

            $question->category_id = $request->category_id;
            $question->subcategory_id = $request->sub_category_id;
            $question->user_id = $request->user()->id;
            $question->choice_selection = $que;
            $question->parent = '1';
            $question->subdomain = Setting::subdomain();
            $question->question = $request->question[$key];
            $question->icon = $request->icon[$key];
            $question->save();

        if($question->choice_selection != 'input'  && isset($choices[$key])){
          foreach ($choices[$key] as $key1 => $value) {
                $question_choice = new CustomFieldChoice;

                $question_choice->custom_field_id = $question->id;
                $question_choice->category_id = $request->category_id;
                $question_choice->user_id = $request->user()->id;
                $question_choice->choice= $value;
                $question_choice->icon_option= isset($icon_option[$key1]);

                if(isset($icon_option[$key1]) &&  $icon_option[$key1] == 'library'){
                	if(isset($choice_icon[$key][$key1])){
	                   $question_choice->icon = $choice_icon[$key][$key1];
	                 }
                }else{

	                if(isset($choice_icon[$key][$key1]) && $icon_option[$key1] == 'upload'){
	                    $image = $choice_icon[$key][$key1];
	                    $new_image = time().$image->getClientOriginalName();
	                    $destination = 'frontend-assets/images/categories';
	                    $image->move(public_path($destination),$new_image);
	                    $question_choice->icon = $new_image; 
	                }
                }
                $question_choice->save();
            }


            }

            }else{

            $question = CustomField::find($request->custom_field_id[$key]);

            $question->category_id = $request->category_id;
            $question->user_id = $request->user()->id;
            $question->choice_selection = $que;
            $question->parent = '1';
            $question->subdomain = Setting::subdomain();
            $question->question = $request->question[$key];
            $question->icon = $request->icon[$key];
            $question->save();

        if($question->choice_selection != 'input'  && isset($choices[$key])){
          foreach ($choices[$key] as $key1 => $value) {
            
            if(isset($request->choice_id[$key][$key1]) == null){
                $question_choice = new CustomFieldChoice;

                $question_choice->custom_field_id = $question->id;
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
                $question_choice = CustomFieldChoice::find($request->choice_id[$key][$key1]);
                 if($question_choice){

                $question_choice->custom_field_id = $question->id;
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
           return redirect('admin/custom-field')->withSuccess(['Success Message here!']);


    }

    public function editcustom($account,$id){
       $customs = CustomField::with('choices')->where('category_id',$id)->where('subcategory_id',null)->orderBy('re_order','asc')->get();
       // return $customs;
       $category_id = $id;
       return view('custom_fields.customappend',compact('customs','category_id'));
    }

    public function subeditcustom($account,$id){
       $category_id = '';
       $customs = CustomField::with('choices')->where('subcategory_id',$id)->get();
       $catDate = Category::where('id',$id)->first();
       $subcategory_id = $id;
       if($catDate){
          $category_id = $catDate->cat_parent_id;
          if(count($customs) < 1){
             $customs = CustomField::with('choices')->where('category_id',$category_id)->where('subcategory_id',0)->get();
             return view('custom_fields.maintosubcustomappend',compact('customs','category_id','subcategory_id'));
          }
       }
       
       return view('custom_fields.subcustomappend',compact('customs','category_id','subcategory_id'));
    }
    public function deletecustom($account,$id){
        CustomField::where('id',$id)->delete();
        return  redirect()->back();
    }
    public function deleteoption($account,$id){
         CustomFieldChoice::where('id',$id)->delete();
         return  redirect()->back();
    }
    public function deletechoice($account,$id){
        CustomFieldChoice::where('custom_field_id',$id)->delete();
        return  redirect()->back();
    }

    public function updateOrder(Request $request)
        {
            // return $request->all();
            $this->validate($request, [
                'questions.*.re_order' => 'required',
            ]);

                foreach($request->questions as $tasksNew) {
                   $question =  CustomField::find($tasksNew['id']);
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
    public function show()
    {
       $category_id = json_decode(Auth::user()->category_id);
       $customFields =  Category::with('customs', 'subcustoms', 'customs.choices', 'subcustoms.choices')
                ->where('cat_parent', '1')
                ->where('cat_parent_id', '0')
                ->whereIn('id', $category_id)
                ->orderBy('category_name', 'desc')
                ->get();

        return view('service_provider.customField', compact('customFields'));
    }

    public function storeQuestions(Request $request)
    {
    	// dd($request->all());
        // Validate incoming request data if needed
        // Handle input fields
        $groupedLastValues = [];
        $secondValues = [];
        if ($request->has('input_id')) {
            foreach ($request->input('input_id') as $index => $custom_field_id) {
                $this->saveOrUpdateAnswer($custom_field_id, $request->input('input')[$index]);
            }
        }

        // Handle radio button
	       if ($request->has('radio_id')) {
	            foreach ($request->input('radio_id') as $index => $custom_field_id) {
	                $answer = explode(',', array_values($request->input('option'))[$index])[1]; // Extract answer from option
	                $this->saveOrUpdateAnswer($custom_field_id, $answer);
	            }
	        }

	        // Handle checkboxes
          if($request->has('checkbox')){
				 foreach ($request->input('checkbox') as $index2 => $checkbox) {
			    $parts = explode(',', $checkbox); // Extract values from checkbox
			    $firstValue = $parts[0];
			    $secondValue = $parts[1];
			    $lastValue = end($parts);
			    
			    // Add last value to the array corresponding to the first value
			    $groupedLastValues[$firstValue][] = $lastValue;
			}

			// Ensure groupedLastValues is not empty before performing any actions
			if (count($groupedLastValues) > 0) {
			    // Pass $parts[0], $parts[1], and array_values($groupedLastValues) to the choiceSaveUdateAnswer function
			    foreach ($groupedLastValues as $key => $values) {
			        $this->choiceSaveUdateAnswer($key, $parts[1], $values);
			    }
			}
    }
         return  redirect()->back();
    }

    private function saveOrUpdateAnswer($custom_field_id, $answer)
    {
        $user_id = auth()->id(); // Get the current user ID
        $existingAnswer = CustomFieldAnswer::where('custom_field_id', $custom_field_id)
            ->where('user_id', $user_id)
            ->first();

        if ($existingAnswer) {
            $existingAnswer->update(['answer' => $answer]);
        } else {
            CustomFieldAnswer::create([
                'custom_field_id' => $custom_field_id,
                'user_id' => $user_id,
                'answer' => $answer,
            ]);
        }
    }


    private function choiceSaveUdateAnswer($custom_field_id, $answer,$choice_id)
    {
    	// dd($custom_field_id, $answer,$choice_id);
          $user_id = auth()->id(); // Get the current user ID
          $existingAnswer = CustomFieldAnswer::where('custom_field_id', $custom_field_id)
		    ->where('user_id', $user_id)
		    ->delete();

        // if ($existingAnswer) {
        //     $existingAnswer->update(['answer' => $answer]);
        // } else {
        	foreach ($choice_id as $key => $id) {
        		// dd($id);
        		 CustomFieldAnswer::create([
                'custom_field_id' => $custom_field_id,
                'custom_field_choice_id' => $id,
                'user_id' => $user_id,
                'answer' => $answer,
            ]);
        	}
           
        // }
    }

    public function changeCustomText(Request $request){

      if($request->id){
       $customText = CustomFieldTitle::find($request->id);
       $customText->title = $request->custom_text;
       $customText->save();
       return $customText;
      }
      else{
       $customText = new CustomFieldTitle();
       $customText->title = $request->custom_text;
       $customText->category_id = $request->category_id;
       $customText->subdomain = Setting::subdomain();
       $customText->save();
       return $customText;
      }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Acelle\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomField $question)
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
    public function update(Request $request, CustomField $question)
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
        $question = CustomField::find($id);
        $question->delete();
        return redirect()->back()->with('success', 'your message,here'); 
    }
}
