@extends('layout.layout')
@section('section')
    <div class="row">
        <div class="col-md-3">
            <p>Users</p>
            <span>{{ $users }}</span>
        </div>
    </div>
    @push('scripts')
    @endpush
@endsection
