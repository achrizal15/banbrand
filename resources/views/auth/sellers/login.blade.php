@extends('template.main')
@section('content')
    <div class="container justify-content-center d-flex">
        <div class="col-md-6 ">
            <div class="card mt-5">
                <form action="{{ $url }}" method="POST" novalidate class="form-ajax needs-validation">
                    @csrf
                    @method("post")
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-at"></i></span>
                                <input type="text" name="email" class="form-control" id="formGroupExampleInput">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Password</label>
                            <div class="input-group">
                                <label for="pass" class="input-group-text"><i class="fa-solid fa-key"></i></label>
                                <input type="password" name="password" class="form-control" id="pass">
                            </div>
                            @if ($type=='seller')
                            <div class="text-end">
                                <a href="{{ route('register', 'sellers') }}">Register</a>
                            </div>      
                            @endif
                        </div>
                        <button class="btn btn-primary">Login</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
