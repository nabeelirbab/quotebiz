@extends('customer.layout.app')
@section('title', 'My Jobs')
@section('styling')
<style type="text/css">
  .table th {
    line-height: 4;
}
.button {
  position: relative;
  display: inline-block;
  height: 46px;
  min-width: 46px;
  padding: 0 16px !important;
  border-radius: 6px;
  background-color: #fff;
  color: #333 !important;
  font-size: 30px !important;
  font-weight: 600;
  text-align: center;
  transition: background-color .2s ease-in-out,color .2s ease-in-out,opacity .2s ease-in-out;
  -webkit-user-select: none;
  user-select: none;
  cursor: pointer;
  background: rgba(0,0,0,.05);
  border: none;
  line-height: 44px;
  color: rgba(0,0,0,.55);
}
.card-panel {
  margin: 12px;
  background-color: #fff;
  border-radius: 4px;
  box-shadow: 0 1px 2px rgba(0,0,0,.1),0 0 4px rgba(0,0,0,.1);
  max-width: 400px;
  padding: 24px;
}
</style>
@endsection
@section('content')

<div class="nk-content mt-5">
    <div class="container mt-4">
        <div class="nk-content-inner">
          
            <div class="nk-content-body">
                <div class="nk-content-wrap">
                    <div class="nk-block-head">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">My Quotes</h3>
                                <div class="nk-block-des text-soft">
                                    <p>You have total {{count($myrequests)}} quotes.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                           <div class="nk-block-head-content">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <div class="drodown">
                                            <a href="{{url('/')}}" class="btn btn-icon btn-primary" style="padding: 7px 12px 7px 12px"><span>Get Another Quote</span></a>
                                        </div>
                                    </li>
                                </ul>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <table class="table table-tickets">
                                <thead class="tb-ticket-head">
                                    <tr class="tb-ticket-title">
                                        <th class="tb-ticket-id"><span>#ID</span></th>
                                        <th class="tb-ticket-desc">
                                            <span>Category</span>
                                        </th>
                                        <th class="tb-ticket-desc">
                                            <span>Address</span>
                                        </th>
                                        <th class="tb-ticket-desc" colspan="2">
                                            <span>Additional Information</span>
                                        </th>
                                        <th class="tb-ticket-desc" colspan="2">
                                            <span>Quotations</span>
                                        </th>
                                        <th class="tb-ticket-date tb-col-md">
                                            <span>Posted on</span>
                                        </th>
                                        <th class="tb-ticket-status">
                                            <span>Status</span>
                                        </th>
                                        <th class="tb-ticket-action">Action</th>
                                    </tr><!-- .tb-ticket-title -->
                                </thead>
                                <tbody class="tb-ticket-body">
                                  @if(count($myrequests) > 0)
                                    @foreach($myrequests as $request)
                                    <tr class="tb-ticket-item is-unread">
                                        <td class="tb-ticket-id">{{$request->id}}</td>
                                        <td class="tb-ticket-desc">
                                            <span class="title">{{$request->category->category_name}}</span>
                                        </td>
                                        <td class="tb-ticket-date tb-col-md">
                                            <span>{{$request->zip_code}}</span>
                                        </td>
                                        <td class="tb-ticket-date tb-col-md" colspan="3">
                                            {{Str::limit($request->additional_info, 120, '...')}}
                                        </td>
                                        <td class="tb-ticket-date tb-col-md">
                                            <span class="date">{{count($request->quotations)}}</span>
                                        </td>
                                        <td class="tb-ticket-date tb-col-md">
                                            <span class="date">{{\Carbon\Carbon::parse($request->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
                                        </td>
                                        <td class="tb-ticket-status">
                                            @if($request->status == 'pending')
                                            <span class="badge badge-light">Open for quoting</span>
                                            @else
                                             <span class="badge badge-success">Open</span>
                                            @endif
                                        </td>
                                        <td class="tb-ticket-action">
                                            <button class="btn btn-sm btn-success" onclick="openNav('{{$request->id}}')">View Details</button>
                                        </td>
                                    </tr><!-- .tb-ticket-item -->
                                     <div id="mySidepanel{{$request->id}}" class="sidepanel" style="top: 13px;height: 100%;background: #f3f3f3;">
                                      <div class="d-flex justify-content-between align-items-center" style="background: white;padding: 12px;">
                                        <div style="">
                                      <a href="javascript:void(0)" class="button" onclick="closeNav('{{$request->id}}')">×</a>
                                      </div>
                                      <div style="margin-right: 10px;">
                                       <h5>{{$request->category->category_name}}</h5>
                                          </div>
                                          <div>
                                            
                                          </div>
                                       </div>
                                            <div class="row card-panel">
                                            <br>

                                             @foreach($request->questionsget as $questions)
                                               <div class="col-md-12 mt-1 mb-1 p-0">
                                                 <h6>{{$questions->questions->question}}</h6>
                                                 @foreach($questions->choice as $choices)
                                                 
                                                     <p class="fs-2">{{$choices->choice_value}}</p>
                                                 @endforeach
                                             </div>
                                             @endforeach

                                             <br>
                                              <br>
                                            <div class="mt-4">
                                             <h6>Additional Information</h6>
                                             <p>{{$request->additional_info}}</p>
                                             </div>
                                         </div>
                                       </div>
                                    @endforeach

                                    @else
                                    <tr class="tb-ticket-item is-unread">
                                        <td class="tb-ticket-id text-center" colspan="10">
                                          No Record Found
                                     </td> 
                                   </tr>
                                    @endif
                                   
                                </tbody>
                            </table>
                            {{$myrequests}}
                        </div>
                    </div><!-- .nk-block -->
                </div>
             
            </div>
        </div>
    </div>
</div>
                <!-- content @e -->

@endsection
@section('script')

<script type="text/javascript">
    function openNav(id) {
  // document.getElementById("mySidepanel").style.width = "35%";
  $('.toggle-expand').removeClass('active');
  $('.toggle-expand-content').removeClass('expanded');
  $('.toggle-expand-content').hide();
  $('#mySidepanel'+id).addClass('panelWidth');
}

function closeNav(id) {
  // document.getElementById("mySidepanel").style.width = "0";
  $('#mySidepanel'+id).removeClass('panelWidth');
}
</script>
@endsection