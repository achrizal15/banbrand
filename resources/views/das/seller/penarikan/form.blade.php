@extends('template.das.seller.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-ajax needs-validation" novalidate action="{{ $url }}"
                            method="POST">
                            @csrf
                            @if (isset($produk))
                                @method('PUT')
                            @endif

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama"
                                    value="@isset($produk) {{ $produk->nama }} @endisset"
                                    class="form-control" required>
                            </div>
                            <input type="text" hidden name="seller_id" value="{{ $user->id }}">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <select id="select-kategori"
                                    data-parsley-errors-container="#kategori-errors"
                                    data-parsley-group="block-2" class="form-control select2"
                                    style="width: 100%;" required name="category_id">
                                    <option selected value="" disabled>Pilih Satu</option>
                                    @foreach ($kategoris as $k)
                                        @isset($produk)
                                            @if ($produk->category_id == $k->id)
                                                <option value="{{ $k->id }}" selected>{{ $k->nama }}</option>
                                            @else
                                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                        @endisset
                                    @endforeach
                                </select>
                                <span id="kategori-errors"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Deskripsi & Persyaratan</label>
                                <textarea id="summernote" name="deskripsi"
                                    rows="10">
                                @isset($produk)
{{ $produk->deskripsi }}
@endisset
                                </textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thumnail</label>
                                @isset($produk)
                                <input type="hidden" name="thumnail-edit" id="dropify-thumnail-edit"
                                    value="{{ $produk->thumnail }} ">@endisset
                                <input type="file" class="dropify"
                                    name="thumnail"
                                    @isset($produk) data-default-file="{{ asset("storage/produk-image/$produk->thumnail") }}" @endisset />
                            </div>

                            <div class="col-md-6 mb-3">
                                <input type="checkbox" name="status"
                                    @isset($produk) @if ($produk->status == 'on') checked @endif
                                @else
                                checked @endisset
                                data-bootstrap-switch data-off-color="danger"
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
