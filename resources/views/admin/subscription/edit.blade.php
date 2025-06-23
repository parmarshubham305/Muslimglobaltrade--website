@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Subscription plan')]))
@section('css')
    {{-- LightBox  --}}
    <link rel="stylesheet" href="{{ asset('dist/plugins/lightbox/css/lightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/mediamanager/css/media-manager.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <div class="col-md-12" id="brand-edit-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('subscription.index') }}">{{ __('Subscription plan') }} </a>
                    >>{{ __('Edit :x', ['x' => __('Subscription plan')]) }}</h5>
            </div>
            <div class="card-block table-border-style">
                <div class="row form-tabs">
                    <form action="{{ route('subscription.update', $subscription->id) }}" method="post" id="brandAdd"
                        class="form-horizontal col-md-12" enctype="multipart/form-data">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-uppercase font-bold" id="home-tab" data-bs-toggle="tab" href="#home"
                                    role="tab" aria-controls="home" aria-selected="true">{{ __(':x Information', ['x' => __('Subscription plan')]) }}</a>
                            </li>
                        </ul>
                        <div class="col-md-12 tab-content form-edit-con mt-5" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="row">
                                    
                                    <div class="col-md-8 form-container">
                                        <div class="form-group row">
                                            <label for="name" class="control-label require ltr:pe-3 rtl:ps-3">{{ __('Name') }}
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="{{ __('Name') }}"
                                                    class="form-control form-width inputFieldDesign" id="name"
                                                    name="name" value="{{ $subscription->name }}" required oninv
                                                    alid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="price" class="control-label require ltr:pe-3 rtl:ps-3">{{ __('Price') }}
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="{{ __('Price') }}"
                                                    class="form-control form-width inputFieldDesign" id="price"
                                                    name="price" value="{{ $subscription->price }}" required oninv
                                                    alid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label for="description" class="col-md-3 control-label">{{ __('Description') }}
                                            </label>
                                            <div class="col-md-12">
                                                <textarea name="description" class="form-control form-width">{{ $subscription->description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="features" class="col-md-3 control-label">{{ __('Features') }}
                                            </label>
                                            <div class="col-md-12">
                                                <textarea name="features" class="form-control form-width">{{ ($subscription->features) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="Status"
                                                class="col-md-3 control-label">{{ __('Status') }}</label>
                                            <div class="col-md-12">
                                                <select class="form-control select2-hide-search inputFieldDesign"
                                                    name="status" id="status">
                                                    <option value="Active"
                                                        {{ $subscription->status == 'Active' ? 'selected' : '' }}>
                                                        {{ __('Active') }}</option>
                                                    <option value="Inactive"
                                                        {{ $subscription->status == 'Inactive' ? 'selected' : '' }}>
                                                        {{ __('Inactive') }}</option>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 control-label"></div>
                                <div class="col-md-9 btn-con">
                                    <a href="{{ route('subscription.index') }}"
                                        class="btn custom-btn-cancel all-cancel-btn">{{ __('Cancel') }}</a>
                                    <button class="btn custom-btn-submit" type="submit" id="btnSubmit"><i
                                            class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span
                                            id="spinnerText">{{ __('Update') }}</span></button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    @include('mediamanager::image.modal_image')

@endsection
@section('js')
    <script src="{{ asset('dist/plugins/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/brand.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/validation.min.js') }}"></script>
@endsection
