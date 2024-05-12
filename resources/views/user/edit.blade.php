<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Customer    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        textarea {
            resize: none;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('userslist') }}">Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/user') }}">Export</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('user/import') }}">Import</a>
                    </li>

                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Customer Edit </h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('user.update', $users->id) }}" method="POST"
                            enctype="multipart/form-data" id="FormID">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="col-md-10 offset-1">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control name" placeholder="Enter Name"
                                        value="{{ $users->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter Email"
                                        value="{{ $users->email }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Mobile</label>
                                    <input type="text" name="mobile" class="form-control num" placeholder="Enter Mobile"
                                    minlength="10" maxlength="10" value="{{ $users->mobile }}">
                                </div>

                                <div class="mb-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="address" placeholder="Leave a address here">{{ $users->address }}</textarea>
                                        <label for="floatingTextarea">Address</label>
                                    </div>
                                </div>

                                <div class="offset-md-5 col-md-10">
                                    <button type="submit" class="dis btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary"
                                        onclick="javascript:history.back()">Cancel</button>
                                </div>
                            </div>

                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
<script>
    $(function() {
        $("#FormID").validate({
            rules: {
                'name': {
                    required: true
                },
                'email': {
                    required: true
                },
                'mobile': {
                    required: true
                },
                'address': {
                    required: true
                }
            },

            messages: {
                'name': {
                    required: "Enter Name"
                },
                'email': {
                    required: "Enter Email"
                },
                'mobile': {
                    required: "Select Mobile"
                },
                'address': {
                    required: "Enter Address"
                }

            },
            submitHandler: function(form) {
                form.submit();
                $(".dis").prop('disabled', true);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).on("input", ".name", function() {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
    });
    $(document).on("input", ".num", function() {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });
    $(document).on("input", ".alphanumeric", function() {
        this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '');
    });
</script>
