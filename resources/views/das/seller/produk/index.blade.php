@extends('template.das.seller.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('sellers.product.create') }}" class="btn btn-primary">Tambah</a>
                        <table class="dataTable table table-bordered table-hover" id="table-category">
                            <thead>
                                <tr>
                                    <th width="60px" data-priority="1">THUMNAIL</th>
                                    <th data-priority="2">NAMA</th>
                                    <th class="text-nowrap" data-priority="2">KATEGORI</th>
                                    <th width="150px">PRICING</th>
                                    <th class="text-nowrap">STATUS</th>
                                    <th class="text-nowrap" data-priority="3">ACTION</th>
                                </tr>
                            </thead>
                            <tbody class="text-uppercase">
                                @foreach ($produks as $p)
                                    <tr>
                                        <td><img src="{{ asset('storage/produk-image/' . $p->thumnail) }}"
                                                alt="{{ $p->nama }}"
                                                width="100px"
                                                height="100px"></td>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->kategori ? $p->kategori->nama : '' }}</td>
                                        <td><a href="{{ route('product.price', ['product' => $p->id]) }}"
                                                class="btn btn-default btn-xs">ATUR HARGA</a></td>
                                        <td>{{ $p->status }}</td>
                                        <td class="text-nowrap text-center">
                                            <a href="{{ route('sellers.product.edit', ['product' => $p->id]) }}"
                                                class="btn btn-sm btn-warning"><i class="fas fa-pencil text-white"></i></a>
                                            <form id="form-delete-item" data-remove="true" data-refresh="true"
                                                class="d-inline"
                                                action="{{ route('sellers.product.destroy', $p->id) }}" method="post">
                                                @csrf
                                                @method("delete")
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    {{-- modal --}}
    <div class="modal fade" id="deskripsiModal" tabindex="-1" aria-labelledby="deskripsiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deskripsiModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
