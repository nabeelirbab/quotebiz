@extends('layouts.core.frontend')

@section('title', trans('messages.dashboard'))

@section('head')
  <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
    <style type="text/css">
        .sub-text {
            display: block;
            font-size: 16px;
            color: #fbfdff;
            font-weight: bold;
        }
        .accordion {
            border-radius: 4px;
            border: none;
            background: #fff;
        }
    </style>
@endsection

@section('content')
 <!-- content @s -->
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Question Lists</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total {{$questionsCount}} questions.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                     
                                          <li class="nk-block-tools-opt"><a href="{{ url('questions/add-question') }}" class="btn btn-primary" ><em class="icon ni ni-plus"></em><span>Add Question</span></a></li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                <div class="card card-bordered card-stretch">
                <div class="card-inner-group">
                <div class="card-inner position-relative card-tools-toggle">
                <div class="card-title-group">
                <div class="card-tools">
                <div class="form-inline flex-nowrap gx-3">
                <div class="form-wrap" style="width: 300px;">
                <select class="form-select" data-search="off" onchange="category(this)" data-placeholder="Bulk Action" style="opacity: 1">
                    <option value="">Select Category</option>
                   @foreach(Acelle\Jobs\HelperJob::categories() as $category)
                   <option value="{{$category->id}}">{{$category->category_name}}</option>
                   @endforeach
                </select>
                </div>
               
                </div><!-- .form-inline -->
                </div><!-- .card-tools -->
                <div class="card-tools mr-n1">
                <ul class="btn-toolbar gx-1">
                <!-- <li>
                <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                </li>
                <li class="btn-toolbar-sep"></li> --><!-- li -->
                <li>
                
                </li><!-- li -->
                </ul><!-- .btn-toolbar -->
                </div><!-- .card-tools -->
                </div><!-- .card-title-group -->
               <!--  <div class="card-search search-wrap" data-search="search">
                    <div class="card-body">
                        <div class="search-content">
                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email">
                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                        </div>
                    </div>
                </div> --><!-- .card-search -->
                </div><!-- .card-inner -->
                <div id="appendQuestion">
                    @foreach($categories as $category)
                  <div id="accordion{{$category->id}}" class="accordion">
                  <div class="accordion-item">
                      <a href="#" class="accordion-head" data-toggle="collapse" data-target="#accordion-item-{{$category->id}}">
                          <h6 class="title">{{$category->category_name}}</h6>
                          <span class="accordion-icon"></span>
                      </a>
                      <div class="accordion-body collapse" id="accordion-item-{{$category->id}}" data-parent="#accordion{{$category->id}}">
                          <div class="accordion-inner">
                            <div class="card-inner p-0">
                           <div class="nk-tb-list nk-tb-ulist">
                            <div class="nk-tb-item nk-tb-head" style="background: #253a46e3;">
                          
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">ID</span></div>
                            <div class="nk-tb-col"><span class="sub-text">Question</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Category Name</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Sub Category Name</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Selection</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Created At</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Action</span></div>
                            
                        </div><!-- .nk-tb-item --> 
                        @if(count($category->questions) > 0) 
                        @foreach($category->questions as $question)
                        <div class="nk-tb-item">
                        
                            <div class="nk-tb-col">
                               <span>{{$question->id}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-mb">
                                <span class="tb-amount">{{$question->question}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span>{{$question->categories->category_name}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span>{{$question->subcategories->category_name}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span>{{$question->choice_selection}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span>{{\Carbon\Carbon::parse($question->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-status text-success">Active</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                  
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="triggerBtn dropdown-toggle btn btn-icon btn-trigger " data-toggle="dropdown"><em class=" icon ni ni-more-h"></em></a>
                                            <div class=" dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#" data-toggle="modal" data-target="#modalZoom{{$question->id}}"><em class="icon ni ni-eye"></em><span>View Options</span></a></li>
                                                    <li><a href="{{ url('custom-field/add?category_id='.$question->category_id)}}"><em class="icon ni ni-repeat"></em><span>Edit</span></a></li>
                                                   
                                                    <li class="divider"></li>
                                                   
                                                    <li><a href="{{ url('custom-field/delete/'.$question->id)}}"><em class="icon ni ni-na"></em><span>Delete</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                             <!-- Modal Zoom -->
                            <div class="modal fade zoom" tabindex="-1" id="modalZoom{{$question->id}}">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Category {{$question->categories->category_name}}</h5>
                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                <em class="icon ni ni-cross"></em>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                           <div class="card-inner p-0">
                                            <div class="nk-tb-list nk-tb-ulist">
                                                <div class="nk-tb-item nk-tb-head" style="background: #253a46e3;">
                                                  
                                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">ID</span></div>
                                                    <div class="nk-tb-col"><span class="sub-text">Option</span></div>
                                                    <div class="nk-tb-col tb-col-mb"><span class="sub-text">Icon</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">Created At</span></div>
                                                    
                                                </div><!-- .nk-tb-item -->  
                                                @foreach($question->choices as $option)
                                                <div class="nk-tb-item">
                                                
                                                    <div class="nk-tb-col">
                                                       <span>{{$option->id}}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-mb">
                                                        <span class="tb-amount">{{$option->choice}}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-mb" style="width: 20%;">
                                                        <span>
                                                         @if($option->icon)
                                                          <img src="{{ asset('/frontend-assets/images/categories/'.$option->icon) }}">
                                                        @else
                                                         <img src="{{ asset('/frontend-assets/images/icons/option.png') }}">
                                                        @endif</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span>{{\Carbon\Carbon::parse($option->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
                                                    </div>
                                                    
                                                    
                                                </div><!-- .nk-tb-item -->
                                                @endforeach
                                              
                                            </div><!-- .nk-tb-list -->
                                        </div><!-- .card-inner -->
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                      <!-- Mopdal Small -->
                                </div><!-- .nk-tb-item -->
                                @endforeach
                                
                            @else
                                 <div class="nk-tb-item">
                                    <span>No Record</span>
                                </div>
                                @endif
                                </div>
                                      </div>
                                  </div>
                              </div>
                            </div>  
                           
 
                            </div>
                             @endforeach
                       <p>  {{$categories}}</p>
                        </div><!-- .card-inner-group -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
             
        </div>
    </div>
</div>
<!-- content @e -->
@endsection

@section('script')
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>

 <!-- <script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script> -->

<script type="text/javascript">

  
    function category(data){

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
        url: "{{action('Admin\QuestionController@searchcategory')}}",
        type:"post",
        data:{ id:data.value, _token: _token},
        success:function(response){
           console.log(response);
           $('#appendQuestion').html(response);
        },
        error: function (xhr) {

        }

    });
    }
</script>
@endsection
