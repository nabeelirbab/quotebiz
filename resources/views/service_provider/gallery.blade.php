@extends('service_provider.layout.app')
@section('title', 'Profile')
@section('styling')
    <style type="text/css">
.image-gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.image-card {
    flex: 0 0 calc(33.33% - 20px); /* Display three images in a row */
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    height: 250px; /* Set a fixed height for the image cards */
}

.image-card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
}

.image-card img {
    max-width: 100%;
    height: 100%; /* Make the image fill the entire height of the card */
    display: block;
    object-fit: cover; /* Maintain aspect ratio and cover the available space */
}

.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 8px;
    opacity: 0;
    transition: opacity 0.3s;
}

.image-card:hover .image-overlay {
    opacity: 1;
}

.image-overlay a,
.image-overlay button {
    display: inline-block;
    padding: 6px 10px;
    margin-right: 5px;
    border: none;
    background-color: transparent;
    color: white;
    font-size: 14px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.image-overlay a:hover,
.image-overlay button:hover {
    background-color: rgba(255, 255, 255, 0.2);
}


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
            .image-card {
                flex: 0 0 calc(100% - 20px);
            }
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
                                            <div class="nk-tab-actions mr-n1">
                                                <a href="{{ url('/service-provider/gallery/create') }}" class="btn btn-success">Add Image
                                                </a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="nk-data data-list">
                                          
                                          <div class="image-gallery mt-5">
                                            @foreach($images as $image)
                                                <div class="image-card">
                                                    <img src="{{ asset('frontend-assets/images/' . $image->image) }}" alt="{{ $image->title }}">
                                                    <div class="image-overlay">
                                                        <a href="{{ url('/service-provider/gallery/edit', $image->id) }}">Edit</a>
                                                        <form action="{{ url('/service-provider/gallery/destroy', $image->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                            <!-- data-item -->

                                        </div><!-- data-list -->

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
   

@endsection
@section('script')

    <script type="text/javascript">
        function showsidebar(){
            $('.side-class').toggle();
        }
        function uploadImg(e) {
            console.log(e.files);
            var form_data = new FormData();

            var oFReader = new FileReader();
            oFReader.readAsDataURL(e.files[0]);
            var f = e.files[0];
            var fsize = f.size || f.fileSize;
            if (fsize > 2000000) {
                alert("Image File Size is very big");
            } else {
                form_data.append("file", e.files[0]);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('service-provider/userImg') }}",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function (data) {
                        $('.uploadimg').html('<div style="margin-right: 15px;" class="nk-msg-media user-avatar"><img src="' + data + '" alt=""></div>');
                    }
                });
            }

        }
    </script>
@endsection