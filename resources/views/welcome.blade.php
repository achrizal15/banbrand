@extends('template.main')
@section('content')
<section class="container mt-5 bg-white p-4 rounded d-flex flex-wrap gap-4 justify-content-center">
    @foreach ($produk as $p)
    @if ($p->status != 'on' || $p->seller->is_ban == 1||count($p->priceproduk)<1) @continue @endif <div class="card shadow" style="width: 15rem;">
        <img src="{{ asset('storage/produk-image/' . $p->thumnail) }}" alt="Picture 1" height="150">
        <div class="card-body " style="overflow: hidden">
            <span class="d-block" style="white-space: nowrap;overflow: hidden;
                                        text-overflow: ellipsis;">{{ $p->nama }}</span>
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
            <i class="fa-solid fa-map-pin text-red"></i>  {{ $p->seller->kelurahan }}
            <br>
            <div class="d-grid">
                <a href="{{ route('produk-detail', ['produk' => $p->id]) }}" class="btn mt-3 btn-outline-success fw-bold">Order</a>
            </div>



        </div>
        </div>
        @endforeach
</section>
@endsection