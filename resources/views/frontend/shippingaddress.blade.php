@extends('frontend.layouts.template')

@section('main-content')
    <h1>Provide Your Shipping Information</h1>
    <div class="row">
        <div class="col-12">
            <div class="box_main">
                <form action="{{ route('addshippingaddress') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number">
                    </div>

                    <div class="form-group">
                        <label for="city_name">City</label>
                        <input type="text" class="form-control" name="city_name">
                    </div>

                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" name="postal_code">
                    </div>

                    <input type="submit" value="Next" class="btn btn-primary btn-sm">
                </form>
            </div>
        </div>
    </div>
@endsection
