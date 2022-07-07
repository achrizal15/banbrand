@extends('template.das.admin.main')
@section('content')

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data {{ ucwords($title) }}</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah</a>
                    <table class="dataTable table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-nowrap" data-priority="2">NAMA</th>
                                <th class="text-nowrap">NO EMAIL</th>
                                <th class="text-nowrap" width='100' data-priority="3">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $value)
                            <tr>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('admin.users.edit', ['user' => $value->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                    <form id="form-delete-item" data-remove="true" data-refresh="true" class="d-inline" action="{{ route('admin.users.destroy', $value->id) }}" method="post">
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
@endsection