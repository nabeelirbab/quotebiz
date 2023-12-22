        <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg side-class"
         data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
        <div class="card-inner-group" data-simplebar>
            <div class="card-inner">
                   <div class="card" style="border:none">

                    <div class="user-action" style="position: absolute;right: 0;">
                        <div class="dropdown">
                            <a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown"
                               href="#"><em class="icon ni ni-more-v"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li>
                                        <input type="file" accept="image/*" name="image" id="uploadImg" onchange="uploadImg(this)"
                                               class="d-none">
                                        <label for="uploadImg" class="labelcls"><em class="icon ni ni-camera-fill cameraicon"></em><span>Change Photo</span></label>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        @if(Auth::user()->user_img)
                        <img src="{{asset('frontend-assets/images/users/'.Auth::user()->user_img)}}" alt="Profile Image" class="rounded-circle" style="width: 120px; height: 120px; border: 3px solid #ddd;">
                        @else
                        <img src="{{asset('frontend-assets/images/avt.jpeg')}}" alt="Profile Image" class="rounded-circle" style="width: 120px; height: 120px; border: 3px solid #ddd;">
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center mb-0">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h5>
                         <p class="card-text text-center mb-2">{{Auth::user()->email}}</p>
                        <p class="card-text text-center">
                          @foreach(json_decode(Auth::user()->category_id) as $key => $cat)
                            <span class="data-value badge badge-pill badge-info">{{\Acelle\Jobs\HelperJob::categoryDetail($cat)->category_name}}</span>
                            @if ($key < count(json_decode(Auth::user()->category_id)) - 1)
                                 
                            @endif
                        @endforeach
                        </p>
                      
                    </div>
                </div>
                <div class="user-card">

                </div><!-- .user-card -->
            </div><!-- .card-inner -->
          
            <div class="card-inner p-0">
                <ul class="link-list-menu">
                  <li>
                        <a href="{{url('service-provider/location-setting')}}">
                            <em class="icon ni ni-location"></em>
                            <span>Service Location Settings</span>
                        </a>
                    </li>
                    <li>
                        <a  href="{{url('service-provider/business-setting')}}">
                            <em class="icon ni ni-user-fill-c"></em>
                            <span>Business Infomation</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('service-provider/settings')}}">
                            <em class="icon ni ni-user-fill-c"></em>
                            <span>Personal Infomation</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('service-provider/gallery')}}">
                            <em class="icon ni ni-user-fill-c"></em>
                            <span>Gallery</span>
                        </a>
                    </li>
                </ul>
            </div><!-- .card-inner -->

        </div><!-- .card-inner-group -->
    </div><!-- card-aside -->