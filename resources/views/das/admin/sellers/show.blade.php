@extends("template.das.admin.main")
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <div class="profile-pic img-fluid img-circle overflow-hidden">
                                    <img
                                        src="{{ asset('storage/logo-sellers/' . $seller->logo) }}"
                                        alt="User profile picture" class="profile-pic-img">

                                </div>
                            </div>

                            <h3 class="profile-username text-center">{{ $seller->nama_toko }}</h3>

                            <p class="text-muted text-center">{{ $seller->nama }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Product</b> <a class="float-right">{{ count($seller->products) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Terjual</b> <a class="float-right">{{ $seller->checkout->filter(function($idx){
                                        return strtolower($idx->status) == 'selesai';
                                    })->count() 
                                    }}</a>
                                </li>
                            </ul>

                            {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <strong><i class="fas fa-map-marker-alt mr-1"></i>Lokasi Toko</strong>

                            <p class="text-muted">{{ $seller->alamat_toko }}</p>

                            <hr>
                            <strong> <i class="fas fa-street-view mr-1"></i> Alamat</strong>

                            <p class="text-muted">{{ $seller->alamat }}</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Email</strong>

                            <p class="text-muted ">
                             {{$seller->email}}
                            </p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-9">
                    <div class="card">

                        <div class="card-header p-2 ">
                            @if ($seller->is_active)
                                <ul class="nav nav-pills">
                                    {{-- <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-activity-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-activity" type="button" role="tab"
                                            aria-controls="pills-activity" aria-selected="true">Activity</button>
                                    </li> --}}
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-timeline-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-timeline" type="button" role="tab"
                                            aria-controls="pills-timeline" aria-selected="false">Timeline</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-setting-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-setting" type="button" role="tab"
                                            aria-controls="pills-setting" aria-selected="false">Setting</button>
                                    </li>
                                </ul>
                            @else
                                <button id="approval-btn" data-id="{{ $seller->id }}" data-type="active"
                                    data-url="{{ route('admin.sellers.update', $seller->id) }}"
                                    class="btn btn-success mr-2">Activate Now</button>
                                <button id="approval-btn" data-id="{{ $seller->id }}"
                                    data-url="{{ route('admin.sellers.update', $seller->id) }}" data-type="remove"
                                    class="btn btn-danger">Remove Approval</button>
                            @endif


                        </div><!-- /.card-header -->
                        <div class="card-body" id="pills-tabContent">
                            <div class="tab-content">
                                {{-- <div class="tab-pane fade show active" id="pills-activity" role="tabpanel"
                                    aria-labelledby="pills-activity-tab">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ asset('storage/logo-sellers/' . $seller->logo) }}"
                                                alt="user image">
                                            <span class="username">
                                                <a href="#">Jonathan Burke Jr.</a>
                                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                            </span>
                                            <span class="description">Shared publicly - 7:30 PM today</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            Lorem ipsum represents a long-held tradition for designers,
                                            typographers and the like. Some people hate it and argue for
                                            its demise, but others ignore the hate as they create awesome
                                            tools to help create filler text for everyone from bacon lovers
                                            to Charlie Sheen fans.
                                        </p>

                                        <p>
                                            <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i>
                                                Share</a>
                                            <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>
                                                Like</a>
                                            <span class="float-right">
                                                <a href="#" class="link-black text-sm">
                                                    <i class="far fa-comments mr-1"></i> Comments (5)
                                                </a>
                                            </span>
                                        </p>

                                        <input class="form-control form-control-sm" type="text"
                                            placeholder="Type a comment">
                                    </div>
                                    <!-- /.post -->

                                    <!-- Post -->
                                    <div class="post clearfix">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ asset('storage/logo-sellers/' . $seller->logo) }}"
                                                alt="User Image">
                                            <span class="username">
                                                <a href="#">Sarah Ross</a>
                                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                            </span>
                                            <span class="description">Sent you a message - 3 days ago</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            Lorem ipsum represents a long-held tradition for designers,
                                            typographers and the like. Some people hate it and argue for
                                            its demise, but others ignore the hate as they create awesome
                                            tools to help create filler text for everyone from bacon lovers
                                            to Charlie Sheen fans.
                                        </p>

                                        <form class="form-horizontal">
                                            <div class="input-group input-group-sm mb-0">
                                                <input class="form-control form-control-sm" placeholder="Response">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-danger">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.post -->

                                </div> --}}
                                <!-- /.tab-pane -->
                                <div class="tab-pane fade show active" id="pills-timeline" role="tabpanel"
                                    aria-labelledby="pills-timeline-tab">
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        <div class="time-label">
                                            <span class="bg-danger">
                                                {{ date('d M. Y', strtotime($seller->created_at)) }}
                                            </span>
                                        </div>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->

                                        <div>
                                            <i class="fas fa-user bg-info"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i
                                                        class="far fa-clock"></i>
                                                    {{ time_elapsed_string($seller->created_at) }}</span>

                                                <h3 class="timeline-header border-0"><a href="#">{{ $seller->nama }}</a>
                                                    membuat akun baru
                                                </h3>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <?php $duplicate = []; ?>
                                        @foreach ($seller->useractivitylog as $activity)
                                            @if (!in_array(date('dmy', strtotime($activity->created_at)), $duplicate))
                                            <?php 
                                            $duplicate_date=date("dmy",strtotime($activity->created_at));
                                            array_push($duplicate,$duplicate_date)  ?> 
                                            <div class="time-label">
                                                    <span class="{{ $activity->bg_color }}">
                                                        {{ date('d M. Y', strtotime($activity->created_at)) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <i
                                                        class="fas {{ $activity->icon }} {{ $activity->bg_color }}"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="far fa-clock"></i>
                                                            {{ time_elapsed_string($activity->created_at) }}</span>

                                                        <h3 class="timeline-header"><a
                                                                href="#">{{ $seller->nama }}</a>
                                                            {{ $activity->activity }}
                                                        </h3>

                                                        <div class="timeline-body">
                                                            {{ $activity->details }}
                                                        </div>
                                                        {{-- <div class="timeline-footer">
                                                            <a href="#" class="btn btn-warning btn-flat btn-sm">View
                                                                comment</a>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            @else
                                                <div>
                                                    <i
                                                        class="fas {{ $activity->icon }} {{ $activity->bg_color }}"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="far fa-clock"></i>
                                                            {{ time_elapsed_string($activity->created_at) }}</span>

                                                        <h3 class="timeline-header"><a
                                                                href="#">{{ $seller->nama }}</a>
                                                            {{ $activity->activity }}
                                                        </h3>

                                                        <div class="timeline-body">
                                                            {{ $activity->details }}
                                                        </div>
                                                        {{-- <div class="timeline-footer">
                                                            <a href="#" class="btn btn-warning btn-flat btn-sm">View
                                                                comment</a>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                   
                                                @endif
                                        @endforeach

                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.tab-pane -->
                                <div class="tab-pane fade" id="pills-setting" role="tabpanel"
                                    aria-labelledby="pills-setting-tab">
                                    <form novalidate method="POST" action="{{ route("admin.sellers.pw-reset",$seller->id) }}" class="form-ajax needs-validation">
                                        @csrf
                                        @method("put")
                                        <div class="row mb-3">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password" required class="form-control" id="inputPassword3">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Re Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" data-parsley-equalTo-message="Password tidak sama" required class="form-control" data-parsley-equalTo="#inputPassword3">
                                            </div>
                                        </div>
                                        <div class="row mb-3 pl-1">
                                            <div class="col-sm-10 offset-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" data-parsley-error-message="" required type="checkbox" id="gridCheck1">
                                                    <label class="form-check-label text-bold" for="gridCheck1">
                                                        I agree to <a href="">the terms and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-danger">Reset Password</button>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
