@extends('admin.layouts.app')
@section('page_title', __('Subscription Plan'))

@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="activity-list-container">
    <div class="card">
        <div id="no_shadow_on_card" class="card-body px-4 need-batch-operation"
            data-namespace="App\Models\Subscription" data-column="id">
            <div class="card-block pt-2 px-0">
                <div class="col-sm-12 form-tabs">
                    @include('admin.layouts.includes.yajra-data-table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
