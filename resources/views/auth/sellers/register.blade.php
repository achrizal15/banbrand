@extends('template.main')
@section('content')
    <div class="container justify-content-center d-flex">
        <div class="col-md-8 ">
            <div class="card mt-5">
                {{-- <div class="card-header" style="visibility: hidden"></div> --}}
                <div class="card-body">
                    <div id="smartwizard">
                        <ul class="nav">
                            <li>
                                <a class="nav-link" href="#step-1">
                                    User Profile
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="#step-2">
                                    Toko Profile
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="#step-3">
                                    Akun
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="#step-4">
                                    Selesai
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" style="margin-bottom: 10px ">

                            <div id="step-1" class="tab-pane" role="tabpanel" style="margin: 0 18px 0 18px">
                                <form id="form-1">
                                
                                    <div class="row mt-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Penjual</label>
                                            <input type="text" name="nama-penjual"
                                                value=""
                                                class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">No Handphone</label>
                                            <input type="text" name="no-handphone"
                                                value=""
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <label class="form-label">Alamat Penjual</label>
                                    <input type="text" name="alamat-penjual"
                                        value=""
                                        class="form-control" required>
                                    <br><br>
                                </form>
                            </div>
                            <div id="step-2" class="tab-pane" role="tabpanel" style="margin: 0 18px 0 18px">
                                <form id="form-2" method="POST" >
                                      <div class="row mt-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Toko</label>
                                            <input type="text" name="nama-toko"
                                                value=""
                                                class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">No Telepone</label>
                                            <input type="text" name="no"
                                                value=""
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </form>
                                <img src="{{ asset("storage/logo-sellers/default.jpg") }}" class="rounded-circle" style="border: red 1px solid">

                            </div>
                            <div id="step-3" class="tab-pane" role="tabpanel">
                                Step content
                            </div>
                            <div id="step-4" class="tab-pane" role="tabpanel">
                                Step content
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
