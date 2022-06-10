@extends('template.das.admin.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                  
                        <form class="form-ajax needs-validation" novalidate action="{{ $url }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                              
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $data->email }}" required readonly>
                                    <div class="invalid-feedback">
                                        Email harus diisi
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_bank">Nama bank</label>
                                    <input type="nama_bank" class="form-control" id="nama_bank" name="nama_bank"
                                        value="{{ $data->nama_bank }}" required readonly>
                                    <div class="invalid-feedback">
                                        nama_bank harus diisi
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="atas_nama_bank">Atas Nama Bank</label>
                                    <input type="atas_nama_bank" class="form-control" id="atas_nama_bank" name="atas_nama_bank"
                                        value="{{ $data->atas_nama_bank }}" required readonly>
                                    <div class="invalid-feedback">
                                        atas_nama_bank harus diisi
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_handphone">No Handphone</label>
                                    <input type="no_handphone" class="form-control" id="no_handphone" name="no_handphone"
                                        value="{{ $data->no_handphone }}" required readonly>
                                    <div class="invalid-feedback">
                                        no_handphone harus diisi
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_rekening">No rekening</label>
                                    <input type="no_rekening" class="form-control" id="no_rekening" name="no_rekening"
                                        value="{{ $data->no_rekening }}" required readonly>
                                    <div class="invalid-feedback">
                                        no_rekening harus diisi
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="harga_ongkir">Harga Ongkir</label>
                                    <input type="text" class="form-control" id="harga_ongkir" name="harga_ongkir"
                                        value="{{ $data->harga_ongkir }}" required readonly>
                                    <div class="invalid-feedback">
                                        No HP harus diisi
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="about_us">About us</label>
                                    <textarea class="form-control" id="about_us" name="about_us_web" readonly
                                        required>{{ $data->about_us_web }}</textarea>
                                 
                                </div>
                          
                            </div>

                            <div class="col-md-6 mb-3 mt-5">
                                <button type="button"
                                    class="btn btn-warning" id="btn-edit">EDIT</button>
                                <button type="submit"
                                    class="btn btn-success" hidden id="btn-submit">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const btnEdit=document.getElementById('btn-edit');
        const btnSubmit=document.getElementById('btn-submit');
        btnEdit.addEventListener('click',function(){
            btnEdit.hidden=true;
            btnSubmit.hidden=false;
            document.querySelectorAll('input').forEach(function(input){
                input.readOnly=false;
            })
            document.querySelectorAll('textarea').forEach(function(textarea){
                textarea.readOnly=false;
            })
        })
    </script>
@endsection
