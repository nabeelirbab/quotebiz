            
            <div class="startQuestion">
            @if(count($questions) > 0)
            <input type="hidden" id="addQuestionIndex0" name="addQuestionIndex0" value="{{count($questions)}}">
            @foreach($questions as $key=>$question)
            <input type="hidden" id="addQuestionIndex" name="addQuestionIndex" value="{{$key}}">
            <input type="hidden" name="category_id" value="{{$question->category_id}}"><div class="removeQuestion mb-4">
             <div class="row mb-4">
                <div class="col-sm-2"><div class="custom-control custom-checkbox">
                <input type="radio" name="check[{{$key}}]" class="custom-control-input checking" id="customCheck{{$key}}" value="single" {{($question->choice_selection == 'single') ? 'checked' : ''}} >
                <label class="custom-control-label" for="customCheck{{$key}}">Radio</label>
                </div></div>
                <div class="col-sm-2"><div class="custom-control custom-checkbox">
                    <input type="radio" name="check[{{$key}}]" class="custom-control-input checking" id="customChecks{{$key}}" value="multiple" {{($question->choice_selection == 'multiple') ? 'checked' : ''}}>
                    <label class="custom-control-label" for="customChecks{{$key}}">Checkbox</label>
                </div>
                </div>
                <div class="col-sm-2">
                    <div class="custom-control custom-checkbox">
                    <input type="radio" name="check[{{$key}}]" class="custom-control-input checking" id="input{{$key}}" value="input" {{($question->choice_selection == 'input') ? 'checked' : ''}}>
                    <label class="custom-control-label" for="input{{$key}}">Input Box</label>
                </div>
                </div>
                <div class="col-sm-2">
                    <div class="custom-control custom-checkbox">
                    <input type="radio" name="check[{{$key}}]" class="custom-control-input checking" id="date{{$key}}" value="datepicker" {{($question->choice_selection == 'datepicker') ? 'checked' : ''}}>
                    <label class="custom-control-label" for="date{{$key}}">Date Picker</label>
                </div>
                </div>
                
                <div class="col-sm-4" style="padding-right: 0;"><span title="Remove Question" class="deleteQuestions material-icons-round remove-icon xtooltip tooltipstered lh-1 float-end fs-1" style="cursor: pointer;">remove_circle</span><input type="hidden" name="question_id[{{$key}}]" value="{{$question->id}}"></div> </div>
                <div class="row">
                    <div class="col-sm-10 mb-4">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Enter Question</label>
                            <div class="form-control-wrap">
                                <input type="text" value="{{$question->question}}" class="form-control" name="question[{{$key}}]"  placeholder="Enter Question" required>
                            </div>
                        </div>
                    </div>
                    <div class="appendChoiceInput col-sm-2"><span title="Add Option" class="addChoice material-icons-round add-icon xtooltip tooltipstered  float-end fs-3" style="cursor: pointer;line-height:3!important">add_circle</span><input type="hidden" value="{{$key}}"></div>
                    <div class="appendChoice mb-5 mt-3" style="border-bottom:dotted">
                  @if($question->choice_selection !='input' && $question->choice_selection !='datepicker')      
                 @foreach($question->choices as $key2=>$choice)
                
                    <div class="row removeChoices pr-0">
                        <div class="col-sm-6 ">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Enter Option</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="choice[{{$key}}][]"  placeholder="Enter option" value="{{$choice->choice}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
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
                    <div class="col-sm-2"><span title="Remove Option" class="deleteChoice material-icons-round remove-icon xtooltip tooltipstered  float-end fs-3" style="cursor: pointer;line-height:3!important">remove_circle</span><input type="hidden" value="{{$choice->id}}" name="choice_id[{{$key}}][]"></div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    @else
    <input type="hidden" id="startQuestions" name="addQuestionIndex0" value="{{count($questions)}}">
    @endif
    </div>