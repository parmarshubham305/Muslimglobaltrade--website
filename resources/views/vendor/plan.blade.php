@extends('vendor.layouts.app')
@section('page_title', __('Plan & Subscriptions'))
@section('content')
<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Pricing</h1>
    <p class="fs-5 text-muted">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
  </div>
<div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
    @foreach($plans as $plan)
    <div class="col-md-3">
      <div class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
          <h4 class="my-0 fw-normal">{{$plan->name}}</h4>
        </div>
        <div class="card-body">
          <h1 class="card-title pricing-card-title">${{(int)$plan->price}}<small class="text-muted fw-light">/{{($plan->billing_cycle == "monthly") ? "month" : "year"}}</small></h1>
          @php
          echo nl2br(htmlspecialchars($plan->description));
          @endphp
          <button type="button" class="w-100 btn btn-lg btn-outline-primary mt-2">{{(auth()->user()->subscription_id == $plan->id) ? "Active Plan" : "Upgrade"}}</button>
        </div>
      </div>
    </div>
    @endforeach 
  </div>
@endsection
