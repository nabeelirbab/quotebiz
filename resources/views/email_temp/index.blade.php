@extends('layouts.core.frontend')

@section('title', trans('messages.page_form_layout'))

@section('page_header')

    <div class="page-title">
    	<div class="row">
    		<div class="col-md-7">
		       <!--  <ul class="breadcrumb breadcrumb-caret position-right">
		            <li class="breadcrumb-item"><a href="{{ url("layouts") }}">{{ trans('messages.home') }}</a></li>
		        </ul> -->
		        <h3>
		            <span class="text-semibold"><span class="material-icons-round">
                format_list_bulleted
                </span> {{ trans('messages.page_form_layout2') }}</span>
		        </h3>
		        <h3>{{ trans('messages.layout.description2') }}</h3>
	    	</div>
        </div>
    </div>

@endsection

@section('content')
    <div class="listing-form"
        data-url="{{ url('admin/layouts/listing') }}"
        per-page="{{ Acelle\Model\Layout::$itemsPerPage }}"                    
    >
        
        <div class="row top-list-controls hide">
            <div class="col-md-9">
                @if ($items->count() >= 0)                    
                    <div class="filter-box">
                        <span class="filter-group">
                            <span class="title text-semibold text-muted">{{ trans('messages.sort_by') }}</span>
                            <select class="select" name="sort_order">
                                <option value="created_at">{{ trans('messages.created_at') }}</option>
                            </select>                                        
                            <input type="hidden" name="sort_direction" value="desc" />
<button type="button" class="btn btn-light sort-direction" data-popup="tooltip" title="{{ trans('messages.change_sort_direction') }}" role="button" class="btn btn-xs">
                                <span class="material-icons-outlined desc">
sort
</span>
                            </button>
                        </span>
                    </div>
                @endif
            </div>
            <div class="col-md-3 text-end">
                
            </div>
        </div>
        
        <div class="pml-table-container">
        </div>
    </div>       

    <script>
        var LayoutsIndex = {
            getList: function() {
                return makeList({
                    url: '{{ url('admin/layouts/listing') }}',
                    container: $('.listing-form'),
                    content: $('.pml-table-container')
                });
            }
        };

        $(function() {
            LayoutsIndex.getList().load();
        });
    </script>
@endsection
