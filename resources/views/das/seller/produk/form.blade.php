@extends("template.das.admin.main")
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
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea id="summernote" name="deskripsi"
                                    rows="10">@isset($produk) {{ $produk->deskripsi }} @endisset</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="checkbox" name="status"
                                    @isset($produk) @if ($produk->status == 'on') checked @endif
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
