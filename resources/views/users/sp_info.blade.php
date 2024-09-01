@extends('layouts.core.register')

<?php
  $provideradminlocation = Acelle\Jobs\HelperJob::provideradminlocationreg(\Acelle\Model\Setting::subdomain());
  $countries = Acelle\Jobs\HelperJob::countries(); 
  $providerstatename = Acelle\Jobs\HelperJob::statename($provideradminlocation->state);
  $providercityname = Acelle\Jobs\HelperJob::cityname($provideradminlocation->city); 
  $providercountry = Acelle\Jobs\HelperJob::countryname($provideradminlocation->country); 
  $job_design = Acelle\Jobs\HelperJob::form_design();
  $sitename = \Acelle\Model\Setting::get("site_name");
  $sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_dark'));
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
.progress-container { 
    text-align: center; 
    margin-bottom: 30px; 
} 

#progressbar { 
    list-style-type: none; 
    display: flex; 
    justify-content: space-between; 
    color: lightgrey; 
} 

#progressbar li { 
    flex: 1; 
    text-align: center; 
    font-size: 15px; 
    font-weight: bold; 
    position: relative; 
} 

#progressbar li.active { 
    color: #2F8D46; 
} 

.progress { 
    height: 20px; 
    background-color: lightgray; 
    border-radius: 5px; 
    overflow: hidden; 
} 

.progress-bar { 
    background-color: {{ ($job_design) ? $job_design->underline_color:'#6200EA'}} !important; 
    width: 10%; 
    height: 100%; 
    transition: width 0.4s ease-in-out; 
} 

.step-container fieldset { 
     
    border-radius: 5px; 
    box-sizing: border-box; 
    width: 100%; 
    margin: 0; 
    padding-bottom: 20px; 
    position: relative; 
    display: none; 
} 

.step-container fieldset:first-of-type { 
    display: block; 
} 

h2 { 
    color: #2F8D46; 
    margin-top: 10px; 
    text-align: center; 
} 

.next-step, 
.previous-step { 
    font-weight: bold; 
    color: white; 
    border: 0 none; 
    border-radius: 5px; 
    cursor: pointer; 
    padding: 10px 5px; 
    margin: 10px 5px 10px 0px; 
    float: right; 
} 

.next-step:hover, 
.next-step:focus { 
    background-color: #1e6f3e; 
} 

.previous-step:hover, 
.previous-step:focus { 
    background-color: #4d4d4d; 
} 

.text { 
    color: #2F8D46; 
    font-weight: normal; 
} 

.finish { 
    text-align: center; 
}

        </style>
</style>

@section('content')

        <div class="progress-container"> 
            <ul id="progressbar"> 
                <li class="active"
                    id="step1"> 
                    <!-- <strong>Step 1</strong>  -->
                </li> 
                <li id="step2"> 
                    <!-- <strong>Step 2</strong>  -->
                </li> 
                <li id="step3"> 
                    <!-- <strong>Step 3</strong>  -->
                </li> 
              
            </ul> 
            <div class="progress"> 
                <div class="progress-bar"></div> 
            </div> 
        </div> 
        <form enctype="multipart/form-data" action="{{ url('service-provider/info-update') }}" method="POST" class="form-validate-jqueryz subscription-form">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="step-container panel panel-body p-4 rounded-3 shadow" style="background: rgba(255, 255, 255, 0.9);"> 
            <fieldset> 
                     <h2 class="mb-20">Add Your Business info</h2>
                @if($errors->any())
                <div class="alert alert-danger alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button> 
                    <strong>{{ $errors->first() }}</strong>
                </div>
                @endif

                 <p class="mb-4">People want to know what you look like. Please upload a profile pic of yourself or your business logo by clicking 'Edit' below the profile pic.</p>
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
            <!--     <div class="form-group control-text">
                    <label><b>Business Phone</b><span class="text-danger">*</span></label>
                    <input type="text" name="business_phone" class="form-control">
                </div> -->
              <!--   <div class="form-group control-text">
                    <label><b>Business Email</b><span class="text-danger">*</span></label>
                    <input type="text" name="business_email" class="form-control">
                </div> -->
              <!--   <div class="form-group control-text">
                    <label><b>Business Website</b></label>
                    <input type="text" name="business_website" class="form-control">
                </div> -->
                <div class="form-group control-text">
                    <label><b>Years In Business</b></label>
                    <input type="text" name="experience" class="form-control">
                </div>
                <input type="button"
                    name="next-step"
                    class="next-step btn-primary"
                    value="Next Step" /> 
            </fieldset> 
            <fieldset> 
                <h2>About Us / Biography</h2>
                  <div class="form-group control-text">
            
                    <textarea name="biography" style="font-size: 1rem;height: auto !important;" class="form-control" rows="20" cols="16" id="myTextarea" maxlength="2500"></textarea>
                    <!-- <div id="charCount" class="float-right">Characters remaining: 2500</div> -->
                  </div> 
                  <div>
                 <input type="button"
                    name="next-step"
                    class="next-step btn-primary"
                    value="Next Step" /> 
                <input type="button"
                name="previous-step"
                class="previous-step btn-primary"
                value="Previous Step" /> 
                  </div>
            
            </fieldset> 
            <fieldset> 
                <h2>Gallery</h2> 
                <p>Please add some photos of your work for people to see on your profile page.</p>
                    <div class="form-group mt-4">
                        <input type="file" class="form-control" name="images[]" id="images" multiple accept="image/*">
                    </div>
                    <div id="imagePreviews" class="mt-2 mb-3">
                      
                    </div>
                <input type="submit"
                    name="next-step"
                    class="next-step btn-primary"
                    value="Submit" /> 
                <input type="button"
                    name="previous-step"
                    class="previous-step btn-primary"
                    value="Previous Step" /> 
            </fieldset> 
       
               <hr>
                <div class="row flex align-items">
                    <div class="col-md-12">
                       
                        <a href="{{ url('service-provider/settings') }}" class="btn rounded-2 btn-defult d-block login-button py-2 fw-600">Skip</a>
                    </div>
                </div>
        </div> 
  
    </form>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('frontend-assets/js/jquery.steps.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnout.com/toastr.js"></script>
    <script type="text/javascript">
        // script.js 
document.addEventListener("DOMContentLoaded", function () { 
    const progressListItems = 
        document.querySelectorAll("#progressbar li"); 
    const progressBar = 
        document.querySelector(".progress-bar"); 
    let currentStep = 0; 

    function updateProgress() { 
        console.log(currentStep,'-',progressListItems.length - 1);
        const percent = 
            (currentStep / (progressListItems.length - 1)) * 100; 
        progressBar.style.width = percent + "%"; 

        progressListItems.forEach((item, index) => { 
            if (index === currentStep) { 
                item.classList.add("active"); 
            } else { 
                item.classList.remove("active"); 
            } 
        }); 
    } 

    function showStep(stepIndex) { 
        const steps = 
            document.querySelectorAll(".step-container fieldset"); 
        steps.forEach((step, index) => { 
            if (index === stepIndex) { 
                step.style.display = "block"; 
            } else { 
                step.style.display = "none"; 
            } 
        }); 
    } 

    function nextStep() { 
        if (currentStep < progressListItems.length - 1) { 
            currentStep++; 
            showStep(currentStep); 
            updateProgress(); 
        } 
    } 

    function prevStep() { 
        console.log(currentStep);
        if (currentStep > 1) { 
            currentStep--; 
            showStep(currentStep); 
            updateProgress(); 
        } else if(currentStep == 1){
             currentStep--; 
            showStep(currentStep); 
            updateProgress(); 
             progressBar.style.width = "10.33%";
        }
    } 

    const nextStepButtons = 
        document.querySelectorAll(".next-step"); 
    const prevStepButtons = 
        document.querySelectorAll(".previous-step"); 

    nextStepButtons.forEach((button) => { 
        button.addEventListener("click", nextStep); 
    }); 

    prevStepButtons.forEach((button) => { 
        button.addEventListener("click", prevStep); 
    }); 
});
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
