<?php
require_once('includes.php');
$pdo = ORM::get_db();
?>
<?php
/**
 * StarReviews - jQuery & Ajax powered php review and rating form
 * @author Adriaan Ebbeling
 * @version 1.0
 */


// Converts linebreaks to <br>
function mynl2br($text)
{
    return strtr($text, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />'));
}

$pageTitle = '';
$pageContent = '';

if (!isset($_GET['action'])) {
    $pageTitle = 'Reviews waiting for approval';

    $rows = ORM::for_table($config['db']['pre'].'reviews')
        ->where_not_equal('publish', 1)
        ->order_by_desc('date')
        ->find_many();

    $count = count($rows);

    if ($count == 0) {
        $pageContent .= '<p>There are no unapproved reviews at the moment, please check back later.</p>';
    } else {
        $pageContent .= '<p>There are <strong>'.$count.'</strong> unapproved reviews waiting for your approval.</p><div class="table-responsive">
        <table class="table table-bordered" id="reviews">
        <thead>
        <tr>
        <th>Stars</th>
        <th>Product Title</th>
        <th>Date</th>
        <th>Name</th>
        <th>Actions</th>
        </tr>
        </thead>
        <tbody>';

        foreach ($rows as $fetch) {
            $info = ORM::for_table($config['db']['pre'].'user')->find_one($fetch['user_id']);
            $fullname = $info['name'];
            $username = $info['username'];

            $info2 = ORM::for_table($config['db']['pre'].'product')->find_one($fetch['productID']);
            $ad_title = $info2['product_name'];

            $pageContent .= '
            <tr>
            <td><img src="plugins/starreviews/assets/img/rating-star'.$fetch['rating'].'.png"></td>
            <td><a href="post_detail.php?id='.$fetch['productID'].'">'.$ad_title.'</a></td>
            <td>'.timeAgo($fetch['date']).'</td>
            <td>'.$fullname.'</td>
            <td style="width:250px">
            <button type="button" class="btn btn-sm btn-default" data-container="body" data-toggle="popover" data-placement="left" data-content="'.$fetch['comments'].'" data-original-title="" title="Review comments">View review</button>
            <div class="btn-group">
                <a href="review.php?action=edit&id='.$fetch['reviewID'].'" class="btn btn-sm btn-primary">Edit</a>
                <a href="review.php?action=approve&id='.$fetch['reviewID'].'" class="btn btn-sm btn-success">Approve</a>
                <a href="review.php?action=delete&id='.$fetch['reviewID'].'&type=unapproved" class="btn btn-sm btn-danger">Delete</a>
            </div>
            </td>
            </tr>';
        }

        $pageContent .= '
        </tbody>
        </table></div>';
    }
} else {
    if ($_GET['action'] == "edit") {
        if (isset($_GET['id'])) {
            if (!empty($_GET['id'])) {
                if (isset($_POST['Submit'])) {
                    if (isset($_POST['publish'])) {
                        if ($_POST['publish'] == 1) {
                            $setPublish = 1;
                        } else {
                            $setPublish = 0;
                        }
                    } else {
                        $setPublish = 0;
                    }
                    $comment = mynl2br($_POST['comments']);

                    $query = "UPDATE ".$config['db']['pre']."reviews SET
                    rating='".$_POST['rating-new']."',
                    comments='".mynl2br($_POST['comments'])."',
                    publish='".$setPublish."'
                    WHERE reviewID='".$_GET['id']."'";
                    $result = $pdo->query($query);

                    if ($result) {
                        $pageContent .= '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Success!</strong>  You changes have been saved successfully. </div>';
                    } else {
                        $pageContent .= '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Error!</strong>  Something went wrong while saving your changes. Please try again. </div>';
                    }

                }
                // Pull data from database
                $row = ORM::for_table($config['db']['pre'].'reviews')
                    ->where('reviewID', $_GET['id'])
                    ->find_one();

                if ($row['rating'] == 1) { $rating_selected_1 = 'selected="selected"'; } else { $rating_selected_1 = ''; }
                if ($row['rating'] == 2) { $rating_selected_2 = 'selected="selected"'; } else { $rating_selected_2 = ''; }
                if ($row['rating'] == 3) { $rating_selected_3 = 'selected="selected"'; } else { $rating_selected_3 = ''; }
                if ($row['rating'] == 4) { $rating_selected_4 = 'selected="selected"'; } else { $rating_selected_4 = ''; }
                if ($row['rating'] == 5) { $rating_selected_5 = 'selected="selected"'; } else { $rating_selected_5 = ''; }
                if ($row['publish'] == 1) { $publish = 'checked="checked"'; } else { $publish = ''; }
                $pageTitle = 'Edit review';
                $pageContent .= '
                <form role="form" action="" method="post">
                    <div class="form-group input select rating-new">
                        <label for="rating">Rating</label>
                        <select id="rating-new" name="rating-new">
                            <option value="1" '.$rating_selected_1.'>1 Star</option>
                            <option value="2" '.$rating_selected_2.'>2 Stars</option>
                            <option value="3" '.$rating_selected_3.'>3 Stars</option>
                            <option value="4" '.$rating_selected_4.'>4 Stars</option>
                            <option value="5" '.$rating_selected_5.'>5 Stars</option>
                        </select>
                    </div>
                   
                    <div class="form-group">
                        <label for="comments">Review</label>
                        <textarea class="form-control" name="comments">'.$row['comments'].'</textarea>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="css-input css-checkbox css-checkbox-primary">
                                <input type="checkbox" name="publish" value="1" '.$publish.'><span></span> Publish
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success" name="Submit" id="Submit">Submit</button>
                </form>';
            }
        }
    }
    elseif ($_GET['action'] == "approve") {
        if (isset($_GET['id'])) {
            if (!empty($_GET['id'])) {

                $query = "UPDATE ".$config['db']['pre']."reviews SET publish='1' WHERE reviewID='".$_GET['id']."'";
                $result = $pdo->query($query);

                if ($result) {
                    header("location: review.php");
                }
            }
        }
    }
    elseif ($_GET['action'] == "unapprove") {
        if (isset($_GET['id'])) {
            if (!empty($_GET['id'])) {
                $query = "UPDATE ".$config['db']['pre']."reviews SET publish='0' WHERE reviewID='".$_GET['id']."'";
                $result = $pdo->query($query);

                if ($result) {
                    header("location: review.php?action=all-reviews");
                }
            }
        }
    }
    elseif ($_GET['action'] == "delete") {
        if (isset($_GET['id'])) {
            if(!check_allow()){
                ?>
                <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
                <script>
                    $(document).ready(function(){
                        $('#sa-title').trigger('click');
                    });
                </script>
                <?php

            }
            else {
                if (!empty($_GET['id'])) {
                    $result = ORM::for_table($config['db']['pre'].'reviews')
                        ->where('reviewID', $_GET['id'])
                        ->delete_many();
                    if ($result) {
                        if (isset($_GET['type'])) {
                            if (!empty($_GET['type'])) {
                                if ($_GET['type'] == "approved") {
                                    header("location: review.php?action=all-reviews");
                                } else {
                                    header("location: review.php");
                                }
                            }
                        }
                    }
                }
            }

        }
    }
    elseif ($_GET['action'] == "all-reviews") {

        $pageTitle = 'All active reviews';

        $rows = ORM::for_table($config['db']['pre'].'reviews')
            ->where('publish', 1)
            ->order_by_desc('date')
            ->find_many();
        $count = count($rows);

        if ($count == 0) {
            $pageContent .= '<p>There are no <strong>approved</strong> reviews at the moment, go to <a href="review.php">reviews waiting approval</a>.</p>';

        }
        else {
            $pageContent .= '<p>There are <strong>'.$count.'</strong> approved reviews.</p><div class="table-responsive">
            <table class="table table-bordered" id="reviews">
            <thead>
            <tr>
            <th>Stars</th>
            <th>Product ID</th>
            <th>Date</th>
            <th>Name</th>
            <th>Actions</th>
            </tr>
            </thead>
            <tbody>';

            foreach ($rows as $fetch) {

                $info = ORM::for_table($config['db']['pre'].'user')->find_one($fetch['user_id']);
                $fullname = $info['name'];
                $username = $info['username'];

                $info2 = ORM::for_table($config['db']['pre'].'product')->find_one($fetch['productID']);
                $ad_title = $info2['product_name'];

                $pageContent .= '
                <tr>
                <td><img src="plugins/starreviews/assets/img/rating-star'.$fetch['rating'].'.png"></td>
                <td><a href="post_detail.php?id='.$fetch['productID'].'">'.$ad_title.'</a></td>
                <td>'.timeAgo($fetch['date']).'</td>
                <td>'.$fullname.'</td>
                <td>
                <button type="button" class="btn btn-sm btn-default" data-container="body" data-toggle="popover" data-placement="left" data-content="'.$fetch['comments'].'" data-original-title="" title="Review comments">View review</button>
                <a href="review.php?action=edit&id='.$fetch['reviewID'].'" class="btn btn-sm btn-primary">Edit</a>
                <a href="review.php?action=unapprove&id='.$fetch['reviewID'].'" class="btn btn-sm btn-success">Unapprove</a>
                <a class="btn btn-sm btn-danger" href="review.php?action=delete&id='.$fetch['reviewID'].'&type=approved">Delete</a>
                </td>
                </tr>';
            }

            $pageContent .= '
            </tbody>
            </table></div>';
        }
    }
}


?>

<?php include("header.php");?>
<!-- Admin stylesheet -->
<link href="plugins/starreviews/assets/css/starReviewsAdmin.css" rel="stylesheet" type="text/css"/>

<!-- Page JS Plugins CSS -->

<main class="app-layout-content">

    <!-- Page Content -->
    <div class="container-fluid p-y-md">
        <!-- Partial Table -->
        <div class="card">
            <div class="card-header">
                <h4><?php echo $pageTitle; ?></h4>
                <div class="pull-right">
                    <a class="btn btn-sm btn-warning" href="review.php">Unapproved reviews</a>
                    <a class="btn btn-sm btn-success" href="review.php?action=all-reviews">Active reviews</a>
                </div>
            </div>
            <div class="card-block">

                <?php echo $pageContent; ?>
            </div>
            <!-- .card-block -->
        </div>
        <!-- .card -->
        <!-- End Partial Table -->

    </div>
    <!-- .container-fluid -->
    <!-- End Page Content -->

</main>


<?php include("footer.php"); ?>

<!-- jQuery Form Validator -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.34/jquery.form-validator.min.js"></script>

<!-- jQuery Barrating plugin -->
<script src="plugins/starreviews/assets/js/jquery.barrating.js"></script>

<!-- StarReviews Admin -->
<script src="plugins/starreviews/assets/js/starReviewsAdmin.js"></script>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript">
    !function ($) {

        $(function(){

            // popover
            $("[data-toggle=popover]").popover()

        })

    }(jQuery)
</script>

</body>

</html>


