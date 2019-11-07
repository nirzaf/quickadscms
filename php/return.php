<?php

if(!isset($_GET['rt']))
{
    error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
}
else{
    $custom = $_GET['rt'];
}
if(checkloggedin()) {
    $info = ORM::for_table($config['db']['pre'].'transaction')->find_one($custom);

    if (!empty($info)) {
        // output data of each row
        $item_pro_id = $info['product_id'];
        $item_amount = $info['amount'];
        $item_featured = $info['featured'];
        $item_urgent = $info['urgent'];
        $item_highlight = $info['highlight'];

        $transaction = ORM::for_table($config['db']['pre'].'user')->find_one($custom);
        $transaction->set('status', 'success');
        $transaction->save();

        $product = ORM::for_table($config['db']['pre'].'product')->find_one($item_pro_id);
        $product->set('featured', $item_featured);
        $product->set('urgent', $item_urgent);
        $product->set('highlight', $item_highlight);
        $product->save();

        $info2 = ORM::for_table($config['db']['pre'].'balance')->find_one(1);

        if (!empty($info2)) {
            $current_amount=$info2['current_balance'];
            $total_earning=$info2['total_earning'];

            $updated_amount=($item_amount+$current_amount);
            $total_earning=($item_amount+$total_earning);

            $balance = ORM::for_table($config['db']['pre'].'product')->find_one(1);
            $balance->set('current_balance', $updated_amount);
            $balance->set('total_earning', $total_earning);
            $balance->save();
        }

        message($lang['SUCCESS'],$lang['PAYMENTSUCCESS']);
        exit;

    }
    else{
        error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
    }
}
else
{
    error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);
}