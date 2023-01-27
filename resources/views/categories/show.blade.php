@extends('backend.pages.layouts.layout')
@section('content')
    <div class="content-wrapper" style="min-height: 357px;">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend::dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend::categories.index') }}">Categories</a>
                            </li>
                            <li class="breadcrumb-item active">Show Category</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Show Category</h3>
                                <div class="card-header-btn-section">
                                    <a href="{{ route('backend::categories.index') }}" class="btn btn-primary btn-sm"><i
                                            class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Previous image</label>
                                            <img src="{{ url('/') . $category->image }}"
                                                style="width: 150px;height: 100px;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" placeholder="Enter name"
                                                value="{{ $category->name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Status</label>
                                            <select class="form-control" name="status" id="status" disabled>
                                                <option value="1" @if ($category->status == 1) selected @endif>
                                                    Active</option>
                                                <option value="0" @if ($category->status == 0) selected @endif>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Description</label>
                                            <textarea name="description" class="form-control" rows="5" disabled>{!! $category->description !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
