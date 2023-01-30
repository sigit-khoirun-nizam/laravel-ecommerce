@extends('admin.layout.template')

@section('page_title')
    Add Product - Tokoku
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Add Product</h4>

    <!-- Basic Layout -->
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Add Product</h5>
            <small class="text-muted float-end">Input information</small>
          </div>
          <div class="card-body">
            <form action="{{ route('storeproduct') }}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="product_name">Product Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="product_name" id="product_name" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="price">Product Price</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="price" id="price" />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="quantity">Product Quantity</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="quantity" id="quantity" />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="product_short_des">Product Short Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="product_short_des" id="product_short_des" cols="30" rows="10">

                  </textarea>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="product_long_des">Product Long Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="product_long_des" id="product_long_des" cols="30" rows="10">

                  </textarea>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="product_category_id">Select Category</label>
                <div class="col-sm-10">
                    <select id="product_category_id" name="product_category_id" class="form-select">
                        <option selected>Pilih Product Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="product_subcategory_id">Select Sub Category</label>
                <div class="col-sm-10">
                    <select id="product_subcategory_id" name="product_subcategory_id" class="form-select">
                        <option selected>Pilih Product SubCategory</option>
                        @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                        @endforeach
                    </select>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="product_img">Upload Product Image</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" id="product_img" name="product_img" />
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
