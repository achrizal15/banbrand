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
            <div class="py-3">
                <ul class="nav nav-tabs nav-pembayaran" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active text-bold" id="Semua-tab" data-bs-toggle="tab"
                            data-bs-target="#Semua"
                            type="button" role="tab" aria-controls="Semua" aria-selected="true">Semua</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-bold" id="BelumBayar-tab" data-bs-toggle="tab"
                            data-bs-target="#BelumBayar"
                            type="button" role="tab" aria-controls="BelumBayar" aria-selected="true">Belum
                            Bayar</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-bold" id="Proses-tab" data-bs-toggle="tab" data-bs-target="#Proses"
                            type="button" role="tab" aria-controls="Proses" aria-selected="true">Proses</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-bold" id="Selesai-tab" data-bs-toggle="tab"
                            data-bs-target="#Selesai"
                            type="button" role="tab" aria-controls="Selesai" aria-selected="true">Selesai</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-bold" id="Batal-tab" data-bs-toggle="tab" data-bs-target="#Batal"
                            type="button" role="tab" aria-controls="Batal" aria-selected="true">Batal</button>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Semua" role="tabpanel" aria-labelledby="Semua-tab">
                    @foreach ($pesanan as $p)
                        <div class="card p-3">
                            <div class="border-bottom pb-2 d-flex justify-content-between">
                                <div> <a href="{{ route('toko', $p->seller->id) }}" class="text-dark"><i
                                            class="fa-solid fa-shop"></i>
                                        <span class="text-bold ml-2"> {{ $p->seller->nama_toko }}</span></a>
                                </div>
                                <div class="border-left pl-2">
                                    <span class="text-bold">{{ $p->status }}</span>
                                </div>
                            </div>
                            <div class="mt-2 d-flex border-bottom pb-2 justify-content-between">
                                <div class="d-flex">
                                    <img width="148" height="148"
                                        src="{{ asset('storage/produk-image/' . $p->produk->thumnail) }}">
                                    <div class="ml-3">
                                        <div class="text-bold">{{ $p->produk->nama }}</div>
                                        {{-- catatan --}}
                                        <div class="text-muted">{{ $p->price_product->nama }}</div>
                                    </div>
                                </div>
                                <div class="text-end d-flex align-items-center text-bold">
                                    {{ rupiah($p->total) }}
                                </div>
                            </div>
                            <div class="mt-2 d-flex justify-content-between">
                                <div>
                                    <div class="text-muted">Catatan : {{ $p->pesan }}</div>
                                    <div class="text-bold">
                                        <i class="fa-solid fa-calendar-alt"></i>
                                        <span class="ml-2">{{ $p->created_at }}</span>
                                    </div>
                                </div>
                                <div class="text-end">

                                    @if (strtolower($p->status) == 'belum dibayar')
                                        <a href="{{ route('customer.batal.pesanan', $p->id) }}"
                                            class="btn btn-primary">
                                            Batalkan Pesanan
                                        </a>
                                        @if ($p->expired_at > now())
                                            <a href="{{ route('pembayaran', $p->id) }}" class="btn btn-primary">
                                                Bayar
                                            </a>
                                        @endif
                                    @endif

                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="BelumBayar" role="tabpanel" aria-labelledby="BelumBayar-tab">
                    @foreach ($pesanan as $p)
                        @if (strtolower($p->status) != 'belum dibayar')
                            @continue
                        @endif
                        <div class="card p-3">
                            <div class="border-bottom pb-2 d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('toko', $p->seller->id) }}" class="text-dark"><i
                                            class="fa-solid fa-shop"></i>
                                        <span class="text-bold ml-2"> {{ $p->seller->nama_toko }}</span></a>
                                </div>
                                <div class="border-left pl-2">
                                    <span class="text-bold">{{ $p->status }}</span>
                                </div>
                            </div>
                            <div class="mt-2 d-flex border-bottom pb-2 justify-content-between">
                                <div class="d-flex">
                                    <img width="148" height="148"
                                        src="{{ asset('storage/produk-image/' . $p->produk->thumnail) }}">
                                    <div class="ml-3">
                                        <div class="text-bold">{{ $p->produk->nama }}</div>
                                        {{-- catatan --}}
                                        <div class="text-muted">{{ $p->price_product->nama }}</div>
                                    </div>
                                </div>
                                <div class="text-end d-flex align-items-center text-bold">
                                    {{ rupiah($p->total) }}
                                </div>
                            </div>
                            <div class="mt-2 d-flex justify-content-between">
                                <div>
                                    <div class="text-muted">Catatan : {{ $p->pesan }}</div>
                                    <div class="text-bold">
                                        <i class="fa-solid fa-calendar-alt"></i>
                                        <span class="ml-2">{{ $p->created_at }}</span>
                                    </div>
                                </div>
                                <div class="text-end">

                                    @if (strtolower($p->status) == 'belum dibayar')
                                        <a href="{{ route('customer.batal.pesanan', $p->id) }}"
                                            class="btn btn-primary">
                                            Batalkan Pesanan
                                        </a>
                                        @if ($p->expired_at > now())
                                            <a href="{{ route('pembayaran', $p->id) }}" class="btn btn-primary">
                                                Bayar
                                            </a>
                                        @endif
                                    @endif

                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="Proses" role="tabpanel" aria-labelledby="Proses-tab">
                    @foreach ($pesanan as $p)
                        @if (strtolower($p->status) != 'proses')
                            @continue
                        @endif
                        <div class="card p-3">
                            <div class="border-bottom pb-2 d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('toko', $p->seller->id) }}" class="text-dark"><i
                                            class="fa-solid fa-shop"></i>
                                        <span class="text-bold ml-2"> {{ $p->seller->nama_toko }}</span></a>
                                </div>
                                <div class="border-left pl-2">
                                    <span class="text-bold">{{ $p->status }}</span>
                                </div>
                            </div>
                            <div class="mt-2 d-flex border-bottom pb-2 justify-content-between">
                                <div class="d-flex">
                                    <img width="148" height="148"
                                        src="{{ asset('storage/produk-image/' . $p->produk->thumnail) }}">
                                    <div class="ml-3">
                                        <div class="text-bold">{{ $p->produk->nama }}</div>
                                        {{-- catatan --}}
                                        <div class="text-muted">{{ $p->price_product->nama }}</div>
                                    </div>
                                </div>
                                <div class="text-end d-flex align-items-center text-bold">
                                    {{ rupiah($p->total) }}
                                </div>
                            </div>
                            <div class="mt-2 d-flex justify-content-between">
                                <div>
                                    <div class="text-muted">Catatan : {{ $p->pesan }}</div>
                                    <div class="text-bold">
                                        <i class="fa-solid fa-calendar-alt"></i>
                                        <span class="ml-2">{{ $p->created_at }}</span>
                                    </div>
                                </div>
                                <div class="text-end">

                                    @if (strtolower($p->status) == 'belum dibayar')
                                        <a href="{{ route('customer.batal.pesanan', $p->id) }}"
                                            class="btn btn-primary">
                                            Batalkan Pesanan
                                        </a>
                                        @if ($p->expired_at > now())
                                            <a href="{{ route('pembayaran', $p->id) }}" class="btn btn-primary">
                                                Bayar
                                            </a>
                                        @endif
                                    @endif

                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="Selesai" role="tabpanel" aria-labelledby="Selesai-tab">
                    @foreach ($pesanan as $p)
                        @if (strtolower($p->status) != 'selesai')
                            @continue
                        @endif
                        <div class="card p-3">
                            <div class="border-bottom pb-2 d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('toko', $p->seller->id) }}" class="text-dark"><i
                                            class="fa-solid fa-shop"></i>
                                        <span class="text-bold ml-2"> {{ $p->seller->nama_toko }}</span></a>
                                </div>
                                <div class="border-left pl-2">
                                    <span class="text-bold">{{ $p->status }}</span>
                                </div>
                            </div>
                            <div class="mt-2 d-flex border-bottom pb-2 justify-content-between">
                                <div class="d-flex">
                                    <img width="148" height="148"
                                        src="{{ asset('storage/produk-image/' . $p->produk->thumnail) }}">
                                    <div class="ml-3">
                                        <div class="text-bold">{{ $p->produk->nama }}</div>
                                        {{-- catatan --}}
                                        <div class="text-muted">{{ $p->price_product->nama }}</div>
                                    </div>
                                </div>
                                <div class="text-end d-flex align-items-center text-bold">
                                    {{ rupiah($p->total) }}
                                </div>
                            </div>
                            <div class="mt-2 d-flex justify-content-between">
                                <div>
                                    <div class="text-muted">Catatan : {{ $p->pesan }}</div>
                                    <div class="text-bold">
                                        <i class="fa-solid fa-calendar-alt"></i>
                                        <span class="ml-2">{{ $p->created_at }}</span>
                                    </div>
                                </div>
                                <div class="text-end">

                                    @if (strtolower($p->status) == 'belum dibayar')
                                        <a href="{{ route('customer.batal.pesanan', $p->id) }}"
                                            class="btn btn-primary">
                                            Batalkan Pesanan
                                        </a>
                                        @if ($p->expired_at > now())
                                            <a href="{{ route('pembayaran', $p->id) }}" class="btn btn-primary">
                                                Bayar
                                            </a>
                                        @endif
                                    @endif

                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="Batal" role="tabpanel" aria-labelledby="Batal-tab">
                    @foreach ($pesanan as $p)
                        @if (strtolower($p->status) != 'batal')
                            @continue
                        @endif
                        <div class="card p-3">
                            <div class="border-bottom pb-2 d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('toko', $p->seller->id) }}" class="text-dark"><i
                                            class="fa-solid fa-shop"></i>
                                        <span class="text-bold ml-2"> {{ $p->seller->nama_toko }}</span></a>
                                </div>
                                <div class="border-left pl-2">
                                    <span class="text-bold">{{ $p->status }}</span>
                                </div>
                            </div>
                            <div class="mt-2 d-flex border-bottom pb-2 justify-content-between">
                                <div class="d-flex">
                                    <img width="148" height="148"
                                        src="{{ asset('storage/produk-image/' . $p->produk->thumnail) }}">
                                    <div class="ml-3">
                                        <div class="text-bold">{{ $p->produk->nama }}</div>
                                        {{-- catatan --}}
                                        <div class="text-muted">{{ $p->price_product->nama }}</div>
                                    </div>
                                </div>
                                <div class="text-end d-flex align-items-center text-bold">
                                    {{ rupiah($p->total) }}
                                </div>
                            </div>
                            <div class="mt-2 d-flex justify-content-between">
                                <div>
                                    <div class="text-muted">Catatan : {{ $p->pesan }}</div>
                                    <div class="text-bold">
                                        <i class="fa-solid fa-calendar-alt"></i>
                                        <span class="ml-2">{{ $p->created_at }}</span>
                                    </div>
                                </div>
                                <div class="text-end">

                                    @if (strtolower($p->status) == 'belum dibayar')
                                        <a href="{{ route('customer.batal.pesanan', $p->id) }}"
                                            class="btn btn-primary">
                                            Batalkan Pesanan
                                        </a>
                                        @if ($p->expired_at > now())
                                            <a href="{{ route('pembayaran', $p->id) }}" class="btn btn-primary">
                                                Bayar
                                            </a>
                                        @endif
                                    @endif

                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection
