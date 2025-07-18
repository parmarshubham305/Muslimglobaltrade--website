@extends('vendor.layouts.app')
@section('page_title', __('Supports'))
@section('css')
<link rel="stylesheet" href="{{ asset('datta-able/plugins/summer-note/summernote-lite.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/invoice-style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/summer-note-modal.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/mediamanager/css/media-manager.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <div id="add-ticket-container">
        <div class="card user-list">
            <div class="card-header">
                <h5><a href="{{ route('vendor.threads') }}">{{ __('Open Ticket') }}</a></h5>
            </div>
            <div class="card-block">
                <div class="form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase font-bold" id="home-tab" data-bs-toggle="tab" href="#home"
                                role="tab" aria-controls="home" aria-selected="true">{{ __('Ticket Information') }}</a>
                        </li>
                        <li class="nav-item"></li>
                    </ul>
                </div>
                <div class="tab-content ltr:ps-4 rtl:pe-4" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form id="add_ticket_form" class="form-horizontal" action="{{ route('vendor.ticketStore') }}"
                            method="post" enctype="multipart/form-data">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                            <input type="hidden" value="{{ $object_type }}" name="object_type">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label require">{{ __('Subject') }}</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{ old('subject') }}" class="form-control inputFieldDesign"
                                                name="subject" id="subject" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label require">{{ __('Message') }}</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control description1" name="message" id="summernote"> </textarea>
                                            <label id="ticket_messages-error" class="error" for="ticket_messages"></label>
                                            <input type="hidden" name="receiver_id" value="{{ 1 }}">
                                        </div>
                                    </div>

                                    <!--department-->
                                    <div class="form-group row">
                                        @if ($departments)
                                            <label class="col-sm-2 col-form-label">{{ __('Departament') }}</label>
                                            <div class="col-sm-3">
                                                <select name="department_id" class="form-control select2-hide-search">
                                                    @foreach ($departments as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        @if ($priorities)
                                            <label
                                                class="col-sm-2 col-form-label pe-0 require">{{ __('Priority') }}</label>
                                            <div class="col-sm-3">
                                                <select name="priority_id" class="form-control select2-hide-search">
                                                    @foreach ($priorities as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label id="priority_id-error" class="error display_inline_block"
                                                    for="priority_id"></label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label">{{ __('Featured Image') }}</label>
                                        <div class="col-sm-8">
                                            <div data-toggle="modal" data-target="#exampleModalCenter"
                                                class="custom-file has-media-manager has-thumbnail" data-val="multiple"
                                                id="image-status">
                                                <input class="form-control up-images attachment d-none" name="attachment"
                                                    id="validatedCustomFile" accept="image/*">
                                                <label class="custom-file-label overflow_hidden position-relative d-flex align-items-center"
                                                    for="validatedCustomFile">{{ __('Upload image') }}</label>
                                            </div>
                                            <div class="d-flex" id="ticket-image">
                                                <!-- img will be shown here -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <div class="ms-3" id="uploader-text"></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-8 m-t-15">
                                            <a href="{{ url('vendor/ticket/list') }}"
                                                class="btn custom-btn-cancel all-cancel-btn">{{ __('Cancel') }}</a>
                                            <button class="btn custom-btn-submit" type="submit" id="add_ticket_btn"><i
                                                    class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span
                                                    id="spinnerText">{{ __('Open') }} </span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="flag" id="flag" value="no">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('mediamanager::image.modal_image')
@endsection

@section('js')
    <script src="{{ asset('datta-able/plugins/summer-note/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('Modules/Ticket/Resources/assets/js/message.min.js') }}"></script>
    {!! translateValidationMessages() !!}
    <script>
        'use strict';
        var projectId = "{{ !empty($getProject) ? $getProject : '' }}";
    </script>
    
@endsection
