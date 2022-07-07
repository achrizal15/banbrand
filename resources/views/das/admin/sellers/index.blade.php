@extends('template.das.admin.main')
@section('content')

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Seller
                        {{ ucwords(request('condition')) ? ucwords(request('condition')) : 'Approved' }}
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="dataTable table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th data-priority="1">LOGO</th>
                                <th class="text-nowrap" data-priority="2">NAMA TOKO</th>
                                <th>PEMILIK</th>
                                <th class="text-nowrap">NO REKENING</th>
                                <th class="text-nowrap">NO HANDPHONE</th>
                                <th class="text-nowrap">NO TELP TOKO</th>
                                <th class="text-nowrap" width='100' data-priority="3">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sellers as $seller)
                            <tr>
                                <td><img src="{{ asset('storage/logo-sellers/' . $seller->logo) }}" alt="" width="60px" height="60px"></td>
                                <td>{{ $seller->nama_toko }}</td>
                                <td>{{ $seller->nama }}</td>
                                <td>{{ $seller->no_rekening }}</td>
                                <td>{{ $seller->no_telp }}</td>
                                <td>{{ $seller->no_telp_toko }}</td>
                                <td class="text-nowrap">
                                    @if ($seller->is_active == 1)
                                    <a href="{{ route('admin.sellers.show', ['seller' => $seller->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> View</a>
                                    <form class="d-inline" id="seller-banned-form" action="{{ route('admin.sellers.destroy', $seller->id) }}" method="post">
                                        @csrf
                                        @method("delete")
                                        <input type="text" name="is_ban" value="{{ $seller->is_ban ? 0 : 1 }}" hidden>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            @if ($seller->is_ban == 1)
                                            <i class="fa-solid fa-shield-check"></i> Unbanned
                                            @else
                                            <i class="fa-solid fa-shield-slash"></i> Banned
                                            @endif
                                        </button>
                                    </form>
                                    @else
                                    <a href="{{ route('admin.sellers.show', ['seller' => $seller->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-info-circle"></i> Confirmation</a>
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