<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerExtraField extends Model
{
    use HasFactory;

    /**
     * Fillable
     *
     * @var array
     */
    protected $fillable = ['seller_id', 'organization_type', 'business_type', 'website', 'documents'];

    /**
     * Store
     *
     * @param  array  $data
     * @return bool
     */
    public function store($data = [])
    {
        if (parent::insert($data)) {
            return true;
        }

        return false;
    }
}
