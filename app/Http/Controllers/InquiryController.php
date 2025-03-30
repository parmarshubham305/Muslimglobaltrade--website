<?php

/**
 * @author TechVillage <support@techvill.org>
 *
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 *
 * @created 18-01-2024
 */

namespace App\Http\Controllers;

use App\DataTables\InquiryDataTable;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    /*
    * User List
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function log(InquiryDataTable $dataTable)
    {
        $data['users'] = Inquiry::join('users', 'users.id', 'inquiries.user_id')
            ->select('users.id', 'users.name')
            ->distinct()
            ->pluck('users.name', 'users.id')
            ->toArray();

        $data['products'] = Inquiry::join('products', 'products.id', 'inquiries.product_id')
            ->select('products.id', 'products.name')
            ->distinct()
            ->pluck('products.name', 'products.id')
            ->toArray();

        $data['inquiry'] = Inquiry::with(['user', 'product'])->get()->toArray();

        return $dataTable->render('admin.inquiry.index', $data);
    }
}
