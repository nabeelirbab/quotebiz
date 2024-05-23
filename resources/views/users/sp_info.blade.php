@extends('layouts.core.register')

<?php
  $provideradminlocation = Acelle\Jobs\HelperJob::provideradminlocationreg(\Acelle\Model\Setting::subdomain());
  $countries = Acelle\Jobs\HelperJob::countries(); 
  $providerstatename = Acelle\Jobs\HelperJob::statename($provideradminlocation->state);
  $providercityname = Acelle\Jobs\HelperJob::cityname($provideradminlocation->city); 
  $providercountry = Acelle\Jobs\HelperJob::countryname($provideradminlocation->country); 
?>

@section('title', trans('messages.create_your_account'))

<style type="text/css">
    .btn-group {
        width: 100%;
        height: 50px;
        background-color: transparent;
    }
    .btn-lg {
        width: 100%;
        background-color: transparent !important;
        color: black !important;
        border: 1px solid #bbb !important;
    }
    .multiselect-container {
        width: 100% !important;
    }
    .labelcls {
        display: flex;
        align-items: center;
        padding: 0.3rem 1rem;
        font-size: 12px;
        font-weight: 500;
        color: #526484;
        transition: all .4s;
        line-height: 1.3rem;
        position: relative;
        margin-bottom: 0px !important;
        width: 66%;
        margin-top: -23px;
        background: white;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        transition: transform 0.2s ease-in-out;
        border-radius: 29px;
        margin-left: 20px;
    }
</style>

@section('content')
  <form enctype="multipart/form-data" action="{{ url('service-provider/info-update') }}" method="POST" class="form-validate-jqueryz subscription-form">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
         <div class="panel panel-body p-4 rounded-3 shadow" style="background: rgba(255, 255, 255, 0.9);">
                <h1 class="mb-20">Add Your Business info</h1>
                @if($errors->any())
                <div class="alert alert-danger alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button> 
                    <strong>{{ $errors->first() }}</strong>
                </div>
                @endif
                <div class="d-flex justify-content-center mb-4 mt-4">
                    <div>
                         <input type="file" accept="image/*" name="image" id="uploadImg" class="d-none">
                        @if(Auth::user()->user_img)
                        <div class="uploadimg">
                             <img src="{{ asset('frontend-assets/images/users/' . Auth::user()->user_img) }}" alt="Profile Image" class="rounded-circle" style="width: 120px; height: 120px; border: 3px solid #ddd;">
                        </div>
                           <label for="uploadImg" class="labelcls justify-content-center" style="margin-top:-17px"><em class="icon ni ni-camera-fill cameraicon"></em><span style="line-height: 1;">Edit</span></label>
                        @else
                        <div class="uploadimg">
                            <img src="{{ asset('frontend-assets/images/avt.jpeg') }}" alt="Profile Image" class="rounded-circle" style="width: 120px; height: 120px; border: 3px solid #ddd;">
                        </div>
                           <label for="uploadImg" class="labelcls justify-content-center" style="margin-top:-17px"><em class="icon ni ni-camera-fill cameraicon"></em><span style="line-height: 1;">Edit</span></label>
                        @endif
                    </div>
                </div>
        
                <div class="form-group control-text">
                    <label><b>Business Registration Number</b></label>
                    <input type="text" name="business_reg" class="form-control">
                </div>
                <div class="form-group control-text">
                    <label><b>Business Phone</b><span class="text-danger">*</span></label>
                    <input type="text" name="business_phone" class="form-control" required>
                </div>
                <div class="form-group control-text">
                    <label><b>Business Email</b><span class="text-danger">*</span></label>
                    <input type="text" name="business_email" class="form-control" required>
                </div>
                <div class="form-group control-text">
                    <label><b>Business Website</b></label>
                    <input type="text" name="business_website" class="form-control">
                </div>
                <div class="form-group control-text">
                    <label><b>Years In Business</b></label>
                    <input type="text" name="experience" class="form-control">
                </div>
                <hr>
                <div class="row flex align-items">
                    <div class="col-md-12">
                        <button type="submit" class="btn rounded-2 btn-primary d-block login-button py-2 fw-600" style="width:100%;text-transform:uppercase"><i class="icon-check"></i> Update</button>
                        <a href="{{ url('service-provider/settings') }}" class="btn rounded-2 btn-defult d-block login-button py-2 fw-600">Skip</a>
                    </div>
                </div>
            </div>
    </form>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnout.com/toastr.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#uploadImg').on('change', function() {
                var form_data = new FormData();

                var oFReader = new FileReader();
                oFReader.readAsDataURL(this.files[0]);
                var f = this.files[0];
                var fsize = f.size || f.fileSize;
                if (fsize > 2000000) {
                    alert("Image File Size is very big");
                } else {
                    form_data.append("file", this.files[0]);
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
                            $('.uploadimg').html('<img class="rounded-circle" style="width: 120px; height: 120px; border: 3px solid #ddd;" src="' + data + '" alt="">');
                        }
                    });
                }
            });
        });
    </script>
@endsection
