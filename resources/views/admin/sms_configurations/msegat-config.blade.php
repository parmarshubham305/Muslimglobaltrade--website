@extends('admin.layouts.app')
@section('page_title', __('SMS Setup'))

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="sms-configuration-settings-container">
        <div class="card">
            <div class="card-body row">
                <div class="col-lg-3 ltr:ps-1 ltr:ps-lg-3 ltr:pe-0 rtl:pe-1 rtl:pe-lg-3 rtl:ps-0">
                    @include('admin.layouts.includes.sms-settings-menu')
                </div>
                <div class="col-lg-9 ltr:ps-1 ltr:ps-lg-0 rtl:pe-1 rtl:pe-lg-0">
                    <div class="card card-info shadow-none mb-0">
                        <x-backend.sms.error-message />
                        
                        <x-backend.sms.card-title title="{{ __('Msegat') }}" />
                    </div>
                    
                    <div>
                        <form action="{{ route('sms.config.msegat.update') }}" method="post" class="form-horizontal">
                            @csrf
                            <div class="card-body p-l-15">                                
                                <x-backend.sms.input-field :gateway="$gateway" key="api_key" title="{{ __('API Key') }}" />
                                
                                <x-backend.sms.input-field :gateway="$gateway" key="user_name" title="{{ __('User Name') }}" />
                                
                                <x-backend.sms.input-field :gateway="$gateway" key="user_sender" title="{{ __('User Sender') }}" />
                                
                                <x-backend.sms.default-switcher provider="msegat" />
                            </div>
                            
                            <x-backend.sms.save-button />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('dist/js/custom/validation.min.js') }}"></script>
@endsection
