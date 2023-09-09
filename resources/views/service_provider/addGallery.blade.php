@extends('service_provider.layout.app')
@section('title', 'Profile')
@section('styling')
    <style type="text/css">
        .labelcls {
            display: flex;
            align-items: center;
            padding: 0.625rem 1.25rem;
            font-size: 12px;
            font-weight: 500;
            color: #526484;
            transition: all .4s;
            line-height: 1.3rem;
            position: relative;
            margin-bottom: 0px !important;
        }

        .cameraicon {
            font-size: 1.125rem;
            width: 1.75rem;
            opacity: .8;
        }
        .toggle-side-menu{
            display: none !important;
        }
        @media only screen and (max-width: 600px) {
           .side-class{
            transition: none;
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
            position: fixed !important;
            display: none;
          }
          .toggle-side-menu{
            background: white;
            margin-bottom: 13px;
            padding-top: 10px;
            padding-bottom: 30px;
            padding-right: 24px;
            display: block !important;
          }
        }

       
    </style>
@endsection
@section('content')

    <!-- content @s -->
    <div class="nk-content mb-3">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="toggle-side-menu" onclick="showsidebar()">
                            <em class="icon ni ni-menu float-right" style="font-size: 20px"></em>
                        </div>
                        <div class="card">
                            @if(Session::has('success'))
                                <div class="alert alert-success  fade show mt-5" role="alert">
                                    <strong>Profile!</strong> {{Session::get('success')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head">
                                        <div class="nk-block-between d-flex justify-content-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Gallery</h4>
                                                <div class="nk-block-des">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="nk-data data-list">
                                            <!-- <div class="data-head">
                                                <h6 class="overline-title">A</h6>
                                            </div> -->
                                    <form action="{{ isset($image) ? url('service-provider/gallery/update', $image->id) : url('service-provider/gallery/store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @if(isset($image))
                                            @method('PUT')
                                        @endif
                                        <div class="form-group mt-4">
                                            <input type="file" class="form-control" name="images[]" id="images" multiple>
                                        </div>
                                        <div id="imagePreviews" class="mt-2 mb-3">
                                            @if(isset($image))
                                                <img src="{{ asset('frontend-assets/images/' . $image->image) }}" alt="{{ $image->title }}" style="max-width: 100px; margin-right: 10px;">
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-success mt-3">{{ isset($image) ? 'Update' : 'Add' }} Images</button>
                                    </form>
                                            </div>
                                        
                                    </div><!-- .nk-block -->
                                </div>
                             @include('service_provider.includes.setting-sidebar')
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
  

@endsection
@section('script')
<script>
    function showsidebar(){
            $('.side-class').toggle();
        }
    document.getElementById('images').addEventListener('change', function (event) {
        const imagePreviews = document.getElementById('imagePreviews');
        imagePreviews.innerHTML = ''; // Clear existing previews

        for (const file of event.target.files) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px'; // Adjust image size if needed
                img.style.marginRight = '10px'; // Adjust margin between images if needed
                imagePreviews.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    });
</script>
@endsection