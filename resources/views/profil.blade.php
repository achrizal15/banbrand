@extends('template.main')
@section('content')
    <div class="row mt-5">
        <div class="col-md-3 pr-3">
            <div class="float-end">
                <div class="border-bottom pb-3">
                    <img class="rounded" width="50" src="{{ asset('/storage/images-customer/default.png') }}">
                    <span class="align-middle text-bold">{{ $user->nama }}</span>
                </div>
                <div class="d-flex mt-3">
                    <i class="fa-solid fa-clipboard-list text-info text-lg"></i>
                    <a href="{{ route('detail_pembayaran.index') }}" class="pt-1"><span
                            class="pt-1 text-bold ml-2 text-dark">Pesanan</span></a>
                </div>
                <div class="d-flex mt-3">
                    @php
                        $belum_dibaca = $notif
                            ->filter(function ($item) {
                                return $item->dibaca == false;
                            })
                            ->count();
                    @endphp
                    @if ($belum_dibaca > 0)
                        <i class="fa-solid fa-bell-on text-lg text-success"></i>
                    @else
                        <i class="fa-solid fa-bell text-lg"></i>
                    @endif
                    <a href="{{ route('customer.notifikasi') }}" class="pt-1">
                        <span class="pt-1 text-bold ml-2 text-dark">Notifikasi
                            @if ($belum_dibaca > 0)
                                <small class="badge badge-pill badge-success">{{ $belum_dibaca }}</small>
                            @endif
                        </span>
                    </a>
                </div>
                <div class="d-flex mt-3">
                    <i class="fa-solid fa-user text-lg text-yellow"></i>
                    <a href="{{ route('customer.edit') }}" class="pt-1"><span
                            class="pt-1 text-bold ml-2 text-dark">Profil</span></a>
                </div>
                <div class="d-flex mt-3">
                    <i class="fa-solid fa-right-from-bracket text-lg text-danger"></i>
                    <a href="{{ route('logOut', 'customers') }}" class="pt-1"><span
                            class="pt-1 text-bold ml-2 text-dark">Logout</span></a>
                </div>
            </div><br>
        </div>

        <div class="col-md-9 px-5">
            <div class="card">
                <div class="card-body">
                    <form class="form-ajax" action="{{ route("customer.update",$user->id) }}" method="POST">
                        @csrf @method("PUT")
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama" value="{{ $user->nama }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input type="text" name="password" placeholder="Isikan password baru jika ingin merubah"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" disabled value="{{ $user->email }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">alamat</label>
                                <input type="text" name="alamat" value="{{ $user->alamat }}" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success">UPDATE</button>
                </form>
                </div>
            </div>

        </div>
    </div>
@endsection
