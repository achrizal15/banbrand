@extends('template.das.main')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data {{ $title }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="dataTable table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th data-priority="1">GAMBAR</th>
                                    <th class="text-nowrap" data-priority="2">NAMA</th>
                                    <th>USERNAME</th>
                                    <th class="text-nowrap">NO HANDPHONE</th>
                                    <th class="text-nowrap">NO EMAIL</th>
                                    <th class="text-nowrap" data-priority="3">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer as $value)
                                    <tr>
                                        <td class="text-center"> <img
                                                src="{{ asset('storage/images-customer/' . $value->gambar) }}" alt=""
                                                width="60px"
                                                height="60px"></td>
                                        <td>{{ $value->nama }}</td>
                                        <td>{{ $value->username }}</td>
                                        <td>{{ $value->no_telp }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td class="text-nowrap text-center">
                                            <a href="{{ route('admin.customers.show', ['customer' => $value->id]) }}"
                                                class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                            <form id="form-delete-item" data-remove="true" data-refresh="true" class="d-inline"
                                                action="{{ route('admin.customers.destroy', $value->id) }}" method="post">
                                                @csrf
                                                @method("delete")
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash"></i></button>
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
