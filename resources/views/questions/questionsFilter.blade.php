   @foreach($categories as $category)
                  <div id="accordion{{$category->id}}" class="accordion">
                  <div class="accordion-item">
                      <a href="#" class="accordion-head" data-toggle="collapse" data-target="#accordion-item-{{$category->id}}">
                          <h6 class="title">{{$category->category_name}}</h6>
                          <span class="accordion-icon"></span>
                      </a>
                      <div class="accordion-body collapse show" id="accordion-item-{{$category->id}}" data-parent="#accordion{{$category->id}}">
                          <div class="accordion-inner">
                            <div class="card-inner p-0">
                           <div class="nk-tb-list nk-tb-ulist">
                            <div class="nk-tb-item nk-tb-head" style="background: #808080ad;">
                          
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">ID</span></div>
                            <div class="nk-tb-col"><span class="sub-text">Question</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Category Name</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Selection</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Created At</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Action</span></div>
                            
                        </div><!-- .nk-tb-item --> 
                        @if(count($category->questions) > 0) 
                        @foreach($category->questions as $question)
                        <div class="nk-tb-item">
                        
                            <div class="nk-tb-col">
                               <span>{{$question->id}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-mb">
                                <span class="tb-amount">{{$question->question}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span>{{$question->categories->category_name}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span>{{$question->choice_selection}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span>{{$question->created_at}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-status text-success">Active</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                  
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="triggerBtn dropdown-toggle btn btn-icon btn-trigger " data-toggle="dropdown"><em class=" icon ni ni-more-h"></em></a>
                                            <div class=" dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#" data-toggle="modal" data-target="#modalZoom{{$question->id}}"><em class="icon ni ni-eye"></em><span>View Options</span></a></li>
                                                    <li><a href="{{ url('admin/questions/add-question?category_id='.$question->category_id)}}"><em class="icon ni ni-repeat"></em><span>Edit</span></a></li>
                                                   
                                                    <li class="divider"></li>
                                                   
                                                    <li><a href="{{ url('admin/questions/delete/'.$question->id)}}"><em class="icon ni ni-na"></em><span>Delete</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                             <!-- Modal Zoom -->
                            <div class="modal fade zoom" tabindex="-1" id="modalZoom{{$question->id}}">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Category {{$question->categories->category_name}}</h5>
                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                <em class="icon ni ni-cross"></em>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                           <div class="card-inner p-0">
                                            <div class="nk-tb-list nk-tb-ulist">
                                                <div class="nk-tb-item nk-tb-head">
                                                  
                                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">ID</span></div>
                                                    <div class="nk-tb-col"><span class="sub-text">Option</span></div>
                                                    <div class="nk-tb-col tb-col-mb"><span class="sub-text">Icon</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">Created At</span></div>
                                                    
                                                </div><!-- .nk-tb-item -->  
                                                @foreach($question->choices as $option)
                                                <div class="nk-tb-item">
                                                
                                                    <div class="nk-tb-col">
                                                       <span>{{$option->id}}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-mb">
                                                        <span class="tb-amount">{{$option->choice}}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-mb" style="width: 20%;">
                                                        <span><img src="{{asset('frontend-assets/images/categories/'.$option->icon)}}"></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span>{{$option->created_at}}</span>
                                                    </div>
                                                    
                                                    
                                                </div><!-- .nk-tb-item -->
                                                @endforeach
                                              
                                            </div><!-- .nk-tb-list -->
                                        </div><!-- .card-inner -->
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                      <!-- Mopdal Small -->
                                </div><!-- .nk-tb-item -->
                                @endforeach
                                
                            @else
                                 <div class="nk-tb-item tb-col-lg">
                                    <span>No Record</span>
                                </div>
                                @endif
                                </div>
                                      </div>
                                  </div>
                              </div>
                            </div>  
                           
 
                            </div>
                             @endforeach
