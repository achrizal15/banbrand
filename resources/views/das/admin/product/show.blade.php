@extends('template.das.admin.main')
@section('content')
<section class="container ">
    <div class="row">
        <div class="col-lg-7">
            <div class="card mb-3 shadow">
                <img src="{{ asset('storage/produk-image/' . $produk->thumnail) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-capitalize">{{ $produk->nama }}</h5>
                    <p class="card-text"><small class="text-muted">Created At {{ $produk->created_at }}</small>
                    </p>
                    <p class="card-text">
                        {!! $produk->deskripsi !!}
                    </p>
                    <div class="d-flex">
                        <img src="{{ asset('storage/logo-sellers/' . $produk->seller->logo) }}"
                            class="rounded-circle bg-info bg-gradient"
                            style="width: 100px;overflow:hidden;height:100px;object-fit:cover">
                        <div class="ml-3 mt-2 ">
                            <h5 class="card-title text-capitalize text-bold"
                                onclick="window.location='{{ route('admin.sellers.show', $produk->seller->id) }}'"
                                style="cursor: pointer;">{{ $produk->seller->nama_toko }}</h5></a>
                            <p class="card-text"><small
                                    class="text-muted">{{ $produk->seller->alamat }}</small>
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                        @php
                            $width = 100 / count($produk->priceproduk);
                        @endphp
                        @foreach ($produk->priceproduk as $m)
                            <li class="nav-item" role="presentation" style="width:{{ $width }}%">
                                <button
                                    class="nav-link text-bold text-uppercase @if ($loop->iteration == 1) active @endif"
                                    id="li{{ $m->id }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#li{{ $m->id }}"
                                    type="button"
                                    style="width: 100%"
                                    role="tab" aria-controls="{{ $m->nama }}"
                                    aria-selected="true">{{ $m->nama }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body tab-content position-relative">
                    {{ request()->get('nama') }}
                    @foreach ($produk->priceproduk as $m)
                        <div class="tab-pane fade @if ($loop->iteration == 1) active show @endif"
                            id="li{{ $m->id }}" role="tabpanel" aria-labelledby="li{{ $m->id }}-tab">
                            <div class="d-flex flex-column">
                                <h3 class="text-end text-bold"> {{ rupiah($m->harga) }}</h3>
                                @if (count($m->produkgaleries) > 0)
                                    <h5 class="text-start text-bold">Galeri Desain</h5>
                                    <div class="d-flex  gap-1 flex-wrap mb-3">
                                        @foreach ($m->produkgaleries as $g)
                                            <img src="{{ asset('storage/produk-image/' . $g->nama) }}" alt=""
                                                width="98">
                                        @endforeach
                                    </div>
                                @endif
                                <div>{!! $m->deskripsi !!}</div>
                                {{ request()->get('nama') }}
                                @if (strtolower($m->nama) == 'custom')
                                    Rekomendasi pembuatan desain:
                                    <a href="http://banbrand.test/produk-detail/5?nama=rendi">Tols Editor</a>
                                @endif
                           
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


</section>
@endsection
