<?php

/**
 * @author TechVillage <support@techvill.org>
 *
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 *
 * @created 18-01-2024
 */

namespace App\DataTables;

use App\Models\{
    Subscription
};
use Illuminate\Http\JsonResponse;

class SubscriptionDataTable extends DataTable
{
    /**
     * Handle the AJAX request for attribute groups.
     *
     * This function queries attribute groups and returns the data in a format suitable
     * for DataTables to consume via AJAX.
     *
      @return \Illuminate\Http\JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $subscription = $this->query();

        return datatables()
            ->of($subscription)
            ->addColumn('name', function ($subscription) {
                return $subscription->name;
            })->addColumn('action', function ($subscription) {
                // $edit = '<a data-bs-toggle="tooltip" title="' . __('Edit') . '" href="' . route('subscription.edit', ['id' => $subscription->id]) . '" class="action-icon"><i class="feather icon-edit-1"></i></a>';
                $edit = '<a title="' . __('Edit') . '" href="' . route('subscription.edit', ['id' => $subscription->id]) . '" class="action-icon"><i class="feather icon-edit-1"></i></a>';

                return $edit;
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
    }

    /*
    * DataTable Query
    *
    * @return mixed
    */
    public function query()
    {
        $subscription = Subscription::query()->filter();

        return $this->applyScopes($subscription);
    }

    /*
    * DataTable HTML
    *
    * @return \Yajra\DataTables\Html\Builder
    */
    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'id', 'name' => 'id', 'title' => __('Id'), 'visible' => true])
            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => __('Name'), 'className' => 'align-middle'])
            ->addColumn(['data' => 'price', 'name' => 'price', 'title' => __('Price'), 'orderable' => false, 'searchable' => false, 'className' => 'align-middle text-left', 'width' => '12%'])
            ->addColumn(['data' => 'billing_cycle', 'name' => 'billing_cycle', 'title' => __('Billing Cycle'), 'orderable' => false, 'searchable' => false, 'className' => 'align-middle text-left', 'width' => '12%'])
            ->addColumn(['data' => 'description', 'name' => 'description', 'title' => __('Featured'), 'orderable' => false, 'searchable' => false, 'className' => 'align-middle text-left', 'width' => '12%'])
            ->addColumn([
                'data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '12%',
                'visible' => 'true',
                'orderable' => false, 'searchable' => false, 'className' => 'text-right align-middle',
            ])
            ->parameters(dataTableOptions(['dom' => 'Bfrtip']));
    }
}
