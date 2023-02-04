    @extends('layouts.core.frontend')

    @section('title', trans('messages.dashboard'))

    @section('head')
    <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
    <style type="text/css">
        .form-group:last-child {
            margin-bottom: 0px !important;
        }
        .sub-categoryli{
            box-shadow: 0px 0px 15px 0px rgb(0 0 0 / 10%);
            transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
            border: 1px solid;
            color: #d5d5d5;
            border-radius: 6px;
            padding: 10px !important;
            display: flex;
            align-items: center;

        }
        .sub-category{
            font-size: 1rem;
            color: #252525;
            padding-left:10px;
        }
        .actions{
            width: 90px;
        }
        ul.d-flex.flex-wrap.g-1 {
            max-height: 230px;
            overflow: auto;
        }
        li.w-100.sub-categoryli.mt-1.mb-1:hover {
            border-color: #d756ed;
        }
        .user-avatar.sq.bg-purple:hover {
            border: 1px solid purple;
            display: block;
        }
    </style>
    @endsection

    @section('content')
    <?php $arraycalss=['bg-blue','bg-purple','bg-indigo','bg-pink','bg-red','bg-orange','bg-yellow','bg-green','bg-teal','bg-cyan']; 
    ?>
    <!-- content @s -->
    <div class="nk-content ">
    <div class="container-fluid">
    <div class="nk-content-inner">
    <div class="nk-content-body">
    @if(Session::has('message'))
    <div class="col-12">
    <div class="alert alert-success  fade show mt-5" role="alert">
    {!!Session::get('message')!!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
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
    <li class="nk-block-tools-opt"><a href="javascript:void(0)" class="btn btn-outline-light" onclick="opensubcategory()"><em class="icon ni ni-plus"></em><span>Add Sub Category</span></a></li>
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
    <a href="#"  data-toggle="modal" data-target="#modalEdit{{$category->id}}" class="d-flex align-items-center">
    @if($category->category_icon)
    <div class="" style="width: 60px"><img src="{{asset('frontend-assets/images/categories/'.$category->category_icon)}}">
    </div>
    @else
    <div class="user-avatar sq bg-purple"><span><?php $words = explode(' ', $category->category_name);
    if(count($words) > 1){
     $result = $words[0][0]. $words[1][0];
      echo $result;
    }else
    {
    $result = $words[0][0];
    echo $result;
    }
      ?></span></div>

    @endif
    <div class="ml-3">
        <h6 class="title mb-1">{{$category->category_name}}</h6>
        <span class="sub-text">{{count($category->subcategory)}} SubCategories</span>
    </div>
    </a>
    <div class="dropdown">
    <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 mr-n1" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
    <div class="dropdown-menu dropdown-menu-right">
        <ul class="link-list-opt no-bdr">
            <li><a href="#" onclick="selectVal({{$category->id}})"><em class="icon ni ni-edit"></em><span>Add Sub Category</span></a></li>
            <li><a href="#" data-toggle="modal" data-target="#modalEdit{{$category->id}}"><em class="icon ni ni-edit"></em><span>Edit Category</span></a></li>
            <li><a  href="{{url('admin/service-categories/delete/'.$category->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><em class="icon ni ni-delete"></em><span>Delete Category</span></a></li>
        </ul>
    </div>
    </div>
    </div>
    <!-- <p>{{$category->category_description}}</p> -->
    <ul class="d-flex flex-wrap g-1">
    @foreach($category->subcategory as $key=>$subcategory)
    <li  class="w-100 sub-categoryli mt-1 mb-1" style="padding: 10px !important;">
   @if($subcategory->category_icon)
   <div class="" style="width: 40px"><img src="{{asset('frontend-assets/images/categories/'.$subcategory->category_icon)}}">
    </div>
    @else
    <div class="user-avatar sq {{$arraycalss[$key]}}">
    <span>
    <?php 
        $words = explode(' ', $subcategory->category_name);
        if(count($words) > 1){
         $result = $words[0][0]. $words[1][0];
          echo $result;
        }else
        {
        $result = $words[0][0];
        echo $result;
        }
      ?>
      </span>

    </div>

    @endif
    <span class="sub-category badge-dim " style="width: 45%;">{{$subcategory->category_name}}</span>
    <div class="actions">
        <span style="float: right;">
         <em class="icon ni ni-edit" title="Edit Category" data-toggle="modal" data-target="#modalsubEdit{{$subcategory->id}}"></em>
         <a href="{{ url('admin/service-categories/delete/'.$subcategory->id) }}" style="color: #d5d5d5;" onclick="return confirm('Are you sure you want to delete this category?');" title="Delete Category"><em class="icon ni ni-trash"></em></a>
        </span>
    </div>
   </li>
    <div class="modal fade zoom" tabindex="-1" id="modalsubEdit{{$subcategory->id}}">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Update SubCategory</h5>
    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
    <em class="icon ni ni-cross"></em>
    </a>
    </div>
    <div class="modal-body">
    <div class="preview-block">

    <form action="{{ url('admin/service-categories/update') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row d-flex justify-content-center gy-4">
    <input type="hidden" name="id" value="{{$subcategory->id}}">
    <div class="col-sm-10">
        <div class="form-group">
            <label class="form-label" for="default-01">Category Name</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" name="category_name" id="default-01" placeholder="Category Name" value="{{$subcategory->category_name}}" required>
            </div>
        </div>
    </div>
     <div class="col-sm-10">
        <div class="form-group">
            <label class="form-label" for="default-01">Category Description</label>
            <div class="form-control-wrap">
                <textarea class="form-control" name="category_description">{{$subcategory->category_description}}</textarea> 
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
    <div class="col-sm-10">
        <div class="form-group">
            <label class="form-label" for="default-01">Credits Cost to Quote</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" name="credit_cost" value="{{$subcategory->credit_cost}}" placeholder="Credits Cost to Quote" >
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
    @endforeach
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

    <form action="{{ url('admin/service-categories/update') }}" method="post" enctype="multipart/form-data">
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

     <div class="col-sm-10">
    <div class="form-group">
        <label class="form-label" for="default-01">Credits Cost to Quote</label>
        <div class="form-control-wrap">
            <input type="text" value="{{$category->credit_cost}}" class="form-control" name="credit_cost"   placeholder="Credits Cost to Quote" >
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
    <div id="mySidepanel" class="sidepanel" style="height: 100%">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <div class="preview-block">
    <h5 class="text-center">Add Category</h5>
    <form action="{{ url('admin/service-categories/store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row d-flex justify-content-center gy-4">

    <div class="col-sm-10">
    <div class="form-group">
    <label class="form-label" for="default-01">Category Name</label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" name="category_name" id="default-01" placeholder="Category Name" required>
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
    <label class="form-label" for="default-06">Category Icon (optional)</label>
    <div class="form-control-wrap">
    <div class="custom-file">
    <input type="file" name="category_icon" class="custom-file-input" id="customFile">
    <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
    </div>
    </div>

    </div>

    <div class="col-sm-10">
    <div class="form-group">
    <label class="form-label" for="default-01">Credits Cost to Quote</label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" name="credit_cost" id="default-01" placeholder="Credits Cost to Quote" >
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
    <!-- Modal Zoom -->
    <div id="subSidepanel" class="sidepanel" style="height: 100%">
    <a href="javascript:void(0)" class="closebtn" onclick="closesub()">×</a>
    <div class="preview-block">
    <h5 class="text-center">Add Sub Category</h5>
    <form action="{{ url('admin/service-categories/storesub') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row d-flex justify-content-center gy-4">

    <div class="col-sm-10">
    <div class="form-group">
    <label class="form-label" for="default-01">Select Category</label>
    <div class="form-control-wrap">
    <select class="form-control" id="dropdownid" name="category_id" required>
    <option value="">Select Category</option>
    @foreach(Acelle\Jobs\HelperJob::mycategories() as $category)
    <option value="{{$category->id}}">{{$category->category_name}}</option>
    @endforeach
    </select>
    </div>
    </div>
    </div>
    <div class="col-sm-10">
    <div class="form-group">
    <label class="form-label" for="default-01">Sub Category Name</label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" name="category_name" id="default-01" placeholder="Category Name" required>
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

    <div class="col-sm-10">
    <div class="form-group">
    <label class="form-label" for="default-01">Credits Cost to Quote</label>
    <div class="form-control-wrap">
    <input type="text" class="form-control" value="{{( isset(Acelle\Jobs\HelperJob::quoteprice()->price) ? : '10')}}" name="credit_cost" id="default-01" placeholder="Credits Cost to Quote" >
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
    function selectVal(id){
     $('#dropdownid').val(id);
      opensubcategory();
    }
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
    function opensubcategory() {
    // document.getElementById("mySidepanel").style.width = "35%";
    $('.toggle-expand').removeClass('active');
    $('.toggle-expand-content').removeClass('expanded');
    $('.toggle-expand-content').hide();
    $('#subSidepanel').addClass('panelWidth');
    }

    function closesub() {
    // document.getElementById("mySidepanel").style.width = "0";
    $('#subSidepanel').removeClass('panelWidth');
    }
    </script>
    @endsection
