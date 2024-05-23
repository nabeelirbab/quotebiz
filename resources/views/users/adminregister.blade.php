@extends('layouts.core.register')

@section('title', trans('messages.create_your_account'))
<style type="text/css">
    .subdomain{
      width: 77%;
    }
    @media screen and (max-width: 667px) {
        .subdomain{
          width: 72%;
        }
    }
    #countrySection{
        display: none;
    }
</style>
@section('content')
    
    <form enctype="multipart/form-data" action="{{ url('signup') }}" method="POST" class="form-validate-jqueryz subscription-form">
        {{ csrf_field() }}
         <div class="panel panel-body p-4 rounded-3 bg-white shadow" >
           
                
                <h1 class="mb-20">{{ trans('messages.create_your_account') }}</h1>
                <p>{!! trans('messages.register.intro', [
                    'login' => url("/login"),
                ]) !!}</p>
                <label>
                <b>Subdomain</b>
                 <span class="text-danger">*</span>
             </label>
            <div class="input-group mb-3">
             <div class="subdomain">
              @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'subdomain',
                    'value' => $user->subdomain,
                    'help_class' => 'profile',
                    'rules' => $user->registerRules($user->subdomain)
                ])
            </div>
              <div class="input-group-append">
                <span class="input-group-text" style="height: 45px;" id="basic-addon2">.quotebiz.io</span>
              </div>
               </div>
                <input type="hidden" name="user_type" value="admin">

                 <div class="form-group control-text">
                    <label>
                        <b>Category</b>
                         <span class="text-danger">*</span>
                     </label>
                     <select class="form-control" name="category_id" required>
                         <option value="">Select Category</option>
                         @foreach(Acelle\Jobs\HelperJob::categories() as $category)
                         <option value="{{$category->id}}">{{$category->category_name}}</option>
                         @endforeach
                     </select>
                  </div>
               
                @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'email',
                    'value' => $user->email,
                    'help_class' => 'profile',
                    'rules' => $user->registerRules($user->subdomain)
                ])
                
                @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'first_name',
                    'value' => $user->first_name,
                    'rules' => $user->registerRules($user->subdomain)
                ])
                
                @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'last_name',
                    'value' => $user->last_name,
                    'rules' => $user->registerRules($user->subdomain)
                ])
                
                @include('helpers.form_control', [
                    'type' => 'password',
                    'label'=> trans('messages.password'),
                    'name' => 'password',
                    'rules' => $user->registerRules($user->subdomain),
                    'eye' => true,
                ])
                   <div class="form-group control-text">
                    <label>
                        <b>Where will you quotebiz be located?</b>
                         <span class="text-danger">*</span>
                     </label>
                     <select name="admin_location_type" class="form-control" required onchange="GetTypeData(this.value)" required>
                        <option disabled selected value="">Select Type</option>
                        <option value="World Wide">
                            World Wide
                        </option>
                        <option value="Country Wise">
                           Country Wide
                        </option>
                        <option value="State Wise">
                           State Wide
                        </option>
                    </select>
                  </div>
                <div id="countrySection">
                 <div class="form-group control-text">
                    <label>
                        <b>Country</b>
                         <span class="text-danger">*</span>
                     </label>
                     <select name="country" id="country" class="form-control select2"  onchange="GetStates(this.value)">
                        <option disabled selected value="">Select Country
                        </option>
                        @forelse(Acelle\Jobs\HelperJob::countries() as $country)
                         <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @empty
                        @endforelse
                    </select>
                  </div>
                    <div class="form-group control-text" id="bus_state" style="display: none;">
                     <label>
                        <b>State</b>
                         <span class="text-danger">*</span>
                     </label>
                       <select name="state" id="state" class="form-control select2"  onchange="GetCities(this.value)">
                        <option disabled selected value="">Select Country
                            First
                        </option>
                     </select>
                   </div>
                    <div class="form-group control-text" id="bus_city" style="display: none;">
                     <label>
                        <b>City</b>
                        <span class="text-danger">*</span>
                     </label>
                      <select name="city" id="city" class="form-control select2" >
                        <option disabled selected value="">Select State
                            First
                        </option>
                    </select>
                   </div>
                  <div class="form-group control-text">
                    <label>
                        <b>Zipcode</b>
                         <span class="text-danger">*</span>
                     </label>
                     <input type="text" name="zipcode" class="form-control" >
                  </div>
               </div>
                @if (Acelle\Model\Setting::get('registration_recaptcha') == 'yes')
                    <div class="row">
                        <div class="col-md-12">
                            @if ($errors->has('recaptcha_invalid'))
                                <div class="text-danger text-center">{{ $errors->first('recaptcha_invalid') }}</div>
                            @endif
                            {!! Acelle\Library\Tool::showReCaptcha() !!}
                        </div>
                    </div>
                @endif
                <hr>
             <div class="row flex align-items">
                    <div class="col-md-12">
                        <button type='submit' class="btn rounded-2 btn-primary d-block login-button py-2 fw-600"
            style="width:100%;text-transform:uppercase"><i class="icon-check"></i> {{ trans('messages.get_started') }}</button>
                    </div>
                   
                        
                </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnout.com/toastr.js"></script>
    <script>

        $(document).ready(function () {
            $('.select2').select2();
        });
        
        function GetTypeData(val){
           if(val == 'Country Wise'){
             $('#countrySection').show();
             $('#bus_state').attr("style", "display: none !important");
             $('#bus_city').attr("style", "display: none !important");
           }else if(val == "State Wise") {
             $('#countrySection').show();
             $('#bus_state').attr("style", "display: block !important");
             $('#bus_city').attr("style", "display: none !important");
           }else{
             $('#countrySection').hide();
           }
        }

        function GetStates(val) {
            $("#state").empty();
            $("#city").empty();
            $("#city").html("<option value='' selected disabled>Select State First</option>");
            $.ajax({
                url: "{{ url('super/getstates') }}/" + val,
                method: "get",
                success: function (data) {
                    $("#state").html(data);
                }
            });
        }

        function GetCities(val) {
            $.ajax({
                url: "{{ url('super/getcities') }}/" + val,
                method: "get",
                success: function (data) {
                    $("#city").html(data);
                }
            });
        }
        @if (isSiteDemo())
            $('.res-button').click(function(e) {
                e.preventDefault();
                notify('notice', '{{ trans('messages.notify.notice') }}', '{{ trans('messages.operation_not_allowed_in_demo') }}');
            });
        @endif
         
    </script>
    
@endsection
