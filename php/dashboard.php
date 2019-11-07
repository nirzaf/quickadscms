<?php

if(checkloggedin())
{
    update_lastactive();
    $ses_userdata = get_user_data($_SESSION['user']['username']);

    $author_image = $ses_userdata['image'];
    $author_lastactive = $ses_userdata['lastactive'];
    $author_country = $ses_userdata['country'];
    $updated_at = date('Y-m-d', strtotime(str_replace('-','/', $ses_userdata['updated_at'])));

    $notify_cat = explode(',', $ses_userdata['notify_cat']);
    $category = get_maincategory($notify_cat,"checked");

    if(!isset($_POST['submit']))
    {
        // Output to template
        $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/dashboard.tpl');
        $page->SetParameter ('OVERALL_HEADER', create_header($lang['DASHBOARD']));
        $page->SetLoop ('CATEGORY',$category);
        $page->SetParameter ('RESUBMITADS', resubmited_ads_count($_SESSION['user']['id']));
        $page->SetParameter ('HIDDENADS', hidden_ads_count($_SESSION['user']['id']));
        $page->SetParameter ('PENDINGADS', pending_ads_count($_SESSION['user']['id']));
        $page->SetParameter ('EXPIREADS', expire_ads_count($_SESSION['user']['id']));
        $page->SetParameter ('FAVORITEADS', favorite_ads_count($_SESSION['user']['id']));
        $page->SetParameter ('MYADS', myads_count($_SESSION['user']['id']));
        $page->SetLoop('ERRORS', "");
        $page->SetLoop('COUNTRY', get_country_list($ses_userdata['country']));
        $page->SetParameter ('AUTHORUNAME', ucfirst($ses_userdata['username']));
        $page->SetParameter ('AUTHORNAME', ucfirst($ses_userdata['name']));
        $page->SetParameter ('AUTHORIMG', $author_image);
        $page->SetParameter ('LASTACTIVE', $author_lastactive);
        $page->SetParameter ('EMAIL', $ses_userdata['email']);
        $page->SetParameter ('PHONE', $ses_userdata['phone']);
        $page->SetParameter ('POSTCODE', $ses_userdata['postcode']);
        $page->SetParameter ('ADDRESS', $ses_userdata['address']);
        $page->SetParameter ('CITY', $ses_userdata['city']);
        $page->SetParameter ('COUNTRY', $ses_userdata['country']);

        if(check_user_upgrades($_SESSION['user']['id']))
        {
            $sub_info = get_user_membership_detail($_SESSION['user']['id']);
            $page->SetParameter('SUB_TITLE', $sub_info['sub_title']);
            $page->SetParameter('SUB_IMAGE', $sub_info['sub_image']);
        }else{
            $page->SetParameter('SUB_TITLE','');
            $page->SetParameter('SUB_IMAGE', '');
        }
        $page->SetParameter ('AUTHORTAGLINE', $ses_userdata['tagline']);
        $page->SetParameter ('AUTHORABOUT', $ses_userdata['description']);

        $page->SetParameter ('FACEBOOK', $ses_userdata['facebook']);
        $page->SetParameter ('TWITTER', $ses_userdata['twitter']);
        $page->SetParameter ('GOOGLEPLUS', $ses_userdata['googleplus']);
        $page->SetParameter ('INSTAGRAM', $ses_userdata['instagram']);
        $page->SetParameter ('LINKEDIN', $ses_userdata['linkedin']);
        $page->SetParameter ('YOUTUBE', $ses_userdata['youtube']);
        $page->SetParameter ('UPDATED', $updated_at);
        $page->SetParameter ('WEBSITE', $ses_userdata['website']);
        $page->SetParameter ('NOTIFY', $ses_userdata['notify']);
        $page->SetLoop ('HTMLPAGE', get_html_pages());
        $page->SetParameter('COPYRIGHT_TEXT', get_option("copyright_text"));
        $page->SetParameter ('OVERALL_FOOTER', create_footer());
        $page->CreatePageEcho();
    }
    else{
        $errors = array();
        if(!isset($_POST['heading']))
            $_POST['heading'] = "";
        if(!isset($_POST['content']))
            $_POST['content'] = "";
        if(!isset($_POST['postcode']))
            $_POST['postcode'] = "";
        if(!isset($_POST['city']))
            $_POST['city'] = "";
        if(!isset($_POST['country']))
            $_POST['country'] = "";

        $valid_formats = array("jpg","jpeg","png"); // Valid image formats

        if(!empty($_FILES['avatar']['tmp_name'])) {
            $filename = stripslashes($_FILES['avatar']['name']);
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            //File extension check
            if (in_array($ext, $valid_formats)) {
                $file_avatar = $_FILES["avatar"];
                $path_avatar = "storage/profile/";
                $first_title = $_SESSION['user']['username'];

                if ($author_image != "default_user.png"){
                    $unlink = $author_image;
                    $getAvatar = fileUpload($path_avatar, $file_avatar, "image", $first_title, 225, 225,true, $unlink);
                }
                else{
                    $getAvatar = fileUpload($path_avatar, $file_avatar, "image", $first_title,225, 225,true);
                }

                if ($getAvatar != "") {
                    $avatarName = $getAvatar;
                } else {
                    $errors[]['message'] = "Avatar error: Required JPEG 150x150px image.";
                }
            }
            else {
                $errors[]['message'] = $lang['ONLY_JPG_ALLOW'];
            }
        }
        else{
            $avatarName = $author_image;
        }

        if(count($errors) > 0)
        {

            $page = new HtmlTemplate ('templates/' . $config['tpl_name'] . '/dashboard.tpl');
            $page->SetParameter ('OVERALL_HEADER', create_header($lang,"Dashboard"));
            $page->SetLoop ('CATEGORY',$category);
            $page->SetParameter ('RESUBMITADS', resubmited_ads_count($_SESSION['user']['id']));
            $page->SetParameter ('HIDDENADS', hidden_ads_count($_SESSION['user']['id']));
            $page->SetParameter ('PENDINGADS', pending_ads_count($_SESSION['user']['id']));
            $page->SetParameter ('EXPIREADS', expire_ads_count($_SESSION['user']['id']));
            $page->SetParameter ('FAVORITEADS', favorite_ads_count($_SESSION['user']['id']));
            $page->SetParameter ('MYADS', myads_count($_SESSION['user']['id']));
            $page->SetLoop('ERRORS', $errors);
            $page->SetParameter ('AUTHORUNAME', $_SESSION['user']['username']);
            $page->SetParameter ('AUTHORNAME', $_POST['name']);
            $page->SetParameter ('LASTACTIVE', $author_lastactive);
            $page->SetParameter ('EMAIL', $ses_userdata['email']);
            $page->SetParameter ('PHONE', $_POST['phone']);
            $page->SetParameter ('POSTCODE', $_POST['postcode']);
            $page->SetParameter ('ADDRESS', $_POST['address']);
            $page->SetParameter ('CITY', $_POST['city']);
            $page->SetParameter ('COUNTRY', $_POST['country']);

            $page->SetParameter ('AUTHORTAGLINE', $_POST['heading']);
            $page->SetParameter ('AUTHORABOUT', $_POST['content']);

            $page->SetParameter ('FACEBOOK', $_POST['facebook']);
            $page->SetParameter ('TWITTER', $_POST['twitter']);
            $page->SetParameter ('GOOGLEPLUS', $_POST['googleplus']);
            $page->SetParameter ('INSTAGRAM', $_POST['instagram']);
            $page->SetParameter ('LINKEDIN', $_POST['linkedin']);
            $page->SetParameter ('YOUTUBE', $_POST['youtube']);
            $page->SetParameter ('AUTHORIMG', $author_image);
            $page->SetParameter ('WEBSITE', $_POST['website']);
            $page->SetParameter ('NOTIFY', $_POST['notify']);
            $page->SetLoop ('HTMLPAGE', get_html_pages());
            $page->SetParameter('COPYRIGHT_TEXT', get_option("copyright_text"));
            $page->SetParameter ('OVERALL_FOOTER', create_footer());
            $page->CreatePageEcho();
            exit();
        }
        else{
            $notify = isset($_POST['notify']) ? '1' : '0';
            if (isset($_POST['choice']) && is_array($_POST['choice'])) {
                $choice = validate_input(implode(',', $_POST['choice']));
            }else{
                $choice = '';
            }

            $website_link = addhttp($_POST['website']);
            $now = date("Y-m-d H:i:s");
            $user_update = ORM::for_table($config['db']['pre'].'user')->find_one($_SESSION['user']['id']);
            $user_update->set('name', $_POST['name']);
            $user_update->set('image', $avatarName);
            $user_update->set('tagline', $_POST['heading']);
            $user_update->set('description', $_POST['content']);
            $user_update->set('phone', $_POST['phone']);
            $user_update->set('postcode', $_POST['postcode']);
            $user_update->set('address', $_POST['address']);
            $user_update->set('city', $_POST['city']);
            $user_update->set('country', $_POST['country']);
            $user_update->set('facebook', $_POST['facebook']);
            $user_update->set('twitter', $_POST['twitter']);
            $user_update->set('googleplus', $_POST['googleplus']);
            $user_update->set('instagram', $_POST['instagram']);
            $user_update->set('linkedin', $_POST['linkedin']);
            $user_update->set('youtube', $_POST['youtube']);
            $user_update->set('website', $website_link);
            $user_update->set('notify', $notify);
            $user_update->set('notify_cat', $choice);
            $user_update->set('updated_at', $now);
            $user_update->save();

            ORM::for_table($config['db']['pre'].'notification')
                ->where_equal('user_id', $_SESSION['user']['id'])
                ->delete_many();

            if($notify)
            {
                if(isset($_POST['choice']))
                {
                    foreach ($_POST['choice'] as $key=>$value)
                    {
                        $notification = ORM::for_table($config['db']['pre'].'notification')->create();
                        $notification->user_id = $_SESSION['user']['id'];
                        $notification->cat_id = $key;
                        $notification->user_email = $ses_userdata['email'];
                        $notification->save();
                    }
                }
            }

            transfer($link['DASHBOARD'],'Profile Updated Successfully','Profile Updated Successfully');
            exit;

        }
    }
}
else{
    headerRedirect($link['LOGIN']);
}
?>