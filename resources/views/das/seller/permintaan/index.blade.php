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
                                    <th width="60px" data-priority="1">No Transaksi</th>
                                    <th data-priority="2">Customer</th>
                                    <th class="text-nowrap" data-priority="2">Product</th>
                                    <th width="150px">Design</th>
                                    <th width="150px">File</th>
                                    <th width="150px">Pengiriman</th>
                                    <th width="150px">Harga</th>
                                    <th class="text-nowrap">STATUS</th>
                                </tr>
                            </thead>
                            <tbody class="text-uppercase">
                                @foreach ($permintaan as $p)
                                    <tr>
                                      <td>{{ $p->no_transaksi }}</td>
                                      <td>{{ $p->customer->nama }}</td>
                                      <td>{{ $p->produk->nama }}</td>
                                      <td></td>
                                      <td><a href="{{ asset("/storage/checkout/$p->file") }}">Download</a></td>
                                      <td>{{ $p->pengiriman }}</td>
                                      <td>{{ $p->harga }}</td>
                                      <td>{{ $p->status }}</td>                                    
                                     
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
