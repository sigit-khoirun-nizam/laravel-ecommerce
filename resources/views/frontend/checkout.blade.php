@extends('frontend.layouts.template')

@section('main-content')
<h1>Final step to place your order</h1>
    <div class="row">
        <div class="col-7">
            <div class="box_main">
                <h3>Product will send at -</h3>
                <p>City - {{ $shipping_address->city_name }}</p>
                <p>Nomor - {{ $shipping_address->phone_number }}</p>
                <p>Postal Code - {{ $shipping_address->postal_code }}</p>
            </div>
        </div>
        <div class="col-5">
            <div class="box_main">
                <h4>Your Final Product Are -</h4>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($cart_items as $item)
                            <tr>
                                @php
                                    $product_name = App\Models\Product::where('id', $item->product_id)->value('product_name');
                                @endphp
                                <td>{{ $product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                            </tr>

                            @php
                                $total = $total + $item->price;
                            @endphp
                        @endforeach

                            <tr>
                                <td></td>
                                <td>Total</td>
                                <td>{{ $total }}</td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>

        <form action="" method="post">
            @csrf
            <div class="form-group">
                <input type="submit" value="Cancel Order" class="btn btn-danger btn-sm mr-3">
            </div>
        </form>

        <form action="{{ route('placeorder') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="submit" value="Place Order" class="btn btn-success btn-sm">
            </div>
        </form>
    </div>
@endsection
