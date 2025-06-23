<?php

/**
 * @author TechVillage <support@techvill.org>
 *
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 *
 * @created 18-01-2024
 */

namespace App\Http\Controllers;

use App\DataTables\QuoteDataTable;
use App\Models\Quote;

class QuoteController extends Controller
{
    /*
    * User List
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function log(QuoteDataTable $dataTable)
    {
        $data['users'] = Quote::join('users', 'users.id', 'quotes.user_id')
            ->select('users.id', 'users.name')
            ->distinct()
            ->pluck('users.name', 'users.id')
            ->toArray();

        $data['products'] = Quote::join('products', 'products.id', 'quotes.product_id')
            ->select('products.id', 'products.name')
            ->distinct()
            ->pluck('products.name', 'products.id')
            ->toArray();

        $data['inquiry'] = Quote::with(['user', 'product'])->get()->toArray();

        return $dataTable->render('admin.quote.index', $data);
    }
}
