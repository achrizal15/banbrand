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

                        <div class="tab-content" style="margin-bottom: 10px" >
                            <form id="form-register-seller" method="POST"  class="form-ajax" enctype="multipart/form-data"
                                action="{{ route('createaccount', 'sellers') }}" novalidate>
                                @csrf
                                @method("POST")
                                <div id="step-1" class="tab-pane" role="tabpanel" style="margin: 0 18px 0 18px">
                                <fieldset>
                                    <div class="row mt-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Penjual</label>
                                            <input tabindex="-1" data-parsley-group="block-1" type="text"
                                                name="nama-penjual"
                                                class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">No Handphone</label>
                                            <input tabindex="-1" data-parsley-group="block-1" type="text"
                                                name="no-handphone"
                                                class="form-control input-number-only" required>
                                        </div>
                                    </div>
                                    <label class="form-label">Alamat Penjual</label>
                                    <input tabindex="-1" data-parsley-group="block-1" type="text" name="alamat-penjual"
                                        class="form-control" required>
                                    </fieldset>
                                    <br /><br />
                                    <br /><br />
                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" style="margin: 0 18px 0 18px">
                                 <fieldset>
                                    <div class="row mt-3">
                                        <div class="col-md-5">
                                            <input tabindex="-1" type="file" class="dropify upload-avatar"
                                                data-default-file="{{ asset('storage/logo-sellers/default.jpg') }}"
                                           name="logo" />
                                        </div>
                                        <div class="col-md-7 mb-3">
                                            <label class="form-label">Nama Toko</label>
                                            <input tabindex="-1" data-parsley-group="block-2" type="text" name="nama-toko"
                                                class="form-control mb-3" required>
                                            <label class="form-label">No Telepone</label>
                                            <input tabindex="-1" data-parsley-group="block-2" type="text" name="no-toko"
                                                class="form-control mb-3 input-number-only" required>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Kota / Kabupaten</label>
                                                <select id="select-kota" tabindex="-1"
                                                    data-parsley-errors-container="#kota-errors"
                                                    data-parsley-group="block-2" class="form-control select2"
                                                    style="width: 100%;" required name="kota">
                                                    <option selected value="" disabled>Pilih Satu</option>
                                                </select>
                                                <span id="kota-errors"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Kecamatan</label>
                                                <select id="select-kecamatan" tabindex="-1"
                                                    data-parsley-errors-container="#kecamatan-errors"
                                                    data-parsley-group="block-2" class="form-control select2"
                                                    style="width: 100%;" required name="kecamatan">
                                                    <option selected value="" disabled>Pilih Satu</option>
                                                </select>
                                                <span id="kecamatan-errors"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Kelurahan</label>
                                                <select id="select-kelurahan" tabindex="-1"
                                                    data-parsley-errors-container="#kelurahan-errors"
                                                    data-parsley-group="block-2" class="form-control select2"
                                                    style="width: 100%;" required name="kelurahan">
                                                    <option selected value="" disabled>Pilih Satu</option>
                                                </select>
                                                <span id="kelurahan-errors"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <label class="form-label">Kode Pos</label>
                                            <input tabindex="-1" data-parsley-group="block-2" type="text"
                                                name="kode-pos"
                                                class="form-control" required>
                                        </div>
                                        <div class="col-md-4 ">
                                            <label class="form-label">Bank</label>
                                            <select id="select-bank" tabindex="-1"
                                                data-parsley-errors-container="#bank-errors"
                                                data-parsley-group="block-2" class="form-control select2"
                                                style="width: 100%;" required name="bank">
                                                <option selected value="" disabled>Pilih Satu</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}">{{ $bank->nama }}</option>
                                                @endforeach
                                            </select>
                                            <span id="bank-errors"></span>
                                        </div>
                                        <div class="col-md-4 ">
                                            <label class="form-label">No Rekening</label>
                                            <input tabindex="-1" data-parsley-group="block-2" type="text"
                                                name="no-rekening"
                                                class="form-control input-number-only" required>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label class="form-label">Alamat Toko</label>
                                        <input tabindex="-1" type="text" name="alamat_toko" data-parsley-group="block-2" class="form-control"></div>
                                </fieldset>
                                    <br /><br />
                                    <br /><br />
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel" style="margin: 0 18px 0 18px">
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Username</label>
                                            <input tabindex="-1" data-parsley-group="block-3" type="text" name="username"
                                             required
                                                class="form-control mb-3">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input tabindex="-1" data-parsley-group="block-3" type="email" name="email"
                                                value=""
                                                class="form-control mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Password</label>
                                            <input tabindex="-1" data-parsley-group="block-3" type="password"
                                                name="password"
                                                id="password"
                                                class="form-control mb-3" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Ulangi Password</label>
                                            <input tabindex="-1" data-parsley-group="block-3" type="password" name="password_confirmation"
                                                class="form-control mb-3" data-parsley-equalTo="#password" required>
                                        </div>
                                        
                                    </div>
                                    <br /><br />
                                    <br /><br />
                                </div>
                                <div id="step-4" class="tab-pane text-center p-5" role="tabpanel">
                                    <div class="mb-3">
                                        <h3>Data Siap</h3>
                                        <img src="{{ asset('images/check.png') }}" alt="centang" width="100">
                                    </div>
                                    <button type="submit" tabindex="-1" class="btn btn-success">DAFTAR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
