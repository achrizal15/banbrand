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
                                        src="{{ asset('storage/images-customer/' . $customer->gambar) }}"
                                        alt="User profile picture" class="profile-pic-img">

                                </div>
                            </div>

                            <h3 class="profile-username text-center">{{ $customer->nama }}</h3>

                            <p class="text-muted text-center">{{ $customer->username }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
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

                            <strong><i class="fas fa-map-marker-alt mr-1"></i>Lokasi</strong>

                            <p class="text-muted">{{ $customer->kota }}</p>

                            <hr>
                            <strong> <i class="fas fa-street-view mr-1"></i> Alamat</strong>

                            <p class="text-muted">{{ $customer->alamat }}</p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2 ">
                            <ul class="nav nav-pills">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-activity-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-activity" type="button" role="tab"
                                        aria-controls="pills-activity" aria-selected="true">Activity</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-timeline-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-timeline" type="button" role="tab"
                                        aria-controls="pills-timeline" aria-selected="false">Timeline</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-setting-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-setting" type="button" role="tab"
                                        aria-controls="pills-setting" aria-selected="false">Setting</button>
                                </li>
                            </ul>

                        </div><!-- /.card-header -->
                        <div class="card-body" id="pills-tabContent">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="pills-activity" role="tabpanel"
                                    aria-labelledby="pills-activity-tab">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ asset('storage/images-customer/' . $customer->gambar) }}"
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



                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane fade" id="pills-timeline" role="tabpanel"
                                    aria-labelledby="pills-timeline-tab">
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        <div class="time-label">
                                            <span class="bg-danger">
                                                {{ date('d M. Y', strtotime($customer->created_at)) }}
                                            </span>
                                        </div>

                                        <div>
                                            <i class="fas fa-user bg-info"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i>
                                                    {{ time_elapsed_string($customer->created_at) }}</span>

                                                <h3 class="timeline-header border-0"><a href="#">{{ $customer->nama }}</a>
                                                    membuat akun baru
                                                </h3>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        @if ($customer->is_active == 1)
                                            <div>
                                                <i class="fas fa-solid fa-user-check bg-warning"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 27 mins
                                                        ago</span>

                                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your
                                                        post</h3>

                                                    <div class="timeline-body">
                                                        Take me to your leader!
                                                        Switzerland is small and neutral!
                                                        We are more like Germany, ambitious and misunderstood!
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.tab-pane -->
                                <div class="tab-pane fade" id="pills-setting" role="tabpanel"
                                    aria-labelledby="pills-setting-tab">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputNew Password" class="col-sm-2 col-form-label">New
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputSkills">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputNew Password" class="col-sm-2 col-form-label">Re
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputSkills">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms and
                                                            conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
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
