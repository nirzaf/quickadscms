<?php
require_once('includes.php');

?>
<style>
    #quickad-tbs .note-toolbar.panel-heading {
        padding: 0 10px 5px;
    }
</style>
<link href="js/plugins/jqueryui/jquery-ui.min.css" rel="stylesheet">

<!-- Page Content -->
<main class="app-layout-content">

    <!-- Page Content -->
    <div class="container-fluid p-y-md">
        <!-- Partial Table -->
        <div class="card">
            <div class="card-header">
                <h4>Email Notifications</h4>
                <div class="pull-right">
                    <a class="btn btn-sm btn-warning" href="setting.php#quickad_email">Email Configuration Setting</a>
                </div>
            </div>

            <div class="card-block">
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <form method="post" action="ajax_sidepanel.php?action=saveEmailTemplate" id="saveEmailTemplate">
                                <div class="panel panel-default quickad-main">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email_template">E-mail Content Type </label>
                                                    <p class="help-block">Text-plain or HTML content chooser.</p>
                                                    <div>
                                                        <select name="email_template" id="email_template" class="form-control">
                                                            <option <?php if(get_option("email_template") == '0'){ echo "selected"; } ?> value="0">HTML</option>
                                                            <option <?php if(get_option("email_template") == '1'){ echo "selected"; } ?> value="1">Text</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="quickad-tbs" class="wrap">
                                            <div class="quickad-tbs-body">
                                                <div class="panel panel-default quickad-main">
                                                    <div class="panel-body">
                                                        <h4 class="quickad-block-head">
                                                            <span class="quickad-category-title">Email Template</span>
                                                        </h4>
                                                        <div class="quickad-margin-top-xlg">
                                                            <div class="panel-group">
                                                                <!--0.Create Account Details Email-->
                                                                <div class="panel panel-default quickad-js-collapse">
                                                                    <div class="panel-heading" role="tab" id="s_1">
                                                                        <div class="row">
                                                                            <div class="col-sm-8 col-xs-10">
                                                                                <div class="quickad-flexbox">
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%">
                                                                                        <i class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move ui-sortable-handle" title="Reorder" style="display: none;"></i>
                                                                                    </div>
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle">
                                                                                        <a role="button" class="panel-title quickad-js-service-title collapsed" data-toggle="collapse" data-parent=".panel-group" href="#service_0" aria-expanded="false" aria-controls="service_1">
                                                                                            User account details email </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="service_0" class="panel-collapse collapse" role="tabpanel" style="height: 0px;" aria-expanded="false">
                                                                        <div class="panel-body">

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Subject</label>
                                                                                        <input name="email_sub_signup_details" placeholder="Email Subject" class="form-control" type="text" value="<?php echo get_option("email_sub_signup_details") ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mailMethods mailMethod-0" <?php if($config['email_template'] != '0'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_editor_signup_details" rows="6" class="form-control summernote" placeholder="Enter Message"><?php echo get_option("email_message_signup_details") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mailMethods mailMethod-1" <?php if($config['email_template'] != '1'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_textarea_signup_details" rows="10" class="form-control" placeholder="Enter Message"><?php echo get_option("email_message_signup_details") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Short Codes</label>
                                                                                        <table class="quickad-codes">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td><input value="{USER_FULLNAME}" readonly="readonly" onclick="this.select()">- User Full Name</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{USERNAME}" readonly="readonly" onclick="this.select()">- Username</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{PASSWORD}" readonly="readonly" onclick="this.select()">- Passwrod</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{USER_ID}" readonly="readonly" onclick="this.select()">- User unique id</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{EMAIL}" readonly="readonly" onclick="this.select()">- User E-mail</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_TITLE}" readonly="readonly" onclick="this.select()">- Website Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_URL}" readonly="readonly" onclick="this.select()">- Website URL</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Language Shortcode find from this link. <a href="language_file.php?file=english" target="_blank"/>Click here</td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--0.Create Account Details Email-->

                                                                <!--1.Create Account Confirmation Email-->
                                                                <div class="panel panel-default quickad-js-collapse">
                                                                    <div class="panel-heading" role="tab" id="s_1">
                                                                        <div class="row">
                                                                            <div class="col-sm-8 col-xs-10">
                                                                                <div class="quickad-flexbox">
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%">
                                                                                        <i class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move ui-sortable-handle" title="Reorder" style="display: none;"></i>
                                                                                    </div>
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle">
                                                                                        <a role="button" class="panel-title quickad-js-service-title collapsed" data-toggle="collapse" data-parent=".panel-group" href="#service_1" aria-expanded="false" aria-controls="service_1">
                                                                                            Create account confirmation email </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="service_1" class="panel-collapse collapse" role="tabpanel" style="height: 0px;" aria-expanded="false">
                                                                        <div class="panel-body">

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Subject</label>
                                                                                        <input name="email_sub_signup_confirm" placeholder="Email Subject" class="form-control" type="text" value="<?php echo get_option("email_sub_signup_confirm") ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mailMethods mailMethod-0" <?php if($config['email_template'] != '0'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_editor_signup_confirm" rows="6" class="form-control summernote" placeholder="Enter Message"><?php echo get_option("email_message_signup_confirm") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mailMethods mailMethod-1" <?php if($config['email_template'] != '1'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_textarea_signup_confirm" rows="10" class="form-control" placeholder="Enter Message"><?php echo get_option("email_message_signup_confirm") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Short Codes</label>
                                                                                        <table class="quickad-codes">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td><input value="{USER_FULLNAME}" readonly="readonly" onclick="this.select()">- User Full Name</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{USERNAME}" readonly="readonly" onclick="this.select()">- Username</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{USER_ID}" readonly="readonly" onclick="this.select()">- User unique id</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{EMAIL}" readonly="readonly" onclick="this.select()">- User E-mail</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_TITLE}" readonly="readonly" onclick="this.select()">- Website Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_URL}" readonly="readonly" onclick="this.select()">- Website URL</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{CONFIRMATION_LINK}" readonly="readonly" onclick="this.select()">- Registration Confirmation Link</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{LANG_EMAILCONFIRM}" readonly="readonly" onclick="this.select()">- Email Confirmation</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Language Shortcode find from this link. <a href="language_file.php?file=english" target="_blank"/>Click here</td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--1.Create Account Confirmation Email-->

                                                                <!--2.Forgot Password Email-->
                                                                <div class="panel panel-default quickad-js-collapse">
                                                                    <div class="panel-heading" role="tab" id="s_2">
                                                                        <div class="row">
                                                                            <div class="col-sm-8 col-xs-10">
                                                                                <div class="quickad-flexbox">
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%">
                                                                                        <i class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move ui-sortable-handle" title="Reorder" style="display: none;"></i>
                                                                                    </div>
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle">
                                                                                        <a role="button" class="panel-title quickad-js-service-title collapsed" data-toggle="collapse" data-parent=".panel-group" href="#service_2" aria-expanded="false" aria-controls="service_2">
                                                                                            Forgot Password Email </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="service_2" class="panel-collapse collapse" role="tabpanel" style="height: 0px;" aria-expanded="false">
                                                                        <div class="panel-body">

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Subject</label>
                                                                                        <input name="email_sub_forgot_pass" placeholder="Email Subject" class="form-control" type="text" value="<?php echo get_option("email_sub_forgot_pass") ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mailMethods mailMethod-0" <?php if($config['email_template'] != '0'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_editor_forgot_pass" rows="6" class="form-control summernote" placeholder="Enter Message"><?php echo get_option("email_message_forgot_pass") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mailMethods mailMethod-1" <?php if($config['email_template'] != '1'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_textarea_forgot_pass" rows="10" class="form-control" placeholder="Enter Message"><?php echo get_option("email_message_forgot_pass") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Short Codes</label>
                                                                                        <table
                                                                                            class="quickad-codes">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td><input value="{USER_FULLNAME}" readonly="readonly" onclick="this.select()">- User Fullname</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{EMAIL}" readonly="readonly" onclick="this.select()">- User E-mail</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_TITLE}" readonly="readonly" onclick="this.select()">- Website Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_URL}" readonly="readonly" onclick="this.select()">- Website URL</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{FORGET_PASSWORD_LINK}" readonly="readonly" onclick="this.select()">- Forgot password reset link</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{LANG_FORGOTPASS}" readonly="readonly" onclick="this.select()">- Forgot Password</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Language Shortcode find from this link. <a href="language_file.php?file=english" target="_blank"/>Click here</td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--2.Forgot Password Email-->

                                                                <!--3.Contact Us Email-->
                                                                <div class="panel panel-default quickad-js-collapse">
                                                                    <div class="panel-heading" role="tab" id="s_3">
                                                                        <div class="row">
                                                                            <div class="col-sm-8 col-xs-10">
                                                                                <div class="quickad-flexbox">
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%">
                                                                                        <i class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move ui-sortable-handle" title="Reorder" style="display: none;"></i>
                                                                                    </div>
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle">
                                                                                        <a role="button" class="panel-title quickad-js-service-title collapsed" data-toggle="collapse" data-parent=".panel-group" href="#service_3" aria-expanded="false" aria-controls="service_3">
                                                                                            Contact Us Email </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="service_3" class="panel-collapse collapse" role="tabpanel" style="height: 0px;" aria-expanded="false">
                                                                        <div class="panel-body">

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Subject</label>
                                                                                        <input name="email_sub_contact" placeholder="Email Subject" class="form-control" type="text" value="<?php echo get_option("email_sub_contact") ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mailMethods mailMethod-0" <?php if($config['email_template'] != '0'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_editor_contact" rows="6" class="form-control summernote" placeholder="Enter Message"><?php echo get_option("email_message_contact") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mailMethods mailMethod-1" <?php if($config['email_template'] != '1'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_textarea_contact" rows="10" class="form-control" placeholder="Enter Message"><?php echo get_option("email_message_contact") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Short Codes</label>
                                                                                        <table
                                                                                            class="quickad-codes">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td><input value="{CONTACT_SUBJECT}" readonly="readonly" onclick="this.select()">- Contact email subject</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{NAME}" readonly="readonly" onclick="this.select()">- User Full Name</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{EMAIL}" readonly="readonly" onclick="this.select()">- User Email</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{MESSAGE}" readonly="readonly" onclick="this.select()">- Message</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_TITLE}" readonly="readonly" onclick="this.select()">- Website Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_URL}" readonly="readonly" onclick="this.select()">- Website URL</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{LANG_CONTACT_SUBJECT_START}" readonly="readonly" onclick="this.select()">- Website Email:</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Language Shortcode find from this link. <a href="language_file.php?file=english" target="_blank"/>Click here</td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--3.Contact Us Email-->

                                                                <!--4.Feedback Email-->
                                                                <div class="panel panel-default quickad-js-collapse">
                                                                    <div class="panel-heading" role="tab" id="s_4">
                                                                        <div class="row">
                                                                            <div class="col-sm-8 col-xs-10">
                                                                                <div class="quickad-flexbox">
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%">
                                                                                        <i class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move ui-sortable-handle" title="Reorder" style="display: none;"></i>
                                                                                    </div>
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle">
                                                                                        <a role="button" class="panel-title quickad-js-service-title collapsed" data-toggle="collapse" data-parent=".panel-group" href="#service_4" aria-expanded="false" aria-controls="service_4">
                                                                                            Feedback Email </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="service_4" class="panel-collapse collapse" role="tabpanel" style="height: 0px;" aria-expanded="false">
                                                                        <div class="panel-body">

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Subject</label>
                                                                                        <input name="email_sub_feedback" placeholder="Email Subject" class="form-control" type="text" value="<?php echo get_option("email_sub_feedback") ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mailMethods mailMethod-0" <?php if($config['email_template'] != '0'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_editor_feedback" rows="6" class="form-control summernote" placeholder="Enter Message"><?php echo get_option("email_message_feedback") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mailMethods mailMethod-1" <?php if($config['email_template'] != '1'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_textarea_feedback" rows="10" class="form-control" placeholder="Enter Message"><?php echo get_option("email_message_feedback") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Short Codes</label>
                                                                                        <table
                                                                                            class="quickad-codes">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td><input value="{FEEDBACK_SUBJECT}" readonly="readonly" onclick="this.select()">- Feedback email subject</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{NAME}" readonly="readonly" onclick="this.select()">- User Full Name</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{EMAIL}" readonly="readonly" onclick="this.select()">- User Email</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{PHONE}" readonly="readonly" onclick="this.select()">- User Phone Mumber</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{MESSAGE}" readonly="readonly" onclick="this.select()">- Message</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_TITLE}" readonly="readonly" onclick="this.select()">- Website Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_URL}" readonly="readonly" onclick="this.select()">- Website URL</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{FORGET_PASSWORD_LINK}" readonly="readonly" onclick="this.select()">- Forgot password reset link</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{LANG_SEND-FEEDBACK}" readonly="readonly" onclick="this.select()">- Send a feedback:</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Language Shortcode find from this link. <a href="language_file.php?file=english" target="_blank"/>Click here</td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--4.Feedback Email-->

                                                                <!--5.Report Email-->
                                                                <div class="panel panel-default quickad-js-collapse">
                                                                    <div class="panel-heading" role="tab" id="s_5">
                                                                        <div class="row">
                                                                            <div class="col-sm-8 col-xs-10">
                                                                                <div class="quickad-flexbox">
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%">
                                                                                        <i class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move ui-sortable-handle" title="Reorder" style="display: none;"></i>
                                                                                    </div>
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle">
                                                                                        <a role="button" class="panel-title quickad-js-service-title collapsed" data-toggle="collapse" data-parent=".panel-group" href="#service_5" aria-expanded="false" aria-controls="service_5">
                                                                                            Report Email </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="service_5" class="panel-collapse collapse" role="tabpanel" style="height: 0px;" aria-expanded="false">
                                                                        <div class="panel-body">

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Subject</label>
                                                                                        <input name="email_sub_report" placeholder="Email Subject" class="form-control" type="text" value="<?php echo get_option("email_sub_report") ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mailMethods mailMethod-0" <?php if($config['email_template'] != '0'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_editor_report" rows="6" class="form-control summernote" placeholder="Enter Message"><?php echo get_option("email_message_report") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mailMethods mailMethod-1" <?php if($config['email_template'] != '1'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_textarea_report" rows="10" class="form-control" placeholder="Enter Message"><?php echo get_option("email_message_report") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Short Codes</label>
                                                                                        <table
                                                                                            class="quickad-codes">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td><input value="{NAME}" readonly="readonly" onclick="this.select()">- Sender Full Name</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{EMAIL}" readonly="readonly" onclick="this.select()">- Sender Email</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{USERNAME}" readonly="readonly" onclick="this.select()">- Sender Username</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{USERNAME2}" readonly="readonly" onclick="this.select()">- Violator Username</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{VIOLATION}" readonly="readonly" onclick="this.select()">- Violation subject</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{URL}" readonly="readonly" onclick="this.select()">- Violation URL(LINK)</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{DETAILS}" readonly="readonly" onclick="this.select()">- Violation Message</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_TITLE}" readonly="readonly" onclick="this.select()">- Website Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_URL}" readonly="readonly" onclick="this.select()">- Website URL</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{FORGET_PASSWORD_LINK}" readonly="readonly" onclick="this.select()">- Forgot password reset link</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{LANG_REPORTVIO}" readonly="readonly" onclick="this.select()">- Report Violation</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Language Shortcode find from this link. <a href="language_file.php?file=english" target="_blank"/>Click here</td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--5.Report Email-->

                                                                <!--6.Ad Approve Email-->
                                                                <div class="panel panel-default quickad-js-collapse">
                                                                    <div class="panel-heading" role="tab" id="s_6">
                                                                        <div class="row">
                                                                            <div class="col-sm-8 col-xs-10">
                                                                                <div class="quickad-flexbox">
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%">
                                                                                        <i class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move ui-sortable-handle" title="Reorder" style="display: none;"></i>
                                                                                    </div>
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle">
                                                                                        <a role="button" class="panel-title quickad-js-service-title collapsed" data-toggle="collapse" data-parent=".panel-group" href="#service_6" aria-expanded="false" aria-controls="service_6">
                                                                                            Ad Approve Email </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="service_6" class="panel-collapse collapse" role="tabpanel" style="height: 0px;" aria-expanded="false">
                                                                        <div class="panel-body">

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Subject</label>
                                                                                        <input name="email_sub_ad_approve" placeholder="Email Subject" class="form-control" type="text" value="<?php echo get_option("email_sub_ad_approve") ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mailMethods mailMethod-0" <?php if($config['email_template'] != '0'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_editor_ad_approve" rows="6" class="form-control summernote" placeholder="Enter Message"><?php echo get_option("email_message_ad_approve") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mailMethods mailMethod-1" <?php if($config['email_template'] != '1'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_textarea_ad_approve" rows="10" class="form-control" placeholder="Enter Message"><?php echo get_option("email_message_ad_approve") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Short Codes</label>
                                                                                        <table
                                                                                            class="quickad-codes">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td><input value="{SELLER_NAME}" readonly="readonly" onclick="this.select()">- Seller Full Name</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SELLER_EMAIL}" readonly="readonly" onclick="this.select()">- Seller Email</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{ADTITLE}" readonly="readonly" onclick="this.select()">- Ad Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{ADLINK}" readonly="readonly" onclick="this.select()">- Ad Link</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_TITLE}" readonly="readonly" onclick="this.select()">- Website Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_URL}" readonly="readonly" onclick="this.select()">- Website URL</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Language Shortcode find from this link. <a href="language_file.php?file=english" target="_blank"/>Click here</td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--6.Ad Approve Email-->

                                                                <!--7.Re-submit Ad Approve Email-->
                                                                <div class="panel panel-default quickad-js-collapse">
                                                                    <div class="panel-heading" role="tab" id="s_7">
                                                                        <div class="row">
                                                                            <div class="col-sm-8 col-xs-10">
                                                                                <div class="quickad-flexbox">
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%">
                                                                                        <i class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move ui-sortable-handle" title="Reorder" style="display: none;"></i>
                                                                                    </div>
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle">
                                                                                        <a role="button" class="panel-title quickad-js-service-title collapsed" data-toggle="collapse" data-parent=".panel-group" href="#service_7" aria-expanded="false" aria-controls="service_7">
                                                                                            Re-submit Ad Approve Email </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="service_7" class="panel-collapse collapse" role="tabpanel" style="height: 0px;" aria-expanded="false">
                                                                        <div class="panel-body">

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Subject</label>
                                                                                        <input name="email_sub_re_ad_approve" placeholder="Email Subject" class="form-control" type="text" value="<?php echo get_option("email_sub_re_ad_approve") ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mailMethods mailMethod-0" <?php if($config['email_template'] != '0'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_editor_re_ad_approve" rows="6" class="form-control summernote" placeholder="Enter Message"><?php echo get_option("email_message_re_ad_approve") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mailMethods mailMethod-1" <?php if($config['email_template'] != '1'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_textarea_re_ad_approve" rows="10" class="form-control" placeholder="Enter Message"><?php echo get_option("email_message_re_ad_approve") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Short Codes</label>
                                                                                        <table
                                                                                            class="quickad-codes">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td><input value="{SELLER_NAME}" readonly="readonly" onclick="this.select()">- Seller Full Name</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SELLER_EMAIL}" readonly="readonly" onclick="this.select()">- Seller Email</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{ADTITLE}" readonly="readonly" onclick="this.select()">- Ad Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{ADLINK}" readonly="readonly" onclick="this.select()">- Ad Link</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_TITLE}" readonly="readonly" onclick="this.select()">- Website Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_URL}" readonly="readonly" onclick="this.select()">- Website URL</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Language Shortcode find from this link. <a href="language_file.php?file=english" target="_blank"/>Click here</td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--7.Re-submit Ad Approve Email-->

                                                                <!--8.contact_seller to seller Email-->
                                                                <div class="panel panel-default quickad-js-collapse">
                                                                    <div class="panel-heading" role="tab" id="s_8">
                                                                        <div class="row">
                                                                            <div class="col-sm-8 col-xs-10">
                                                                                <div class="quickad-flexbox">
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%">
                                                                                        <i class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move ui-sortable-handle" title="Reorder" style="display: none;"></i>
                                                                                    </div>
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle">
                                                                                        <a role="button" class="panel-title quickad-js-service-title collapsed" data-toggle="collapse" data-parent=".panel-group" href="#service_8" aria-expanded="false" aria-controls="service_8">
                                                                                            Contact to seller Email </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="service_8" class="panel-collapse collapse" role="tabpanel" style="height: 0px;" aria-expanded="false">
                                                                        <div class="panel-body">

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Subject</label>
                                                                                        <input name="email_sub_contact_seller" placeholder="Email Subject" class="form-control" type="text" value="<?php echo get_option("email_sub_contact_seller") ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mailMethods mailMethod-0" <?php if($config['email_template'] != '0'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_editor_contact_seller" rows="6" class="form-control summernote" placeholder="Enter Message"><?php echo get_option("email_message_contact_seller") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mailMethods mailMethod-1" <?php if($config['email_template'] != '1'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_textarea_contact_seller" rows="10" class="form-control" placeholder="Enter Message"><?php echo get_option("email_message_contact_seller") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Short Codes</label>
                                                                                        <table
                                                                                            class="quickad-codes">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td><input value="{ADTITLE}" readonly="readonly" onclick="this.select()">- Ad Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{ADLINK}" readonly="readonly" onclick="this.select()">- Ad Link</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SELLER_NAME}" readonly="readonly" onclick="this.select()">- Seller Full Name</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SELLER_EMAIL}" readonly="readonly" onclick="this.select()">- Seller Email</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SENDER_NAME}" readonly="readonly" onclick="this.select()">- Sender Full Name</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SENDER_EMAIL}" readonly="readonly" onclick="this.select()">- Sender Email</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SENDER_PHONE}" readonly="readonly" onclick="this.select()">- Sender Phone</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{MESSAGE}" readonly="readonly" onclick="this.select()">- Sender Message</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_TITLE}" readonly="readonly" onclick="this.select()">- Website Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_URL}" readonly="readonly" onclick="this.select()">- Website URL</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Language Shortcode find from this link. <a href="language_file.php?file=english" target="_blank"/>Click here</td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--8.Contact to seller Email-->

                                                                <!--9.Send new ad notification to subscriber-->
                                                                <div class="panel panel-default quickad-js-collapse">
                                                                    <div class="panel-heading" role="tab" id="s_9">
                                                                        <div class="row">
                                                                            <div class="col-sm-8 col-xs-10">
                                                                                <div class="quickad-flexbox">
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%">
                                                                                        <i class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move ui-sortable-handle" title="Reorder" style="display: none;"></i>
                                                                                    </div>
                                                                                    <div class="quickad-flex-cell quickad-vertical-middle">
                                                                                        <a role="button" class="panel-title quickad-js-service-title collapsed" data-toggle="collapse" data-parent=".panel-group" href="#service_9" aria-expanded="false" aria-controls="service_9">
                                                                                            Send new ad notification to subscriber </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="service_9" class="panel-collapse collapse" role="tabpanel" style="height: 0px;" aria-expanded="false">
                                                                        <div class="panel-body">

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Subject</label>
                                                                                        <input name="email_sub_post_notification" placeholder="Email Subject" class="form-control" type="text" value="<?php echo get_option("email_sub_post_notification") ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mailMethods mailMethod-9" <?php if($config['email_template'] != '0'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_editor_post_notification" rows="6" class="form-control summernote" placeholder="Enter Message"><?php echo get_option("email_message_post_notification") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mailMethods mailMethod-9" <?php if($config['email_template'] != '1'){ echo 'style="display: none;"'; } ?>>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="pageContent">Message</label>
                                                                                        <textarea name="email_message_textarea_post_notification" rows="10" class="form-control" placeholder="Enter Message"><?php echo get_option("email_message_post_notification") ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Short Codes</label>
                                                                                        <table class="quickad-codes">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_TITLE}" readonly="readonly" onclick="this.select()">- Website Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{SITE_URL}" readonly="readonly" onclick="this.select()">- Website URL</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{ADTITLE}" readonly="readonly" onclick="this.select()">- Ad Title</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{ADLINK}" readonly="readonly" onclick="this.select()">- Ad Link</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><input value="{LANG_ADNOTICE}" readonly="readonly" onclick="this.select()">- Ad Notification</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Language Shortcode find from this link. <a href="language_file.php?file=english" target="_blank"/>Click here</td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--9.Send new ad notification to subscriber-->

                                                                <div class="panel-footer">
                                                                    <div class="pull-left">
                                                                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#test-email-notification">Test Email Notifications</button>
                                                                    </div>
                                                                    <button name="email_setting" type="submit" class="btn btn-success btn-radius save-changes">Save</button>
                                                                    <button class="btn btn-default" type="reset">Reset</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- .card-block -->
        </div>
        <!-- .card -->
        <!-- End Partial Table -->

    </div>
    <!-- .container-fluid -->
    <!-- End Page Content -->

</main>


<div class="modal fade" tabindex=-1 role="dialog" id="test-email-notification">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="test_notification_send" action="ajax_sidepanel.php?action=testEmailTemplate" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <div class="modal-title">Test Email Notifications</div>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="test_to_name">To name</label>
                                <input id="test_to_name" name="test_to_name" class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="test_to_email">To email</label>
                                <input id="test_to_email" name="test_to_email" class="form-control" type="text"/>
                            </div>
                        </div>
                    </div>

                    <div id="quickad-tbs">
                        <div class="btn-group quickad-margin-bottom-lg quickad-services-holder">
                            <button class="btn btn-default btn-block dropdown-toggle quickad-flexbox" data-toggle="dropdown">
                                <div class="quickad-flex-cell text-left" style="width: 100%">Notification templates (10)</div>
                                <div class="quickad-flex-cell">
                                    <div class="quickad-margin-left-md"><span class="caret"></span></div>
                                </div>
                            </button>
                            <ul class="dropdown-menu" style="width: 570px">
                                <li class="quickad-padding-horizontal-md">
                                    <a class="checkbox checkbox-success"  href="#">
                                        <input type="checkbox" class="quickad-check-all-entities" value="any" id="all-template">
                                        <label for="all-template">All templates </label>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li class="quickad-padding-horizontal-md">
                                    <a class="checkbox checkbox-success" href="#">
                                        <input type="checkbox" class="quickad-js-check-entity" value="any" id="signup-details" name="signup-details">
                                        <label for="signup-details">Signup account details email </label>
                                    </a>
                                </li>
                                <li class="quickad-padding-horizontal-md">
                                    <a class="checkbox checkbox-success"  href="#">
                                        <input type="checkbox" class="quickad-js-check-entity" value="any" id="create-account" name="create-account">
                                        <label for="create-account">Create account confirmation email </label>
                                    </a>
                                </li>
                                <li class="quickad-padding-horizontal-md">
                                    <a class="checkbox checkbox-success"  href="#">
                                        <input type="checkbox" class="quickad-js-check-entity" value="any" id="forgot-pass" name="forgot-pass">
                                        <label for="forgot-pass">Forgot Password Email </label>
                                    </a>
                                </li>
                                <li class="quickad-padding-horizontal-md">
                                    <a class="checkbox checkbox-success"  href="#">
                                        <input type="checkbox" class="quickad-js-check-entity" value="any" id="contact_us" name="contact_us">
                                        <label for="contact_us">	Contact Us Email</label>
                                    </a>
                                </li>
                                <li class="quickad-padding-horizontal-md">
                                    <a class="checkbox checkbox-success"  href="#">
                                        <input type="checkbox" class="quickad-js-check-entity" value="any" id="feedback" name="feedback">
                                        <label for="feedback">	Feedback Email</label>
                                    </a>
                                </li>
                                <li class="quickad-padding-horizontal-md">
                                    <a class="checkbox checkbox-success"  href="#">
                                        <input type="checkbox" class="quickad-js-check-entity" value="any" id="report" name="report">
                                        <label for="report"> Report Email</label>
                                    </a>
                                </li>
                                <li class="quickad-padding-horizontal-md">
                                    <a class="checkbox checkbox-success"  href="#">
                                        <input type="checkbox" class="quickad-js-check-entity" value="any" id="ad_approve" name="ad_approve">
                                        <label for="ad_approve"> Ad Approve Email</label>
                                    </a>
                                </li>
                                <li class="quickad-padding-horizontal-md">
                                    <a class="checkbox checkbox-success"  href="#">
                                        <input type="checkbox" class="quickad-js-check-entity" value="any" id="re_ad_approve" name="re_ad_approve">
                                        <label for="re_ad_approve">	Re-submit Ad Approve Email</label>
                                    </a>
                                </li>
                                <li class="quickad-padding-horizontal-md">
                                    <a class="checkbox checkbox-success"  href="#">
                                        <input type="checkbox" class="quickad-js-check-entity" value="any" id="contact_to_seller" name="contact_to_seller">
                                        <label for="contact_to_seller">	Contact to seller Email</label>
                                    </a>
                                </li>
                                <li class="quickad-padding-horizontal-md">
                                    <a class="checkbox checkbox-success"  href="#">
                                        <input type="checkbox" class="quickad-js-check-entity" value="any" id="ad_newsletter" name="ad_newsletter">
                                        <label for="ad_newsletter">	Send new ad notification to subscriber</label>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="test-email-notification" class="btn btn-lg btn-success ladda-button" data-style="zoom-in"
                            data-spinner-size="40"><span class="ladda-label">Send</span></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php include("footer.php"); ?>

<script>
    $(".save-changes").click(function(){
        $(".save-changes").addClass("bookme-progress");
    });
    $(".ladda-button").click(function(){
        $(".ladda-button").addClass("bookme-progress");
    });
    /* Mail Method Changer */
    $("#email_template").on('change',function(){
        $(".mailMethods").hide();
        $(".mailMethod-"+$(this).val()).show();
    });

    $(document).on('change', '.quickad-check-all-entities', function () {
        $(this).parents('.quickad-services-holder').find('.quickad-js-check-entity').prop('checked', $(this).prop('checked'));
    });
    // wait for the DOM to be loaded
    $(document).ready(function() {
        // bind 'myForm' and provide a simple callback function
        $('#saveEmailTemplate').ajaxForm(function(data) {
            if (data == 0) {
                alertify.error("Unknown Error generated.");
            } else {
                data = JSON.parse(data);
                if (data.status == "success") {
                    alertify.success(data.message);
                }
                else {
                    alertify.error(data.message);
                }
            }
            $(".save-changes").removeClass('bookme-progress');
        });
    });

    // Test Notification send ajax
    $(document).ready(function() {
        // bind 'myForm' and provide a simple callback function
        $('#test_notification_send').ajaxForm(function(data) {
            if (data == 0) {
                alertify.error("Unknown Error generated.");
            } else {
                data = JSON.parse(data);
                if (data.status == "success") {
                    alertify.success(data.message);
                }
                else {
                    alertify.error(data.message);
                }
            }
            $(".ladda-button").removeClass('bookme-progress');
        });
    });
</script>
<!-- include summernote css/js -->
<link href="assets/js/plugins/summernote/summernote.css" rel="stylesheet">
<script src="assets/js/plugins/summernote/summernote.js"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            tabsize: 2,
            height: 250
        });
    });
</script>
</body>
</html>
