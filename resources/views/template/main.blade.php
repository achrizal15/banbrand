<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- meta token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title : 'BANBRAND' }}</title>
    @include('template.head_include')
</head>

<body class="bg-light font-family-nunito-sans">
    <div class="loader">
        <i class="fas fa-spinner fa-spin loader-icon"></i>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient py-3 sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">BANBRAND</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse fs-6 fw-bold" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('login', 'sellers') }}">Become a Seller</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Help
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">How to Work</a></li>
                            <li><a class="dropdown-item" href="#">How to Order</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Banbrand</a>
                    </li> --}}
                </ul>
                @php
                    $customer = auth()
                        ->guard('customers')
                        ->user();
                @endphp
                @if(!$customer)
                <div class="d-lg-flex">
                    <a href="" class="nav-link link-light" data-bs-toggle="modal"
                        data-bs-target="#loginModal">LOGIN</a>
                    <a href="" type="button" class="btn btn-outline-light fw-bold" data-bs-toggle="modal"
                        data-bs-target="#registerModal">SIGN UP</a>
                </div>
                @else
                <div class="d-lg-flex">
                    <a href="{{ route('detail_pembayaran.index') }}" class="nav-link link-light">
                        <i class="fa-solid fa-user-crown"></i>
                        {{ strtoupper($customer->nama) }}</a>
                </div>
                @endif
            </div>
        </div>
    </nav>
    {{-- <section class="section-sub-nav shadow">
        <nav class="nav container-fluid sub-nav">
            @foreach ($kategori as $value)
                <a class="nav-link active" aria-current="page" href="#">{{ $value->nama }}</a>
            @endforeach
        </nav>
    </section> --}}
    <section class="banner-img">
        <div class=" ">
            <div class="container-fluid">
                <h1 class="display-4 pt-3 text-center font-family-cormorant-garamond">
                    {{ isset($subtitle) ? strtoupper($subtitle) : 'Jasa Cetak Stiker, Banner, Kartu Nama Banyuwangi' }}</h1>
            </div>
        </div>
    </section>
    <!-- Button trigger modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">LOGIN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form novalidate class="form-ajax needs-validation"
                    action="{{ route('loginAuth', ['params' => 'customer']) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input required type="password" class="form-control" id="password" name="password"
                                placeholder="Enter password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">REGISTER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form novalidate class="form-ajax needs-validation"
                    action="{{ route('createaccount', ['params' => 'customer']) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="nama" placeholder="Enter name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" required class="form-control" id="phone" name="phone"
                                placeholder="Enter phone">
                        </div>
                        <div class="form-group">
                            <label for="Alamat">Alamat</label>
                            <input type="text" class="form-control" id="Alamat" name="alamat"
                                placeholder="Jln.Ikan Mas" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input required type="password" class="form-control" id="passwordreg" name="password"
                                placeholder="Enter password">
                        </div>
                        {{-- <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input required type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" data-parsley-equalTo="#passwordreg"
                                placeholder="Enter password">
                        </div> --}}

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @yield("content")
    @include('template.footer_include')

</body>

</html>
