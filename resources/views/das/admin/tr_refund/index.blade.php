@extends('template.das.admin.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="dataTable table table-bordered table-hover" id="table-refund">
                            <thead>
                                <tr>
                                    <th data-priority="1">NO TRANSAKSI</th>
                                    <th class="text-nowrap">CUSTOMER</th>
                                    <th class="text-nowrap">BANK</th>
                                    <th class="text-nowrap">NO REKENING</th>
                                    <th class="text-nowrap">STATUS</th>
                                    <th class="text-nowrap">CREATED AT</th>
                                    <th class="text-nowrap">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($refund as $item)
                                    <tr>
                                        <td>{{ $item->transaksi->no_transaksi }}</td>
                                        <td>{{ $item->transaksi->customer->nama }}</td>
                                        <td>{{ $item->transaksi->bank->nama }}</td>
                                        <td>{{ $item->transaksi->no_rekening }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if ($item->status == 'selesai')
                                                <span class="text-muted">Selesai</span>
                                            @else
                                                <form
                                                    class="form-ajax" method="GET"
                                                    action="{{ route('sellers.permintaan.action', $item->id) }}?status=selesai">
                                                    <button type="submit" class="btn btn-success">Selesai</button>
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
                        <label for="kode_bayar">Kode Bayar</label>
                        <input type="text" class="form-control" id="kode_bayar" readonly>
                    </div>
                    <div class="form-group">
                        <label for="total_bayar">Total Transfer</label>
                        <input type="text" class="form-control" id="total_bayar" readonly>
                    </div>
                    <div class="p-2">
                        <img src="{{ asset('storage/bukti_bayar/bk.jpg') }}" id="bukti" style="width: 100%">
                    </div>
                </div>
                {{-- <div class="modal-footer">
                    <input type="hidden" id="bukti-id">
                    <a id="btn-bukti" data-status="terima"
                        href=""
                        class="btn btn-success">TERIMA
                    </a>
                    <a id="btn-bukti" data-status="tolak"
                        href=""
                        class="btn btn-danger">TOLAK</a>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
