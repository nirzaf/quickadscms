<?php
/**
* Quickad Rating & Reviews - jQuery & Ajax php
* @author Bylancer
* @version 1.0
*/

include_once('setting.php');
// returns average rating 
function averageRating($productid)
{
    global $config,$lang;
    $q_star1_result = ORM::for_table($config['db']['pre'].'reviews')
        ->where(array(
            'rating' => '1',
            'publish' => '1',
            'productID' => $productid
        ))
        ->count();

    $q_star2_result = ORM::for_table($config['db']['pre'].'reviews')
        ->where(array(
            'rating' => '2',
            'publish' => '1',
            'productID' => $productid
        ))
        ->count();

    $q_star3_result = ORM::for_table($config['db']['pre'].'reviews')
        ->where(array(
            'rating' => '3',
            'publish' => '1',
            'productID' => $productid
        ))
        ->count();

    $q_star4_result = ORM::for_table($config['db']['pre'].'reviews')
        ->where(array(
            'rating' => '4',
            'publish' => '1',
            'productID' => $productid
        ))
        ->count();

    $q_star5_result = ORM::for_table($config['db']['pre'].'reviews')
        ->where(array(
            'rating' => '5',
            'publish' => '1',
            'productID' => $productid
        ))
        ->count();
                            
    $total = $q_star1_result + $q_star2_result + $q_star3_result + $q_star4_result + $q_star5_result;
    
    if ($total != 0) {                      
        $rating = ($q_star1_result*1 + $q_star2_result*2 + $q_star3_result*3 + $q_star4_result*4 + $q_star5_result*5) / $total;
    } else {
        $rating = 0;
    }
    
    $rating = round($rating * 2) / 2;

    echo '<h3>'.$lang['AVRAGE_RATING'].'</h3><p><small><strong>'.$rating.'</strong> '.$lang['AVRAGE_BASED_ON'].' <strong>'.$total.'</strong> '.$lang['REVIEWS'].'.</small></p><div class="rating-passive" data-rating="'.$rating.'"><span class="stars"></span></div>';
}

// show average rating
if (isset($_GET['show'])) {
    if ($_GET['show'] == "average") {
        averageRating($productid);
    }
} else {
    // show reviews
    $qReviews = ORM::for_table($config['db']['pre'].'reviews')
        ->where(array(
            'publish' => '1',
            'productID' => $productid
        ))
        ->order_by_desc('date')
        ->find_many();

    $rReviews = count($qReviews);

    if ($rReviews == 0) {
        echo '<p>'.$lang['NO_REVIEW'].'</p>';
    } else {
        foreach ($qReviews as $fReviews) {

            $info = ORM::for_table($config['db']['pre'].'user')
                ->select_many('name','username','image')
                ->find_one($fReviews['user_id']);

            $fullname = $info['name'];
            $username = $info['username'];
            $image = $info['image'];
            $star = '';
            for($i=1; $i<=5; $i++){

                if($i <= $fReviews['rating']){
                    $checked = "starchecked";
                }else{
                    $checked = "";
                }
                $star .= '<span class="fa fa-star font-18 '.$checked.'"></span>';
            }

            echo '<div class="review"  id="'.$fReviews['reviewID'].'">
                        <div class="image">
                            <div class="bg-transfer">
                                <img src="'.$config['site_url'].'/storage/profile/small_'.$image.'" alt="'.$fullname.'">
                            </div>
                        </div>
                        <div class="description">
                            <figure>
                                <div class="rating-passive" data-rating="'.$fReviews['rating'].'">
                                    <span class="stars">

                                    </span>
                                </div>
                                <span class="date">'.date("d F Y", strtotime($fReviews['date'])).'</span>
                                <p class="t-body -size-m h-m0">by <a class="t-link -decoration-reversed" href="'.$config['site_url'].'profile/'.$username.'">'.$fullname.'</a></p>
                            </figure>
                            <p>'.$fReviews['comments'].'</p>
                        </div>
                    </div>
                    <!--end review-->';
        } 
    } 
}
?>