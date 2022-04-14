@extends("template.das.seller.main")
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @if (getActiveUser('sellers')->is_active != 1 || getActiveUser('sellers')->is_ban != 0)
                    <div class="alert alert-danger" role="alert">
                        @if (getActiveUser('sellers')->is_active != 1)
                            Akun anda belum di verifikasi oleh admin, silahkan tunggu beberapa saat lagi.
                        @else
                            Akun anda telah diblokir oleh admin, silahkan hubungi admin untuk informasi lebih lanjut.
                        @endif

                    </div>
                @endif

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
