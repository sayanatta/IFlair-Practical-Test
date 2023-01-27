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
                            <a href="{{ route('categories.create') }}" class="btn btn-success btn-sm">Add</a>
                            <table class="table table-bordered" id="table_data">
                                <thead>
                                    <tr>
                                        <th>Name</th>
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
                    ajax: "{{ route('categories.index') }}",
                    columns: [{
                        data: 'category_name',
                        name: 'category_name'
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
