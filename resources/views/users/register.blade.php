@extends('layouts.core.register')

@section('title', trans('messages.create_your_account'))
<style type="text/css">
    .btn-group{
        width: 100%;
        height: 50px;
        background-color: transparent;
    }
    .btn-lg{
        width: 100%;
        background-color: transparent !important;
        color: black !important;
        border: 1px solid #bbb !important;
    }
    .multiselect-container{
        width: 100% !important;
    }
</style>
@section('content')
  
    <form enctype="multipart/form-data" action="{{ url('users/register') }}" method="POST" class="form-validate-jqueryz subscription-form">
        {{ csrf_field() }}
        <input type="hidden" name="invite" value="{{Request::get('invite')}}">
        <div class="row mt-5 mc-form">
            <div class="col-md-2"></div>
            <div class="col-md-2 text-end mt-60">
                <a class="main-logo-big" href="{{ url('/') }}">
                    <img width="150px" src="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_logo_big')) }}" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <h1 class="mb-20">{{ trans('messages.create_your_account') }}</h1>
                <p>If you would like to become part of our network and offer your business and provide your skills to people looking for your skills then please register below.<a href="{{url("users/login")}}">Login</a></p>
              @if($errors->any())
                <div class="alert alert-danger alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button> 
                    <strong>{{$errors->first()}}</strong>
                </div>
                @endif
                <div class="form-group control-text">
                    <label>
                        <b>Category</b>
                         <span class="text-danger">*</span>
                     </label>
                     <select class="form-control" name="category_id[]" required onchange="subCategory(this)">
                         <option value="">Select Category</option>
                         @foreach(Acelle\Jobs\HelperJob::categories() as $category)
                         <option value="{{$category->id}}">{{$category->category_name}}</option>
                         @endforeach
                     </select>
                  </div>
                  <div id="appendbox">
                      
                  </div>
                   <div class="form-group control-text">
                
                    <input id="subdomain" placeholder="" value="{{request('account')}}" type="hidden" name="subdomain" class="form-control required unique:users,subdomain,,id  ">
                <input type="hidden" name="user_type" value="service_provider">
                    </div>

                
                @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'email',
                    'value' => $user->email,
                    'help_class' => 'profile',
                    'rules' => $user->registerRules()
                ])
                
                @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'first_name',
                    'value' => $user->first_name,
                    'rules' => $user->registerRules()
                ])
                
                @include('helpers.form_control', [
                    'type' => 'text',
                    'name' => 'last_name',
                    'value' => $user->last_name,
                    'rules' => $user->registerRules()
                ])
                
                @include('helpers.form_control', [
                    'type' => 'password',
                    'label'=> trans('messages.new_password'),
                    'name' => 'password',
                    'rules' => $user->registerRules(),
                    'eye' => true,
                ])
                <div class="form-group control-text">
                    <label>
                        <b>City</b>
                         <span class="text-danger">*</span>
                     </label>
                     <input type="text" name="city" class="form-control" required>
                  </div>
                  <div class="form-group control-text">
                    <label>
                        <b>Zipcode</b>
                         <span class="text-danger">*</span>
                     </label>
                     <input type="text" name="zipcode" class="form-control" required>
                  </div>
                @include('helpers.form_control', [
                    'type' => 'select',
                    'name' => 'timezone',
                    'value' => $user->timezone,
                    'options' => Tool::getTimezoneSelectOptions(),
                    'include_blank' => trans('messages.choose'),
                    'rules' => $user->registerRules()
                ])								
                
                @include('helpers.form_control', [
                    'type' => 'select',
                    'name' => 'language_id',
                    'label' => trans('messages.language'),
                    'value' => $user->language_id,
                    'options' => Acelle\Model\Language::getSelectOptions(),
                    'include_blank' => trans('messages.choose'),
                    'rules' => $user->registerRules()
                ])
                
                @if (Acelle\Model\Setting::get('registration_recaptcha') == 'yes')
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            @if ($errors->has('recaptcha_invalid'))
                                <div class="text-danger text-center">{{ $errors->first('recaptcha_invalid') }}</div>
                            @endif
                            {!! Acelle\Library\Tool::showReCaptcha() !!}
                        </div>
                    </div>
                @endif
                <hr>
                <div class="row flex align-items">
                    <div class="col-md-4">
                        <button type='submit' class="btn btn-secondary res-button"><i class="icon-check"></i> {{ trans('messages.get_started') }}</button>
                    </div>
                    <div class="col-md-8">
                        {!! trans('messages.register.agreement_intro') !!}
                    </div>
                        
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </form>
    <script>
     
      function subCategory(e){
        // alert(e.value);
         $.ajax({url: "{{url('users/subcategory/')}}/"+e.value, success: function(result){
         $('#appendbox').html(result);
            $('#example-getting-started').multiselect({
              templates: {
                button: '<button type="button" class="multiselect dropdown-toggle btn btn-primary btn-lg" data-bs-toggle="dropdown" aria-expanded="false"><span class="multiselect-selected-text"></span></button>',
              },
                header: true,
                height: 150,
                allSelectedText: 'Sub Category Selected',
                selectedList: 3,
                numberDisplayed: 3,
                nonSelectedText: "Select Sub Category",
                minWidth: 410
            });
         console.log(result);
        
        }});
      }

        @if (isSiteDemo())
            $('.res-button').click(function(e) {
                e.preventDefault();

                notify('notice', '{{ trans('messages.notify.notice') }}', '{{ trans('messages.operation_not_allowed_in_demo') }}');
            });
        @endif
    </script>
    
@endsection
