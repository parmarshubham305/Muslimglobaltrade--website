<?php

/**
 * @author TechVillage <support@techvill.org>
 *
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 *
 * @created 18-01-2024
 */

namespace App\Http\Controllers;

use App\DataTables\SubscriptionDataTable;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /*
    * User List
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(SubscriptionDataTable $dataTable)
    {
        $data['plan'] = Subscription::get()->toArray();

        return $dataTable->render('admin.subscription.index', $data);
    }

    /**
     * Edit Brand
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $subscription = Subscription::getAll()->where('id', $id)->first();
        if (empty($subscription)) {
            $response = $this->messageArray(__(':x does not exist.', ['x' => __('Subscription')]), 'fail');
            $this->setSessionValue($response);

            return redirect()->route('subscription.index');
        }
        $data['subscription'] = $subscription;

        return view('admin.subscription.edit', $data);
    }

    /**
     * Update Subscription
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        if ($request->isMethod('post')) {
            $result = $this->checkExistence($id, 'subscriptions');
            if ($result['status'] === true) {
                $validator = Subscription::updateValidation($request->all(), $id);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                $request['features'] = json_encode($request['features']);
                if ((new Subscription())->updatePlan($request->only('name', 'price', 'features', 'description', 'status'), $id)) {
                    $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Subscription')]), 'success');
                }
            } else {
                $response['message'] = $result['message'];
            }
        }
        $this->setSessionValue($response);

        return redirect()->route('subscription.index');
    }
}
