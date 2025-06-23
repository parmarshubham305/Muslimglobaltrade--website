<?php

/**
 * @author TechVillage <support@techvill.org>
 *
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 *
 * @created 21-11-2021
 */

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
// use App\Services\Mail\SendInquiryMailService;
use App\Models\{
    Quote,
};
use Illuminate\Http\Request;
use Auth;

class QuoteController extends Controller
{
    /**
     * Store
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $response = ['status' => 0, 'message' => __('Oops! Something went wrong, please try again.')];
        $request['user_id'] = Auth::user()->id ?? null;

        $validator = Quote::storeValidation($request->all());
        if ($validator->fails()) {
            $response['status'] = 0;
            $response['message'] = $validator->errors()->first();

            return $response;
        }
        $inquiryId = (new Quote())->store($request->only('user_id', 'product_id', 'quantity', 'unit', 'details', 'preferred_unit_price'));

        if (! empty($inquiryId)) {
            $response['status'] = 1;
            $response['message'] = __('Thanks for the inquiry. We will be get back soon.');

            return $response;
        }

        return $response;
    }

    /**
     * Update
     *
     * @param  int  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $result = $this->checkExistence($id, 'Inquiries');
        if ($result['status'] === true) {
            $request['user_id'] = Auth::user()->id;
            if (Quote::getAll()->where('id', $id)->where('is_default', 1)->count() > 0) {
                $request['is_default'] = 1;
            }
            $validator = Quote::updateValidation($request->all(), $id);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $response = (new Quote())->updateData($request->all(), $id);
        } else {
            $response = ['status' => 'fail', 'message' => $result['message']];
        }

        $this->setSessionValue($response);

        return redirect()->route('site.address');
    }

    /**
     * Delete
     *
     * @param  int  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy($id = null)
    {
        $result = $this->checkExistence($id, 'Inquiries');
        if ($result['status'] === true) {
            $response = (new Quote())->remove($id);
        } else {
            $response = ['status' => 'fail', 'message' => $result['message']];
        }

        $this->setSessionValue($response);

        return back();
    }

    /**
     * Check default user address
     *
     * @return json $response
     */
    public function checkDefault(Request $request)
    {
        $response['status'] = 0;
        $address = Quote::getAll()->where('user_id', $request->user_id)->where('is_default', 1)->first();
        if (! empty($address)) {
            $response['status'] = 1;
        }

        return $response;
    }

    /**
     * make default user address
     *
     * @param  int  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function makeDefault($id)
    {
        $result = (new Quote())->updateDefault($id);
        $this->setSessionValue($result);

        return redirect()->back();
    }
}
