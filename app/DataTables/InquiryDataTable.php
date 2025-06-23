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
    Inquiry
};
use Illuminate\Http\JsonResponse;

class InquiryDataTable extends DataTable
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
        $inquiry = $this->query();

        return datatables()
            ->of($inquiry)

            ->addColumn('user', function ($inquiry) {
                return $inquiry?->user?->name;
            })
            ->addColumn('product', function ($inquiry) {
                return $inquiry?->product?->name;
            })
            // ->editColumn('notification', function ($inquiry) {
            //     $className = $inquiry->notification_type;
            //     $shortClassName = str_replace('Notification', '', class_basename($className));

            //     return ucwords(preg_replace('/(?<=\\w)(?=[A-Z])/', ' $1', $shortClassName));
            // })
            // ->editColumn('channel', function ($inquiry) {
            //     $classNameParts = explode('\\', $inquiry->channel);
            //     $shortName = end($classNameParts);
            //     $shortClassName = str_replace('Channel', '', class_basename($shortName));

            //     return ucwords(preg_replace('/(?<=\\w)(?=[A-Z])/', ' $1', ucfirst($shortClassName)));
            // })
            // ->editColumn('confirmed_at', function ($inquiry) {
            //     return timeToGo($inquiry->confirmed_at, false, 'ago');
            // })
            // ->addColumn('action', function ($inquiry) {
            //     $str = '';

            //     if ($this->hasPermission(['App\\Http\\Controllers\\NotificationController@destroyLog'])) {
            //         $str .= '<form method="post" action="' . route('inquiry.log.destroy', ['id' => $inquiry->id]) . '" id="delete-notification-' . $inquiry->id . '" accept-charset="UTF-8" class="display_inline">
            //         ' . csrf_field() . '
            //         ' . method_field('delete') . '
            //         <a title="' . __('Delete') . '" class="action-icon confirm-delete" type="button" data-id=' . $inquiry->id . ' data-delete="notification" data-label="Delete" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Notification Log')]) . '" data-message="' . __('Are you sure to delete this?') . '">
            //         <i class="feather icon-trash"></i>
            //         </a>
            //         </form>';
            //     }

            //     return $str;
            // })
            ->rawColumns(['user', 'notification', 'channel', 'confirmed_at', 'action'])
            ->make(true);
    }

    /*
    * DataTable Query
    *
    * @return mixed
    */
    public function query()
    {
        $inquiry = Inquiry::with(['user', 'product'])->filter();

        return $this->applyScopes($inquiry);
    }

    /*
    * DataTable HTML
    *
    * @return \Yajra\DataTables\Html\Builder
    */
    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'id', 'name' => 'id', 'title' => __('Id'), 'visible' => false])
            ->addColumn(['data' => 'user', 'name' => 'user', 'title' => __('User'), 'orderable' => false, 'searchable' => false, 'className' => 'align-middle text-left', 'width' => '12%'])
            ->addColumn(['data' => 'product', 'name' => 'product', 'title' => __('Product'), 'orderable' => false, 'searchable' => false, 'className' => 'align-middle text-left', 'width' => '12%'])
            ->addColumn(['data' => 'inquiry_title', 'name' => 'inquiry_title', 'title' => __('Inquiry Title'), 'orderable' => false, 'searchable' => false, 'className' => 'align-middle text-left', 'width' => '12%'])
            ->addColumn(['data' => 'inquiry_description', 'name' => 'inquiry_description', 'title' => __('Inquiry Description'), 'orderable' => false, 'searchable' => false, 'className' => 'align-middle text-left', 'width' => '12%'])
            ->parameters(dataTableOptions(['dom' => 'Bfrtip']));
    }
}
