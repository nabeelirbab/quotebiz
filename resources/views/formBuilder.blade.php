@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))

@section('head')

@endsection
@section('page_header')

	<div class="page-title">
		<ul class="breadcrumb breadcrumb-caret position-right">
			<li class="breadcrumb-item"><a href="{{ url("/") }}">{{ trans('messages.home') }}</a></li>
		</ul>
		<h1>
			<span class="text-semibold"><span class="material-icons-round">
                format_list_bulleted
                </span> Form Builder</span>
		</h1>
	</div>

@endsection
@section('content')
<div style="padding: 6px; background-color: white">
<div id="fb-editor"></div>
<div class="setDataWrap">
  <button id="getXML" type="button">Get XML Data</button>
  <button id="getJSON" type="button">Get JSON Data</button>
  <button id="getJS" type="button">Get JS Data</button>
  <button id="clear" type="button">Clear Data</button>
</div>
<div class="fb-render">
</div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
  <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
    <script>
  jQuery(function($) {
  var fbEditor = document.getElementById('fb-editor');
  var formBuilder = $(fbEditor).formBuilder({
  	showActionButtons:false,

  });

  document.getElementById('getXML').addEventListener('click', function() {
    alert(formBuilder.actions.getData('xml'));
    $('.fb-render').formRender({
	  dataType: 'xml',
	  formData: formBuilder.actions.getData('xml')
	});
  });
  document.getElementById('getJSON').addEventListener('click', function() {
    alert(formBuilder.actions.getData('json'));
    $('.fb-render').formRender({
	  dataType: 'json',
	  formData: formBuilder.actions.getData('json')
	});
  });
  document.getElementById('getJS').addEventListener('click', function() {
    alert('check console');
    console.log(formBuilder.actions.getData());
    $('.fb-render').formRender({
	  // dataType: 'json',
	  formData: formBuilder.actions.getData()
	});
  });

  document.getElementById('clear').addEventListener('click', function() {
    
    formBuilder.actions.clearFields();
   
  });
  
  });
  </script>
@endsection