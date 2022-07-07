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
                <table class="dataTable table table-bordered table-hover" id="table-category">
                    <thead>
                        <tr>
                            <th data-priority="1" width="60px">GAMBAR</th>
                            <th class="text-nowrap" data-priority="2">NAMA</th>
                            <th width="150px">KATEGORI</th>
                            <th class="text-nowrap">SELLER</th>
                            <th class="text-nowrap">STATUS</th>
                            <th class="text-nowrap" data-priority="3">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr class="text-capitalize">
                            <td class="text-center"><img width="60px" height="60px" src="{{ asset('storage/produk-image/'.$item->thumnail) }}" alt=""></td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                {{ $item->kategori->nama }}
                            </td>
                            <td>
                                {{ $item->seller->nama }}
                            </td>
                            <td>{{ $item->status }}</td>
                            <td class="text-nowrap " style="width: 20px">
                                <a href="{{ route("admin.products.show",$item->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> View</a>
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