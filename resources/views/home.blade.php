@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="py-3">Products</h3>
        <div class="row pt-2">
            <div class="col-md-9">
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="dashboard">
                            <div class="products">
                                    <div class="product mb-4">
                                        <!-- <img width="120px" src="{{$product->image_url}}" alt=""> -->
                                        <h5>{{ $product->name }}</h5>
                                        <p>{{ $product->description }}</p>
                                        <p>Price: ${{ $product->price }}</p>
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit">Add to Cart</button>
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                    
            </div>
            <div class="col-md-3">
                <div class="cart-summary">
                    <div id="cart">
                        <h3>Shopping Cart</h3>
                        <table class="table table-striped table-hover">
                                <thead>
                                    <!-- <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr> -->
                                </thead>
                                <tbody>
                                    @if(isset($cart->items))
                                        @foreach($cart->items as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>${{ $item->price }}</td>
                                                <td>
                                                    <form  style="display: block;" action="{{ route('cart.edit',['id' => $item->pivot->id]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="number" min="1" style="width:40px" name="new_quantity" value="{{ $item->pivot->quantity }}" id="">
                                                        <button type="submit">Update</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('cart.remove',['id' => $item->pivot->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit">x</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>No Available Product</tr>
                                    @endif
                                </tbody>
                        </table>
                        <p>Total Price: <span id="total-price">${{$totalCalculatedPrice}}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection