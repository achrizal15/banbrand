@extends("template.das.seller.main")
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-ajax needs-validation" novalidate action="{{ $url }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($price))
                                @method('PUT')
                            @endif

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama"
                                    @isset($price) @if ($price->nama == 'Custom')
                                    readOnly @endif
                                @endisset

                                value="@isset($price) {{ $price->nama }} @endisset"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input value="@isset($price) {{ $price->harga }} @endisset"
                                    class="form-control input-number-only" name="harga">
                            </div>
                        </div>
                        <input type="text" hidden name="produk_id" value="{{ $produk->id }}">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deskripsi & Persyaratan</label>
                            <textarea id="summernote" name="deskripsi"
                                rows="10">
                                @isset($price) {{ $price->deskripsi }} @endisset
                                </textarea>
                        </div>

                        <label class="form-label"
                            @isset($price) @if ($price->nama == 'Custom')
                                hidden @endif
                        @endisset>Galery</label>
                    <div class="col-md-6 mb-3 border p-2 d-flex"
                    style="visibility: @isset($price) @if ($price->nama == 'Custom')
                    hidden @else visible @endif
                @endisset"
                        >
                    <div class="add-multiple-images">
                        <i class="fas fa-plus" style="height: full;width:full"></i>
                    </div>
                    @isset($price)
                        @foreach ($price->produkgaleries as $galeri)
                            <div class="upload-group">
                                <button type="button" data-id="{{ $galeri->id }}" id="delete-multi-upload"
                                    class="close">x</button>
                                <input type="file" class="dropify upload-multiple"
                                    data-default-file="{{ asset("storage/produk-image/$galeri->nama") }}"
                                    name="galerys[]" placeholder="x" />
                                <input type="text" name="old_image[]" value="{{ $galeri->nama }}" hidden>
                            </div>
                        @endforeach
                    @endisset
                </div>

                <div class="col-md-6 mb-3">
                    <input type="checkbox" name="status"
                        @isset($price) @if ($price->status == 'on') checked @endif
                    @else
                        checked
                    @endisset data-bootstrap-switch data-off-color="danger"
                    data-on-color="success">
            </div>
            <div class="col-md-6 mb-3 mt-5">
                <a href="{{ url()->previous() }}" class="btn btn-danger">BACK</a>
                <button type="submit"
                    class="btn btn-primary bg-gradient">SUBMIT</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</section>
@endsection
