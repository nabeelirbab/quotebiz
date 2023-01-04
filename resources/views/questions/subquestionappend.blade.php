               <div class="col-sm-12 p-0 mb-4">
                <div class="form-group">
                    <label class="form-label" for="default-01">Select Sub Category </label>
                    <div class="form-control-wrap">
                       <select class="form-control" name="sub_category_id" onchange="subcategory(this)">
                           <option selected>Select Sub Category</option>
                           @foreach(Acelle\Jobs\HelperJob::mysubcategories($category_id) as $subcategory)
                           <option value="{{$subcategory->id}}" {{ $subcategory_id == $subcategory->id ? 'selected':'' }}>{{$subcategory->category_name}}</option>
                           @endforeach
                        </select>
                    </div>
                    <span title="Add New Question" id="addquestion" class="addQuestions material-icons-round add-icon xtooltip tooltipstered lh-1 float-end fs-1" style="cursor: pointer;position: absolute;top: 27px;right: -45px;display: none">add_circle</span>
                </div>

            </div>
            <div class="startQuestion">
            @if(count($questions) > 0)
            <input type="hidden" id="addQuestionIndex0" name="addQuestionIndex0" value="{{count($questions)}}">
           @foreach($questions as $key=>$question)
            <input type="hidden" id="addQuestionIndex" name="addQuestionIndex" value="{{$key}}">
            <input type="hidden" name="category_id" value="{{$question->category_id}}">
            <div class="removeQuestion mt-4" style="background: #f5f6fa;padding: 20px;border-radius:15px">
             <div class="row mb-4">
                <div class="col-xs-6 col-md-2">
                    <div class="custom-control custom-checkbox">
                    <input type="radio" name="check[{{$key}}]" class="custom-control-input checking" id="input{{$key}}" value="input" {{($question->choice_selection == 'input') ? 'checked' : ''}}>
                    <label class="custom-control-label" for="input{{$key}}">Input Field</label>
                </div>
                </div>
                <div class="col-xs-6 col-md-3"><div class="custom-control custom-checkbox">
                <input type="radio" name="check[{{$key}}]" class="custom-control-input checking" id="customCheck{{$key}}" value="single" {{($question->choice_selection == 'single') ? 'checked' : ''}} >
                <label class="custom-control-label" for="customCheck{{$key}}">Single Choice</label>
                </div></div>
                <div class="col-xs-6 col-md-3"><div class="custom-control custom-checkbox">
                    <input type="radio" name="check[{{$key}}]" class="custom-control-input checking" id="customChecks{{$key}}" value="multiple" {{($question->choice_selection == 'multiple') ? 'checked' : ''}}>
                    <label class="custom-control-label" for="customChecks{{$key}}">Multiple Choice</label>
                </div>
                </div>
                <div class="col-xs-6 col-md-2 pr-0">
                    <div class="custom-control custom-checkbox">
                    <input type="radio" name="check[{{$key}}]" class="custom-control-input checking" id="date{{$key}}" value="datepicker" {{($question->choice_selection == 'datepicker') ? 'checked' : ''}}>
                    <label class="custom-control-label" for="date{{$key}}">Date Picker</label>
                </div>
                </div>
                
                <div class="col-xs-6 col-md-2" style="padding-right: 0;"><span title="Remove Question" class="deleteQuestions material-icons-round remove-icon xtooltip tooltipstered lh-1 float-end fs-1" style="cursor: pointer;">remove_circle</span><input type="hidden" name="question_id[{{$key}}]" value="{{$question->id}}">
                </div> 
               </div>
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Enter Question</label>
                            <div class="form-control-wrap">
                                <input type="text" value="{{$question->question}}" class="form-control" name="question[{{$key}}]"  placeholder="Enter Question" required>
                            </div>
                        </div>
                    </div>
                   
                    <div class="appendChoice ">
                  @if($question->choice_selection !='input' && $question->choice_selection !='datepicker')      
                 @foreach($question->choices as $key2=>$choice)
                    <div class="row removeChoices pr-0">
                        <div class="col-sm-5 ">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Enter Option</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="choice[{{$key}}][]"  placeholder="Enter option" value="{{$choice->choice}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                    <div class="form-group">
                            <label class="form-file-label" for="default-06">Icon (optional)</label>
                            <div class="form-control-wrap">
                                <div class="custom-file">
                                    <input type="file" accept="image/*" name="choice_icon[{{$key}}][]" class="custom-file-input" value="{{$choice->icon}}" >
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="col-sm-2 pr-1"><span title="Remove Option" class="deleteChoice material-icons-round remove-icon xtooltip tooltipstered  float-end fs-3" style="cursor: pointer;line-height:3!important;color: #44e8bc;">remove_circle</span><input type="hidden" value="{{$choice->id}}" name="choice_id[{{$key}}][]"></div>
                    </div>
                    @endforeach
                    @endif
                </div>
                 @if($question->choice_selection !='input' && $question->choice_selection !='datepicker')
                    <div class="appendChoiceInput col-sm-12 pr-1"><span title="Add Option" class="addChoice material-icons-round add-icon xtooltip tooltipstered  float-end fs-3" style="cursor: pointer;line-height:3!important;color: #44e8bc;">add_circle</span><input type="hidden" value="{{$key}}"></div>
                    @endif
            </div>
        </div>
    @endforeach
    @else
        <input type="hidden" id="startQuestions" name="addQuestionIndex0" value="{{count($questions)}}">
        <div class="removeQuestion mt-4" style="background: #f5f6fa;padding: 20px;border-radius:15px">
           <div class="row mb-4">
             <input type="hidden" name="question_id[0]" value="">
               <div class="col-sm-2"><div class="custom-control custom-checkbox">
                   <input type="radio" name="check[0]" class="custom-control-input checking" id="inputconditionUp" value="input" checked>
                   <label class="custom-control-label" for="inputconditionUp">Input Field</label>
               </div>
               </div>
               <div class="col-sm-3"><div class="custom-control custom-checkbox">
               <input type="radio" name="check[0]" class="custom-control-input checking" id="customCheckconditionUp" value="single">
               <label class="custom-control-label" for="customCheckconditionUp">Single Choice</label>
               </div></div>
               <div class="col-sm-3"><div class="custom-control custom-checkbox">
                   <input type="radio" name="check[0]" class="custom-control-input checking" id="customChecksconditionUp" value="multiple">
                   <label class="custom-control-label" for="customChecksconditionUp">Multiple Choice</label>
               </div>
               </div>
               <div class="col-sm-2 pr-0"><div class="custom-control custom-checkbox">
                   <input type="radio" name="check[0]" class="custom-control-input checking" id="dateconditionUp" value="datepicker">
                   <label class="custom-control-label" for="dateconditionUp">Date Picker</label>
               </div>
               </div>
               <div class="col-sm-2" style="padding-right: 0;"><span title="Remove Question" class="removeQuestions material-icons-round remove-icon xtooltip tooltipstered lh-1 float-end fs-1" style="cursor: pointer;">remove_circle</span></div> </div>
               <div class="row"><div class="col-sm-12 mb-4">
                       <div class="form-group">
                           <label class="form-label" for="default-01">Enter Question</label>
                           <div class="form-control-wrap">
                               <input type="text" class="form-control" name="question[0]"  placeholder="Enter Question" required>
                           </div>
                       </div>
                   </div>
                   
                   <div class="appendChoice">
                  </div>
                  <div class="appendChoiceInput col-sm-12 pr-1"><span title="Add Option" class="addChoice material-icons-round add-icon xtooltip tooltipstered  float-end fs-3" style="cursor: pointer;line-height:3!important;color: #44e8bc;display: none">add_circle</span><input type="hidden" value="0"></div>
               </div></div></div>
    @endif
    </div>