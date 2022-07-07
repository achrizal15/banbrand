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
                                <th class="text-nowrap">USER</th>
                                <th>TYPE</th>
                                <th class="text-nowrap">TOTAL</th>
                                <th class="text-nowrap">BANK</th>
                                <th class="text-nowrap">NO REKENING</th>
                                <th class="text-nowrap">KETERANGAN</th>
                                <th class="text-nowrap">STATUS</th>
                                <th class="text-nowrap">CREATED AT</th>
                                <th data-priority="1" class="text-nowrap">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($refund as $item)
                            <tr>

                                <td>
                                    @isset($item->seller)
                                    {{$item->seller->nama}}
                                    @endisset @isset($item->transaksi)
                                    @isset($item->transaksi->customer)
                                    {{ $item->transaksi->customer->nama }}
                                    @endisset
                                    @endisset
                                </td>
                                <td>{{ ucwords($item->type) }}</td>
                                <td>{{ rupiah($item->saldo) }}</td>
                                <td>{{ $item->transaksi ? $item->transaksi->bank->nama : $item->seller->bank->nama }}
                                </td>
                                <td>{{ $item->no_rekening }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @if ($item->status == 'Selesai' || $item->status == 'Tolak')
                                    <span class="text-muted">{{ $item->status }}</span>
                                    @else
                                    <form method="post" action="{{ route('admin.transaksi.refund.update', $item->id) }}">
                                        @method('post')
                                        @csrf
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" class="btn btn-success">Selesai</button>
                                    </form>
                                    <form method="post" action="{{ route('admin.transaksi.refund.update', $item->id) }}">
                                        @method('post')
                                        @csrf
                                        <input type="hidden" name="status" value="tolak">
                                        <button type="submit" class="btn btn-danger">Tolak</button>
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