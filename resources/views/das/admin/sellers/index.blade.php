@extends('template.das')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Seller {{ ucwords(request("condition"))? ucwords(request("condition")):"Approved"}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="dataTable table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th data-priority="1">LOGO</th>
                                    <th class="text-nowrap" data-priority="2">NAMA TOKO</th>
                                    <th data-priority="3">PEMILIK</th>
                                    <th class="text-nowrap">NO REKENING</th>
                                    <th class="text-nowrap">NO HANDPHONE</th>
                                    <th class="text-nowrap">NO TELP TOKO</th>
                                    <th class="text-nowrap">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sellers as $seller)
                                    <tr>
                                        <td><img src="{{ asset('storage/logo-sellers/' . $seller->logo) }}" alt="" width="60px"
                                                height="60px"></td>
                                        <td>{{ $seller->nama_toko }}</td>
                                        <td>{{ $seller->nama }}</td>
                                        <td>{{ $seller->no_rekening }}</td>
                                        <td>{{ $seller->no_telp }}</td>
                                        <td>{{ $seller->no_telp_toko}}</td>
                                        <td class="text-nowrap text-center">
                                            @if ($seller->is_active == 1)
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-sm btn-warning text-white"><i class="far fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-ban"></i></button>
                                            @else
                                            <button class="btn btn-sm btn-info"><i class="fas fa-info-circle"></i></button>
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
@endsection
