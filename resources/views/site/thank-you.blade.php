@extends('site.layouts.app')
@section('page_title', __('Thank you'))
@section('seo')
    <meta name="robots" content="index, follow">
    <meta name="title" content="{{ preference('company_name').' '.__('Thank you') }}">
@endsection
@section('content')
    <!-- component -->
    <div class="ltr:ml-4 ltr:lg:ml-4 ltr:xl:ml-32 ltr:2xl:ml-64 ltr:3xl:ml-92 rtl:mr-4 rtl:lg:mr-4 rtl:xl:mr-32 rtl:2xl:mr-64 rtl:3xl:mr-92">
        
        <div class="md:flex">
            <div class="3xl:w-36% md:w-1/3 w-full ltr:mr-4 ltr:lg:mr-0 rtl:ml-4 rtl:lg:ml-0">
                <nav class="text-gray-600 text-sm mt-30p md:mt-50p" aria-label="Breadcrumb">
                    <ol class="list-none p-0 flex flex-wrap md:inline-flex text-xs md:text-sm roboto-medium font-medium text-gray-10 leading-5">
                        <li class="flex items-center">
                            <svg class="-mt-1 ltr:mr-2 rtl:ml-2" width="13" height="15" viewBox="0 0 13 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.35643 1.89407C4.93608 2.1717 4.43485 2.59943 3.69438 3.23412L2.916 3.9013C2.0595 4.63545 1.82512 4.85827 1.69934 5.13174C1.57357 5.4052 1.55692 5.72817 1.55692 6.85625V10.1569C1.55692 10.9127 1.55857 11.4013 1.60698 11.7613C1.65237 12.099 1.72565 12.2048 1.7849 12.264C1.84416 12.3233 1.94997 12.3966 2.28759 12.442C2.64759 12.4904 3.13619 12.492 3.89206 12.492H8.56233C9.31819 12.492 9.80679 12.4904 10.1668 12.442C10.5044 12.3966 10.6102 12.3233 10.6695 12.264C10.7287 12.2048 10.802 12.099 10.8474 11.7613C10.8958 11.4013 10.8975 10.9127 10.8975 10.1569V6.85625C10.8975 5.72817 10.8808 5.4052 10.755 5.13174C10.6293 4.85827 10.3949 4.63545 9.53838 3.9013L8.76 3.23412C8.01953 2.59943 7.5183 2.1717 7.09795 1.89407C6.69581 1.62848 6.44872 1.55676 6.22719 1.55676C6.00566 1.55676 5.75857 1.62848 5.35643 1.89407ZM4.49849 0.595063C5.03749 0.239073 5.5849 0 6.22719 0C6.86948 0 7.41689 0.239073 7.95589 0.595063C8.4674 0.932894 9.04235 1.42573 9.7353 2.01972L10.5515 2.71933C10.5892 2.75162 10.6264 2.78347 10.6632 2.81492C11.3564 3.40806 11.8831 3.85873 12.1694 4.48124C12.4557 5.10375 12.4551 5.79693 12.4543 6.70926C12.4543 6.75764 12.4542 6.80662 12.4542 6.85625L12.4542 10.2081C12.4543 10.8981 12.4543 11.4927 12.3903 11.9688C12.3217 12.479 12.167 12.9681 11.7703 13.3648C11.3736 13.7615 10.8845 13.9162 10.3742 13.9848C9.89812 14.0488 9.30358 14.0488 8.61355 14.0488H3.84083C3.1508 14.0488 2.55626 14.0488 2.08015 13.9848C1.56991 13.9162 1.08082 13.7615 0.68411 13.3648C0.2874 12.9681 0.132701 12.479 0.064101 11.9688C9.07021e-05 11.4927 0.000124017 10.8981 0.000162803 10.2081L0.000164659 6.85625C0.000164659 6.80662 0.000122439 6.75763 8.07765e-05 6.70926C-0.000705247 5.79693 -0.00130245 5.10374 0.285011 4.48124C0.571324 3.85873 1.09802 3.40806 1.79122 2.81492C1.82798 2.78347 1.8652 2.75162 1.90288 2.71933L2.68126 2.05215C2.69391 2.0413 2.70652 2.03049 2.71909 2.01972C3.41204 1.42573 3.98698 0.932893 4.49849 0.595063Z" fill="#898989" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.50293 9.37853C3.50293 8.51876 4.19991 7.82178 5.05969 7.82178H7.39482C8.25459 7.82178 8.95158 8.51876 8.95158 9.37853V13.2704C8.95158 13.7003 8.60309 14.0488 8.1732 14.0488C7.74331 14.0488 7.39482 13.7003 7.39482 13.2704V9.37853H5.05969V13.2704C5.05969 13.7003 4.71119 14.0488 4.28131 14.0488C3.85142 14.0488 3.50293 13.7003 3.50293 13.2704V9.37853Z" fill="#898989" />
                            </svg>
                            <a href="{{ route('site.index') }}">{{ __('Home') }}</a>
                            <p class="px-2">/</p>
                        </li>
                        <li class="flex items-center"><a href="#" class="text-gray-12">{{ __('Thank you') }}</a></li>
                    </ol>
                </nav>
                <div class="md:mt-3.5 mt-18p ltr:lg:mr-0 ltr:mr-5 rtl:lg:ml-0 rtl:ml-5">
                    <p class="dm-bold wow flex flex-wrap fadeInUp font-bold 2xl:text-42 xl:text-3xl text-2xl uppercase primary-text-color" data-wow-duration="1s"><span class="lg:leading-55p ltr:mr-2 rtl:ml-2">Thank You</span><span class="text-gray-12 lg:leading-55p">{{ __(' For Registration ') }} </span></p>
                        <p class="md:mt-5p mt-2.5 dm-regular lg:whitespace-nowrap font-regular wow fadeInUp text-gray-12 xl:text-lg lg:text-base text-sm" data-wow-duration="1s" data-wow-delay="200ms"> {{ __('Your acccount is in under review.') }}</p>
                        <p class="dm-regular font-regular wow fadeInUp text-gray-12 xl:text-lg lg:text-base text-sm" data-wow-duration="1s" data-wow-delay="300ms">{{ __('You will sortly get notified with your account approval information.') }}</p>
                    <div class="lg:mt-6 mt-15p border-animation"></div>
                </div>
            </div>
            <div class="3xl:w-848p md:w-3/5 lg:w-1/2 md:mt-0 mt-7 ltr:ml-auto rtl:mr-auto">
                <div class="header-div bg-gray-11 relative ltr:float-right rtl:float-left">
                </div>
                <div>
                    <img class="xl:w-382p xl:h-491p md:h-337p md:w-80 w-219-h-262 absolute xl:mt-4 md:mt-60p mt-2 wow ltr:md:-ml-12 ltr:ml-12 ltr:xxs:ml-20 ltr:sm:ml-28 LtrfadeInRight rtl:md:-mr-12 rtl:mr-12 rtl:xxs:mr-20 rtl:sm:mr-28 RtlfadeInLeft" data-wow-duration="2.5s" data-wow-delay="900ms" data-wow-offset="0" src="{{ asset('frontend/assets/img/coupon/man-circle.png') }}" alt="{{ __('Image') }}">
                    <img id="shopping_bag" class="absolute xl:h-60p primary-text-color xl:w-52p w-7 h-8 xl:mt-60p md:mt-10 header-icon cursor-pointer wow fadeIn ltr:xl:-ml-89p ltr:md:-ml-10 ltr:ml-9 rtl:xl:-mr-89p rtl:md:-mr-10 rtl:mr-9" data-wow-duration="2.5s" data-wow-delay="900ms" src="{{ asset('frontend/assets/img/coupon/shopping_bag.svg') }}" alt="{{ __('Image') }}">
                    <img id="cart" class="absolute xl:h-49p xl:w-58p w-8 h-7 xl:mt-450p md:mt-96 mt-60 header-icon cursor-pointer wow fadeIn ltr:xl:-ml-36 ltr:md:-ml-12 rtl:xl:-mr-36 rtl:md:-mr-12" data-wow-duration="2.5s" data-wow-delay="900ms" src="{{ asset('frontend/assets/img/coupon/cart.svg') }}" alt="{{ __('Image') }}">
                    <img id="hand" class="absolute xl:w-53p xl:h-58p w-29p h-8 header-icon xl:mt-485p md:mt-96 mt-64 cursor-pointer wow fadeIn ltr:xl:ml-411p ltr:xs:ml-72 ltr:ml-64 rtl:xl:mr-411p rtl:xs:mr-72 rtl:mr-64" data-wow-duration="2.5s" data-wow-delay="900ms" src="{{ asset('frontend/assets/img/coupon/hand.svg') }}" alt="{{ __('Image') }}">
                </div>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>
   
@endsection
