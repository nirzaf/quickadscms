<?php
require_once("includes/lib/curl/curl.php");
require_once("includes/lib/curl/CurlResponse.php");

if(checkloggedin())
{
    if(isset($_POST['upgrade']))
    {
        $info = ORM::for_table($config['db']['pre'].'subscriptions')
            ->where('sub_id', $_POST['upgrade'])
            ->find_one();

        $title = $info['sub_title'];
        $amount = $info['sub_amount'];
        $term = $info['sub_term'];
        $payment_type = "subscr";
        $pay_mode = $info['pay_mode'];

        if(isset($_POST['payment_method_id']))
        {
            $access_token = uniqid();
            $_SESSION['quickad'][$access_token]['name'] = $title." ".$lang['MEMBERSHIPPLAN'];
            $_SESSION['quickad'][$access_token]['amount'] = $amount;
            $_SESSION['quickad'][$access_token]['payment_type'] = $payment_type;
            $_SESSION['quickad'][$access_token]['sub_id'] = $_POST['upgrade'];
            $_SESSION['quickad'][$access_token]['payment_mode'] = $pay_mode;

            if($term == 'DAILY')
            {
                $_SESSION['quickad'][$access_token]['plan_interval'] = "day";
            }
            elseif($term == 'WEEKLY')
            {
                $_SESSION['quickad'][$access_token]['plan_interval'] = "week";
            }
            elseif($term == 'MONTHLY')
            {
                $_SESSION['quickad'][$access_token]['plan_interval'] = "month";
            }
            elseif($term == 'YEARLY')
            {
                $_SESSION['quickad'][$access_token]['plan_interval'] = "year";
            }


            $info = ORM::for_table($config['db']['pre'].'payments')
                ->where(array(
                    'payment_id' => $_POST['payment_method_id'],
                    'payment_install' => '1'
                ))
                ->find_one();

            $folder = $info['payment_folder'];

            if($folder == "2checkout"){
                $_SESSION['quickad'][$access_token]['firstname'] = $_POST['checkoutCardFirstName'];
                $_SESSION['quickad'][$access_token]['lastname'] = $_POST['checkoutCardLastName'];
                $_SESSION['quickad'][$access_token]['BillingAddress'] = $_POST['checkoutBillingAddress'];
                $_SESSION['quickad'][$access_token]['BillingCity'] = $_POST['checkoutBillingCity'];
                $_SESSION['quickad'][$access_token]['BillingState'] = $_POST['checkoutBillingState'];
                $_SESSION['quickad'][$access_token]['BillingZipcode'] = $_POST['checkoutBillingZipcode'];
                $_SESSION['quickad'][$access_token]['BillingCountry'] = $_POST['checkoutBillingCountry'];
            }

            $_SESSION['quickad'][$access_token]['folder'] = $folder;

            require_once('includes/payments/' . $folder . '/pay.php');
        }
        else
        {
            $payment_types = array();
            $sub_info = get_user_membership_detail($_SESSION['user']['id']);

            if ( isset($sub_info['sub_id']) &&  $sub_info['pay_mode'] == "recurring") {

                $subscription = ORM::for_table($config['db']['pre'].'upgrades')
                    ->where(array(
                        'user_id' => $_SESSION['user']['id'],
                        'status' => 'Active'
                    ))
                    ->find_one();

                if ( $subscription['stripe_customer_id'] != null ) {

                    $rows = ORM::for_table($config['db']['pre'].'payments')
                        ->where('payment_folder', 'stripe')
                        ->find_many();

                }else if($subscription['paypal_profile_id'] != null){

                    $rows = ORM::for_table($config['db']['pre'].'payments')
                        ->where('payment_folder', 'paypal')
                        ->find_many();

                }else{

                    $rows = ORM::for_table($config['db']['pre'].'payments')
                        ->where('payment_install', '1')
                        ->find_many();
                }
            }else{

                $rows = ORM::for_table($config['db']['pre'].'payments')
                    ->where('payment_install', '1')
                    ->find_many();

            }

            $num_rows = count($rows);
            foreach ($rows as $info)
            {
                $payment_types[$info['payment_id']]['id'] = $info['payment_id'];
                $payment_types[$info['payment_id']]['title'] = $info['payment_title'];
                $payment_types[$info['payment_id']]['folder'] = $info['payment_folder'];
                $payment_types[$info['payment_id']]['desc'] = $info['payment_desc'];
            }

            $period = 0;
            if($term == "DAILY") {
                $period = 86400;
            }
            elseif($term == "WEEKLY") {
                $period = 604800;
            }
            elseif($term == "MONTHLY") {
                $period = 2678400;
            }
            elseif($term == "YEARLY") {
                $period = 31536000;
            }

            $expires = (time()+$period);
            $start_date = date("d-m-Y",time());
            $expiry_date = date("d-m-Y",$expires);

            // assign posted variables to local variables
            $bank_information = nl2br(get_option('company_bank_info'));
            $userdata = get_user_data($_SESSION['user']['username']);
            $email = $userdata['email'];

            $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/membership_payment.tpl');
            $page->SetParameter ('OVERALL_HEADER', create_header($lang['UPGRADES']));
            $page->SetLoop ('PAYMENT_TYPES', $payment_types);
            $page->SetParameter ('UPGRADE', $_POST['upgrade']);
            $page->SetParameter ('PAYMENT_METHOD_COUNT', $num_rows);
            $page->SetParameter ('SUB_ID', $_POST['upgrade']);
            $page->SetParameter ('BANK_INFO', $bank_information);
            $page->SetParameter ('START_DATE', $start_date);
            $page->SetParameter ('EXPIRY_DATE', $expiry_date);
            $page->SetParameter ('ORDER_TITLE', $title);
            $page->SetParameter ('AMOUNT', $amount);
            $page->SetParameter ('EMAIL', $email);
            $page->SetParameter ('OVERALL_FOOTER', create_footer());
            $page->CreatePageEcho();
        }
    }
	elseif(check_user_upgrades($_SESSION['user']['id']))
	{
		$upgrades = array();

		if(isset($_GET['change_plan']) && $_GET['change_plan'] == "changeplan")
		{
            check_validation_for_subscribePlan();
            $sub_info = get_user_membership_detail($_SESSION['user']['id']);

            $rows = ORM::for_table($config['db']['pre'].'subscriptions')
                ->where('active', '1')
                ->find_many();
            foreach ($rows as $info)
            {
                if($info['sub_id'] == $sub_info['sub_id'])
                {
                    $sub_types[$info['sub_id']]['Selected'] = 1;
                }
                else
                {
                    $sub_types[$info['sub_id']]['Selected'] = 0;
                }

                if($info['sub_term'] == 'DAILY')
                {
                    $sub_types[$info['sub_id']]['term'] = $lang['DAILY'];
                }
                elseif($info['sub_term'] == 'WEEKLY')
                {
                    $sub_types[$info['sub_id']]['term'] = $lang['WEEKLY'];
                }
                elseif($info['sub_term'] == 'MONTHLY')
                {
                    $sub_types[$info['sub_id']]['term'] = $lang['MONTHLY'];
                }
                elseif($info['sub_term'] == 'YEARLY')
                {
                    $sub_types[$info['sub_id']]['term'] = $lang['YEARLY'];
                }

                $sub_types[$info['sub_id']]['id'] = $info['sub_id'];
                $sub_types[$info['sub_id']]['title'] = $info['sub_title'];
                $sub_types[$info['sub_id']]['recommended'] = $info['recommended'];
                $sub_types[$info['sub_id']]['cost'] = $info['sub_amount'];
                $sub_types[$info['sub_id']]['pay_mode'] = $info['pay_mode'];

                $info2 = ORM::for_table($config['db']['pre'].'usergroups')
                    ->where('group_id', $info['group_id'])
                    ->find_one();

                $sub_types[$info['sub_id']]['limit'] = ($info2['ad_limit'] == "999")? "Unlimited": $info2['ad_limit'];
                $sub_types[$info['sub_id']]['duration'] = $info2['ad_duration'];
                $sub_types[$info['sub_id']]['featured_fee'] = $info2['featured_project_fee'];
                $sub_types[$info['sub_id']]['urgent_fee'] = $info2['urgent_project_fee'];
                $sub_types[$info['sub_id']]['highlight_fee'] = $info2['highlight_project_fee'];
                $sub_types[$info['sub_id']]['featured_duration'] = $info2['featured_duration'];
                $sub_types[$info['sub_id']]['urgent_duration'] = $info2['urgent_duration'];
                $sub_types[$info['sub_id']]['highlight_duration'] = $info2['highlight_duration'];
                $sub_types[$info['sub_id']]['top_search_result'] = $info2['top_search_result'];
                $sub_types[$info['sub_id']]['show_on_home'] = $info2['show_on_home'];
                $sub_types[$info['sub_id']]['show_in_home_search'] = $info2['show_in_home_search'];
            }

            $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/membership_plan.tpl');
            $page->SetParameter ('OVERALL_HEADER', create_header($lang['UPGRADES']));
            $page->SetLoop ('SUB_TYPES', $sub_types);
            $page->SetParameter ('OVERALL_FOOTER', create_footer());
            $page->CreatePageEcho();

			exit;
		}
        else if(isset($_GET['action']) && $_GET['action'] == "cancel_auto_renew")
        {
            $action = $_GET['action'];

            $sub_info = get_user_membership_detail($_SESSION['user']['id']);

            if ( isset($sub_info['sub_id'])  &&  $sub_info['pay_mode'] == "recurring") {

                $subscription = ORM::for_table($config['db']['pre'].'upgrades')
                    ->where('user_id', $_SESSION['user']['id'])
                    ->find_one();

                if ( $subscription->stripe_customer_id != null ) {

                    require_once('includes/payments/stripe/pay.php');

                }else if($subscription->paypal_profile_id){

                    require_once('includes/payments/paypal/pay.php');

                }
                exit;
            }
        }
		else
		{
            $info = ORM::for_table($config['db']['pre'].'upgrades')
                ->where('user_id', $_SESSION['user']['id'])
                ->find_one();

            $sub_info = ORM::for_table($config['db']['pre'].'subscriptions')
                ->where('sub_id', $info['sub_id'])
                ->find_one();

            $upgrade_id = $info['upgrade_id'];
            $upgrades_title = $sub_info['sub_title'];
            $upgrades_cost = $sub_info['sub_amount'];
            $upgrades_status = $info['status'];
            $pay_mode = $sub_info['pay_mode'];

            if($upgrades_status == "active" && $pay_mode == "recurring"){
                $show_cancel_button = "1";
            }else{
                $show_cancel_button = "0";
            }

            if($sub_info['sub_term'] == 'DAILY')
            {
                $upgrades_term = $lang['DAILY'];
            }
            elseif($sub_info['sub_term'] == 'WEEKLY') {
                $upgrades_term = $lang['WEEKLY'];
            }
            elseif($sub_info['sub_term'] == 'MONTHLY')
            {
                $upgrades_term = $lang['MONTHLY'];
            }
            elseif($sub_info['sub_term'] == 'YEARLY')
            {
                $upgrades_term = $lang['YEARLY'];
            }

            $upgrades_start_date = date("d-m-Y",$info['upgrade_lasttime']);
            $upgrades_expiry_date = date("d-m-Y",$info['upgrade_expires']);


			$page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/membership_current.tpl');
			$page->SetParameter ('OVERALL_HEADER', create_header($lang['UPGRADES']));

            $page->SetParameter ('UPGRADE_ID', $upgrade_id);
            $page->SetParameter ('UPGRADE_TITLE', $upgrades_title);
            $page->SetParameter ('UPGRADE_COST', $upgrades_cost);
            $page->SetParameter ('UPGRADE_STATUS', $upgrades_status);
            $page->SetParameter ('UPGRADE_TERM', $upgrades_term);
            $page->SetParameter ('UPGRADE_START_DATE', $upgrades_start_date);
            $page->SetParameter ('UPGRADE_EXPIRY_DATE', $upgrades_expiry_date);
            $page->SetParameter ('SHOW_CANCEL_BUTTON', $show_cancel_button);

            $page->SetParameter ('MYADS', myads_count($_SESSION['user']['id']));
            $page->SetParameter ('ACTIVEADS', active_ads_count($_SESSION['user']['id']));
            $page->SetParameter ('PENDINGADS', pending_ads_count($_SESSION['user']['id']));
            $page->SetParameter ('HIDDENADS', hidden_ads_count($_SESSION['user']['id']));
            $page->SetParameter ('FAVORITEADS', favorite_ads_count($_SESSION['user']['id']));
            $page->SetParameter ('EXPIREADS', expire_ads_count($_SESSION['user']['id']));
            $page->SetParameter ('RESUBMITADS', resubmited_ads_count($_SESSION['user']['id']));
			$page->SetParameter ('OVERALL_FOOTER', create_footer());
			$page->CreatePageEcho();
			exit;
		}
	}
	else
	{
		$sub_types = array();
        $rows = ORM::for_table($config['db']['pre'].'subscriptions')
            ->where('active', '1')
            ->find_many();

        foreach ($rows as $info)
        {
            $sub_types[$info['sub_id']]['Selected'] = 0;
            $sub_types[$info['sub_id']]['id'] = $info['sub_id'];
            $sub_types[$info['sub_id']]['title'] = $info['sub_title'];
            $sub_types[$info['sub_id']]['recommended'] = $info['recommended'];
            $sub_types[$info['sub_id']]['cost'] = $info['sub_amount'];
            $sub_types[$info['sub_id']]['pay_mode'] = $info['pay_mode'];

            if($info['sub_term'] == 'DAILY')
            {
                $sub_types[$info['sub_id']]['term'] = $lang['DAILY'];
            }
            elseif($info['sub_term'] == 'WEEKLY')
            {
                $sub_types[$info['sub_id']]['term'] = $lang['WEEKLY'];
            }
            elseif($info['sub_term'] == 'MONTHLY')
            {
                $sub_types[$info['sub_id']]['term'] = $lang['MONTHLY'];
            }
            elseif($info['sub_term'] == 'YEARLY')
            {
                $sub_types[$info['sub_id']]['term'] = $lang['YEARLY'];
            }
            $info2 = ORM::for_table($config['db']['pre'].'usergroups')
                ->where('group_id', $info['group_id'])
                ->find_one();

            $sub_types[$info['sub_id']]['limit'] = ($info2['ad_limit'] == "999")? "Unlimited": $info2['ad_limit'];
            $sub_types[$info['sub_id']]['duration'] = $info2['ad_duration'];
            $sub_types[$info['sub_id']]['featured_fee'] = $info2['featured_project_fee'];
            $sub_types[$info['sub_id']]['urgent_fee'] = $info2['urgent_project_fee'];
            $sub_types[$info['sub_id']]['highlight_fee'] = $info2['highlight_project_fee'];
            $sub_types[$info['sub_id']]['featured_duration'] = $info2['featured_duration'];
            $sub_types[$info['sub_id']]['urgent_duration'] = $info2['urgent_duration'];
            $sub_types[$info['sub_id']]['highlight_duration'] = $info2['highlight_duration'];
            $sub_types[$info['sub_id']]['top_search_result'] = $info2['top_search_result'];
            $sub_types[$info['sub_id']]['show_on_home'] = $info2['show_on_home'];
            $sub_types[$info['sub_id']]['show_in_home_search'] = $info2['show_in_home_search'];
        }

        $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/membership_plan.tpl');
        $page->SetParameter ('OVERALL_HEADER', create_header($lang['UPGRADES']));
        $page->SetLoop ('SUB_TYPES', $sub_types);
        $page->SetParameter ('OVERALL_FOOTER', create_footer());
        $page->CreatePageEcho();

	}
}
else
{
    headerRedirect($link['LOGIN']);
}
?>