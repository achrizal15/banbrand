@extends('template.main')
@section('content')
    <form action="">
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
                        <input type="text" class="form-control text-bold" value="Rizal 0812188271" readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Contak Darurat</label>
                        <input type="text" class="form-control text-bold" placeholder="081xxxx" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control text-bold" value="Jln.Cut nyak dien" required>
                    </div>
                </div>

            </div>
        </section>
        <section class="container mt-1 card">
            <div class="card-header text-gray">
                <h5>
                    <i class="fa-solid fa-folder-image"></i>
                    Desain
                </h5>
            </div>
            <div class="card-body">
                
            </div>
        </section>
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
                            jadikan file zip dan di upload ke server kami. <a href="#" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Lihat persyaratan.
                            </a></b> </p>
                </article>
                <div class="col-md-5">
                    <input type="file" name="persyaratan" class="dropify">
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
