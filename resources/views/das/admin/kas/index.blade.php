@extends('template.das.admin.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Start Date</label>
                                        <input type="date" name="startdate" value="{{ $startdate }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">End Date</label>
                                        <input type="date" name="enddate" value="{{ $enddate }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2"  >                                  
                                    <button class="btn btn-info " style="margin-top: 30px"  type="submit">Filter</button>
                                </div>
                            </div>


                        </form>
                        <table class="dataTable table table-bordered table-hover" id="table-refund">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">TANGGAL TRANSAKSI</th>
                                    <th class="text-nowrap">KREDIT</th>
                                    <th class="text-nowrap">DEBIT</th>
                                    <th class="text-nowrap">SALDO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kas as $item)
                                    <tr>
                                        <td>{{ $item->created_at }}</td>
                                        <td class="text-red">
                                            @if ($item->jenis == 'kredit')
                                                {{ rupiah($item->jumlah) }}
                                            @endif
                                        </td>
                                        <td class="text-green">
                                            @if ($item->jenis != 'kredit')
                                                {{ rupiah($item->jumlah) }}
                                            @endif
                                        </td>
                                        <td>{{ rupiah($item->saldo) }}</td>
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
