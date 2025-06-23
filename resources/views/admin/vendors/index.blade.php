@extends('admin.layouts.app')
@section('page_title', __('Vendors'))
@section('css')
    <link rel="stylesheet" href="{{ asset('dist/css/vendor-responsiveness.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <div class="col-sm-12 list-container" id="vendor-list-container">
        <div class="card">
            <div class="card-header bb-none pb-0">
                <h5>{{ __('Vendors') }}</h5>
                <x-backend.group-filters :groups="$groups" :column="'status'" />
                <div class="card-header-right my-2 mx-md-0 mx-sm-4">
                    <x-backend.button.batch-delete />
                    @if (in_array('App\Http\Controllers\VendorController@create', $prms))
                        <x-backend.button.add-new href="{{ route('vendors.create') }}" />
                    @endif
                    <x-backend.button.export />
                    <x-backend.button.filter />
                </div>
            </div>

            <x-backend.datatable.filter-panel>
                <div class="col-md-12">
                    <x-backend.datatable.input-search />
                </div>
            </x-backend.datatable.filter-panel>
            
            <x-backend.datatable.table-wrapper class="table-field need-batch-operation" data-namespace="\App\Models\Vendor" data-column="id">
                @include('admin.layouts.includes.yajra-data-table')
            </x-backend.datatable.table-wrapper>

    {{-- Edit status --}}
    <div id="edit-status" class="modal fade display_none" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit :x', ['x' => __('Vendor')]) }}</h4>
                    <a type="button" class="close h4" data-bs-dismiss="modal">×</a>
                </div>
                <form action="{{ route('vendors.updateStatus') }}" method="post" id="edit-slider-form"
                    class="form-horizontal">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="edit-id" id="edit-id" name="id">
                        <div class="form-group row">
                            @php
                                $statues = array("Approve"=> "Approve","Rejected" => "Reject","Modified" => "Modified");
                            @endphp
                            <label class="col-sm-3 control-label f-14 require" for="store-term">{{ __('Status') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control sl_common_bx select2-hide-search" id="status_id" name="status_id" required
                                oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                    <option value="">{{ __('Select Status') }}</option>
                                    @foreach ($statues as $key=>$status)
                                        <option value="{{ $key }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="add-comment" style="display: none">
                            <label for="comment"
                                class="col-sm-3 control-label require">{{ __('Comment') }}</label>
                            <div class="col-sm-9">
                                <textarea placeholder="{{ __('Comment') }}" id="comment" class="form-control" name="comment"
                                    minlength="5" data-min-length="{{ __('Address should be atleast 5 characters.') }}" maxlength="191"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-0">
                        <div class="form-group row">
                            <label for="btn_save" class="col-sm-3 control-label f-14"></label>
                            <div class="col-sm-12">
                                <button type="submit"
                                    class="btn custom-btn-submit float-end">{{ __('Update') }}</button>
                                <button type="button"
                                    class="py-13 custom-btn-cancel float-end h4 ltr:me-2 rtl:ms-2"
                                    data-bs-dismiss="modal">{{ __('Close') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
            @include('admin.layouts.includes.delete-modal')
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        'use strict';
        var pdf = "{{ (in_array('App\Http\Controllers\VendorController@pdf', $prms)) ? '1' : '0' }}";
        var csv = "{{ (in_array('App\Http\Controllers\VendorController@csv', $prms)) ? '1' : '0' }}";
    </script>
    <script src="{{ asset('dist/js/custom/permission.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/vendors.min.js') }}"></script>
    <script>
    $('#edit-status').on('show.bs.modal', function (e) {
        $('#edit-id').val($(e.relatedTarget).attr('id'));
    });
    $('#status_id').change(function () {
        var selectedValue = $(this).val(); // Get the selected value
        if (selectedValue == "Modified") {
            $('#add-comment').show(); // Show textbox if value is 2
        } else {
            $('#add-comment').hide(); // Hide textbox otherwise
        }
    });
    </script>
@endsection
