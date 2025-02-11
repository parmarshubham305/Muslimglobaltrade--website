@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Vendor')]))
@section('css')
    {{-- LightBox --}}
    <link rel="stylesheet" href="{{ asset('dist/plugins/lightbox/css/lightbox.min.css') }}">
    {{-- Media manager --}}
    <link rel="stylesheet" href="{{ asset('modules/mediamanager/css/media-manager.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/intl-tel-input/intlTelInput.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="vendor-edit-container">
        <div class="card">
            <div class="card-header">
                <h5> <a href="{{ route('vendors.index') }}">{{ __('Vendors') }} </a>
                    >>{{ __('Edit :x', ['x' => __('Vendor')]) }}</h5>
            </div>
            <div class="card-block table-border-style">
                <div class="row form-tabs">
                    <form action="{{ route('vendors.update', $vendors->id) . '?shop=' . $shop_exist }}" method="post"
                        id="vandorEdit" class="form-horizontal col-sm-12" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link font-bold active text-uppercase">{{ __(':x Information', ['x' => __('Vendor')]) }}</a>
                            </li>
                        </ul>
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
                                                    value="{{ $vendors->name }}" required maxlength="80"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email"
                                                class="col-sm-3 control-label require">{{ __('Email') }}</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control inputFieldDesign" id="email"
                                                    name="email" value="{{ $vendors->email }}"
                                                    placeholder="{{ __('Email') }}" required maxlength="100"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                                    data-type-mismatch="{{ __('Enter a valid :x.', ['x' => strtolower(__('Email'))]) }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone"
                                                class="col-sm-3 control-label require">{{ __('Phone') }}
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="{{ __('Phone') }}"
                                                    class="form-control phone-number inputFieldDesign" id="phone"
                                                    name="phone" value="{{ $vendors->phone }}" required maxlength="45"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                        <div class="form-group row d-none">
                                            <label for="gender"
                                                class="col-sm-3 control-label require">{{ __('Gender') }}</label>
                                            <div class="col-sm-9">
                                                <select id="select" name="gender" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" class="border-gray-2 rounded-sm w-full h-46p roboto-medium ltr:pl-18p rtl:pr-18p font-medium text-sm text-gray-10 form-control appearance-none genderSelect z-0">
                                                    <option value="Male" {{  old('gender', $vendors->gender) == 'Male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                                    <option value="Female" {{ old('gender', $vendors->gender) == 'Female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row d-none">
                                            <label for="formal_name"
                                                class="col-sm-3 control-label">{{ __('Formal Name') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control inputFieldDesign" id="formal_name"
                                                    name="formal_name" placeholder="{{ __('Formal Name') }}"
                                                    maxlength="100" value="{{ $vendors->formal_name }}">
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
                                                        value="{{ formatCurrencyAmount($vendors->sell_commissions) }}"
                                                        data-placement="top" max="100"
                                                        data-max="{{ __('The value not more than be :x', ['x' => 100]) }}">
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group row d-none">
                                            <label class="col-sm-3 control-label">{{ __('Description') }}</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="description" id="description">{{ $vendors->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row conditional preview-parent">
                                            <label class="col-sm-3 control-label">{{ __('Logo') }}</label>
                                            <div class="col-sm-9">
                                                <div class="custom-file position-relative position-relative media-manager-img" data-val="single"
                                                    data-returntype="ids" id="image-status">
                                                    <input class="custom-file-input is-image form-control inputFieldDesign"
                                                        name="vendor_logo" value="{{ $vendors->vendor_logo }}">

                                                    <label class="custom-file-label overflow_hidden d-flex align-items-center"
                                                        for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                </div>
                                                <div class="preview-image" id="#">
                                                    <!-- img will be shown here -->
                                                    <div class="d-flex flex-wrap mt-2">
                                                        <div class="position-relative border boder-1 p-1 ltr:me-2 rtl:ms-2 rounded mt-2">
                                                            <img class="upl-img p-1 neg-transition-scale"
                                                                src="{{ optional($vendors->logo)->fileUrl() ?? $vendors->fileUrl() }}">
                                                        </div>
                                                    </div>
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
                                        <div class="form-group row conditional preview-parent">
                                            <label class="col-sm-3 control-label">{{ __('Cover Photo') }}</label>
                                            <div class="col-sm-9">
                                                <div class="custom-file position-relative media-manager-img" data-val="single"
                                                    data-returntype="ids" id="image-status">
                                                    <input class="custom-file-input is-image form-control inputFieldDesign"
                                                        name="cover_photo" value={{ $vendors->cover_photo }}>

                                                    <label class="custom-file-label overflow_hidden d-flex align-items-center"
                                                        for="validatedCustomFile">{{ __('Upload image') }}</label>
                                                </div>
                                                <div class="preview-image" id="#">
                                                    <!-- img will be shown here -->
                                                    <div class="d-flex flex-wrap mt-2">
                                                        <div
                                                            class="position-relative border boder-1 p-1 mr-2 rounded mt-2">
                                                            <img class="upl-img p-1 neg-transition-scale"
                                                                src="{{ optional($vendors->cover)->fileUrl() ?? $vendors->fileUrl() }}">
                                                        </div>
                                                    </div>
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

                                        <div class="form-group row">
                                            <label for="Status"
                                                class="col-sm-3 control-label require">{{ __('Status') }}</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2-hide-search" name="status"
                                                    id="status">
                                                    <option value="Pending"
                                                        {{ $vendors->status == 'Pending' ? 'selected' : '' }}>
                                                        {{ __('Pending') }}</option>
                                                    <option value="Active"
                                                        {{ $vendors->status == 'Active' ? 'selected' : '' }}>
                                                        {{ __('Active') }}</option>
                                                    <option value="Inactive"
                                                        {{ $vendors->status == 'Inactive' ? 'selected' : '' }}>
                                                        {{ __('Inactive') }}</option>
                                                </select>
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
                                                        {{ $shops->organization_type == 'manufacturer' ? 'selected' : '' }}>
                                                        {{ __('Manufacturer') }}</option>
                                                    <option value="retailer"
                                                        {{ $shops->organization_type == 'retailer'  ? 'selected' : '' }}>
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
                                                $selectedBusinessType = !empty($shops->business_type) ? $shops->business_type : array_key_first($businessTypes);
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
                                                    value="{{ $shops->name }}" required maxlength="80"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="shop_email"
                                                class="col-sm-3 control-label require">{{ __('Shop Email') }}</label>
                                            <div class="col-sm-9">
                                                <input type="shop_email" class="form-control inputFieldDesign bg-white"
                                                    id="shop_email" name="shop_email" value="{{ $shops->email }}"
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
                                                    name="shop_number" value="{{ $shops->phone }}" required maxlength="15"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="alias"
                                                class="col-sm-3 control-label require">{{ __('Alias') }}</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control inputFieldDesign"
                                                    id="alias" name="alias" placeholder="{{ __('Alias') }}"
                                                    value="{{ $shops->alias  }}" required maxlength="45"
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
                                                <input type="text" class="form-control inputFieldDesign" id="website"
                                                    name="website" placeholder="{{ __('Website') }}" maxlength="255"
                                                    pattern="(http[s]?:\/\/)?(www\.)?([\.]?[a-z]+[a-zA-Z0-9\-]{1,})?[\.]?[a-z]+[a-zA-Z0-9\-]+\.[a-zA-Z]{2,5}([\.]?[a-zA-Z]{2,5})?"
                                                    data-pattern="{{ __('Enter a valid :x.', ['x' => __('URL')]) }}"
                                                    value="{{ $shops->website }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address"
                                                class="col-sm-3 control-label require">{{ __('Address') }}</label>
                                            <div class="col-sm-9">
                                                <textarea placeholder="{{ __('Address') }}" id="address" class="form-control" name="address" required
                                                    minlength="5" data-min-length="{{ __('Address should be atleast 5 characters.') }}" maxlength="191"
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">{{ $shops->address }}</textarea>
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
                                                    value="{{ $shops->post_code }}" required maxlength="10"
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
                                                    <div class="d-flex flex-wrap mt-2">
                                                        <div class="position-relative border boder-1 p-1 ltr:me-2 rtl:ms-2 rounded mt-2">
                                                            <img class="upl-img p-1 neg-transition-scale" 
     src="{{ $shops->personal_document ? asset(Storage::url($shops->personal_document)) : $vendors->fileUrl() }}"
>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-10 px-0 mt-3 mt-md-0">
                                    <a href="{{ request('shop') ? route('shop.index') : route('vendors.index') }}"
                                        class="btn all-cancel-btn custom-btn-cancel">{{ __('Cancel') }}</a>
                                    <button class="btn custom-btn-submit" type="submit" id="btnSubmit">
                                        <i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i>
                                        <span id="spinnerText">{{ __('Update') }}</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('mediamanager::image.modal_image')

@endsection

@section('js')
    <script type="text/javascript">
        "use strict";
        var vendor_id = '{{ isset($shops->vendor_id) ? $shops->vendor_id : null }}';
        const utilJs = "{{ asset('dist/js/intl-tel-input/utils.min.js') }}";
        let oldCountry = "{!! $shops->country ?? 'null' !!}";
        let oldState = "{!! $shops->state ?? 'null' !!}";
        let oldCity = "{!! $shops->city ?? 'null' !!}";
        let selectCity = `<option value="">${jsLang('Select City')}</option>`;
        let selectState = `<option value="">${jsLang('Select State')}</option>`;
        let errorMsg = jsLang(':x is not available.');
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
    
    <script src="{{ asset('dist/js/intl-tel-input/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/site/set-dial-code.min.js') }}"></script>
    
    <script src="{{ asset('dist/js/custom/vendors.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/validation.min.js') }}"></script>
@endsection
