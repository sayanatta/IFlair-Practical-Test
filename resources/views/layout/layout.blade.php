<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Practical Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .row .col-md-3 {
            padding: 15px;
            border: 2px solid #000;
            border-radius: 5px;
            margin-right: 5px;
        }
    </style>
</head>

<body class="container">
    <section>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Practical Test</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('signin') }}">Sign in</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('signup') }}">Sign up</a>
                            </li>
                        @endif
                    </ul>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex">
                        @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">{{ Auth::user()->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-success" href="{{ route('logout') }}">Logout</a>
                            </li>
                        @endif
                    </ul>

                </div>
            </div>
        </nav>
    </section>

    <!-- DELETE MODAL START -->
    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" id="confirm_del" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Parmanently</h4>
                    </div>
                    <div class="modal-body text-center">
                        <p>Are you sure about this ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- DELETE MODAL END -->
    @yield('section')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        function getDeleteRoute($route) {
            // console.log($route);
            $("#confirm_del").attr("action", $route);
            $("#confirmDelete").modal("show");
        }
    </script>
    @stack('scripts')
</body>

</html>
