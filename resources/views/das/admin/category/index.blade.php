@extends('template.das.main')
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
                        <table class="dataTable table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th data-priority="1">NAMA</th>
                                    <th class="text-nowrap" data-priority="2">PRODUK</th>
                                    <th width="150px">DESKRIPSI</th>
                                    <th class="text-nowrap">STATUS</th>
                                    <th class="text-nowrap" data-priority="3">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorys as $category)
                                    <tr class="text-capitalize">
                                        <td>{{ $category->nama }}</td>
                                        <td><a href="">VIEW(12)</a></td>
                                        <td ><p class="text-truncate" style="max-width: 300px;">{{ $category->deskripsi }}adsajdjas a dsajdiaaaaaaaaaaaaaaaaa Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa, sunt ducimus mollitia quibusdam, earum ad odit accusantium deleniti corporis incidunt tempore dicta quod, quas laboriosam! Velit modi accusantium corporis quisquam. </p> 
                                          <a href="">Show All</a>
                                       </td>
                                        <td>{{ $category->status }}</td>
                                        <td class="text-nowrap text-center">
                                          <a href="{{ route('admin.categorys.edit', ['category' => $category->id]) }}"
                                              class="btn btn-sm btn-warning"><i class="fas fa-pencil text-white"></i></a>
                                          <form id="form-delete-item" data-remove="true" data-refresh="true" class="d-inline"
                                              action="{{ route('admin.categorys.destroy', $category->id) }}" method="post">
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
