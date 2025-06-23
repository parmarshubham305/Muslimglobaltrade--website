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

class Inquiry extends Model
{
    use hasFiles;
    use ModelTrait;

    /**
     * timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Foreign key with User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Foreign key with Product model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    /**
     * Store Validation
     *
     * @param  array  $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $validator = Validator::make($data, [
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'inquiry_title' => 'required|max:191',
            'inquiry_description' => 'nullable',
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
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'inquiry_title' => 'required|max:191',
            'inquiry_description' => 'nullable',
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
     * Update
     *
     * @param  array  $request
     * @param  int  $id
     * @return array
     */
    public function updateData($request = [], $id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Inquiry does not found.')];
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->update(array_intersect_key($request, array_flip((array) ['user_id', 'product_id', 'inquiry_title', 'inquiry_description'])));
            self::forgetCache();
            $data = ['status' => 'success', 'message' => __('The :x has been successfully saved.', ['x' => __('Inquiry')])];
        }

        return $data;
    }

    /**
     * delete
     *
     * @param  int  $id
     * @return array
     */
    public function remove($id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Inquiry does not found.')];
        $record = parent::find($id);
        if (! empty($record)) {
            $record->delete();
            $data = ['status' => 'success', 'message' =>  __('The :x has been successfully removed.', ['x' => __('Inquiry')])];
        }

        return $data;
    }

    public function inquiryImages()
    {
        return $this->objectFile()->get()->isNotEmpty() ? $this->filesUrlold() : [];
    }
}
