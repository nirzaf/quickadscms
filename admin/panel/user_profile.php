<?php
require_once('../datatable-json/includes.php');

$fetchuser = ORM::for_table($config['db']['pre'].'user')->find_one($_GET['id']);

if(!isset($_GET['id']))
{
    echo 'Error : 404 Page not found';
}

$fetchusername  = $fetchuser['username'];
$fetchuserpic     = $fetchuser['image'];

if($fetchuserpic == "")
    $fetchuserpic = "default_user.png";


?>

<style>
    .app-contacts *{
        box-sizing: border-box;
    }
</style>
<div class="app-contacts">
    <header class="slidePanel-header overlay" style="background-image: url(assets/images/user-bg.jpg)">
        <div class="overlay-panel overlay-background vertical-align">
            <div class="vertical-align-middle">
                <a class="avatar" href="#" id="emp_img_uploader">
                    <img src="../storage/profile/<?php echo $fetchuserpic;?>" alt="" style="min-height: 100px; min-width: 100px">
                </a>

                <h3 class="name"><?php echo $fetchuser['name'];?></h3>

                <div class="tags">
                    <?php echo $fetchuser['email'];?>
                </div>
            </div>
        </div>
    </header>
    <div class="slidePanel-actions">
        <div class="btn-group-flat">
            <button type="button" class="btn btn-pure btn-inverse slidePanel-close icon ion-android-close font-size-20" aria-hidden="true"></button>
        </div>
    </div>
    <div class="slidePanel-inner">
        <div class="user-btm-box">
            <!-- .row -->
            <div class="row text-center m-t-10">
                <div class="col-md-6 b-r"><strong>Name</strong><p><?php echo $fetchuser['name'];?></p></div>
                <div class="col-md-6"><strong>Gender</strong><p><?php echo $fetchuser['sex'];?></p></div>
            </div>
            <!-- /.row -->
            <hr>
            <!-- .row -->
            <div class="row text-center m-t-10">
                <div class="col-md-6 b-r"><strong>Country</strong><p><?php echo $fetchuser['country'];?></p></div>
                <div class="col-md-6"><strong>Joined</strong><p><?php echo date('dS M g:iA', strtotime($fetchuser['created_at'])); ?></p></div>
            </div>
            <!-- /.row -->
            <hr>
            <!-- .row -->
            <div class="row text-center m-t-10">
                <div class="col-md-12"><strong>About</strong><p class="m-t-30"><?php echo $fetchuser['description'];?></p></div>

            </div>

        </div>
    </div>
</div>



