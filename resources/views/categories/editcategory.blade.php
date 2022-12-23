@extends('layouts.core.frontend')

@section('title', 'Edit Category')

@section('head')
  <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
@endsection

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Edit Category</h3>
                <div class="nk-block-des text-soft">
                    <p>Edit service category</p>
                </div>
            </div><!-- .nk-block-head-content -->
           
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="card card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Edit Category</span>
                 <form action="{{ url('admin/categories/update') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row d-flex justify-content-center gy-4">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label class="form-label" for="default-01">Category Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="category_name" id="default-01" placeholder="Category Name" value="{{$category->category_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
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
                    <div class="col-sm-7 text-center">
                        <button class="btn btn-success btn-lg" type="submit">Update</button>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div><!-- .card-preview -->

</div>
@endsection