<div class="nk-tb-list nk-tb-tnx">
    <div class="nk-tb-item nk-tb-head" style="background: #f5f6fa;">
        <div class="nk-tb-col"><span>#ID</span></div>
        <div class="nk-tb-col text-right tb-col-sm"><span>Payment At</span></div>
        <div class="nk-tb-col"><span>Name</span></div>
        <div class="nk-tb-col"><span>Email</span></div>
        <div class="nk-tb-col tb-col-xxl"><span>Source</span></div>
        <div class="nk-tb-col tb-col-xxl"><span>Payment ID</span></div>
        <div class="nk-tb-col"><span>Amount</span></div>
        <div class="nk-tb-col text-right tb-col-sm"><span>Credits</span></div>
        <div class="nk-tb-col nk-tb-col-status"><span class="sub-text d-none d-md-block">Payment Status</span></div>
        
    </div><!-- .nk-tb-item -->
    @foreach($payments as $creadit)
    <div class="nk-tb-item">
        <div class="nk-tb-col">
            <div class="nk-tnx-type">
                
                <div class="nk-tnx-type-text">
                    <span class="tb-lead">{{$creadit->id}}</span>
                </div>
            </div>
        </div>
        
        <div class="nk-tb-col text-right tb-col-sm">
            <span class="tb-amount">{{\Carbon\Carbon::parse($creadit->created_at)->format(Acelle\Jobs\HelperJob::dateFormat())}}</span>
        </div>
        <div class="nk-tb-col">
            <span class="tb-lead-sub">{{$creadit->users->first_name}} {{$creadit->users->last_name}}</span>
        </div>
        <div class="nk-tb-col">
            <span class="tb-lead-sub">{{$creadit->users->email}}</span>
        </div>
        <div class="nk-tb-col tb-col-xxl">
            <span class="tb-lead-sub">Stripe</span>
        </div>
        <div class="nk-tb-col tb-col-lg">
            <span class="tb-lead-sub">{{$creadit->payment_id}}</span>
        </div>
        <div class="nk-tb-col text-right">
            <span class="tb-amount">
                <?php 
                  $currencyConvert = Acelle\Jobs\HelperJob::usdcurrency($creadit->amount); 
                 ?>
                {{$currencyConvert['convert']}}<span> {{$currencyConvert['currency']}}</span></span>
        </div>
        <div class="nk-tb-col text-right tb-col-sm">
            <span class="tb-amount">{{$creadit->creadits}}</span>
        </div>
        <div class="nk-tb-col nk-tb-col-status tb-col-lg">
            <!-- <div class="dot dot-success d-md-none"></div> -->
            <span class="badge badge-sm badge-dim badge-outline-success d-none d-md-inline-flex">Completed</span>
        </div>
    </div><!-- .nk-tb-item -->
    @endforeach
 
</div><!-- .nk-tb-list -->
<div class="card-inner">
{{$payments}}
</div><!-- .card-inner -->