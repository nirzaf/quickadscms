<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Add Admin</h2>
        </div>
        <div class="slidePanel-actions">
            <div class="btn-group-flat">
                <button type="button" class="btn btn-floating btn-warning btn-sm waves-effect waves-float waves-light margin-right-10" id="post_sidePanel_data"><i class="icon ion-android-done" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-pure btn-inverse slidePanel-close icon ion-android-close font-size-20" aria-hidden="true"></button>
            </div>
        </div>
    </div>
</header>
<div class="slidePanel-inner">
    <div class="panel-body">
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">

                <div class="white-box">
                    <div id="post_error"></div>
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="addAdmin" id="sidePanel_form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Profile Picture<code>*</code></label>
                                        <input class="form-control input-sm" type="file" id="file" name="file" placeholder=".input-sm" />
                                        <span class="help-block">Valid <code>jpg</code> image only</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputfullname">Full Name<code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ion-person"></i></div>
                                            <input type="text" class="form-control" id="exampleInputfullname" placeholder="Full Name" name="name" required="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="box-title">User Login Details</h4>
                                <hr>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Username<code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ion-person"></i></div>
                                            <input type="text" class="form-control" id="exampleInputuname" placeholder="Username" name="username" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address<code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ion-android-mail"></i></div>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputpwd1">Password<code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ion-android-lock"></i></div>
                                            <input type="password" class="form-control" id="exampleInputpwd1" placeholder="Login Password" name="password" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                            </div>

                            <input type="hidden" name="submit">

                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>

