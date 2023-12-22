    <div class="modal fade" role="dialog" id="profile-edit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="title">Update Profile</h5>
                    <ul class="nk-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personal">Personal</a>
                        </li>
                         <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#business"> Business</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#biography"> Biography</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#galleryImg"> Gallery</a>
                        </li>
                    </ul><!-- .nav-tabs -->
                    <div class="tab-content">
                              <div class="tab-pane " id="galleryImg">
                            <div>
                            <form action="{{url('service-provider/gallery/store') }}" method="post" enctype="multipart/form-data">
                               {{ csrf_field() }}
                              <div>
                                <div class="form-group mt-4">
                                    <input type="file" class="form-control" name="images[]" id="images" multiple accept="image/*">
                                </div>
                                <div id="imagePreviews" class="mt-2 mb-3">
                                  
                                </div>
                                <button type="submit" class="btn btn-success mt-3"> Add Images</button>
                            </div>
                            </form>
                        </div>
                        </div>
                        <div class="tab-pane active" id="personal">
                            <form action="{{ url('service-provider/profile-update') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">First Name</label>
                                            <input type="text" class="form-control" id="full-name"
                                                   value="{{Auth::user()->first_name}}" name="first_name"
                                                   placeholder="Enter Full name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="display-name">Last Name</label>
                                            <input type="text" class="form-control" id="display-name"
                                                   value="{{Auth::user()->last_name}}" name="last_name"
                                                   placeholder="Enter display name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no">Mobile Number</label>
                                            <input type="text" class="form-control" id="phone-no"
                                                   value="{{Auth::user()->mobileno}}" name="mobileno"
                                                   placeholder="Phone Number">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="personal-email">City</label>
                                            <input type="text" class="form-control" name="city" id="personal-email"
                                                   value="{{Auth::user()->city}}" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="zipcode">Zipcode</label>
                                            <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Zipcode" 
                                                   value="{{Auth::user()->zipcode}}">
                                        </div>
                                    </div>

                                  

                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                            </li>
                                            <li>
                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div><!-- .tab-pane -->
                        <div class="tab-pane" id="business">
                          
                              <form action="{{ url('service-provider/business-update') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Business Name</label>
                                            <input type="text" class="form-control" id="full-name"
                                                   value="{{Auth::user()->business->business_name}}" name="business_name"
                                                   placeholder="Enter business name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="display-name">Business Registration Number</label>
                                            <input type="text" class="form-control" id="display-name"
                                                   value="{{Auth::user()->business->business_reg}}" name="business_reg"
                                                   placeholder="Enter business registration number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="personal-email">Business Email</label>
                                            <input type="email" class="form-control" id="personal-email"
                                                   value="{{Auth::user()->business->business_email}}" name="business_email"  placeholder="Enter business email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no">Business Phone</label>
                                            <input type="text" class="form-control" id="phone-no"
                                                   value="{{Auth::user()->business->business_phone}}" name="business_phone"
                                                   placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no">Business Category</label>
                                            <select class="form-control" name="category_id[]" required onchange="subCategory(this)">
                                             <option value="" >Select Category</option>
                                             @foreach(Acelle\Jobs\HelperJob::categories() as $category)
                                             <option value="{{$category->id}}" {{$selectcat == $category->id ? 'selected': ''}}>{{$category->category_name}}</option>
                                             @endforeach
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="subcat">

                                    </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="experience">Years in Business</label>
                                            <input type="text" class="form-control" name="experience" id="experience"
                                                   value="{{Auth::user()->experience}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="birth-day">Business Website</label>
                                            <input type="text" class="form-control" value="{{Auth::user()->business->business_website}}"
                                                   name="business_website" placeholder="Enter business website">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <button type="submit" class="btn btn-primary">Update Business</button>
                                            </li>
                                            <li>
                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div><!-- .tab-pane -->
                        <div class="tab-pane " id="biography">
                           <form action="{{ url('service-provider/profile-update') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row gy-4">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="experience">Biography</label>
                                            <textarea name="biography" class="form-control" rows="4" cols="6">{{Auth::user()->biography}}</textarea>
                                            
                                        </div>
                                    </div>
                                      <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <button type="submit" class="btn btn-primary">Update Biography</button>
                                            </li>
                                            <li>
                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                        </div>
                  
                    </div><!-- .tab-content -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->