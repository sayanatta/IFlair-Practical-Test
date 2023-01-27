@extends('layout.layout')
@section('section')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <a href="{{ route('products.create') }}" class="btn btn-success btn-sm">Add</a>
                            <table class="table table-bordered" id="table_data">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            $(function() {
                $('#table_data').DataTable({
                    processing: true,
                    responsive: true,
                    serverSide: true,
                    ordering: false,
                    ajax: "{{ route('products.index') }}",
                    columns: [{
                        data: 'image',
                        name: 'image'
                    }, {
                        data: 'product_name',
                        name: 'product_name'
                    }, {
                        data: 'category',
                        name: 'category'
                    }, {
                        data: 'status',
                        name: 'status'
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }, ]
                });
            });
        </script>
    @endpush
@endsection
