<link rel="stylesheet" href="{{ asset('frontend/assets/swiper/swiper-bundle.min.css') }}">
<div id="item-view-load">
    <!--Overlay Effect-->
    <div class="fixed hidden items-center inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="view-modal">
        <!--modal content-->
        <div class="relative mx-auto p-15p border shadow-lg rounded-lg bg-white w-11/12 lg:w-860p overflow-auto h-[500px] [@media(min-width:641px)]:h-auto" id="view-modal-main">
            @if (isset($productView))
                @php $stockDisplayFormat = preference('stock_display_format'); $lowStockThreshold = $product->getStockThreshold() @endphp
                <div class="w-full flex justify-between items-center relative border-b border-gray-2 mb-5">
                    <div class="flex items-center">
                        <span class="text-gray-12 ltr:mr-2 rtl:ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.95145 10.8918C5.39254 10.8918 4.93945 10.4388 4.93945 9.87985L4.93945 5.83186C4.93945 3.03731 7.20488 0.771874 9.99944 0.771875C12.794 0.771874 15.0594 3.03731 15.0594 5.83186L15.0594 9.87985C15.0594 10.4388 14.6063 10.8918 14.0474 10.8918C13.4885 10.8918 13.0354 10.4388 13.0354 9.87985L13.0354 5.83186C13.0354 4.15513 11.6762 2.79587 9.99944 2.79587C8.32271 2.79587 6.96345 4.15513 6.96345 5.83186L6.96345 9.87985C6.96345 10.4388 6.51036 10.8918 5.95145 10.8918Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.56553 5.83203C5.58652 5.83203 5.60758 5.83204 5.62871 5.83204L14.4345 5.83203C15.2643 5.83199 15.9829 5.83194 16.5631 5.90728C17.1867 5.98826 17.7854 6.17025 18.2893 6.6339C18.7932 7.09754 19.0243 7.67906 19.1568 8.29382C19.28 8.86574 19.3397 9.58182 19.4085 10.4088L19.9338 16.7119C19.9354 16.7312 19.937 16.7505 19.9386 16.7698C19.9773 17.2323 20.0145 17.6776 19.9944 18.0458C19.9719 18.4585 19.8723 18.9392 19.4976 19.3465C19.1228 19.7538 18.6521 19.8929 18.2426 19.9496C17.8773 20.0002 17.4305 20.0001 16.9665 20C16.9471 20 16.9277 20 16.9083 20H3.0917C3.07229 20 3.05291 20 3.03355 20C2.56948 20.0001 2.12265 20.0002 1.75736 19.9496C1.34793 19.8929 0.877202 19.7538 0.502445 19.3465C0.127687 18.9392 0.0281424 18.4585 0.00563022 18.0458C-0.0144547 17.6776 0.0227368 17.2323 0.0613632 16.7698C0.0629743 16.7505 0.0645879 16.7312 0.0661998 16.7119L0.586205 10.4718C0.58796 10.4508 0.589708 10.4298 0.59145 10.4088C0.66032 9.58183 0.719952 8.86574 0.843213 8.29382C0.975704 7.67906 1.20678 7.09754 1.71067 6.6339C2.21456 6.17025 2.81326 5.98826 3.4369 5.90728C4.01708 5.83194 4.73565 5.83199 5.56553 5.83203ZM3.69753 7.91443C3.29198 7.96709 3.15822 8.05239 3.08114 8.12332C3.00406 8.19424 2.90794 8.32045 2.82178 8.72023C2.72951 9.14838 2.67888 9.73178 2.60321 10.6399L2.0832 16.88C2.03799 17.4225 2.01511 17.7246 2.02662 17.9356C2.02677 17.9383 2.02692 17.941 2.02708 17.9436C2.02968 17.944 2.03234 17.9443 2.03505 17.9447C2.24432 17.9737 2.54726 17.976 3.0917 17.976H16.9083C17.4527 17.976 17.7557 17.9737 17.9649 17.9447C17.9677 17.9443 17.9703 17.944 17.9729 17.9436C17.9731 17.941 17.9732 17.9383 17.9734 17.9356C17.9849 17.7246 17.962 17.4225 17.9168 16.88L17.3968 10.6399C17.3211 9.73178 17.2705 9.14838 17.1782 8.72023C17.0921 8.32045 16.9959 8.19424 16.9189 8.12332C16.8418 8.05239 16.708 7.96709 16.3025 7.91443C15.8681 7.85803 15.2826 7.85603 14.3713 7.85603H5.62871C4.71745 7.85603 4.13186 7.85803 3.69753 7.91443Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <h3 class="dm-bold font-bold text-22">Product Inquiry</h3>
                    </div>
                    
                <button class="absolute right-3 open-view-modal-close">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0.512559 0.512559C1.19597 -0.170853 2.304 -0.170853 2.98741 0.512559L13.4873 11.0125C14.1707 11.6959 14.1707 12.8039 13.4873 13.4873C12.8039 14.1707 11.6959 14.1707 11.0125 13.4873L0.512559 2.98741C-0.170853 2.304 -0.170853 1.19597 0.512559 0.512559Z"
                            fill="#898989" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M13.4874 0.512559C12.804 -0.170853 11.696 -0.170853 11.0126 0.512559L0.512681 11.0125C-0.170731 11.6959 -0.170731 12.8039 0.512681 13.4873C1.19609 14.1707 2.30412 14.1707 2.98753 13.4873L13.4874 2.98741C14.1709 2.304 14.1709 1.19597 13.4874 0.512559Z"
                            fill="#898989" />
                    </svg>
                </button>
                </div>
                <div class="placeholder-loader placeholder-loader-animation">
                    <div class="w-full">
                        <div class="sm:flex sm:gap-x-5 flex w-full bg-white p-2 rounded-md">
                            <div class="w-full sm:w-1/2">
                                <div data-placeholder class="mb-2 h-40 md:h-96 overflow-hidden relative bg-gray-200">
                                </div>
                                <div data-placeholder class="mb-2 h-10 sm:h-16 overflow-hidden relative bg-gray-200">
                                </div>

                            </div>
                            <div class="w-full sm:w-1/2 ltr:ml-4 rtl:mr-4">
                                <div data-placeholder class="h-5 sm:h-10 mb-2  relative bg-gray-200">
                                </div>
                                <div data-placeholder class="h-10 sm:h-14 mb-2  relative bg-gray-200">
                                </div>
                                <div data-placeholder
                                    class="h-5 sm:h-10 mb-4 w-52  relative bg-gray-200"></div>
                                <div data-placeholder
                                    class="h-5 sm:h-10 mb-3 w-40  relative bg-gray-200"></div>
                                <div data-placeholder
                                    class="h-5 sm:h-10 mb-3 w-40  relative bg-gray-200"></div>
                                <div data-placeholder
                                    class="h-5 sm:h-10 mb-3 w-40 relative bg-gray-200"></div>
                                <div data-placeholder class="h-5 sm:h-10 mb-2 relative bg-gray-200">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <p class="text-gray-12 leading-15p md:text-13 text-xs roboto-medium font-medium ltr:ml-1 ltr:mr-5 rtl:mr-1 rtl:ml-5 mb-5">
                            <span class="font-normal text-gray-10">To</span>
                            <span class="cursor-pointer">
                                {{$product->vendor->name ?? ''}}
                            </span>
                                                                    
                                                            </p>
                    </div>
                    <div class="grid grid-cols-1 min-[641px]:grid-cols-2 [@media(min-width:641px)]:grid-cols-2 item-view-content">
                        <div class="flex">
                            <div class="w-60p h-60p border flex justify-center items-center rounded-sm">
                                <img class="w-full h-full" src="http://localhost/trade/public/dist/img/default-image.png" alt="Image">
                            </div>
                            <div class="flex flex-col justify-center ltr:pl-15p rtl:pr-15p">
                                <p class="dm-bold text-gray-12 text-lg">{{$product->name}}</p>
        
                                <div class="flex items-center cursor-pointer">
                                    <div class="md:flex flex-wrap hidden">
                                        <div class="flex-initial px-2 text-gray-10 bg-gray-11 mb-2 rounded-sm ltr:mr-2 rtl:ml-2">
                                        <p class="roboto-medium font-medium text-xs py-1">Category:
                                            {{$product->category[0]->name}}</p>
                                        </div>
                                        <div class="flex-initial px-2 text-gray-10 bg-gray-11 mb-2 rounded-sm ltr:mr-2 rtl:ml-2">
                                            <p class="roboto-medium font-medium text-xs py-1">{{$product->sku}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <form action="" method="post" id="inquiryForm"  enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="lg:mb-3 mb-3.5">
                            <label class="text-sm dm-sans font-medium capitalize text-gray-12 require-profile" for="inquiry_title">
                                {{ __('Inquiry Title') }}</label>
                            <input class="border-gray-2 rounded-sm w-full mt-1.5 lg:mt-1p lg:h-46p h-10 roboto-medium font-medium text-sm text-gray-10 form-control border focus:border-gray-12  " type="text" id="inquiry_title" name="inquiry_title" type="text" value="{{ old('inquiry_title') }}" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" placeholder="{{ __('Title') }}">

                        </div>

                        <div class="lg:mb-3 mb-3.5">
                            <label class="block ltr:text-left rtl:text-right mt-3 col-span-2 c-label">
                                <span class="text-sm text-gray-12 dm-sans">{{ __('Description') }}</span>
                                <textarea class="form-control form-textarea block w-full rounded text-13 roboto-medium h-32 mt-2.5"
                                    id="inquiry_description" name="inquiry_description" rows="3" placeholder="{{ __('Description') }}"
                                    value="{{ old('inquiry_description') }}"></textarea>
                            </label>
                        </div>
                        <div class="lg:mb-3 mb-3.5">
                        <label class="block text-left mt-3 ml-2 ">
                            <span class="text-sm text-gray-600 dm-sans">{{ __('Attachments') }}</span>
                            <div class="relative h-24 rounded-lg border-dashed mt-1 pb-3 border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
                                <div class="absolute">
                                    <div class="flex flex-col items-center">
                                        <div class="text-xl mt-2">
                                            <i class="fa fa-cloud-upload text-gray-200"></i>
                                        </div>
                                        <span class="block text-gray-400 font-normal text-sm">{{ __('Attach you files here') }}</span>
                                        <span class="block text-gray-400 font-normal text-sm">{{ __('or') }}</span>
                                        <span class="block text-blue-400 font-normal text-sm">{{ __('Browse files') }}</span>
                                    </div>
                                </div>
                                <input type="file" id="image" name="image[]" multiple class="h-full w-full opacity-0">
                            </div>
                        </label>
                        </div>
                        <div id="message" class="mt-4">

                        </div>
                        <div id="imgs" class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 2xl:grid-cols-10 gap-4 mt-8">
                        </div>
                        <div class="flex gap-3 lg:mt-5 mt-6">
                            <button class="lg:order-none order-last dm-sans text-center transition duration-200 rounded py-3.5 cursor-pointer font-medium text-sm text-gray-12 w-141p h-46p bg-white border border-gray-2 mb-7p hover:border-gray-12 open-view-modal-close">{{ __('Cancel') }}
                            </button>
                            <button type="submit" id="btnSubmit" class="inquiry-submit-modal-btn dm-sans transition duration-200 items-center cursor-pointer py-3 px-6 font-medium text-sm whitespace-nowrap text-white bg-gray-12 save-add-func hover:bg-yellow-1 hover:text-gray-12 mb-7p rounded">{{ __('Save Inquiry') }}</button>
                        </div>
                    </form>

                </div>
            @else
                <div class="flex placeholder-loader-animation">
                    <div class="w-full">
                    <div class="sm:flex sm:gap-x-5  flex w-full bg-white p-2 rounded-md">
                        <div class="w-full sm:w-1/2">
                            <div data-placeholder class="mb-2 h-40 md:h-96 overflow-hidden relative bg-gray-200"></div>
                            <div data-placeholder class="mb-2 h-10 sm:h-16 overflow-hidden relative bg-gray-200"></div>

                        </div>
                        <div class="w-full sm:w-1/2 ltr:ml-4 rtl:mr-4">
                            <div data-placeholder class="h-5 sm:h-10 mb-4 w-52  relative bg-gray-200"></div>
                            <div data-placeholder class="h-10 sm:h-14 mb-2  relative bg-gray-200"></div>
                            <div data-placeholder class="h-5 sm:h-10 mb-4 w-52  relative bg-gray-200">
                            </div>
                            <div data-placeholder class="h-5 sm:h-10 mb-3 w-40  relative bg-gray-200">
                            </div>
                            <div data-placeholder class="h-5 sm:h-10 mb-3 w-40  relative bg-gray-200">
                            </div>
                            <div data-placeholder class="h-5 sm:h-10 mb-3 w-40  relative bg-gray-200">
                            </div>
                            <div data-placeholder class="h-5 sm:h-10 mb-2 relative bg-gray-200"></div>
                        </div>
                    </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

    @php
        $allImage = [];
        if (isset($images)) {
            foreach ($images as $im) {
                $allImage[] = getBackgroundImage($im);
            }
        }
        $format = getFormatedCountdown();
        $formatSaleTo = date($format, strtotime(strtr($sale_to ?? null, " ", '')));
    @endphp
    <script>
        var attributePriceWithId = '{!! json_encode($filterVariation['attributePriceWithId'] ?? null) !!}';
        var defaultImages = '{!! json_encode($allImage) !!}';
        var slideImagecount = {{ isset($images) ? count($images) : 0 }};
        var possbileVariations = '{!! json_encode($filterVariation['possibleVariation'] ?? null) !!}';
        itemType = "{{ $type ?? \App\Enums\ProductType::$Simple }}";
        isManageStock = "{{ $manage_stocks ?? null }}";
        stockQty = "{{ $stock_quantity ?? null }}";
        qty = 1;
        backOrders = "{{ $backorders ?? 0 }}";
        var stockHide = "{{ $stock_hide ?? 0 }}";
        var featured = "{{ isset($featured) ? 1 : 0 }}";
        var reviewAvg = "{{ $review_average ?? 0 }}";
        var offerFlag = "{{ $offerFlag ?? null }}";
        var formatedSaleTo = "{{ $formatSaleTo }}";
        var stockDisplayFormat = "{{ preference('stock_display_format') }}"
        var videoExtensions = @json(getFileExtensions(6));


        $(document).on("submit", "#inquiryForm", function (e) {
            e.preventDefault();
            var form = this;
            if ($("#imgs").find(".pip").length > 15) {
                $("#message").show(200);
                $("#message").html(
                    '<span class="font-bold text-red-600">' +
                    jsLang("You can only upload a maximum of 15 files.") +
                    "</span>"
                );
                return 0;
            } else {
                var formData = new FormData(this);

                $('.inquiry-submit-modal-btn').html(`
                    ${jsLang('Submitting')}
                    <svg class="animate-spin text-gray-700 w-4 h-4 ml-1 mt-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="#000" stroke-width="3"></circle>
                        <path class="opacity-75" fill="#fff" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                `)
                // if (ratingUpdate) {
                //     formData.append("rating", ratingValue);
                // }
                $.ajax({
                    url: SITE_URL + "/product/inquiry/store",
                    type: "POST",
                    dataType: "JSON",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 1) {
                        setTimeout(() => {
                            $("#view-modal").hide(500);
                            fetch_data(1);
                        }, 3000);

                        $("#imgs").html("");
                        $("#inquiry-message").show(200);
                        $("#inquiry-message").html(
                            '<span class="font-bold text-green-600">' +
                                jsLang(data.message) +
                                "</span>"
                        );
                        $("#comments").val(null);
                        deletedFiles = [];
                        gImgObj = [];
                        j = 0;
                        k = 0;
                    } else {
                        $("#inquiry-message").show(200);
                        $("#inquiry-message").html(
                            '<span class="font-bold text-red-600">' +
                                jsLang(data.message) +
                                "</span>"
                        );
                    }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        if (xhr.status == 401) {
                            $("#message").show(200);
                            $("#message").html(
                                '<span class="font-bold text-red-600">' +
                                    jsLang(
                                        "To give a review, you need to login first."
                                    ) +
                                    "</span>"
                            );
                        } else {
                            $("#message").show(200);
                            $("#message").html(
                                '<span class="font-bold text-red-600">' +
                                    jsLang(thrownError) +
                                    "</span>"
                            );
                        }
                    },
                    complete: function() {
                        $('.review-submit-modal-btn').html(`
                            ${jsLang('Submit')}
                        `)
                    }
                });
            }
    });


    </script>
    <script src="{{ asset('frontend/assets/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/site/product-view.min.js') }}"></script>
