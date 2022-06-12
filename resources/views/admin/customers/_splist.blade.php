@if ($customers->count() > 0)

    <table class="table table-box pml-table mt-2"
        current-page="{{ empty(request()->page) ? 1 : empty(request()->page) }}"
    >
    
    <thead class="tb-ticket-head">
            <tr class="tb-ticket-title">
                <th class="tb-ticket-id"><span>#ID</span></th>
                <th class="tb-ticket-desc text-center">
                    <span>User</span>
                </th>
                <th class="tb-ticket-desc">
                    <span>Subdomain</span>
                </th>
                <th class="tb-ticket-desc">
                    <span>City</span>
                </th>
                <th class="tb-ticket-desc">
                    <span>Zip Code</span>
                </th>
                <th class="tb-ticket-date tb-col-md">
                    <span>Created At</span>
                </th>
                <th class="tb-ticket-status">
                    <span>Status</span>
                </th>
                <!-- <th class="tb-ticket-action">Action</th> -->
            </tr><!-- .tb-ticket-title -->
        </thead>
        @foreach ($customers as $key => $item)
            <tr>
                <td width="1%">
                   {{$item->id}}
                </td>
                <td>
                    <div class="text-center">
                     <span>   
                     <img width="50" class="rounded-circle me-2" src="{{ $item->getProfileImageUrl() }}" alt="">
                    </span>
                    <h5 class="m-0 text-bold">
                        <a class="kq_search d-block" href="{{ action('Admin\CustomerController@edit', $item->uid) }}">{{ $item->displayName() }}</a>
                    </h5>
                    <span class="text-muted kq_search">{{ $item->email }}</span><br>
                
                </div>
                </td>
                <td>
                    
                 {{$item->subdomain }}
                </td>
              <td>
                 {{$item->city }}
                  
              </td>
              <td>
                 {{$item->zipcode }}
              </td>
                <td>
                   {{ Tool::formatDateTime($item->created_at) }}
                </td>
             <td>
                 @if($item->activated == 1)
                 <span class="badge badge-primary">Active</span>
                 @else
                 <span class="badge badge-warning">Inactive</span>
                 @endif
             </td>
                         
            </tr>
        @endforeach
    </table>
    @include('elements/_per_page_select', ["items" => $customers])
    

    <script>
        var assignPlan;        
        $(function() {
            $('.assign_plan_button').click(function(e) {
                e.preventDefault();

                var src = $(this).attr('href');
                assignPlan = new Popup({
                    url: src
                });

                assignPlan.load();
            });
        });
    </script>

@elseif (!empty(request()->keyword))
    <div class="empty-list">
        <span class="material-icons-round">
people_outline
</span>
        <span class="line-1">
            {{ trans('messages.no_search_result') }}
        </span>
    </div>
@else
    <div class="empty-list">
        <span class="material-icons-round">
people_outline
</span>
        <span class="line-1">
            {{ trans('messages.customer_empty_line_1') }}
        </span>
    </div>
@endif
