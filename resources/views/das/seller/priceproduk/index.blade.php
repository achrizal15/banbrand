@extends('template.das.seller.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route("sellers.product.index") }}"
                            class="btn btn-danger">BACK</a>
                        <a @if(count($price)>=2) hidden @endif href="{{ route('product.price.action', ['product' => $produk->id]) . '?type=create' }}"
                            class="btn btn-primary">Tambah</a>
                        <table class="dataTable table table-bordered table-hover" id="table-category">
                            <thead>
                                <tr>
                                    <th data-priority="1">NAMA</th>
                                    <th class="text-nowrap">HARGA</th>
                                    <th width="150px">GALERY</th>
                                    <th class="text-nowrap">STATUS</th>
                                    <th class="text-nowrap" data-priority="3" width="50px">ACTION</th>
                                </tr>
                            </thead>
                            <tbody class="text-uppercase">
                                @foreach ($price as $p)
                                    <tr>
                                        <td>{{ $p->nama }}</td>
                                        <td>Rp.{{ $p->harga }}</td>
                                        <td>
                                            @foreach ($p->produkgaleries as $pg)
                                                <img width="30px" src="{{ asset("storage/produk-image/$pg->nama") }}"
                                                    alt="">
                                            @endforeach
                                        </td>
                                        <td>{{ $p->status }}</td>
                                        <td class="text-nowrap text-center">
                                            <a href="{{ route('product.price.action', ['product' => $produk->id]) . '?type=edit&id='.$p->id }}"
                                                class="btn btn-sm btn-warning"><i class="fas fa-pencil text-white"></i></a>
                                            @if (strtolower($p->nama) != 'custom')
                                                <form id="form-delete-item" data-remove="true" data-refresh="true"
                                                    class="d-inline"
                                                    action="{{ route('product.price.destroy', $p->id) }}" method="post">
                                                    @csrf
                                                    @method("delete")
                                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            @endif

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
