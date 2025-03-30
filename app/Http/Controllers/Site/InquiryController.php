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
use App\Services\Mail\SendInquiryMailService;
use App\Models\{
    Inquiry,
    Country
};
use Illuminate\Http\Request;
use Auth;

class InquiryController extends Controller
{
    /**
     * address view page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['Inquiries'] = Inquiry::getAll()->where('user_id', Auth::user()->id);
        $data['countries'] = Country::getAll();

        return view('site.address.index', $data);
    }

    /**
     * Store
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $response = ['status' => 0, 'message' => __('Oops! Something went wrong, please try again.')];
        $request['user_id'] = Auth::user()->id ?? null;

        $validator = Inquiry::storeValidation($request->all());
        if ($validator->fails()) {
            $response['status'] = 0;
            $response['message'] = $validator->errors()->first();

            return $response;
        }
        $inquiryId = (new Inquiry())->store($request->only('user_id', 'product_id', 'inquiry_title', 'inquiry_description'));

        if (! empty($inquiryId)) {
            $response['status'] = 1;
            $response['message'] = __('Thanks for the inquiry. We will be get back soon.');

            return $response;
        }

        return $response;


        // $request['user_id'] = Auth::user()->id;
        // $validator = Inquiry::storeValidation($request->all());
        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // }
        // $inquiryId = (new Inquiry())->store($request->only('user_id', 'product_id', 'inquiry_title', 'inquiry_description'));
        // if ($inquiryId) {
        //     $data = ['status' => 'success', 'message' => __('The :x has been successfully saved.', ['x' => __('Inquiry')])];
        // } else {
        //     $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        // }

        // $this->setSessionValue($data);
        // $request['inquiry_id'] = $inquiryId;
        // $request['type'] = "admin";
        // (new SendInquiryMailService())->send($request);

        // $request['inquiry_id'] = $inquiryId;
        // $request['type'] = "user";
        // (new SendInquiryMailService())->send($request);


        // if (isset($request->redirect) && $request->redirect == 'checkout') {
        //     return redirect()->route('site.checkOut');
        // }

        // return redirect()->back();
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
            if (Inquiry::getAll()->where('id', $id)->where('is_default', 1)->count() > 0) {
                $request['is_default'] = 1;
            }
            $validator = Inquiry::updateValidation($request->all(), $id);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $response = (new Inquiry())->updateData($request->all(), $id);
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
            $response = (new Inquiry())->remove($id);
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
        $address = Inquiry::getAll()->where('user_id', $request->user_id)->where('is_default', 1)->first();
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
        $result = (new Inquiry())->updateDefault($id);
        $this->setSessionValue($result);

        return redirect()->back();
    }
}
