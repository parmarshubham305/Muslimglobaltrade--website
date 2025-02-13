@extends('admin.layouts.app')
@section('page_title', __('Create :x', ['x' => __('Vendor')]))

@section('css')
    <link rel="stylesheet" href="{{ asset('modules/mediamanager/css/media-manager.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/intl-tel-input/intlTelInput.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="vendor-add-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('vendors.index') }}">{{ __('Vendors') }} </a>
                    >>{{ __('Create :x', ['x' => __('Vendor')]) }}</h5>
            </div>
            <div class="card-block table-border-style">
                <div class="row form-tabs">
                    <form action="{{ route('vendors.store') }}" method="post" id="vandorAdd"
                        class="form-horizontal col-sm-12" enctype="multipart/form-data"
                        onsubmit="return passwordValidation()">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                        
                        <div class="col-sm-12 tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 control-label require">{{ __('Name') }}
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="{{ __('Name') }}"
                                                    class="form-control inputFieldDesign" id="name" name="name"
                                                    value="{{ old('name') }}" required maxlength="80"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email"
                                                class="col-sm-3 control-label require">{{ __('Email') }}</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control inputFieldDesign bg-white"
                                                    id="email" name="email" value="{{ old('email') }}"
                                                    placeholder="{{ __('Email') }}" required readonly
                                                    onfocus="this.removeAttribute('readonly');" maxlength="80"
                                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                    data-pattern="{{ __('Enter a valid :x.', ['x' => strtolower(__('Email'))]) }}"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone"
                                                class="col-sm-3 control-label require">{{ __('Phone') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control  inputFieldDesign" id="phone"
                                                    name="phone" value="{{ old('phone') }}" required maxlength="15"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="gender"
                                                class="col-sm-3 control-label require">{{ __('Gender') }}</label>
                                            <div class="col-sm-9">
                                                <select id="select" name="gender" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" class="border-gray-2 rounded-sm w-full h-46p roboto-medium ltr:pl-18p rtl:pr-18p font-medium text-sm text-gray-10 form-control appearance-none genderSelect z-0">
                                                    <option value="Male" {{  old('gender') == 'Male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label for="password"
                                                class="col-sm-3 control-label require">{{ __('Password') }}</label>
                                            <div class="col-sm-9">
                                                <input type="password" placeholder="{{ __('Password') }}"
                                                    class="form-control password-validation inputFieldDesign" id="password"
                                                    name="password" required maxlength="190"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                <div class="password-validation-error mt-1"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row d-none">
                                            <label for="role_id"
                                                class="col-sm-3 control-label require">{{ __('Role') }}</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2-hide-search inputFieldDesign"
                                                    name="role_ids[]" id="role_id">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                            {{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row d-none">
                                            <label for="formal_name"
                                                class="col-sm-3 control-label">{{ __('Formal Name') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control inputFieldDesign"
                                                    id="formal_name" name="formal_name"
                                                    placeholder="{{ __('Formal Name') }}" maxlength="80"
                                                    value="{{ old('formal_name') }}">
                                            </div>
                                        </div>
                                       
                                        
                                        @if (!empty($commission) && $commission->is_active == 1)
                                            <div class="form-group row">
                                                <label for="sell_commissions"
                                                    class="col-sm-3 control-label">{{ __('Commission') }}(%)</label>
                                                <div class="col-sm-9">
                                                    <input type="number"
                                                        class="form-control positive-float-number inputFieldDesign"
                                                        id="sell_commissions" name="sell_commissions"
                                                        value="{{ old('sell_commissions') }}" max="100"
                                                        data-max="{{ __('The value not more than be :x', ['x' => 100]) }}">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group row d-none">
                                            <label for="Status"
                                                class="col-sm-3 control-label">{{ __('Description') }}</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="description" id="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row preview-parent">
                                            <label class="col-sm-3 control-label">{{ __('Logo') }}</label>
                                            <div class="col-sm-9">
                                                <div class="custom-file position-relative media-manager-img" data-val="single"
                                                    data-returntype="ids" id="image-status">
                                                    <input class="custom-file-input is-image form-control inputFieldDesign"
                                                        name="vendor_logo">
                                                    <label class="custom-file-label overflow_hidden d-flex align-items-center"
                                                        for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                </div>
                                                <div class="preview-image" id="#">
                                                    <!-- img will be shown here -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="divNote">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9" id='note_txt_1'>
                                                <div class="d-flex">
                                                    <span
                                                        class="badge badge-danger h-100 mt-1">{{ __('Note') }}!</span>
                                                    <ul>
                                                        <li>{{ __('Allowed File Extensions: jpg, png, gif, bmp and Maximum File Size :x MB', ['x' => preference('file_size')]) }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row preview-parent">
                                            <label class="col-sm-3 control-label">{{ __('Cover Photo') }}</label>
                                            <div class="col-sm-9">
                                                <div class="custom-file position-relative media-manager-img" data-val="single"
                                                    data-returntype="ids" id="image-status">
                                                    <input class="custom-file-input is-image form-control"
                                                        name="cover_photo">
                                                    <label class="custom-file-label overflow_hidden d-flex align-items-center"
                                                        for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                </div>
                                                <div class="preview-image" id="#">
                                                    <!-- img will be shown here -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="divNote">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9" id='note_txt_1'>
                                                <div class="d-flex">
                                                    <span class="badge badge-danger h-100 mt-1">{{ __('Note') }}!</span>
                                                    <ul>
                                                        <li>
                                                            {{ __('Allowed File Extensions: jpg, png, gif, bmp and Maximum File Size :x MB', ['x' => preference('file_size')]) }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group row">
                                            <label for="Status"
                                                class="col-sm-3 control-label require">{{ __('Status') }}</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2-hide-search inputFieldDesign"
                                                    name="status" id="status">
                                                    <option value="Pending"
                                                        {{ old('status') == 'Pending' || preference('vendor_default_signup_status') == 'Pending' ? 'selected' : '' }}>
                                                        {{ __('Pending') }}</option>
                                                    <option value="Active"
                                                        {{ old('status') == 'Active' || preference('vendor_default_signup_status') == 'Active' ? 'selected' : '' }}>
                                                        {{ __('Active') }}</option>
                                                    <option value="Inactive"
                                                        {{ old('status') == 'Inactive' || preference('vendor_default_signup_status') == 'Inactive' ? 'selected' : '' }}>
                                                        {{ __('Inactive') }}</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <input type="hidden" name="status" value="Pending">
                                        <div class="form-group row mt-3 ltr:ms-1 rtl:me-1">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9 px-0">
                                                <div class="checkbox checkbox-primary checkbox-fill d-inline">
                                                    <input type="checkbox" class="form-control" name="send_mail"
                                                        id="checkbox-p-fill-1">
                                                    <label for="checkbox-p-fill-1"
                                                        class="cr">{{ __('Send email to the user') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="organization_type" class="col-sm-3 control-label  require">{{ __('Organization Field') }}</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2-hide-search inputFieldDesign"
                                                    name="organization_type" id="organization_type">
                                                    <option value="manufacturer"
                                                        {{ old('organization_type') == 'manufacturer' ? 'selected' : '' }}>
                                                        {{ __('Manufacturer') }}</option>
                                                    <option value="retailer"
                                                        {{ old('organization_type') == 'retailer'  ? 'selected' : '' }}>
                                                        {{ __('Retailer / Dealer & Distributor / Trader / Transport / Wholesaler') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 control-label require">{{ __('Organization Type') }}</label>
                                            @php
                                                $businessTypes = [
                                                    'corporation' => __('Corporation'),
                                                    'partnership' => __('Partnership'),
                                                    'proprietorship' => __('Proprietorship'),
                                                ];
                                                // Get the old or preferred value; if not set, default to the first key.
                                                $selectedBusinessType = old('business_type', preference('business_type') ?? array_key_first($businessTypes));
                                            @endphp

                                            <div class="col-9">
                                                <div class="row radio">
                                                    @foreach($businessTypes as $key => $label)
                                                        <div class="col-12 col-sm-4 col-md-6 mb-2">
                                                            <div class="radio radio-warning d-inline">
                                                                <input type="radio" name="business_type" id="{{ $key }}" value="{{ $key }}" 
                                                                    {{ $selectedBusinessType == $key ? 'checked' : '' }}>
                                                                <label class="cr" for="{{ $key }}">{{ $label }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="shop_name" class="col-sm-3 control-label require">{{ __('Shop Name') }}
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="{{ __('Shop Name') }}"
                                                    class="form-control inputFieldDesign" id="shop_name" name="shop_name"
                                                    value="{{ old('shop_name') }}" required maxlength="80"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="shop_email"
                                                class="col-sm-3 control-label require">{{ __('Shop Email') }}</label>
                                            <div class="col-sm-9">
                                                <input type="shop_email" class="form-control inputFieldDesign bg-white"
                                                    id="shop_email" name="shop_email" value="{{ old('shop_email') }}"
                                                    placeholder="{{ __('Shop Email') }}" required readonly
                                                    onfocus="this.removeAttribute('readonly');" maxlength="80"
                                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                    data-pattern="{{ __('Enter a valid :x.', ['x' => strtolower(__('Shop Email'))]) }}"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="shop_number"
                                                class="col-sm-3 control-label require">{{ __('Shop Number') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control phone-number inputFieldDesign" id="shop_number"
                                                    name="shop_number" value="{{ old('shop_number') }}" required maxlength="15"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="alias"
                                                class="col-sm-3 control-label require">{{ __('Alias') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control inputFieldDesign"
                                                    id="alias" name="alias" placeholder="{{ __('Alias') }}"
                                                    value="{{ old('alias') }}" required maxlength="45"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                        <div class="form-group row" id="divNote">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9" id='note_txt_1'>
                                                <span class="badge badge-primary p-1">{{ __('Note') }}!</span>
                                                {{ __('It will be used as the subdomain of the default shop.') }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="alias"
                                                class="col-sm-3 control-label">{{ __('Website') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control inputFieldDesign"
                                                    id="website" name="website" placeholder="{{ __('Website') }}"
                                                    maxlength="255"
                                                    pattern="(http[s]?:\/\/)?(www\.)?([\.]?[a-z]+[a-zA-Z0-9\-]{1,})?[\.]?[a-z]+[a-zA-Z0-9\-]+\.[a-zA-Z]{2,5}([\.]?[a-zA-Z]{2,5})?"
                                                    data-pattern="{{ __('Enter a valid :x.', ['x' => __('URL')]) }}"
                                                    value="{{ old('website') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address"
                                                class="col-sm-3 control-label require">{{ __('Address') }}</label>
                                            <div class="col-sm-9">
                                                <textarea placeholder="{{ __('Address') }}" id="address" class="form-control" name="address" required
                                                    minlength="5" data-min-length="{{ __('Address should be atleast 5 characters.') }}" maxlength="191"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">{{ old('address') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label require" for="country"> {{ __('Country') }} </label>
                                            <div class="col-sm-9 validSelect">
                                                <select name="country" id="country" class="border-gray-2 mt-1.5 lg:mt-1p rounded-sm w-full lg:h-46p h-10 roboto-medium ltr:pl-18p rtl:pr-18p font-medium text-sm text-gray-10 form-control border focus:border-gray-12 block required-field addressSelect" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"><option value="">{{ __('Select Country') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label require" for="state"> {{ __('State') . ' / ' . __('Province') }} </label>
                                            <div class="col-sm-9 validSelect">
                                                <select name="state" id="state" class="border-gray-2 mt-1.5 lg:mt-1p rounded-sm w-full lg:h-46p h-10 roboto-medium ltr:pl-18p rtl:pr-18p font-medium text-sm text-gray-10 form-control border focus:border-gray-12 block required-field addressSelect" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"> <option value="">{{ __('Select State') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label require" for="city"> {{ __('City') . ' / ' . __('Province') }} </label>
                                            <div class="col-sm-9 validSelect">
                                                <select name="city" id="city" class="border-gray-2 rounded-sm w-full lg:h-46p mt-1.5 lg:mt-1p h-10 roboto-medium ltr:pl-18p rtl:pr-18p font-medium text-sm text-gray-10 form-control border focus:border-gray-12 block required-field addressSelect" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"><option value="">{{ __('Select City') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="post_code" class="col-sm-3 control-label require">{{ __('Postcode') . ' / ' . __('ZIP') }}
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="{{ __('Postcode') . ' / ' . __('ZIP') }}"
                                                    class="form-control inputFieldDesign" id="post_code" name="post_code"
                                                    value="{{ old('post_code') }}" required maxlength="10"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                        <div class="form-group row preview-parent">
                                            <label class="col-sm-3 control-label">{{ __('Upload Personal Document') }}</label>
                                            <div class="col-sm-9">
                                                <div class="custom-file position-relative media-manager-img" data-val="single"
                                                    data-returntype="ids" id="image-status">
                                                    <input class="custom-file-input is-image form-control"
                                                        name="personal_document">
                                                    <label class="custom-file-label overflow_hidden d-flex align-items-center"
                                                        for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                </div>
                                                <div class="preview-image" id="#">
                                                    <!-- img will be shown here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-10 px-0 mt-3 mt-md-0">
                                <a href="{{ route('vendors.index') }}"
                                    class="btn custom-btn-cancel all-cancel-btn">{{ __('Cancel') }}</a>
                                <button class="btn custom-btn-submit" type="submit" id="btnSubmit"><i
                                    class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i><span
                                    id="spinnerText">{{ __('Create') }}</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('mediamanager::image.modal_image')
@endsection
@php
    $uppercase = $lowercase = $number = $symbol = $length = 0;
    if (env('PASSWORD_STRENGTH') != null && env('PASSWORD_STRENGTH') != '') {
        $length = filter_var(env('PASSWORD_STRENGTH'), FILTER_SANITIZE_NUMBER_INT);
        $conditions = explode('|', env('PASSWORD_STRENGTH'));
        $uppercase = in_array('UPPERCASE', $conditions);
        $lowercase = in_array('LOWERCASE', $conditions);
        $number = in_array('NUMBERS', $conditions);
        $symbol = in_array('SYMBOLS', $conditions);
    }
@endphp
@section('js')
    <script>
        'use strict';
        var uppercase = "{!! $uppercase !!}";
        var lowercase = "{!! $lowercase !!}";
        var number = "{!! $number !!}";
        var symbol = "{!! $symbol !!}";
        var length = "{!! $length !!}";
        var currentUrl = "{!! url()->full() !!}";
        var loginNeeded = "{!! session('loginRequired') ? 1 : 0 !!}";
        const utilJs = "{{ asset('dist/js/intl-tel-input/utils.min.js') }}";
        let oldCountry = "{!! old('country') ?? 'null' !!}";
        let oldState = "{!! old('state') ?? 'null' !!}";
        let oldCity = "{!! old('city') ?? 'null' !!}";
    </script>
    
    <script src="{{ asset('dist/js/intl-tel-input/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/site/set-dial-code.js') }}"></script>
    
    <script src="{{ asset('dist/js/custom/vendors.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/validation.min.js') }}"></script>

    <script>
        // setupDialCode('#vandorAdd', 'shop_number');
    let selectCity = `<option value="">${jsLang('Select City')}</option>`;
    let selectState = `<option value="">${jsLang('Select State')}</option>`;
    let errorMsg = jsLang(':x is not available.');
        //    if ($('.address-form , .checkout-address-form').find('#addressForm').length) {
      $.ajax({
         url: WEB_URL + "/geo-locale/countries",
         type: "GET",
         dataType: 'json',
         beforeSend: function() {
            $('#country').html(loader);
            $('#country').attr('disabled','true');
         },
         success: function(result) {
            $('#country').html('<option value="">' + jsLang('Select Country') + '</option>');
            $.each(result, function(key, value) {
               $("#country").append(`'<option  ${value.code==oldCountry?'Selected': ''} data-country="${value.code}" value="${ value
                     .code}">${value.name}</option>'`);
            });
            $("#country").removeAttr("disabled");
         }
      });
//    }

    if (oldState != "null") {
      getState(oldCountry);
    }
    if (oldCity != "null") {
        getCity(oldState,oldCountry);
    }


   $('#country').on('change', function() {;
      let str = $(this).find(':selected').html();
      oldCity = "null";

      if (str.length > 0) {
         let selector = this.closest('.validSelect');
         selector.querySelector('.addressSelect').setCustomValidity("");
         if (selector.querySelector('.error')) {
            selector.querySelector('.error').remove();
         }
      }
      getState($('#country').find(':selected').attr('data-country'));
   });

   function getState( country_code ) {

      if (country_code) {
         $("#state").html('');
         if (oldCity == "null") {
            $('#city').html(selectCity);
         }
         $.ajax({
            url: WEB_URL + "/geo-locale/countries/" + country_code + "/states",
            type: "GET",
            dataType: 'json',
            beforeSend: function() {
               $('#state').attr('disabled','true');
               $('#state').html(loader);
            },
            success: function(result) {
               $('#state').html(selectState);
               $.each(result.data, function(key, value) {
                     $("#state").append(`'<option ${value.code==oldState?'Selected': ''} data-state="${value.code}" value="${value.code}">${value.name}</option>'`);
               });
               $("#state").removeAttr("disabled");
               if (result.length <= 0 && result.data.length <= 0) {
                  errorMsg = errorMsg.replace(":x", 'State');
                 $('#state').html(`<option value="">${errorMsg}</option>`);
               }
            }
         });
      } else {

         $('#state').html(selectState);
         $('#city').html(selectCity);

      }
   }

   $('#state').on('change', function() {
      let str = $(this).find(':selected').html();

      if (str.length > 0) {
         let selector = this.closest('.validSelect');
         selector.querySelector('.addressSelect').setCustomValidity("");
         if (selector.querySelector('.error')) {
            selector.querySelector('.error').remove();
         }
      }
      getCity($('#state').find(':selected').attr('data-state'), $('#country').find(':selected').attr('data-country'));

   });

   function getCity( siso, ciso) {

     if (siso && ciso) {
         $("#city").html('');
         $.ajax({
            url: WEB_URL + "/geo-locale/countries/" + ciso + "/states/" + siso +
               "/cities",
            type: "GET",
            dataType: 'json',
            beforeSend: function() {
               $('#city').html(loader);
               $('#city').attr('disabled','true');
            },
            success: function(res) {
               $('#city').html(selectCity);
               $.each(res.data, function(key, value) {
                     $("#city").append(`<option ${value.name == oldCity ? 'Selected': ''} value="${value.name}">${value.name}</option>`);
               });
               $("#city").removeAttr("disabled");
               if (res.length <= 0 && res.data.length <= 0) {
                  errorMsg = errorMsg.replace(":x", 'City');
                 $('#city').html(`<option value="">${errorMsg}</option>`);
               }
            }
         });
     } else {
         $('#city').html(selectCity);
     }
   }
   $('#city').on('change', function() {
         let str = $(this).find(':selected').html();

         if (str.length > 0) {
            let selector = this.closest('.validSelect');
            selector.querySelector('.addressSelect').setCustomValidity("");
            if (selector.querySelector('.error')) {
               selector.querySelector('.error').remove();
            }
         }
   });

        </script>
@endsection
