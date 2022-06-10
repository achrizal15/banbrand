@extends('template.das.seller.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-primary" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#penarikanModal">
                            Tarik ({{ rupiah($lastKas->saldo) }})</button>
                        <table class="dataTable table table-bordered table-hover" id="table-refund">
                            <thead>
                                <tr>
                                    <th>TYPE</th>
                                    <th class="text-nowrap">TOTAL</th>
                                    <th class="text-nowrap">BANK</th>
                                    <th class="text-nowrap">NO REKENING</th>
                                    <th class="text-nowrap">KETERANGAN</th>
                                    <th class="text-nowrap">STATUS</th>
                                    <th class="text-nowrap">CREATED AT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penarikan as $item)
                                    <tr>
                                        <td>{{ ucwords($item->type) }}</td>
                                        <td>{{ rupiah($item->saldo) }}</td>
                                        <td>{{ $item->seller->bank->nama }}</td>
                                        <td>{{ $item->no_rekening }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->status }}</td>
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
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

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
    <div class="modal fade" id="penarikanModal" tabindex="-1" aria-labelledby="penarikanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="penarikanModalLabel">Tarik Dana</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sellers.penarikanPost') }}" method="POST" class="form-ajax">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        {{-- kode bayar --}}
                        <table>
                            <tr>
                                <td class="text-bold">
                                    Saldo Anda
                                </td>
                                <td>:</td>
                                <td>
                                    {{ rupiah($lastKas->saldo) }}
                                </td>
                            </tr>
                        </table>
                        <br>
                        <input type="text" hidden disabled value="{{ $lastKas->saldo }}" id="saldoSaatIni">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input required type="text" class="form-control" min="50000" name="saldo" id="saldo">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea required class="form-control" name="keterangan"></textarea>
                        </div>
                        {{-- Minimum penarikan adalah 10000 --}}
                        <span class="text-danger">Minimum penarikan adalah Rp. 50.000</span>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-success btn">Sumit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        ////javascript get id saldoSaatIni
        const saldoSaatIni = document.getElementById('saldoSaatIni').value;
        const saldo = document.getElementById('saldo');
        saldo.addEventListener('keyup', function() {
            //get this value
            const value = this.value;
            if (parseInt(value) > parseInt(saldoSaatIni)) {
                alert('Saldo tidak mencukupi');
                this.value = '';
            }

        });
    </script>
@endsection
