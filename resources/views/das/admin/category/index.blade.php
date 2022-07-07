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
                <a href="{{ route('admin.categorys.create') }}" class="btn btn-primary">Tambah</a>
                <table class="dataTable table table-bordered table-hover" id="table-category">
                    <thead>
                        <tr>
                            <th data-priority="1">NAMA</th>
                            <th class="text-nowrap" data-priority="2">PRODUK</th>
                            <th width="150px">DESKRIPSI</th>
                            <th class="text-nowrap">STATUS</th>
                            <th class="text-nowrap" width='100' data-priority="3">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorys as $category)
                        <tr class="text-capitalize">
                            <td>{{ $category->nama }}</td>
                            <td><a href="">VIEW(12)</a></td>
                            <td>
                                <p class="text-truncate" style="max-width: 300px;">{{ $category->deskripsi }} </p>
                                <a href="#" data-bs-toggle="modal" id="btn-deskripsi-category" data-bs-target="#deskripsiModal" data-category="{{ $category }}">Show All</a>
                            </td>
                            <td>{{ $category->status }}</td>
                            <td class="text-nowrap text-center">
                                <a href="{{ route('admin.categorys.edit', ['category' => $category->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                <form id="form-delete-item" data-remove="true" data-refresh="true" class="d-inline" action="{{ route('admin.categorys.destroy', $category->id) }}" method="post">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                </form>
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