@extends('layout.layout')
@section('section')
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
    <div class="row">
        <div class="col-md-3">
            <p>Categories</p>
            <span>{{ $categories }}</span>
        </div>
        <div class="col-md-3">
            <p>Products</p>
            <span>{{ $products }}</span>
        </div>
    </div>
    @push('scripts')
    @endpush
@endsection
