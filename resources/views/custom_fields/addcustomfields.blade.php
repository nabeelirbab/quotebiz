@extends('layouts.core.frontend')

@section('title', 'Add Questions')

@section('head')
  <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
    <style type="text/css">
      .custom-file-label::after {
        position: absolute;
        top: 0px;
        right: 0;
        bottom: 0;
        z-index: 3;
        display: block;
        height: 3.125rem;
        padding: 0.4375rem 1rem;
        line-height: 2.25rem;
        color: #3c4d62;
        content: "Browse";
        background-color: #ebeef2;
        border-left: inherit;
        border-radius: 0 4px 4px 0;
     }
     label.custom-file-label{
      height: 48px;
      padding: 12px;
     }
     .custom-radio:hover label {
            color: #333;
        }

      .select2-selection--single:not([class*=bg-]):not([class*=border-]){
        height: calc(2.9rem + 2px) !important;
        color: #3c4d62;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #c1c1c1;
        border-radius: 4px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      }
      .select2-container--default .select2-selection--single .select2-selection__arrow{
        top: 10px !important;
      }
    </style>
@endsection

@section('content')
<?php $cat_id = Request::get('category_id'); ?>
<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Custom Field</h3>
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
    
                 <form action="{{ url('admin/custom-field/store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row d-flex justify-content-center gy-4">
                   
                    <div class="col-sm-7 m-0" style="padding: 0px !important">
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
                           
                        </div>

                    </div>
                       <div class="col-sm-7 m-0" style="padding: 0px !important" id="appendbox">
                        
                    </div>
                    <div class="col-sm-7 text-center">
                     <span title="Add New Question" id="addquestion" class="addQuestions material-icons-round add-icon xtooltip tooltipstered lh-1 fs-1" style="cursor: pointer;">add_circle</span>
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

    var iconsOptions = @json(Acelle\Jobs\HelperJob::allicons()->map(function($icon) {
    return ['value' => $icon->icon, 'text' => $icon->icon, 'dataIcon' => asset('images/icons/'.$icon->icon)];
})->toArray());
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
           
     $.ajax({url: "{{url('admin/custom-field/editcustom/')}}/"+data.value, success: function(result){
         // $('#addquestion').show();
         $('#appendbox').html(result);
         console.log(data.value);
        
        }});
        
    }

    function subcategory(data){
     $.ajax({url: "{{url('admin/custom-field/subeditcustom/')}}/"+data.value, success: function(result){
         // $('#addquestion').show();
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
      var optionsHtml = '<option value="">Select Category</option>';
    iconsOptions.forEach(function(icon) {
        optionsHtml += '<option value="' + icon.value + '" data-icon="' + icon.dataIcon + '">' + icon.text + '</option>';
    });
       var conditionUp=$(e.target).parent().parent().parent().find('.startQuestion').children()[0].value;
       var  maxField=10;
        conID = 0;
        if(conditionUp < maxField){
           conditionUp ++;
        var html= '<div class="removeQuestion mt-4" style="background: #f5f6fa;padding: 20px;border-radius:15px">'+
         
          '<div class="row mb-4"><input type="hidden" name="custom_field_id['+conditionUp+']" value="">'+
                '<div class="col-sm-3"><div class="custom-control custom-checkbox">'+
                    '<input type="radio" name="check['+conditionUp+']" class="custom-control-input checking" id="input'+conditionUp+'" value="input" checked>'+
                    '<label class="custom-control-label" for="input'+conditionUp+'">Input Field</label>'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-3"><div class="custom-control custom-checkbox">'+
                '<input type="radio" name="check['+conditionUp+']" class="custom-control-input checking" id="customCheck'+conditionUp+'" value="single">'+
                '<label class="custom-control-label" for="customCheck'+conditionUp+'">Single Choice</label>'+
                '</div></div>'+
                '<div class="col-sm-3"><div class="custom-control custom-checkbox">'+
                    '<input type="radio" name="check['+conditionUp+']" class="custom-control-input checking" id="customChecks'+conditionUp+'" value="multiple">'+
                    '<label class="custom-control-label" for="customChecks'+conditionUp+'">Multiple Choice</label>'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-1 pr-0">'+
                '</div>'+
                '<div class="col-sm-2" style="padding-right: 0;"><span title="Remove Question" class="removeQuestions material-icons-round remove-icon xtooltip tooltipstered lh-1 float-end fs-1" style="cursor: pointer;">remove_circle</span></div> </div>'+
                 '<div class="row">'+
                 '<div class="col-sm-7 mb-4">'+
                        '<div class="form-group">'+
                            '<label class="form-label" for="default-01">Enter Question</label>'+
                            '<div class="form-control-wrap">'+
                                '<input type="text" class="form-control" name="question['+conditionUp+']"  placeholder="Enter Question" required>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                      '<div class="col-sm-5 mb-4">'+
                        '<div class="form-group">'+
                            '<label class="form-label" for="default-01">Select Icon</label>'+
                             '<div class="form-control-wrap">' +
                              '<select class="form-control selectsearch" id="maindropdownicons' + conditionUp + '" name="icon['+conditionUp+']">' + optionsHtml + '</select>' +
                          '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="appendChoice">'+
                   '</div>'+

                '<div class="appendChoiceInput col-sm-12 pr-1"><span title="Add Option" id="plusshow'+conditionUp+'" class="addChoice material-icons-round add-icon xtooltip tooltipstered float-end fs-3" style="cursor: pointer;line-height:3!important;color: #44e8bc;display:none">add_circle</span><input type="hidden" value="'+conditionUp+'"></div>'+
                '</div>'+
                '</div></div>';
                $('.startQuestion').append(html);
                y = conditionUp;
                // console.log(index);
                $(e.target).parent().parent().parent().find('.startQuestion').children()[0].value = conditionUp;
                  $('#maindropdownicons' + conditionUp).select2({
                templateResult: formatIcon, // Assuming you have this function defined for formatting results
                templateSelection: formatIconSelection // Assuming you have this function defined for formatting the selection
            });
            }
    });

$(document).on('click','.removeQuestions',function(e){
    var result = confirm("Want to delete?");
     if (result) {
        $(e.target).closest('.removeQuestion').last().remove();
      }
 
});


$(document).on('click','.deleteQuestions',function(e){
  var result = confirm("Want to delete?");
  if (result) {
    var id = $(e.target).parent().find('input')[0].value;
         var storageid=$('#startQuestions').val();
         $.ajax({
        url: "{{url('admin/custom-field/deletecustom')}}/"+id,
        type:"get",
        success:function(response){
           console.log(response);
        },
        error: function (xhr) {

        }

    });
        $(e.target).closest('.removeQuestion').last().remove();
 }
});
 var conID2 = 0;
$(document).on('click','.addChoice',function(e){
// yaha pay har click pay add karvaio ga usi div main
   var optionsHtml = '<option value="">Select Category</option>';
    iconsOptions.forEach(function(icon) {
        optionsHtml += '<option value="' + icon.value + '" data-icon="' + icon.dataIcon + '">' + icon.text + '</option>';
    });
console.log($(e.target).parent().parent().find('.appendChoice'));
  var conditionid= $(e.target).parent().find('input')[0].value;
         console.log(conditionid);
         var  maxField=10;

            if(conditionid < maxField ){
                conID2 = parseInt(conID2) + 1;

         var html = '<div class="row removeChoices pr-0"><div class="col-sm-10">'+
                    '<input type="hidden" value="" name="choice_id['+conditionid+'][]">'+
                    '<div class="form-group">'+
                    '<label class="form-label" for="default-01">Enter Option</label>'+
                    '<div class="form-control-wrap">'+
                        '<input type="text" class="form-control" name="choice['+conditionid+'][]"  placeholder="Enter option" required>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            // '<div class="col-sm-5 mt-4 ">'+
            //   '<div class="form-group">' +
            //     '<label class="form-label">Choose an option:</label>' +
            //     '<div class="form-control-wrap">' +
            //         '<div class="d-flex">' +
            //             '<div class="custom-control custom-radio custom-control-inline">' +
            //                 '<input type="radio" id="uploadOption'+conID2+'" name="icon_option['+conditionid+']['+conID2+']" class="custom-control-input" value="upload" checked>' +
            //                 '<label class="custom-control-label" for="uploadOption'+conID2+'">Upload icons</label>' +
            //             '</div>' +
            //             '<div class="custom-control custom-radio custom-control-inline">' +
            //                 '<input type="radio" id="libraryOption'+conID2+'" name="icon_option['+conditionid+']['+conID2+']" class="custom-control-input" value="library">' +
            //                 '<label class="custom-control-label" for="libraryOption'+conID2+'">Select icon from library</label>' +
            //             '</div>' +
            //         '</div>' +
            //     '</div>' +
            // '</div>'+
            //     '<div id="uploadSection'+conID2+'" class="form-group" >' +
            //     '<label class="form-label" for="customFile">Upload Category Icon (optional)</label>' +
            //     '<div class="form-control-wrap">' +
            //         '<div class="custom-file">' +
            //             '<input type="file" name="choice_icon['+conditionid+'][]" class="custom-file-input" id="customFile'+conID2+'">' +
            //             '<label class="custom-file-label" for="customFile'+conID2+'">Choose file</label>' +
            //         '</div>' +
            //     '</div>' +
            // '</div>' +
            // '<div id="librarySection'+conID2+'" class="form-group" style="display:none;">' +
            //     '<label class="form-label" for="dropdownicons'+conID2+'">Select Category Icon (optional)</label>' +
            //     '<div class="form-control-wrap">' +
            //         '<select class="form-control selectsearch" id="dropdownicons' + conID2 + '" name="choice_icon['+conditionid+'][]">' + optionsHtml + '</select>' +
            //     '</div>'+
            // '</div>'+
            // '</div>'+
            '<div class="col-sm-2 pr-1"><span title="Remove Option" class="removeChoice material-icons-round remove-icon xtooltip tooltipstered  float-end fs-3" style="cursor: pointer;line-height:3!important;color: #44e8bc;">remove_circle</span></div></div>';

            $(e.target).parent().parent().find('.appendChoice').append(html);
            // toggleUploadLibrarySections(conID2, conditionid);
        }
         $('#dropdownicons' + conID2).select2({
                templateResult: formatIcon, // Assuming you have this function defined for formatting results
                templateSelection: formatIconSelection // Assuming you have this function defined for formatting the selection
            });
            setupRadioButtonsEventListeners(conID2);

    });


    function formatIcon(icon) {
        console.log(icon);
        if (!icon.id) {
            return icon.text;
        }
        var $icon = $('<span><img src="' + icon.element.getAttribute('data-icon') + '" style="width:10%" class="img-icon" /> ' + icon.text + '</span>');
        return $icon;
    }

    function formatIconSelection(icon) {
        if (!icon.id) {
            return icon.text;
        }
        var $icon = $('<span><img src="' + icon.element.getAttribute('data-icon') + '" style="width:12%" class="img-icon" /> ' + icon.text + '</span>');
        return $icon;
    }


function setupRadioButtonsEventListeners(conID2) {
    // Event listener for "Upload icons" radio button
    $('#uploadOption' + conID2).click(function() {
        $('#uploadSection' + conID2).show();
        $('#librarySection' + conID2).hide();
    });
    
    // Event listener for "Select icon from library" radio button
    $('#libraryOption' + conID2).click(function() {
        $('#uploadSection' + conID2).hide();
        $('#librarySection' + conID2).show();
    });
}

// $(document).ready(function() {
//     // Listen for changes on radio buttons within the document
//     $(document).on('change', '[id^="uploadOption0"], [id^="libraryOption0"]', function() {
//         // Find the closest parent that contains both the radio buttons and the target sections
//         var $closestParent = $(this).closest('.appendChoice');
        
//         // Assuming 'conditionid' can be derived from an input within the same '.appendChoice' container
//         var conditionid = $closestParent.find('input[type="hidden"]').val();
        
//         // Now use 'conditionid' to toggle visibility
//         if ($('#uploadOption0' + conditionid).is(':checked')) {
//             $('#uploadSection0' + conditionid).show();
//             $('#librarySection0' + conditionid).hide();
//         } else if ($('#libraryOption0' + conditionid).is(':checked')) {
//             $('#uploadSection0' + conditionid).hide();
//             $('#librarySection0' + conditionid).show();
//         }
//     });
// });

$(document).on('click','.removeChoice',function(e){
   var result = confirm("Want to delete?");
    if (result) { 
     $(e.target).closest('.removeChoices').remove();
    }
 
});
$(document).on('click','.deleteChoice',function(e){
  var result = confirm("Want to delete?");
  if (result) {
    var id = $(e.target).parent().find('input')[0].value;
         $.ajax({
        url: "{{url('admin/custom-field/deleteoption')}}/"+id,
        type:"get",
        success:function(response){
           console.log(response);
        },
        error: function (xhr) {

        }

    });
 $(e.target).closest('.removeChoices').remove();
 }
});


    $(document).on('change','.checking',function(e){

       if(typeof $(e.target).parent().parent().parent().find('.deleteQuestions').next()[0] != 'undefined'){
              var questionid = $(e.target).parent().parent().parent().find('.deleteQuestions').next()[0].value;
              $.ajax({
                    url: "{{url('admin/custom-field/deleteChoice')}}/"+questionid,
                    type:"get",
                    success:function(response){
                       console.log(response);
                    },
                    error: function (xhr) {

                    }

                });
          }

        var conditionid = $(e.target).parent().parent().parent().parent().parent().children()[0].value;
        console.log(conditionid);
// 
     if(e.target.value == 'input' || e.target.value == 'datepicker'){
      $(e.target).parent().parent().parent().parent().find('.addChoice').hide();
      $(e.target).parent().parent().parent().parent().find('.appendChoice').empty();
      var html = '<input type="hidden" class="form-control" value="'+e.target.value+'" name="choice['+conditionid+'][]"  placeholder="Enter choice" required>'+
      '<input type="hidden" name="choice_icon['+conditionid+'][]" class="custom-file-input" value="'+e.target.value+'" required>';

      $(e.target).parent().parent().parent().parent().find('.appendChoice').append(html);

     }else{
        var optionsHtml = '<option value="">Select Category</option>';
        iconsOptions.forEach(function(icon) {
            optionsHtml += '<option value="' + icon.value + '" data-icon="' + icon.dataIcon + '">' + icon.text + '</option>';
        });
       $(e.target).parent().parent().parent().parent().find('.addChoice').show();
      // $(e.target).parent().parent().parent().parent().parent().find('.addChoice').html('add_circle');
        
      $(e.target).parent().parent().parent().parent().find('.appendChoice').empty();
        var html =  '<input type="hidden" value="0">'+
                    '<div class="row removeChoices pr-0"><div class="col-sm-10">'+
                    '<input type="hidden" value="" name="choice_id['+conditionid+'][]">'+
                        '<div class="form-group">'+
                            '<label class="form-label" for="default-01">Enter Option</label>'+
                            '<div class="form-control-wrap">'+
                                '<input type="text" class="form-control" name="choice['+conditionid+'][]"  placeholder="Enter option" required>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    // '<div class="col-sm-5 mt-4">'+
                    //     '<div class="form-group">' +
                    //     '<label class="form-label">Choose an option:</label>' +
                    //     '<div class="form-control-wrap">' +
                    //         '<div class="d-flex">' +
                    //             '<div class="custom-control custom-radio custom-control-inline">' +
                    //                 '<input type="radio" id="uploadOption0'+conditionid+'" name="icon_option['+conditionid+'][0]" class="custom-control-input" value="upload" checked>' +
                    //                 '<label class="custom-control-label" for="uploadOption0'+conditionid+'">Upload icons</label>' +
                    //             '</div>' +
                    //             '<div class="custom-control custom-radio custom-control-inline">' +
                    //                 '<input type="radio" id="libraryOption0'+conditionid+'" name="icon_option['+conditionid+'][0]" class="custom-control-input" value="library">' +
                    //                 '<label class="custom-control-label" for="libraryOption0'+conditionid+'">Select icon from library</label>' +
                    //             '</div>' +
                    //         '</div>' +
                    //     '</div>' +
                    // '</div>'+
                    //     '<div id="uploadSection0'+conditionid+'" class="form-group" >' +
                    //     '<label class="form-label" for="customFile">Upload Category Icon (optional)</label>' +
                    //     '<div class="form-control-wrap">' +
                    //         '<div class="custom-file">' +
                    //             '<input type="file" name="choice_icon['+conditionid+'][]" class="custom-file-input" id="customFile0'+conditionid+'">' +
                    //             '<label class="custom-file-label" for="customFile0'+conditionid+'">Choose file</label>' +
                    //         '</div>' +
                    //     '</div>' +
                    // '</div>' +
                    // '<div id="librarySection0'+conditionid+'" class="form-group" style="display:none;">' +
                    //     '<label class="form-label" for="dropdownicons0'+conditionid+'">Select Category Icon (optional)</label>' +
                    //     '<div class="form-control-wrap">' +
                    //         '<select class="form-control selectsearch" id="dropdownicons0'+conditionid+'" name="choice_icon['+conditionid+'][]">' + optionsHtml + '</select>' +
                    //     '</div>'+
                    // '</div>'+
                    // '</div>'+
                    '<div class="col-sm-2 pr-1"><span title="Remove Option" class="removeChoice material-icons-round remove-icon xtooltip tooltipstered  float-end fs-3" style="cursor: pointer;line-height:3!important;color: #44e8bc;">remove_circle</span></div>'+
                    '</div>';
                    
      $(e.target).parent().parent().parent().parent().find('.appendChoice').append(html);
     }
    // $('.appendChoice').hide();
     $('#dropdownicons0'+conditionid).select2({
                templateResult: formatIcon, // Assuming you have this function defined for formatting results
                templateSelection: formatIconSelection // Assuming you have this function defined for formatting the selection
            });
     var id = '0'+conditionid;
     setupRadioButtonsEventListeners(id);

    });
</script>
@endsection