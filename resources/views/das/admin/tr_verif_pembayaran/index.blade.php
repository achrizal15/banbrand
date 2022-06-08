@extends('template.das.admin.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h3 class="card-title">Data {{ $title }} </h3>
                    </div> --}}
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="dataTable table table-bordered table-hover" id="table-verif">
                            <thead>
                                <tr>
                                    <th data-priority="1">NO TRANSAKSI</th>
                                    <th class="text-nowrap" data-priority="2">PRODUK</th>
                                    <th width="150px">SELLER</th>
                                    <th class="text-nowrap">CUSTOMER</th>
                                    <th class="text-nowrap" data-priority="3">BUKTI</th>
                                    <th class="text-nowrap" data-priority="3">CREATED AT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                <tr>
                                    <td>{{ $item->no_transaksi }}</td>
                                    <td>{{ $item->produk->nama }}</td>
                                    <td>{{ $item->seller->nama }}</td>
                                    <td>{{ $item->customer->nama }}</td>
                                    <td>
                                        <a href="#" class="text-decoration-underline" data-bs-toggle="modal"
                                            data-bs-target="#verifModal" id="btn-view-bukti"
                                            data-checkout="{{ $item }}"
                                            data-route="{{ route('admin.transaksi.verifikasi', ['transaksi' => $item->id]) }}"
                                            data-gambar="{{ asset('storage/bukti_bayar/' . $item->bukti_bayar) }}"">
                                                        Tampilkan
                                                    </a>
                                                </td>
                                                <td>{{ $item->created_at }}</td>
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
    <div class="modal fade" id="verifModal" tabindex="-1" aria-labelledby="verifModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- kode bayar --}}
                    <div class="form-group">
                        <label for="kode_bayar">No Rekening</label>
                        <input type="text" class="form-control" id="no_rekening" readonly>
                    </div>
                    <div class="form-group">
                        <label for="total_bayar">Total Transfer</label>
                        <input type="text" class="form-control" id="total_bayar" readonly>
                    </div>
                    <div class="p-2">
                        <img src="{{ asset('storage/bukti_bayar/bk.jpg') }}" id="bukti" style="width: 100%">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="bukti-id">
                    <a id="btn-bukti" data-status="terima"
                        href=""
                        class="btn btn-success">TERIMA
                    </a>
                    <a id="btn-bukti" data-status="tolak"
                        href=""
                        class="btn btn-danger">TOLAK</a>
                </div>
            </div>
        </div>
    </div>
@endsection
