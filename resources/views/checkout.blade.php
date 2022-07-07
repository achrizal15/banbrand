@extends('template.main')
@section('content')
<form enctype="multipart/form-data" class="form-ajax needs-validation" action="{{ route('checkout.store') }}" id="form-checkout-page" method="POST">
    @csrf
    <section class="container mt-5 card">
        <div class="card-header text-gray">
            <h5>
                <i class="fa-solid fa-map-location-dot"></i>
                Location
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">

                    <label class="form-label">Customer</label>
                    <input type="text" class="form-control text-bold" value="{{ $user->nama }}" readonly>
                    <input type="text" hidden name="customer_id" value="{{ $user->id }}">
                    <input type="hidden" name="seller_id" value="{{ $produk->seller->id }}">
                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                    <input type="hidden" name="price_id" value="{{ $price->id }}">
                    <input type="hidden" name="no_transaksi" value=" {{ 'TR' . date('Ymdhis') }}">

                </div>
                <div class="col-md-2">
                    <label class="form-label">Kontak Darurat</label>
                    <input type="text" name="kontakdarurat" class="form-control text-bold" placeholder="081xxxx" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-control text-bold" name="alamat" value="{{ $user->alamat }}" required>
                </div>
            </div>

        </div>
    </section>
    @if (strtolower($price->nama) != 'custom')
    <section class="container mt-1 card">
        <div class="card-header text-gray">
            <h5>
                <i class="fa-solid fa-folder-image"></i>
                Desain
            </h5>
        </div>
        <div class="card-body">
            <div class="d-flex gap-3 mt-2">
                @foreach ($price->produkgaleries as $galeri)
                <div class="form-check ">
                    <input class="form-check-input" type="radio" value="{{ $galeri->id }}" name="galery_id" id="{{ $galeri->nama }}" required>
                    <label class="form-check-label" for="{{ $galeri->nama }}">
                        <img src="{{ asset('storage/produk-image/' . $galeri->nama) }}" alt="{{ $galeri->nama }}" width="100">
                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="container mt-1 card">
        <div class="card-header text-gray">
            <h5>
                <i class="fa-solid fa-file-zipper"></i>
                Persyaratan Berkas
            </h5>
        </div>
        <div class="card-body">
            <article>
                <b>Perhatian!</b>
                <p> <i class="fa-solid fa-exclamation-circle"></i> <b>Berkas yang dibutuhkan untuk order harap di
                        jadikan file zip dan di upload ke server kami. <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Lihat persyaratan.
                        </a></b> </p>
            </article>
            <div class="col-md-5">
                <input type="file" name="file" class="dropify" required data-allowed-file-extensions="zip rar" accept=".rar,.zip">
            </div>

            <div class="col-md-5 mt-3">
                <label class="form-label">Qty</label>
                <input class="form-control input-number-only" name="qty" placeholder="1" min='1' id="qty" type="number" required value="1" />
            </div>
            <div class="col-md-5 mt-3">
                <label class="form-label">Pesan</label>
                <input class="form-control" name="pesan" placeholder="(Opsional) Tinggalkan pesan ke penjual" />
            </div>
        </div>
    </section>
    <section class="container mt-1 card">
        <div class="card-header text-gray">
            <h5>
                <i class="fa-solid fa-credit-card"></i>
                Pembayaran
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                    Opsi Pengiriman
                    <div class="form-check">
                        <input required class="form-check-input" type="radio" name="pengiriman" id="deliver" value="DELIVERY" checked>
                        <label class="form-check-label" for="deliver">
                            <b>DELIVERY</b>
                        </label>
                    </div>
                    <div class="form-check">
                        <input required class="form-check-input" type="radio" name="pengiriman" id="take" value="TAKE">
                        <label class="form-check-label" for="take">
                            <b>TAKE</b>
                            <p>
                                <i class="fa-solid fa-map-marker-alt"></i>
                                <b> {{ $produk->seller->alamat_toko }},
                                    {{ strtolower($produk->seller->kelurahan) }},
                                    {{ strtolower($produk->seller->kecamatan) }},
                                    {{ strtolower($produk->seller->kota) }} ({{ $produk->seller->kode_pos }})</b>
                            </p>
                        </label>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="d-flex justify-content-between text-lg text-bold">
                        <span>Harga :</span>
                        <span id="label-harga">{{ rupiah($price->harga) }}</span>
                        <input type="text" name="harga" hidden value="{{ $price->harga }}">
                    </div>
                    <div class="d-flex justify-content-between text-lg text-bold">
                        <span>Ongkir :</span>
                        <span id="label-ongkir">{{ rupiah($setting->harga_ongkir) }}
                        </span>
                        <input type="text" name="ongkir" value="{{ $setting->harga_ongkir }}" hidden>
                    </div>
                    <div class="d-flex justify-content-between text-lg text-bold">
                        @php
                        $kodetransaksi = date('d');
                        @endphp
                        <span>Kode Transaksi : </span>
                        <span>{{ rupiah($kodetransaksi) }}</span>
                        <input type="text" name="kodetransfer" value="{{ $kodetransaksi }}" hidden>
                    </div>
                    <div class="d-flex justify-content-between text-lg text-bold">
                        <span>Total :</span>
                        <span class="text-primary" id="label-total">{{ rupiah($price->harga + $kodetransaksi + 10000) }}</span>
                        <input type="text" name="total" value="{{ $price->harga + $kodetransaksi + 10000 }}" hidden>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <span class="align-bottom">Dengan melanjutkan, Saya setuju dengan Syarat & Ketentuan yang
                    berlaku.</span>
                <button type="submit" class="btn btn-primary text-bold">
                    Buat Pesanan
                </button>
            </div>
        </div>
    </section>
</form>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                {!! $price->deskripsi !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection