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
                    <a href="" class="pt-1">
                        <span class="pt-1 text-bold ml-2 text-dark">Notifikasi
                        @if ($belum_dibaca > 0)
                            <small class="badge badge-pill badge-success">{{ $belum_dibaca }}</small>                            
                        @endif
                        </span>
                    </a>
                </div>
                <div class="d-flex mt-3">
                    <i class="fa-solid fa-right-from-bracket text-lg text-danger"></i>
                    <a href="{{ route('logOut', 'customers') }}" class="pt-1"><span
                            class="pt-1 text-bold ml-2 text-dark">Logout</span></a>
                </div>
            </div><br>
        </div>

        <div class="col-md-9 px-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            Notification
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notif as $item)
                        <tr>
                            <td class="d-flex justify-content-between">
                                <div>
                                    <label class="form-check-label"
                                        for="{{ 'notif' . $item->id }}">{{ $item->pesan }}</label>
                                </div>
                                <div class="d-flex ">
                                    @if ($item->dibaca == false)
                                        <form method="POST" action="{{ route('customer.notifikasi.dibaca', $item->id) }}"
                                            style="display: inline;" class="mr-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="dibaca" value="true">
                                            <button type="submit" class="btn btn-sm btn-outline-success">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <form method="post" action="{{ route('customer.notifikasi.hapuse',$item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
