@extends("template.das.admin.main")
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-ajax needs-validation" novalidate action="{{ $url }}" method="POST">
                        @csrf
                        @if (isset($user))
                        @method('PUT')
                        @endif
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" value="@isset($user) {{ $user->name }} @endisset" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"  name="email" value="@isset($user) {{ $user->email }} @endisset" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password @isset($user) <small>Isikan password baru jika ingin merubah.</small> @endisset</label>
                            <input type="password" name="password" class="form-control" @if(!isset($user)) required @endif>
                        </div>
                        <div class="col-md-6 mb-3 mt-5">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">BACK</a>
                            <button type="submit" class="btn btn-primary bg-gradient">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection