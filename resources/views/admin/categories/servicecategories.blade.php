@extends('layouts.core.backend')

@section('title', trans('messages.dashboard'))

@section('head')
  <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
    <style type="text/css">
 
    </style>
@endsection

@section('content')

  <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                            @if(Session::has('message'))
                              <div class="col-12">
                                  {!!Session::get('message')!!}
                              </div>
                              @endif
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Service Categories</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>You have total <b>{{count($categories)}}</b> Categories</p>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-filter-alt"></em><span>Filtered By</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a href="#"><span>Web Development</span></a></li>
                                                                        <li><a href="#"><span>Mobile Application</span></a></li>
                                                                        <li><a href="#"><span>Graphics Design</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="nk-block-tools-opt"><a href="javascript:void(0)" class="btn btn-primary" onclick="openNav()"><em class="icon ni ni-plus"></em><span>Add Category</span></a></li>
                                                    </ul>
                                                </div>
                                            </div><!-- .toggle-wrap -->
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="row g-gs">
                                        @foreach($categories as $category)
                                        <div class="col-sm-6 col-lg-4 col-xxl-3">
                                            <div class="card h-100">
                                                <div class="card-inner">
                                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                                        <a href="html/lms/courses.html" class="d-flex align-items-center">
                                                            <div class="" style="width: 60px"><img src="{{asset('frontend-assets/images/categories/'.$category->category_icon)}}">
                                                            </div>
                                                            <div class="ml-3">
                                                                <h6 class="title mb-1">{{$category->category_name}}</h6>
                                                                <span class="sub-text">4 SubCategories</span>
                                                            </div>
                                                        </a>
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 mr-n1" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="#" data-toggle="modal" data-target="#modalEdit{{$category->id}}"><em class="icon ni ni-edit"></em><span>Edit Category</span></a></li>
                                                                    <li><a  href="{{action('Admin\CategoryController@destroy', $category->id)}}"><em class="icon ni ni-delete"></em><span>Delete Category</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p>{{$category->category_description}}</p>
                                                    <ul class="d-flex flex-wrap g-1">
                                                        <li><span class="badge badge-dim badge-primary">Photoshop</span></li>
                                                        <li><span class="badge badge-dim badge-danger">Adobe Illustrator</span></li>
                                                        <li><span class="badge badge-dim badge-info">Logo Design</span></li>
                                                        <li><span class="badge badge-dim badge-warning">Drawing</span></li>
                                                        <li><span class="badge badge-dim badge-secondary">Figma</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                                           <!-- Modal Zoom -->
                            <div class="modal fade zoom" tabindex="-1" id="modalEdit{{$category->id}}">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Category</h5>
                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                <em class="icon ni ni-cross"></em>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                           <div class="preview-block">
                                           
                                             <form action="{{ action('Admin\CategoryController@update') }}" method="post" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                            <div class="row d-flex justify-content-center gy-4">
                                               <input type="hidden" name="id" value="{{$category->id}}">
                                                <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <label class="form-label" for="default-01">Category Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" name="category_name" id="default-01" placeholder="Category Name" value="{{$category->category_name}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <label class="form-label" for="default-01">Category Description</label>
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control" name="category_description">{{$category->category_description}}</textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <label class="form-label" for="default-06">Category Icon</label>
                                                        <div class="form-control-wrap">
                                                            <div class="custom-file">
                                                                <input type="file" name="category_icon" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                </div>

                                                <div class="col-sm-10 text-center">
                                                    <button class="btn btn-success btn-lg" type="submit">Update</button>
                                                </div>

                                               
                                            </div>
                                          </form>
                                        </div>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                                        </div>
                            
    <!-- Mopdal Small -->
                                        @endforeach
                                       
                                    </div>
                                    {{$categories}}
                                </div><!-- .nk-block -->
                                 <!-- Modal Zoom -->
                         <div id="mySidepanel" class="sidepanel">
                          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                            <div class="preview-block">
                                     <form action="{{ action('Admin\CategoryController@store') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                    <div class="row d-flex justify-content-center gy-4">
                                       
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Category Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="category_name" id="default-01" placeholder="Category Name">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-sm-10">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Category Description</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control" name="category_description"></textarea> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Category Icon</label>
                                                <div class="form-control-wrap">
                                                    <div class="custom-file">
                                                        <input type="file" name="category_icon" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div>

                                        <div class="col-sm-10 text-center mb-5">
                                            <button class="btn btn-success btn-lg" type="submit">Save</button>
                                        </div>

                                       
                                    </div>
                                  </form>
                                </div>
                               </div>

    <!-- Mopdal Small -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
@endsection

@section('script')
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
 <script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>
 
 <script>

function openNav() {
  // document.getElementById("mySidepanel").style.width = "35%";
  $('.toggle-expand').removeClass('active');
  $('.toggle-expand-content').removeClass('expanded');
  $('.toggle-expand-content').hide();
  $('#mySidepanel').addClass('panelWidth');
}

function closeNav() {
  // document.getElementById("mySidepanel").style.width = "0";
  $('#mySidepanel').removeClass('panelWidth');
}
</script>
@endsection
