@extends('admin.layouts.app')
@section('page_title', __('Invoice'))
@section('css')
    <link rel="stylesheet" href="{{ asset('Modules/CMS/css/style.min.css') }}">
    <link href="{{ asset('Modules/CMS/css/draganddrop.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('modules/mediamanager/css/media-manager.min.css') }}">

    {{-- Color picker --}}
    <link rel="stylesheet" href="{{ asset('datta-able/plugins/mini-color/css/jquery.minicolors.min.css') }}">

@endsection
@section('content')
    <div class="col-sm-12 list-container">
        <div class="card">
            <div class="card-body" id="main-invoice">
                @include('admin.invoice_settings.appearance')
            </div>
        </div>
    </div>
    @include('mediamanager::image.modal_image')
@endsection
@section('js')
    <script>
        'use strict';
        var appearance_menu = "{{ session('appearanceMenu') }}";
    </script>

    <!-- minicolors Js -->
    <script src="{{ asset('datta-able/plugins/mini-color/js/jquery.minicolors.min.js') }}"></script>

    <script src="{{ asset('dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('dist/js/condition.min.js') }}"></script>
    <script src="{{ asset('Modules/CMS/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/jquery.blockUI.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/invoice-setting.min.js') }}"></script>
@endsection
