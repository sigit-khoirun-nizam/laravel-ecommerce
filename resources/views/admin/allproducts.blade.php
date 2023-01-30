@extends('admin.layout.template')

@section('page_title')
    All Products - Tokoku
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> All Products</h4>
    @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
    @endif
    <div class="card">
        <h5 class="card-header">Available All Products Information</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead class="table-light">
              <tr>
                <th>Id</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($products as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                <td>
                  <img src="{{ asset($product->product_img) }}" alt="" style="height: 100px;" class="mb-1">
                  <br class="">
                  <a href="{{ route('editproductimg', $product->id) }}" class="btn btn-primary">Update</a>
                </td>
                <td>
                    <a href="{{ route('editproduct', $product->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('deleteproduct', $product->id) }}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
</div>
@endsection
