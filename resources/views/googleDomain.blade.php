@extends('layouts.core.frontend')
@section('title', 'Google Ownership Verification')
@section('head')
<link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
<link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
<style type="text/css">
  .accordion-head{
    display: flex;
    align-items: center;
  }
  .accordion-head p{
    margin-left: 20px;
    margin-bottom: 1px;
  }
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
<h3 class="nk-block-title page-title">Google Ownership Verification</h3>
<div class="nk-block-des text-soft">
</div>
</div><!-- .nk-block-head-content -->
 <a href="https://search.google.com/search-console/not-verified?original_url=/search-console/ownership&original_resource_id" target="_blank" style="float: right;"><h6>Google Search Console</h6></a>

</div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div id="accordion" class="accordion">
  <div class="accordion-item">
      <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#accordion-item-1">
          <h6 class="title">HTML file</h6>
          <p>Upload an HTML file</p>
          <span class="accordion-icon"></span>
      </a>
      <div class="accordion-body collapse" id="accordion-item-1" data-parent="#accordion">
          <div class="accordion-inner">
          <p>1. Download HTML file from google search console, and upload it here.</p>
          <p>2. After upload the HTML file then click Verify button in the google search console.</p>
          <form action="{{ url('admin/add-html-file') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="row">
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputAddress">HTML tag</label>
                <input type="file" class="form-control" name="html_file" accept=".html">
              </div>
            </div>
          </div>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
          </div>
      </div>
  </div>
  <div class="accordion-item">
      <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#accordion-item-2">
          <h6 class="title">HTML tag</h6>
          <p>Add a meta tag</p>
          <span class="accordion-icon"></span>
      </a>
      <div class="accordion-body collapse" id="accordion-item-2" data-parent="#accordion" >
        <div class="accordion-inner">
          <p>1. Copy the meta tag from google search console, and paste it here.</p>
          <p>2. After upload the meta tag then click Verify button in the google search console.</p>
          <form action="{{ url('admin/add-meta-tag') }}" method="post">
            {{ csrf_field() }}
          <div class="row">
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputAddress">HTML tag</label>
                <input type="text" class="form-control" name="meta_tag" value="{{\Acelle\Model\Setting::get("meta_tag")}}" placeholder="HTML tag paste here">
              </div>
            </div>
          </div>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
       </div>
  </div>
</div>
@if(Auth::user()->customdomain->parent && Auth::user()->customdomain->status == 'active')
  <div class="accordion-item">
      <a href="#" class="accordion-head collapsed" data-toggle="collapse" data-target="#accordion-item-3">
          <h6 class="title">Sitemap</h6>
          <p>Download your sitemap file</p>
          <span class="accordion-icon"></span>
      </a>
      <div class="accordion-body collapse" id="accordion-item-3" data-parent="#accordion" >
       <div class="accordion-inner">
        <a href="{{ asset('sitemap-'.Auth::user()->customdomain->subdomain.'.xml') }}" class="btn btn-success" download>Download Here</a>
       </div>
  </div>
</div> 
@endif 

</div><!-- .card-inner-group -->
</div><!-- .card -->

</div><!-- .nk-block -->
</div>
</div>
</div>
</div>

@endsection
@section('script')
<script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
<script type="text/javascript">
document.querySelector("#togBtn").onchange = (e) => {
  let checked = e.target.checked;
  if (checked) {
    console.log("checked !");
    window.location.href = '{{ url("admin/domain-status?status=active")}}';
  } else {
    console.log("unchecked...");
    window.location.href = '{{ url("admin/domain-status?status=inactive")}}';
  }
}
</script>
@endsection