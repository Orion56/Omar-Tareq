@extends('layouts.main')

@section('title', 'Edit ' . $product->name_en)

@section('content')
    <div class="col-12">
        <form action="{{ route('dash.products.update'),,$product->id  }}" method="post" enctype="multipart/form-data">
            <div class="form-row justify-content-center">
                <div class="col-3">
                    <label for="file">
                        <img class="w-100" style="cursor:pointer" src="{{ asset('images/products/' . $product->image) }}"
                            alt="Upload" id="image">
                    </label>
                    <input type="file" name="image" id="file" class="d-none" onchange="loadFile(event)">
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="name_en">Name (EN)</label>
                    <input type="text" name="name_en" id="name_en" class="form-control"
                        value="{{ $product->name_en }}">
                </div>
                <div class="col-6">
                    <label for="name_ar">Name (AR)</label>
                    <input type="text" name="name_ar" id="name_ar" class="form-control"
                        value="{{ $product->name_ar }}">
                </div>
            </div>
            <div class="form-row">
                <div class="col-4">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}">
                </div>
                <div class="col-4">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control"
                        value="{{ $product->quantity }}">
                </div>
                <div class="col-4">
                    <label for="code">Code</label>
                    <input type="number" name="code" id="code" class="form-control" value="{{ $product->code }}">
                </div>
            </div>
            <div class="form-row">
                <div class="col-4">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option @selected($product->status == 1) value="1">Active</option>
                        <option @selected($product->status == 0) value="0">Not Active</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="brand_id">Brand</label>
                    <select name="brand_id" id="brand_id" class="form-control">
                        @foreach ($brands as $brand)
                            <option @selected($product->brand_id == $brand->id) value="{{ $brand->id }}">{{ $brand->name_en }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="subcategory_id">Subcategory</label>
                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                        @foreach ($subcategories as $subcategory)
                            <option @selected($product->subcategory_id == $subcategory->id) value="{{ $subcategory->id }}">{{ $subcategory->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="details_en">Details (EN)</label>
                    <textarea name="details_en" id="details_en" cols="30" rows="10" class="form-control">{{ $product->details_en }}</textarea>
                </div>
                <div class="col-6">
                    <label for="details_ar">Details (AR)</label>
                    <textarea name="details_ar" id="details_ar" cols="30" rows="10" class="form-control">{{ $product->details_ar }}</textarea>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="col-3 my-3 ">
                    <button class="btn btn-primary btn-sm w-100"> Update </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection
