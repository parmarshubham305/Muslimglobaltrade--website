@extends('admin.layouts.app')
@section('page_title')
    @if (isset($product))
        {{ $product->name }} - {{ __('Edit :x', ['x' => __('Product')]) }}
    @else
        {{ __('Create new item') }}
    @endif
@endsection

@push('styles')
    <!-- summer note css -->
    <link rel="stylesheet" href="{{ asset('datta-able/plugins/summer-note/summernote-lite.min.css') }}">
    <!-- custom category -->
    <link rel="stylesheet" href="{{ asset('dist/css/custom-category.min.css') }}">
    <!-- date range picker css -->
    <link rel="stylesheet" href="{{ asset('dist/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}">
@endpush
@section('content')
    @php
        $isAdmin = true;
        $productForSelector = isset($product) ? $product : null;
    @endphp
    <!-- Main content -->
    <div class="col-md-12 no-print notification-msg-bar smoothly-hide">
        <div class="noti-alert pad">
            <div class="alert bg-dark text-light m-0 text-center">
                <span class="notification-msg"></span>
            </div>
        </div>
    </div>

    @php
        $sections = (new \App\Services\Product\Editor\Section($productForSelector))->getSections()['sections'];
    @endphp

    <div class="col-md-12 overflow-x-hidden list-container" id="invoice-view-container">
        <div class="row">
            @csrf
            <div class="col-md-12 col-lg-12 col-xl-9 order-last order-xl-first">
                @foreach ($sections as $name => $section)
                    @if (
                        ($section['visibility'] ?? '1') == '1' &&
                            !($section['is_left_side'] ?? false) &&
                            ($section['is_main'] ?? false) &&
                            !($section['is_draggable'] ?? false))
                        @if (is_callable($section['content']))
                            {!! $section['content']() !!}
                        @else
                            @includeIf($section['content'])
                        @endif
                    @endif
                @endforeach

                <div id="sortable" class="drag_and_drop">
                    @foreach ($sections as $name => $section)
                        @if (
                            ($section['visibility'] ?? '1') == '1' &&
                                !($section['is_left_side'] ?? false) &&
                                ($section['is_main'] ?? false) &&
                                ($section['is_draggable'] ?? false))
                            @if (is_callable($section['content']))
                                {!! $section['content']() !!}
                            @else
                                @includeIf($section['content'])
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-md-12 col-lg-12 col-xl-3">
                @foreach ($sections as $name => $section)
                    @if (($section['visibility'] ?? '1') != '1' || ($section['is_main'] ?? false))
                        @continue
                    @endif

                    @if ($section['is_left_side'] ?? false)
                        @if (is_callable($section['content']))
                            {!! $section['content']() !!}
                        @else
                            @includeIf($section['content'])
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <form
        action="{{ isset($product) ? route('products.edit-action', ['code' => $product->code]) : route('product.create') }}"
        method="post" id="ajaxReloadForm">
        @csrf
        <input type="hidden" name="action" class="ajax-form-action">
        <input type="hidden" name="data" class="ajax-form-data">
    </form>

    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn custom-btn-cancel all-cancel-btn"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" id="confirmDeleteSubmitBtn" data-bs-dismiss="modal" data-task=""
                        class="btn custom-btn-submit">{{ __('Yes, Confirm') }}</button>
                    <span class="ajax-loading"></span>
                </div>
            </div>
        </div>
    </div>
    @include('admin.products.sections.sub.attribute-modal')
    @include('mediamanager::image.modal_image')
    @php
        $parentCategory = null;
        $parentCategoryId = null;
    @endphp
@endsection

@section('js')
    <!-- Jquery Ui JS -->
    <script src="{{ asset('dist/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <!-- sweetalert JS -->
    <script src="{{ asset('datta-able/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/delete-modal.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/product.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/jquery.blockUI.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/custom-category.min.js') }}"></script>
    <script>
        var parentCategoryId = {{ isset($product) ? json_encode($parentCategoryId) : json_encode([]) }}
        parentCategoryId != '' ? buttonIsDisable = false : '';
        loadListProduct(false);
        var confirmTextCurrentSection = '';
    </script>
    @if (!empty($parentCategory))
        @foreach (explode(' / ', $parentCategory) as $key => $parent)
            <script>
                confirmTextCurrentSection +=
                    `<li class="breadcrumb-item" data-catId = {{ $parentCategoryId[$key] ?? null }}><a class="custom-a" href="javascript:void(0)">{{ $parent }}</a></li>`;
            </script>
        @endforeach
    @endif
    <script>
        let itemUrl =
            '{{ isset($product) ? route('products.edit-action', ['code' => $product->code]) : route('product.create') }}';
        let itemsAjaxSearch =
            '{{ isset($product) ? route('findProductsAjax', ['code' => $product->code]) : route('findProductsAjax') }}';
        let tagsAjaxSearch = '{{ route('findTagsAjax') }}';
        let variationImagePlaceholder = '{{ asset('dist/img/not.svg') }}';
        const countHelper = {
            attributes: 0,
            variations: 0
        }
        var videoExtensions = @json(getFileExtensions(6));
    </script>

    <script src="{{ asset('dist/js/xss.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom/create-product.min.js') }}"></script>
    <script src="{{ asset('dist/js/moment.min.js') }}"></script>
    <!-- date range picker Js -->
    <script src="{{ asset('dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
    <!-- summernote JS -->
    <script src="{{ asset('datta-able/plugins/summer-note/summernote-lite.min.js') }}"></script>
@endsection
