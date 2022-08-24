@extends('layouts.core.frontend')

@section('title', 'Add Questions')

@section('head')
  <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
@endsection

@section('content')
<?php $cat_id = Request::get('category_id'); ?>
<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Form Builder</h3>
                <div class="nk-block-des text-soft">
                    <p>Here you can make a list of questions in order to collect information from the potential customer and help the service provider provide an accurate quote.</p>
                </div>
            </div><!-- .nk-block-head-content -->
           
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="card card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Create Questions</span>
                 <form action="{{ url('questions/store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row d-flex justify-content-center gy-4">
                   
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Select Category </label>
                            <div class="form-control-wrap">
                               <select class="form-control" name="category_id" onchange="category(this)">
                                <option value="0" selected>Select Category</option>
                                   @foreach(Acelle\Jobs\HelperJob::mycategories() as $category)
                                   <option value="{{$category->id}}" {{ $cat_id == $category->id ? 'selected':'' }}>{{$category->category_name}}</option>
                                   @endforeach
                                     </select>
                            </div>
                            <span title="Add New Question" id="addquestion" class="addQuestions material-icons-round add-icon xtooltip tooltipstered lh-1 float-end fs-1" style="cursor: pointer;position: absolute;top: 27px;right: -45px;display: none">add_circle</span>
                        </div>

                    </div>
                       <div class="col-sm-7 mt-2" id="appendbox">
                        
                    </div>
                  

                    <div class="col-sm-7 text-center">
                        <button class="btn btn-success btn-lg" type="submit">Save</button>
                    </div>

                   
                </div>
              </form>
            </div>
        </div>
    </div><!-- .card-preview -->

</div>
@endsection

@section('script')

<script type="text/javascript">
     $(document).ready(function() {
         var category_id  = {
            value : '{{Request::get('category_id')}}',
         };

         var subcategory_id  = {
            value : '{{Request::get('sub_category_id')}}',
         };

         if(category_id.value){
            category(category_id);
         }

         if(subcategory_id.value){
            subcategory(subcategory_id);
         }
     });

    function category(data){
     $.ajax({url: "{{url('questions/editquestion/')}}/"+data.value, success: function(result){
         $('#addquestion').show();
         $('#appendbox').html(result);
         console.log(data.value);
        
        }});
        
    }

    function subcategory(data){
     $.ajax({url: "{{url('questions/subeditquestion/')}}/"+data.value, success: function(result){
         $('#addquestion').show();
         $('#appendbox').html(result);
         console.log(data.value);
        
        }});
        
    }
    
     var x=0;
         var y=0;
         var z=0;
         var conID = 0;
         var conditionUp = 0;

   $(document).on('click','.addQuestions',function(e){
     var storageid=$(e.target).parent().parent().parent().find('.startQuestion').children()[0].value;
       var  maxField=6;
        conID = 0;
        if(storageid < maxField){
             conditionUp = storageid;
                conditionUp ++;
     
        var html= '<div class="removeQuestion mt-4" style="background: #f5f6fa;padding: 20px;border-radius:15px"><div class="row mb-4"><input type="hidden" name="question_id['+storageid+']" value="">'+
                '<div class="col-sm-2"><div class="custom-control custom-checkbox">'+
                '<input type="radio" name="check['+storageid+']" class="custom-control-input checking" id="customCheck'+conditionUp+'" value="single" checked>'+
                '<label class="custom-control-label" for="customCheck'+conditionUp+'">Radio</label>'+
                '</div></div>'+
                '<div class="col-sm-2"><div class="custom-control custom-checkbox">'+
                    '<input type="radio" name="check['+storageid+']" class="custom-control-input checking" id="customChecks'+conditionUp+'" value="multiple">'+
                    '<label class="custom-control-label" for="customChecks'+conditionUp+'">Checkbox</label>'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-2"><div class="custom-control custom-checkbox">'+
                    '<input type="radio" name="check['+storageid+']" class="custom-control-input checking" id="input'+conditionUp+'" value="input">'+
                    '<label class="custom-control-label" for="input'+conditionUp+'">Input Box</label>'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-2 pr-0"><div class="custom-control custom-checkbox">'+
                    '<input type="radio" name="check['+storageid+']" class="custom-control-input checking" id="date'+conditionUp+'" value="datepicker">'+
                    '<label class="custom-control-label" for="date'+conditionUp+'">Date Picker</label>'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-4" style="padding-right: 0;"><span title="Remove Question" class="removeQuestions material-icons-round remove-icon xtooltip tooltipstered lh-1 float-end fs-1" style="cursor: pointer;">remove_circle</span></div> </div>'+
                '<div class="row"><div class="col-sm-10 mb-4">'+
                        '<div class="form-group">'+
                            '<label class="form-label" for="default-01">Enter Question</label>'+
                            '<div class="form-control-wrap">'+
                                '<input type="text" class="form-control" name="question['+storageid+']"  placeholder="Enter Question" required>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<span class="appendChoiceInput col-sm-2 pr-1"><span title="Add Option" class="addChoice material-icons-round add-icon xtooltip tooltipstered  float-end fs-3" style="cursor: pointer;line-height:3!important">add_circle</span><input type="hidden" value="'+storageid+'"></span>'+
                    '<div class="appendChoice">'+
                    '<input type="hidden" value="" name="choice_id['+storageid+'][]">'+
                    '<div class="row  pr-0"><div class="col-sm-6">'+
                        '<div class="form-group">'+
                            '<label class="form-label" for="default-01">Enter Option</label>'+
                            '<div class="form-control-wrap">'+
                                '<input type="text" class="form-control" name="choice['+storageid+'][]"  placeholder="Enter choice" required>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-4">'+
                    ' <div class="form-group">'+
                            '<label class="form-label" for="default-06">Icon (optional)</label>'+
                            '<div class="form-control-wrap">'+
                                '<div class="custom-file">'+
                                    '<input type="file" accept="image/*" name="choice_icon['+storageid+'][]" class="custom-file-input" value="c:/passwords.txt">'+
                                    '<label class="custom-file-label" for="customFile">Choose file</label>'+
                                '</div>'+
                            '</div>'+
                       '</div>'+
                    '</div>'+
                    '<div class="col-sm-2 pr-1"><span title="Remove Option" class="removeChoice material-icons-round remove-icon xtooltip tooltipstered  float-end fs-3" style="cursor: pointer;line-height:3!important">remove_circle</span></div></div>'+
                  
                '</div></div></div>';
                $('.startQuestion').append(html);
                  storageid++;
                y = storageid;
                // console.log(index);
                $(e.target).parent().parent().parent().find('.startQuestion').children()[0].value = storageid;
            }
    });

$(document).on('click','.removeQuestions',function(e){
         
        $(e.target).closest('.removeQuestion').last().remove();
 
});

$(document).on('click','.deleteQuestions',function(e){
    var id = $(e.target).parent().find('input')[0].value;
         var storageid=$('#startQuestions').val();
         $.ajax({
        url: "{{url('admin/questions/deletequestion')}}/"+id,
        type:"get",
        success:function(response){
           console.log(response);
        },
        error: function (xhr) {

        }

    });
        $(e.target).closest('.removeQuestion').last().remove();
 
});

$(document).on('click','.addChoice',function(e){
// yaha pay har click pay add karvaio ga usi div main
console.log($(e.target).parent().nextAll(".appendChoice").eq(0));
  var conditionid= $(e.target).parent().find('input')[0].value;
         console.log(conditionid);
        var  maxField=6;
    
            if(conditionid < maxField ){
                
                conID = conditionid;
                conID++;

         var html = '<div class="row removeChoices pr-0"><div class="col-sm-6">'+
                    '<input type="hidden" value="" name="choice_id['+conditionid+'][]">'+
                    '<div class="form-group">'+
                    '<label class="form-label" for="default-01">Enter Option</label>'+
                    '<div class="form-control-wrap">'+
                        '<input type="text" class="form-control" name="choice['+conditionid+'][]"  placeholder="Enter option" required>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-4">'+
            ' <div class="form-group">'+
                    '<label class="form-label" for="default-06">Icon (optional)</label>'+
                    '<div class="form-control-wrap">'+
                        '<div class="custom-file">'+
                            '<input type="file" accept="image/*" name="choice_icon['+conditionid+'][]" class="custom-file-input" value="">'+
                            '<label class="custom-file-label" for="customFile">Choose file</label>'+
                        '</div>'+
                    '</div>'+
               '</div>'+
            '</div>'+
            '<div class="col-sm-2 pr-1"><span title="Remove Option" class="removeChoice material-icons-round remove-icon xtooltip tooltipstered  float-end fs-3" style="cursor: pointer;line-height:3!important">remove_circle</span></div></div>';

            $(e.target).parent().nextAll(".appendChoice").eq(0).append(html);
        }
    });

$(document).on('click','.removeChoice',function(e){
    
 $(e.target).closest('.removeChoices').remove();
 
});
$(document).on('click','.deleteChoice',function(e){
    
    var id = $(e.target).parent().find('input')[0].value;
         $.ajax({
        url: "{{url('admin/questions/deleteoption')}}/"+id,
        type:"get",
        success:function(response){
           console.log(response);
        },
        error: function (xhr) {

        }

    });
 $(e.target).closest('.removeChoices').remove();
 
});


    $(document).on('change','.checking',function(e){

       if(typeof $(e.target).parent().parent().parent().find('.deleteQuestions').next()[0] != 'undefined'){
              var questionid = $(e.target).parent().parent().parent().find('.deleteQuestions').next()[0].value;
              $.ajax({
                    url: "{{url('admin/questions/deleteChoice')}}/"+questionid,
                    type:"get",
                    success:function(response){
                       console.log(response);
                    },
                    error: function (xhr) {

                    }

                });
          }

        var conditionid = $(e.target).parent().parent().parent().parent().parent().children()[0].value - 1;
// 
     if(e.target.value == 'input' || e.target.value == 'datepicker'){
      $(e.target).parent().parent().parent().parent().parent().find('.addChoice').empty();
      $(e.target).parent().parent().parent().parent().find('.appendChoice').empty();
      var html = '<input type="hidden" class="form-control" value="'+e.target.value+'" name="choice['+conditionid+'][]"  placeholder="Enter choice" required>'+
      '<input type="hidden" name="choice_icon['+conditionid+'][]" class="custom-file-input" value="'+e.target.value+'" required>';
      $(e.target).parent().parent().parent().parent().find('.appendChoice').append(html);

     }else{
      $(e.target).parent().parent().parent().parent().parent().find('.addChoice').html('add_circle');
        
      $(e.target).parent().parent().parent().parent().find('.appendChoice').empty();
        var html =  '<input type="hidden" value="0">'+
                    '<div class="row removeChoices pr-0"><div class="col-sm-6 ">'+
                    '<input type="hidden" value="" name="choice_id['+conditionid+'][]">'+
                        '<div class="form-group">'+
                            '<label class="form-label" for="default-01">Enter Option</label>'+
                            '<div class="form-control-wrap">'+
                                '<input type="text" class="form-control" name="choice['+conditionid+'][]"  placeholder="Enter choice" required>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-4">'+
                    '<div class="form-group">'+
                            '<label class="form-label" for="default-06">Icon (optional)</label>'+
                            '<div class="form-control-wrap">'+
                                '<div class="custom-file">'+
                                    '<input type="file" accept="image/*"  name="choice_icon['+conditionid+'][]" class="custom-file-input">'+
                                    '<label class="custom-file-label" for="customFile">Choose file</label>'+
                                '</div>'+
                            '</div>'+
                       '</div>'+
                    '</div>'+
                    '<div class="col-sm-2"><span title="Remove Option" class="removeChoice material-icons-round remove-icon xtooltip tooltipstered  float-end fs-3" style="cursor: pointer;line-height:3!important">remove_circle</span></div>'+
                    '</div>';
                    
                    console.log($(e.target).parent().parent().parent().find('.appendChoice'));
      $(e.target).parent().parent().parent().parent().find('.appendChoice').append(html);
     }
    // $('.appendChoice').hide();

    });
</script>
@endsection