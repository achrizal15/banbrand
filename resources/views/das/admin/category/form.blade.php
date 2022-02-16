@extends("template.das.main")
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-ajax needs-validation" action="{{ $url }}"
                            method="POST">
                            @csrf
                            @if (isset($category))
                                @method('PUT')
                            @endif
                            <div class="col-md-5 mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" name="nama"
                                    value="@isset($category) {{ $category->nama }} @endisset"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" id="" cols="10" rows="2">@isset($category) {{ $category->deskripsi }} @endisset</textarea>
                            </div>
                            <div class="col-md-5 mb-3">
                                <input type="checkbox" name="status"
                                    @isset($category) @if ($category->status == 'on') checked @endif
                                @endisset data-bootstrap-switch data-off-color="danger"
                                data-on-color="success">
                        </div>
                        <div class="col-md-5 mb-3">
                           <a href="{{ url()->previous() }}" class="btn btn-danger">BACK</a>
                           <button type="submit"
                                class="btn btn-primary bg-gradient">SUBMIT</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
