<?php
$job_design = Acelle\Jobs\HelperJob::form_design(); 
?>
@extends('service_provider.layout.app')
@section('title', 'Custom Field Questions')
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
                                                <h4 class="nk-block-title">Custom Field Questions</h4>
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
                                            @if(count($customFields[0]->customs) > 0)
                                            <form action="{{ url('service-provider/storequestions') }}" method="post">
                                               @csrf
                                            <div class="row ">
                                            @foreach($customFields[0]->customs as $customField)
                                            @if($customField->choice_selection == "single")
                                            <input type="hidden" name="radio_id[]" value="{{$customField->id}}">
                                            @elseif($customField->choice_selection == "multiple")
                                            <input type="hidden" name="checkbox_id[]" value="{{$customField->id}}">
                                            @else
                                            <input type="hidden" name="input_id[]" value="{{$customField->id}}">
                                            @endif
                                            @if($customField->choice_selection == 'input')
                                           
                                             <div class="col-6 mb-4">
                                              <div class="form-group">
                                              <h5 class="form-label " for="full-name">{{$customField->question}}</h5>
                                                <div class="input-group">
                                                  <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                      <img style="max-width:25px" src="{{ asset('images/icons/'.$customField->icon) }}">
                                                    </div>
                                                  </div> 
                                                  <input placeholder="Enter Answer" name="input[]" type="text" class="form-control" value="{{@Acelle\Jobs\HelperJob::getanswers($customField->id)->answer }}" required>
                                                </div>
                                              </div>
                                              </div>
                                            @elseif($customField->choice_selection == 'single')
                                            
                                              <div class="col-6 mb-3 mt-3">
                                              <div class="form-group">
                                              <h5 class="form-label " for="full-name">{{$customField->question}}</h5>
                                              @foreach($customField->choices as $key => $choices)
                                                <div class="custom-control custom-radio custom-control-inline">
                                                  <input name="option[{{ $customField->id }}]" id="radio_{{$choices->id}}" type="radio" class="custom-control-input" value="{{$customField->id}},{{$choices->choice}}" 
                                                   {{@Acelle\Jobs\HelperJob::getanswers($customField->id)->answer == $choices->choice ? 'checked':'' }}
                                                  required> 
                                                  <label for="radio_{{$choices->id}}" class="custom-control-label">{{$choices->choice}}</label>
                                                </div>
                                                @endforeach
                                              </div>
                                            </div>
                                            @else
                                              <div class="col-6 mb-3 mt-3">
                                                 <div class="form-group">
                                              <h5 class="form-label " for="full-name">{{$customField->question}}</h5>
                                              @foreach($customField->choices as $choices)
                                                <div class="custom-control custom-checkbox custom-control-inline mb-2">
                                                  <input name="checkbox[]" id="checkbox_{{$choices->id}}"  type="checkbox" class="custom-control-input" value="{{$customField->id}},{{$choices->choice}},{{$choices->id}}" 
                                                  {{@Acelle\Jobs\HelperJob::getchoiceanswers($choices->id)->custom_field_choice_id == $choices->id ? 'checked':'' }} > 
                                                  <label for="checkbox_{{$choices->id}}" class="custom-control-label">{{$choices->choice}}</label>
                                                </div>
                                              @endforeach
                                              </div>
                                            </div> 
                                            @endif
                                            @endforeach

                                             </div>
                                            <div class="form-group row">
                                              <div class="offset-4 col-8">
                                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                              </div>
                                            </div>
                                          </form>
                                          @else

                                          <p>No data</p>
                                          @endif
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