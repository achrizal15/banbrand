@extends('template.main')
@section('content')
    <section class="container mt-5 card">

        <div class="card-body">
            <h3 class="text-center">{{ $checkout->no_transaksi }}</h3>
            <hr>
            <div class="d-flex justify-content-between border-bottom mx-auto col-md-5 py-3 text-md text-bold">
                <span>Total Pembayaran</span>
                <span class="text-primary">{{ rupiah($checkout->total) }}</span>
            </div>
            <div class="d-flex justify-content-between border-bottom mx-auto col-md-5 py-3 text-md text-bold">
                <span>Pembayaran Dalam</span>
                <span class="text-primary" id="countdown"
                    data-time="{{ $checkout->expired_at }}">{{ $checkout->expired_at }}</span>
            </div>
            <div class="mx-auto col-md-5">
                <div class="d-flex text-md text-bold py-3 justify-content-between border-bottom collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne"
                    aria-expanded="false"
                    aria-controls="flush-collapseOne">
                    <span>Petunjuk Transfer</span>
                    <i class="fas fa-chevron-down"></i>
                </div>

                <div class="accordion-item" style="border:none !important;">
                    <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul>
                                <li>Transfer ke rekening BCA</li>
                                <li>Nomor Rekening : 0987654321</li>
                                <li>Atas Nama : PT. Banbran Abadi</li>
                                <li>Simpan bukti transfer</li>
                                <li>Foto bukti transfer</li>
                                <li>Upload gambar pada form dibawah ini</li>
                                <li>Selesai</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <form action="{{ route('checkout.bayar', $checkout->id) }}" class="form-ajax needs-validation" method="post" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <div class="mx-auto col-md-5 py-3">

                    <input type="file" name="docx" class="dropify" accept="image/png, image/jpeg"  required>
                </div>
                <div class="mx-auto col-md-5 py-3">
                    <button type="submit" class="btn btn-primary btn-block text-bold">Konfirmasi Pembayaran</button>
                </div>
            </form>
        </div>
        </div>
    </section>
@endsection
