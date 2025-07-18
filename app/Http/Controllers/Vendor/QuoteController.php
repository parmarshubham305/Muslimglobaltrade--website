<?php

/**
 * @author TechVillage <support@techvill.org>
 *
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 *
 * @created 18-01-2024
 */

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\DataTables\QuoteDataTable;
use App\Models\Quote;

class QuoteController extends Controller
{
    /*
    * User List
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(QuoteDataTable $dataTable)
    {

        $data['products'] = Quote::join('products', 'products.id', 'quotes.product_id')
            ->select('products.id', 'products.name')
            ->where('products.vendor_id', session('vendorId'))
            ->distinct()
            ->pluck('products.name', 'products.id')
            ->toArray();

        $data['inquiry'] = Quote::select('quotes.*')
            ->join('products', 'quotes.product_id', '=', 'products.id')
            ->whereNotNull('products.vendor_id')
            ->where('products.vendor_id', session('vendorId'))
            ->with(['user', 'product'])
            ->get()
            ->toArray();

        return $dataTable->render('vendor.quote.index', $data);
    }
}
