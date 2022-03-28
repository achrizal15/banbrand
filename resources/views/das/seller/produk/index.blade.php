@extends('template.das.seller.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('sellers.product.create') }}" class="btn btn-primary">Tambah</a>
                        <table class="dataTable table table-bordered table-hover" id="table-category">
                            <thead>
                                <tr>
                                    <th data-priority="1">NAMA</th>
                                    <th class="text-nowrap" data-priority="2">PRODUK</th>
                                    <th width="150px">DESKRIPSI</th>
                                    <th class="text-nowrap">STATUS</th>
                                    <th class="text-nowrap" data-priority="3">ACTION</th>
                                </tr>
                            </thead>
                      
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
