@extends('layouts.app')

@section('content')
<div class="container-fluid dashboard-content vh-100">
    <h3 class="py-3">Admin Dashboard - Orders/Cart Details</h3>
    <div class="row mt-3 mb-5">
        @foreach ($unprocessedCarts as $cart)
        {{$cart}}
        <div class="col-md-4 mb-2">
            <div class="card text-center card-setup">
                <div class="card-header header-style border-0 mb-0" style="background: #f5f7ff !important;">
                    <div class="row row-cols-lg-2 row-cols-1">
                        <div class="col text-start">
                            <a class="details text-decoration-none">
                            </a>
                        </div>
                        <div class="col text-end">
                            <form action="/admin/orders/{{ $cart->id }}/status" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-control">
                                    <option value="pending" {{ $cart->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="shipped" {{ $cart->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $cart->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <!-- Add other status options -->
                                </select>
                                <button type="submit" class="btn btn-sm btn-default">Update</button>
                            </form>
                        </div>
                    </div>
                    <hr />
                </div>
                <div class="card-body pt-0">
                    <div class="row text-start">
                        <div class="col-md-12"><span>Cart Summary:</span></div>
                        <div class="col-md-10 timeline-status-count">
                            <div class="cart-summary">
                                <ul>
                                    @foreach ($cart->items as $item)
                                    <li>{{ $item->name }}( {{ $item->pivot->quantity }} ) - ${{ $item->price }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="assigned">
                                <p class="follow-up">
                                    Total Product ::
                                    <span class="count">{{count($cart->items)}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

<style>
    /* Add styling to match the layout */

    .dashboard {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .order-list {
        flex: 1;
    }

    .cart-summary {
        flex: 1;
    }

    /* Style table, lists, etc., as needed */


    .dashboard-header h3 {
        font-weight: 700;
    }

    .card-setup {
        border-radius: 10px;
    }

    .header-style {
        /* background-color: white; */
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .assign {
        color: #262c66;
        font-weight: 500;
        cursor: pointer;
    }

    .details {
        color: black;
        font-weight: 700;
        cursor: pointer;
    }

    .date {
        color: dimgray;
    }

    .count {
        font-weight: bold;
    }

    .follow-up {
        margin-top: 12px;
    }

    .assigned {
        border: 1px solid #ffba5a;
        background-color: #fffcf9;
        border-radius: 4px;
    }

    .interested {
        border: 1px solid #34b758;
        background-color: #f5fff8;
        border-radius: 4px;
    }

    .timeline-status-count span {
        background-color: #f5f7ff;
        border-radius: 8px;
        padding: 5px 10px;
        display: inline-block;
        margin-bottom: 10px;
        color: #262c66;
    }

    .router-link-style {
        color: black;
        font-weight: 600;
        cursor: pointer;
    }

    /* 
        .container-fluid.dashboard-content {
            padding: 0 5% 0 5%;
            background-color: #f2f2f2;
        } */

    .timeline-status-style {
        margin-right: 10px;
    }

    .top-margin {
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .image-row {
        box-sizing: border-box;
        /* width: 100px;
  height: 100px; */
    }

    .num-size {
        font-size: 15px;
        font-weight: bold;
        padding-left: 5px;
    }

    .col-4 p {
        font-size: 13px;
    }

    .total-assign {
        text-justify: auto;
        margin-left: -10px;
    }

    .text-style-align {
        padding-left: 20px;
    }

    .assign-call-converted {
        font-weight: bold;
        margin-left: 1px;
    }

    .assign-call-converted-count {
        font-weight: bold;
    }

    .cusror-pointer-style {
        cursor: pointer;
    }

    .assgnment-name-style {
        cursor: pointer;
        color: #686969;
        text-decoration: none;
        font-weight: 600;
    }

    img.cusror-pointer-style {
        margin-right: 15px;
    }

    .col-md-2.image-row.cusror-pointer-style,
    .col-md-12.image-row.cusror-pointer-style {
        padding-top: 10px;
        color: #3e3e3f;
        border: 1px solid #c8cacc;
        height: 60px;
        width: auto;
        background: white;
        border-radius: 5px;
        box-shadow: 0px 0px 1px 1px;
    }

    span.num-size.text-lg.ml-4 {
        margin-left: 10px;
    }

    span.name-style {
        font-weight: 600;
        font-style: italic;
        color: #1d711b;
    }

    label.time-line-style {
        color: red;
        font-weight: 500;
    }

    .assignment-style-name p {
        color: #838383;
    }

    span.phone-style {
        font-weight: 500;
        margin-right: 10px;
    }

    span.email-style {
        color: #838383;
        margin-left: 10px;
    }

    .bar-height {
        height: 50px;
        padding-top: 15px;
        font-size: 13px;
    }

    .card.card-style {
        box-shadow: 0px 1px 8px -3px;
        border: 1px solid #f8f9fa;
    }

    .view-all-active {
        text-decoration: none;
        color: #1d711b;
        font-style: italic;
    }
</style>