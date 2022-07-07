@extends('template.main')
@section('content')
<section class="container mt-5 bg-white p-4 rounded shadow d-flex">
    <img src="{{ asset('/storage/logo-sellers/' . $toko->logo) }}" style="object-fit: cover" width="200" height="200">
    <div class="ml-5 ">
        <h3 class="text-bold mb-3">{{ $toko->nama_toko }}</h3>

        <div class="text-bold d-flex" style="text-transform: capitalize">
            <i class="fa-solid fa-newspaper"></i>
            <div class="ml-3">
                {{ $toko->tentang}}
            </div>
        </div>
        <br>
        <div class="text-bold d-flex" style="text-transform: capitalize">
            <i class="fa-solid fa-map-location-dot"></i>
            <div class="ml-3">
                {{ $toko->alamat_toko }}, {{ strtolower($toko->kelurahan) }}, {{ strtolower($toko->kecamatan) }},
                {{ strtolower($toko->kota) }} ({{ $toko->kode_pos }})
            </div>
        </div>
        <br>
        <div class="text-bold d-flex" style="text-transform: capitalize">
            <i class="fa-solid fa-phone"></i>
            <div class="ml-3">
                {{ $toko->no_telp_toko }}
            </div>
        </div> <br>
        <div class="text-bold d-flex" style="text-transform: capitalize">
            <i class="fa-solid fa-envelope"></i>
            <div class="ml-3">
                {{ $toko->email}}
            </div>
        </div>
        <br>
    </div>
</section>
<section class="container bg-white p-4 rounded shadow mt-5 d-flex gap-4">
    @if (count($produk) == 0)
    <div class="text-center">
        <h3 class="text-bold">Toko ini belum memiliki produk</h3>
    </div>
    @else
    @foreach ($produk as $p)
    @if ($p->status != 'on' || $p->seller->is_ban == 1)
    @continue
    @endif
    <div class="card shadow" style="width: 15rem;">
        <img src="{{ asset('storage/produk-image/' . $p->thumnail) }}" alt="Picture 1" height="150">
        <div class="card-body " style="overflow: hidden">
            <span class="d-block" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{ $p->nama }}</span>
            <a href="{{ route('toko', ['toko' => $p->seller_id]) }}" class="text-bold mb-4 d-block">{{ $p->seller->nama_toko }}</a>

            <?php $price = []; ?>
            @foreach ($p->priceproduk as $pc)
            @if ($pc->status == 'on')
            <?php $price[] = $pc->harga; ?>
            @endif
            @endforeach
            <span class="fw-bold">{{ rupiah(end($price)) }}
                @if (count($price) > 1)
                - {{ rupiah($price[0]) }}
                @endif
            </span>
            <br>
            <i class="fa-solid fa-bags-shopping text-green"></i> Terjual {{count($p->checkout)}}
            <br>
            <i class="fa-solid fa-map-pin text-red"></i> Banyuwangi, Kalipuro
            <br>
            <div class="d-grid">
                <a href="{{ route('produk-detail', ['produk' => $p->id]) }}" class="btn mt-3 btn-outline-success fw-bold">Order</a>
            </div>
        </div>
    </div>
    @endforeach
    @endif

</section>
@endsection