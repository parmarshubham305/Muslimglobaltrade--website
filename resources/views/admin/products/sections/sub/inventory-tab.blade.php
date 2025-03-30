<div class="tab-pane fade mini-form-holder {{ isset($product) && ($product->isGroupedProduct() || $product->isVariableProduct()) ? 'show active' : '' }}"
    id="tabs-b" role="tabpanel" aria-labelledby="tabs-two">
    <div class="form-group row px-2 mt-4">
        <div class="col-md-5 px-0 px-md-2">
            <div class="row">
                <div class="col-md-4">
                    <label for="sku" class="sp-title control-label text-14">{{ __('SKU') }}</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="sku" name="sku" class="form-control inputFieldDesign"
                        placeholder="{{ __('SKU') }}" value="{{ isset($product) ? $product->sku : '' }}">
                </div>
            </div>
        </div>
    </div>

    <div
        class="form-group row px-7 mt-n3 conditional-dom not-external-dom not-grouped-dom {{ isset($product) && ($product->isExternalProduct() || $product->isGroupedProduct()) ? 'd-none' : '' }}">
        <div class="col-md-5 p-0-res mt-15-res">
            <div class="row d-flex align-items-center">
                <div class="col-md-4">
                    <label for="checkbox-p-2" class="sp-title control-label text-14">{{ __('Manage stock') }}</label>
                </div>
                <div class="col-md-8">
                    <div class="checkbox checkbox-primary d-inline w-space">
                        <input type="hidden" name="manage_stocks" value="0">
                        <input class="c-click {{ isset($product) && $product->manage_stocks ? '' : 'collapsed' }}"
                            data-bs-toggle="collapse" href="#Manage_stocks" type="checkbox"
                            {{ isset($product) && $product->manage_stocks ? 'checked' : '' }} name="manage_stocks"
                            value="1" id="checkbox-p-2"
                            area-expanded="{{ isset($product) && $product->manage_stocks ? 'true' : 'false' }}">
                        <label for="checkbox-p-2"
                            class="crs mb-0">{{ __('Enable stock management at product level.') }}</label>
                    </div>
                </div>
                <div id="Manage_stocks"
                    class="col-md-8 d-flx flex-column collapse offset-md-4 pb-2 {{ isset($product) && $product->manage_stocks ? 'show' : '' }}">
                    <div>
                        <div class="d-flex align-items-center">
                            <label class="sp-title control-label">{{ __('Stock quantity') }}</label>
                            <div
                                class="tooltips cursor-pointer neg-transition-scale  ltr:ms-2 rtl:me-2">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 6C12 9.31371 9.31371 12 6 12C2.68629 12 0 9.31371 0 6C0 2.68629 2.68629 0 6 0C9.31371 0 12 2.68629 12 6ZM6.66667 10C6.66667 10.3682 6.36819 10.6667 6 10.6667C5.63181 10.6667 5.33333 10.3682 5.33333 10C5.33333 9.63181 5.63181 9.33333 6 9.33333C6.36819 9.33333 6.66667 9.63181 6.66667 10ZM6 1.33333C4.52724 1.33333 3.33333 2.52724 3.33333 4H4.66667C4.66667 3.26362 5.26362 2.66667 6 2.66667H6.06287C6.76453 2.66667 7.33333 3.23547 7.33333 3.93713V4.27924C7.33333 4.62178 7.11414 4.92589 6.78918 5.03421C5.91976 5.32402 5.33333 6.13765 5.33333 7.05409V8.66667H6.66667V7.05409C6.66667 6.71155 6.88586 6.40744 7.21082 6.29912C8.08024 6.00932 8.66667 5.19569 8.66667 4.27924V3.93713C8.66667 2.49909 7.50091 1.33333 6.06287 1.33333H6Z"
                                        fill="#898989"></path>
                                </svg>
                                <span
                                    class="tooltiptexts">{{ __('If this is a variable product this value will be used to control stock for all variations, unless you define stock at variation level.') }}</span>
                            </div>
                        </div>
                        <input type="text" placeholder="0" class="form-control inputFieldDesign" maxlength="8"
                            name="total_stocks" value="{{ isset($product) ? $product->total_stocks : '' }}">
                    </div>
                    <div>
                        <div class="d-flex align-items-center">
                            <label class="sp-title control-label">{{ __('Pack of quantity ') }}</label>
                        </div>
                        {{-- <input type="text" placeholder="0" class="form-control inputFieldDesign" maxlength="8"
                            name="quantity_pack" value="{{ isset($product) ? $product->quantity_pack : '' }}"> --}}

                            <div class="table-responsive">
                                <table class="options table table-bordered" id="attribute-value">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="quantity_pack">
                                        @php $rowId = 1;
                                        @endphp
                                        @if(isset($product->quantity_pack) && $product->quantity_pack)
                                        @foreach ($product->quantity_pack as $value)
                                            <tr draggable="false" id="rowid-{{ $rowId }}">
                                                <td class="text-center" id="attribute-edit-container">
                                                    <i class="fa fa-bars"></i>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="quantity_pack[]" value="{{ $value }}" class="form-control inputFieldDesign" required id="valueChk-{{ $rowId }}">
                                                        <span id="value-text-{{ $rowId }}" class="validationMsg"></span>
                                                        <input type="hidden" name="row_identify[]" value="{{ $rowId }}">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" id="delete-value" class="btn btn-xs btn-danger delete-row" data-row-id={{ $rowId++ }} data-bs-toggle="tooltip" data-bs-title="Delete Value" data-original-title="">
                                                        <i class="feather icon-trash-2"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <input type="hidden" id="row_id" value="{{ $rowId }}">
                                        @else
                                        <tr draggable="false" id="rowid-1">
                                            <td class="text-center">
                                                <i class="fa fa-bars"></i>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="quantity_pack[]" class="form-control inputFieldDesign" required>
                                                    <span id="value-text-1" class="validationMsg"></span>
                                                    <input type="hidden" name="row_identify[]" value="1">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" id="delete-value" class="btn btn-xs btn-danger delete-row" data-row-id=1 data-bs-toggle="tooltip" data-bs-title="Delete Value" data-bs-original-title="">
                                                    <i class="feather icon-trash-2"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endif
                                        </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-default" id="add-new-value">{{ __('New') }}</button>
                    </div>
                    <div class="mt-1">
                        <div class="d-flex align-items-center">
                            <label class="sp-title control-label pe-2">{{ __('Allow backorders?') }}</label>
                            <div
                                class="tooltips cursor-pointer neg-transition-scale  ltr:ms-2 rtl:me-2">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 6C12 9.31371 9.31371 12 6 12C2.68629 12 0 9.31371 0 6C0 2.68629 2.68629 0 6 0C9.31371 0 12 2.68629 12 6ZM6.66667 10C6.66667 10.3682 6.36819 10.6667 6 10.6667C5.63181 10.6667 5.33333 10.3682 5.33333 10C5.33333 9.63181 5.63181 9.33333 6 9.33333C6.36819 9.33333 6.66667 9.63181 6.66667 10ZM6 1.33333C4.52724 1.33333 3.33333 2.52724 3.33333 4H4.66667C4.66667 3.26362 5.26362 2.66667 6 2.66667H6.06287C6.76453 2.66667 7.33333 3.23547 7.33333 3.93713V4.27924C7.33333 4.62178 7.11414 4.92589 6.78918 5.03421C5.91976 5.32402 5.33333 6.13765 5.33333 7.05409V8.66667H6.66667V7.05409C6.66667 6.71155 6.88586 6.40744 7.21082 6.29912C8.08024 6.00932 8.66667 5.19569 8.66667 4.27924V3.93713C8.66667 2.49909 7.50091 1.33333 6.06287 1.33333H6Z"
                                        fill="#898989"></path>
                                </svg>
                                <span
                                    class="tooltiptexts">{{ __('If managing stock, this controls whether or not backorders are allowed. If enabled, stock quantity can go below 0.') }}</span>
                            </div>
                        </div>
                        <select class="form-control select2" name="meta_backorder" oninvalid=""
                            data-minimum-results-for-search="Infinity">
                            <option {{ isset($product) && $product->meta_backorder == 0 ? 'selected' : '' }}
                                value="0">{{ __('Do not allow') }}</option>
                            <option {{ isset($product) && $product->meta_backorder == 1 ? 'selected' : '' }}
                                value="1">{{ __('Allow') }}</option>
                        </select>
                    </div>
                    @ifSettings('stock_threshold')
                    <div class="mt-1">
                        <div class="d-flex align-items-center">
                            <label class="sp-title control-label">{{ __('Low stock threshold') }}</label>
                            <div
                                class="tooltips cursor-pointer neg-transition-scale  ltr:ms-2 rtl:me-2">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 6C12 9.31371 9.31371 12 6 12C2.68629 12 0 9.31371 0 6C0 2.68629 2.68629 0 6 0C9.31371 0 12 2.68629 12 6ZM6.66667 10C6.66667 10.3682 6.36819 10.6667 6 10.6667C5.63181 10.6667 5.33333 10.3682 5.33333 10C5.33333 9.63181 5.63181 9.33333 6 9.33333C6.36819 9.33333 6.66667 9.63181 6.66667 10ZM6 1.33333C4.52724 1.33333 3.33333 2.52724 3.33333 4H4.66667C4.66667 3.26362 5.26362 2.66667 6 2.66667H6.06287C6.76453 2.66667 7.33333 3.23547 7.33333 3.93713V4.27924C7.33333 4.62178 7.11414 4.92589 6.78918 5.03421C5.91976 5.32402 5.33333 6.13765 5.33333 7.05409V8.66667H6.66667V7.05409C6.66667 6.71155 6.88586 6.40744 7.21082 6.29912C8.08024 6.00932 8.66667 5.19569 8.66667 4.27924V3.93713C8.66667 2.49909 7.50091 1.33333 6.06287 1.33333H6Z"
                                        fill="#898989"></path>
                                </svg>
                                <span
                                    class="tooltiptexts">{{ __('Send email to the vendor of the product if stock reaches to this amount.') }}</span>
                            </div>
                        </div>
                        <input type="text" placeholder="{{ __('Low stock threshold') }}"
                            class="form-control inputFieldDesign" name="meta_stock_threshold"
                            value="{{ isset($product) ? $product->meta_stock_threshold : '' }}">
                    </div>
                    @endifSettings
                    <div class="mt-3">
                        <div class="checkbox checkbox-primary d-inline w-space">
                            <input type="hidden" name="meta_hide_stock" value="0">
                            <input type="checkbox" id="is_hide_stock" name="meta_hide_stock" value="1"
                                {{ isset($product) && $product->hide_stock == 1 ? 'checked' : '' }}>
                            <label for="is_hide_stock" class="crs sp-title d-flx-n">{{ __('Hide Stock.') }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        class="form-group row px-2 s-hide conditional-dom not-external-dom not-grouped-dom {{ isset($product) && ($product->manage_stocks || $product->isExternalProduct() || $product->isGroupedProduct()) ? 'd-none' : '' }}">
        <div class="col-md-5 p-0-res">
            <div class="row">
                <div class="col-md-4">
                    <label for="status"
                        class="sp-title text-14 control-label sl_common_bx rtl:text-end">{{ __('Stock Status') }}</label>
                </div>
                <div class="col-md-8">
                    <select class="form-control select2 sl_common_bx" id="status" name="meta_stock_status">
                        <option value="In Stock"
                            {{ isset($product) && $product->meta_stock_status == 'In Stock' ? 'selected' : '' }}>
                            {{ __('In Stock') }}</option>
                        <option value="Out Of Stock"
                            {{ isset($product) && $product->meta_stock_status == 'Out Of Stock' ? 'selected' : '' }}>
                            {{ __('Out Of Stock') }}</option>
                        <option value="On Backorder"
                            {{ isset($product) && $product->meta_stock_status == 'On Backorder' ? 'selected' : '' }}>
                            {{ __('On Backorder') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div
        class="form-group row px-2 mt-4 conditional-dom not-external-dom not-grouped-dom {{ isset($product) && ($product->isExternalProduct() || $product->isGroupedProduct()) ? 'd-none' : '' }}">
        <div class="col-md-5 p-0-res">
            <div class="row d-flex align-items-center">
                <div class="col-md-4">
                    <label for="checkbox-p-3"
                        class="sp-title control-label d-flx-n text-14">{{ __('Sold Individually') }}</label>
                </div>
                <div class="col-md-8 mt-2">
                    <div class="checkbox checkbox-primary d-inline w-space">
                        <input type="hidden" name="meta_individual_sale" value="0">
                        <input type="checkbox"
                            {{ isset($product) && $product->meta_individual_sale == '1' ? 'checked' : '' }}
                            name="meta_individual_sale" value="1" id="checkbox-p-3">
                        <label for="checkbox-p-3"
                            class="crs mb-0 d-flx-n">{{ __('Enable this to only allow one of this Product to be bought in a single order') }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", "#add-new-value", function (event) {
        event.preventDefault();
        addAttributeValue();
    });
    var rowid = 2;
    if (
        $(".main-body .page-wrapper").find("#attribute-edit-container").length
    ) {
        rowid = $("#row_id").val();
    }
   
    $(document).on("click", ".delete-row", function (e) {
        e.preventDefault();
        var idtodelete = $(this).attr("data-row-id");
        // console.log($('.delete-row').length);
        if($('.delete-row').length == 1){

        }
        
        $("#rowid-" + idtodelete).remove();
    });
    function addAttributeValue() {
        let attributValue = `<tr draggable="false" class="" id="rowid-${rowid}">
                                <td class="text-center">
                                    <i class="fa fa-bars"></i>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="quantity_pack[]" class="form-control inputFieldDesign" required id="valueChk-${rowid}">
                                        <span id="value-text-${rowid}" class="validationMsg"></span>
                                        <input type="hidden" name="row_identify[]" value="${rowid}">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-xs btn-danger delete-row" data-row-id="${rowid}" data-bs-toggle="tooltip" data-title="Delete Value" data-original-title="" title="">
                                        <i class="feather icon-trash-2"></i>
                                    </button>
                                </td>
                            </tr>`;
        rowid++;
        $("#quantity_pack").append(attributValue);
    }
</script>
