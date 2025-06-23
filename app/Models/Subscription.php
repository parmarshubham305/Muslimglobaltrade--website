<?php

/**
 * @author TechVillage <support@techvill.org>
 *
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 *
 * @created 08-12-2021
 */

namespace App\Models;

use App\Traits\ModelTrait;
use Validator;
use App\Traits\ModelTraits\hasFiles;

class Subscription extends Model
{
    use hasFiles;
    use ModelTrait;

    /**
     * timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    protected $casts = [
        'features' => 'array',
    ];

    /**
     * Store Validation
     *
     * @param  array  $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'price' => 'required|numeric',
            'billing_cycle' => 'required',
            'description' => 'required',
        ]);

        return $validator;
    }

    /**
     * Update Validation
     *
     * @param  array  $data
     * @return mixed
     */
    protected static function updateValidation($data, $id)
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        return $validator;
    }

    /**
     * Store
     *
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        $id = parent::insertGetId($data);
        $this->uploadFiles(['isUploaded' => false, 'isSavedInObjectFiles' => true, 'isOriginalNameRequired' => true, 'thumbnail' => false]);

        if (! empty($id)) {
            return $id;
        }

        return false;
    }

    /**
     * Update Brand
     *
     * @param  array  $data
     * @param  null  $id
     * @return bool
     */
    public function updatePlan($data = [], $id = null)
    {
        $result = $this->where('id', $id);

        if ($result->exists()) {
            $result->update($data);

            if (request()->file_id) {
                $result->first();
            } else {
                $result->first();
            }

            self::forgetCache();

            return true;
        }

        return false;
    }

    /**
     * delete
     *
     * @param  int  $id
     * @return array
     */
    public function remove($id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Quote does not found.')];
        $record = parent::find($id);
        if (! empty($record)) {
            $record->delete();
            $data = ['status' => 'success', 'message' =>  __('The :x has been successfully removed.', ['x' => __('Quote')])];
        }

        return $data;
    }

    public function users()
    {
        return $this->hasMany(User::class, 'plan_id');
    }
}
