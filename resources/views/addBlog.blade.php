@extends('layouts.core.frontend')
@section('title', 'Add Blog')
@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
    <style type="text/css">
      .tox-tinymce {
          border: 1px solid #e5e9f2;
          border-radius: 4px;
          box-shadow: none;
          box-sizing: border-box;
          display: flex;
          flex-direction: column;
          overflow: hidden;
          position: relative;
          visibility: inherit !important;
          height: 1200px !important;
      }
      .form-control, div.dataTables_wrapper div.dataTables_filter input, .dual-listbox .dual-listbox__search {
        display: block;
        width: 100%;
        height: calc(2.9rem + 2px) !important;
        padding: 0.4375rem 1rem;
        font-size: 1.6rem;
        font-weight: bold;
        line-height: 1.25rem;
        color: #3c4d62;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #c1c1c1;
        border-radius: 4px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
      .editcurrency{
        padding: 0;
        font-size: 15px !important;
        color: #3fbd9a !important;
        display: contents !important;
      }
       .form-group:last-child {
            margin-bottom: 0px !important;
        }
       .uldesign{
        list-style: auto;
        text-align: justify;
        padding: 10px;
        font-size: 15px;
       }
       .uldesign li{
         list-style: auto;
         margin-bottom: 5px;
       }
       .fade.in {
          opacity: 1
        }

        .fade {
          opacity: 0;
          -webkit-transition: opacity .15s linear;
          -o-transition: opacity .15s linear;
          transition: opacity .15s linear
        }
        .switch {
  position: relative;
  display: inline-block;
  width: 90px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ca2222;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2ab934;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(55px);
  -ms-transform: translateX(55px);
  transform: translateX(55px);
}
.custom-file-upload {
  border: 1px solid #ccc;
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
  color: #3c4d62;
}
/*------ ADDED CSS ---------*/
.on
{
  display: none;
}

.on
{
  color: white;
  position: absolute;
  transform: translate(-50%,-50%);
  top: 50%;
  left: 35%;
  font-size: 12px;
  font-family: Verdana, sans-serif;
}
.off
{
  color: white;
  position: absolute;
  transform: translate(-50%,-50%);
  top: 50%;
  left: 65%;
  font-size: 12px;
  font-family: Verdana, sans-serif;
}

input:checked+ .slider .on
{display: block;}

input:checked + .slider .off
{display: none;}

/*--------- END --------*/

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;}
    </style>
    @endsection
@section('content')
<div class="nk-content ">
<div class="container-fluid">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between g-3">
<div class="nk-block-head-content">
<h3 class="nk-block-title page-title">Add Blog</h3>
<div class="nk-block-des text-soft">
</div>
</div>
</div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
@if(Session::has('success'))
     <div class="alert alert-success alert-dismissible fade in mt-1" role="alert">
      <button class="close" type="button" data-dismiss="alert"></button>
      <strong>Domain!</strong> {{Session::get('success')}}
    </div>
 @endif
<div class="nk-block">
<div class="row g-gs justify-center">
<form action="{{ url('/admin/posts/store') }}" target="" method="post" enctype="multipart/form-data" class="d-flex" id="postForm">
<div class="col-xxl-8 col-sm-8 px-0">
<div class="card">
<div class="card-inner-group p-0" >

<div class="card-inner  p-0 ">
<div class="nk-tb-list nk-tb-tnx">
     {{ csrf_field() }}
   <div class="form-row p-2">
     <div class="form-group col-md-12">
      <label for="inputState">Add Blog Title</label>
       <input type="text" name="title" class="form-control" required >
     </div>
   </div>
   <div class="form-row p-2">
     <div class="form-group col-md-12">
      <label for="inputState">Content Area</label>
        <textarea class="form-control tinymce-basic" name="description" required>.</textarea>
     </div>
   </div>
</div><!-- .nk-tb-list -->
</div><!-- .card-inner -->
</div><!-- .card-inner-group -->
</div><!-- .card -->
</div><!-- .nk-block -->
<div class="col-xxl-4 col-sm-12">
<div class="card">
<div class="card-inner-group p-0" >

<div class="card-inner  p-0 ">
<div class="nk-tb-list nk-tb-tnx">
 
   <div class="form-row p-2 ">

   <div class="form-row p-2 mb-3 w-100">
    <div class="form-group col-md-12 text-end">
     <input type="hidden" name="action" id="action" value="">
  
     <div>
      <input type="submit" value="Preview" class="btn btn-primary" onclick="setFormAction('preview')">

      <input type="submit" value="Save" class="btn btn-success" onclick="setFormAction('save')">
     </div>
    </div>
   </div>
     <div class="form-group col-md-12 mb-4">
      <label for="coverImgInput" class="custom-file-upload font-weight-bold">Please select an image file</label>
      <input type="file" id="coverImgInput" name="cover_img" accept="image/*" class="form-control d-none" required>
    </div>
    <div class="col-md-12 text-center mb-4">
      <img id="coverImgPreview" src="#" alt="Cover Image Preview" style="max-width: 100%; max-height: 200px; display: none">
    </div>
   </div>
</div><!-- .nk-tb-list -->
</div><!-- .card-inner -->
</div><!-- .card-inner-group -->
</div><!-- .card -->
</div><!-- .nk-block -->
</form>
</div>
</div>
</div>
</div>

@endsection
@section('script')
<script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
<script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/editors/tinymce.css?ver=2.9.1') }}">
<script src="{{ asset('frontend-assets/assets/js/libs/editors/tinymce.js?ver=2.9.1') }}"></script>
<script src="{{ asset('frontend-assets/assets/js/editors.js?ver=2.9.1') }}"></script>
<script type="text/javascript">

   const coverImgInput = document.getElementById('coverImgInput');
  const coverImgPreview = document.getElementById('coverImgPreview');

  coverImgInput.addEventListener('change', function(event) {
    const selectedFile = event.target.files[0];
    if (selectedFile) {
      coverImgPreview.src = URL.createObjectURL(selectedFile);
      $('#coverImgPreview').show();
    } else {
      $('#coverImgPreview').hide();
      coverImgPreview.src = '#'; // Clear the preview if no file is selected
    }
  });

 function setFormAction(action) {
   const form = document.getElementById('postForm');
   console.log(form)
  if(action == 'preview'){
    form.target = '_blank';
  }else{
     form.removeAttribute('target');
  }
  document.getElementById('action').value = action;
}


</script>
@endsection