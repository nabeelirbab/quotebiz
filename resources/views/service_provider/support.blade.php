@extends('service_provider.layout.app')
@section('title', 'Support')

@section('content')
<div class="nk-content ">
<div class="container wide-xl">
    <div class="nk-content-inner">
      
        <div class="nk-content-body">
            <div class="nk-content-wrap">
                <div class="nk-block-head">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Support Ticket</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total {{ count($supports)}} tickets.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                       <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <div class="drodown">
                                        <a href="{{url('service-provider/createticket')}}" class="btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
                                       
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
                                    <th class="tb-ticket-id"><span>Ticket</span></th>
                                    <th class="tb-ticket-desc">
                                        <span>Subject</span>
                                    </th>
                                    <th class="tb-ticket-seen tb-col-md">
                                        <span>Detail</span>
                                    </th>
                                    <th class="tb-ticket-seen tb-col-md">
                                        <span>Category</span>
                                    </th>
                                    <th class="tb-ticket-seen tb-col-md">
                                        <span>Priority</span>
                                    </th>
                                    <th class="tb-ticket-date tb-col-md">
                                        <span>Submited</span>
                                    </th>
                                    <th class="tb-ticket-status">
                                        <span>Status</span>
                                    </th>
                                    <th class="tb-ticket-action"> &nbsp; </th>
                                </tr><!-- .tb-ticket-title -->
                            </thead>
                            <tbody class="tb-ticket-body">
                                @foreach($supports as $support)
                                <tr class="tb-ticket-item is-unread">
                                    <td class="tb-ticket-id"><a href="{{url('customer/supportchat?id='.$support->id)}}">{{ $support->id }}</a></td>
                                    <td class="tb-ticket-desc">
                                        <a href="{{url('customer/supportchat')}}"><span class="title">{{ $support->subject }}</span></a>
                                    </td>
                                    <td class="tb-ticket-desc">
                                        <span class="title">{{ $support->message }}</span>
                                    </td>

                                    <td class="tb-ticket-date tb-col-md">
                                        <span class="date">{{$support->category}}</span>
                                    </td>
                                    <td class="tb-ticket-date tb-col-md">
                                        <span class="date">{{$support->priority}}</span>
                                    </td>
                                    <td class="tb-ticket-seen tb-col-md">
                                        <span class="date-last"><em class="icon-avatar bg-danger-dim icon ni ni-user-fill nk-tooltip" title="Support Team"></em> {{\Carbon\Carbon::parse($support->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}} </span>
                                    </td>
                                    <td class="tb-ticket-status">
                                        @if($support->status == 'active')
                                        <span class="badge badge-success">Open</span>
                                        @else
                                        <span class="badge badge-light">Close</span>
                                        @endif
                                    </td>
                                    <td class="tb-ticket-action">
                                        <a href="{{url('customer/supportchat?id='.$support->id)}}" class="btn btn-icon btn-trigger">
                                            <em class="icon ni ni-chevron-right"></em>
                                        </a>
                                    </td>
                                </tr><!-- .tb-ticket-item -->
                                @endforeach
                                </tbody>
                        </table>
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
 
@endsection