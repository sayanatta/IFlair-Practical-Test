@extends('layout.layout')
@section('section')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <a href="{{ route('products.index') }}" class="btn btn-success btn-sm">Back</a>
                            <form action="{{ route('products.update', $product) }}" method="POST" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Preview Image</label>
                                            <img src="{{ url('/') . $product->product_image }}"
                                                style="width:150px;hight:100px">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Image</label>
                                            <input type="file" class="form-control" name="image" id="image">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Enter name" value="{{ $product->product_name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Category</label>
                                            <select class="form-control" name="category" id="category">
                                                <option value="" hidden>Select category</option>
                                                @if (!empty($categories))
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            @if ($product->category_id == $category->id) selected @endif>
                                                            {{ $category->category_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Description</label>
                                            <textarea class="form-control" name="description" id="description" rows="4" placeholder="Enter description"
                                                value="{{ old('description') }}">{!! $product->product_description !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="" hidden>Select status</option>
                                                <option value="1" @if ($product->product_status == 1) selected @endif>
                                                    Active</option>
                                                <option value="2" @if ($product->product_status == 2) selected @endif>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card-footer form-btn-section">
                                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
    @endpush
@endsection
