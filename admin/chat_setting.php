<?php
require_once('includes.php');
$message = "";

if(isset($_POST['update']))
{
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

        function install_chat_setting($code){
            global $config;
            // Set API Key
            $buyer_email = '';
            $installing_version = 'pro';
            $site_url = $config['site_url'];

            $url = "https://bylancer.com/api/api.php?verify-purchase=" . $code . "&version=" . $installing_version . "&site_url=" . $site_url . "&email=" . $buyer_email;
            // Open cURL channel
            $ch = curl_init();

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            //Set the user agent
            $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
            curl_setopt($ch, CURLOPT_USERAGENT, $agent);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
            // Decode returned JSON
            $output = json_decode(curl_exec($ch), true);
            // Close Channel
            curl_close($ch);

            return $output;
        }

        if(isset($_POST['zechat_on_off'])){
            $zechat_purchase = get_option("zechat_purchase_code");
            if($zechat_purchase == NULL) {
                $message .= '<span style="color:red;">( Enter Your Valid Zechat Purchase Code.)</span>';
            }
            else{
                update_option("zechat_on_off",$_POST['zechat_on_off']);
            }
        }
        else{
            update_option("zechat_on_off","off");
        }

        if(isset($_POST['wchat_on_off'])){
            $wchat_purchase = get_option("wchat_purchase_code");
            if($wchat_purchase == "") {
                $message .= '<span style="color:red;">( Enter Your Valid Wchat Purchase Code.)</span>';
            }
            else{
                update_option("wchat_on_off",$_POST['wchat_on_off']);
            }
        }
        else{
            update_option("wchat_on_off","off");
        }

        if(isset($_POST['zechat_purchase_code'])){
            if($_POST['zechat_purchase_code'] != "") {
                $purchase_data = verify_envato_purchase_code($_POST['zechat_purchase_code']);
                if(isset($purchase_data['verify-purchase']['buyer']) )
                {
                    if($purchase_data['verify-purchase']['item_id'] == '16491266'){
                        $code = $_POST['zechat_purchase_code'];
                        $output = install_chat_setting($code);

                        if ($output['success']) {
                            if(isset($config['zechat_secret_file']) && $config['zechat_secret_file'] != ""){
                                $fileName = $config['zechat_secret_file'];
                            }else{
                                $fileName = get_random_string();
                            }
                            file_put_contents('../plugins/zechat/' . $fileName . '.php', $output['data']);
                            $success = true;
                            update_option("zechat_secret_file",$fileName);
                            update_option("zechat_purchase_code",$_POST['zechat_purchase_code']);
                            $message = 'Zechat Purchase code verified successfully';
                            transfer("chat_setting.php",$message);
                            exit;
                        } else {
                            $error = $output['error'];
                            $message .= '<span style="color:red;">'.$error.'</span>';
                        }

                    }else{
                        $message .= '<span style="color:red;">( Invalid Zechat Purchase Code.)</span>';
                    }
                }
                else{
                    $message .= '<span style="color:red;">( Enter Your Valid Zechat Purchase Code.)</span>';
                }


            }
        }

        if(isset($_POST['wchat_purchase_code'])){
            if($_POST['wchat_purchase_code'] != "") {

                $purchase_data = verify_envato_purchase_code($_POST['wchat_purchase_code']);
                if(isset($purchase_data['verify-purchase']['buyer']) )
                {
                    if($purchase_data['verify-purchase']['item_id'] == '18047319'){
                        $code = $_POST['wchat_purchase_code'];
                        $output = install_chat_setting($code);

                        if ($output['success']) {
                            if(isset($config['wchat_secret_file']) && $config['wchat_secret_file'] != ""){
                                $fileName = $config['wchat_secret_file'];
                            }else{
                                $fileName = get_random_string();
                            }
                            file_put_contents('../plugins/wchat/' . $fileName . '.php', $output['data']);
                            $success = true;
                            update_option("wchat_secret_file",$fileName);
                            update_option("wchat_purchase_code",$_POST['wchat_purchase_code']);
                            $message = 'Wchat Purchase code verified successfully';
                            transfer("chat_setting.php",$message);
                            exit;
                        } else {
                            $error = $output['error'];
                            $message .= '<span style="color:red;">'.$error.'</span>';
                        }
                    }else{
                        $message .= '<span style="color:red;">( Invalid Wchat Purchase Code.)</span>';
                    }
                }
                else{
                    $message .= '<span style="color:red;">( Enter Your Valid Wchat Purchase Code.)</span>';
                }
            }
        }
    }
}

?>
<main class="app-layout-content">

    <!-- Page Content -->
    <div class="container-fluid p-y-md">
        <!-- Partial Table -->
        <div class="card">
            <div class="card-header">
                <h4>Chat Setting</h4>
            </div>
            <div class="card-block">
                <form name="form2" class="form form-horizontal" method="post" action="" id="send2">
                    <div class="form-body">
                        <div>
                            <div class="text-left"><?php echo $message; ?></div>
                        </div>
                        <!-- CSS Switches -->
                        <!-- They are native checkboxes styled with CSS, JavaScript code is not used. You can enable/disable/toggle them as usual. -->
                        <?php
                        if(isset($config['zechat_purchase_code']) && $config['zechat_purchase_code'] != ""){
                            ?>
                            <div class="form-group bt-switch">
                                <label class="col-sm-4 control-label">Zechat on/off:</label>
                                <div class="col-sm-6">
                                    <label class="css-input switch switch-success">
                                        <input  name="zechat_on_off" type="checkbox" <?php if (get_option("zechat_on_off") == 'on') { echo "checked"; } ?> /><span></span>
                                    </label>

                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Zechat Purchase Code:</label>
                            <div class="col-sm-6">
                                <?php
                                if(isset($config['zechat_purchase_code']) && $config['zechat_purchase_code'] != ""){
                                    ?>
                                    <div class="alert alert-success">
                                        <strong>Success!</strong> Zechat Purchase code verified, you can on/off</div>
                                <?php
                                }
                                ?>
                                <input name="zechat_purchase_code" type="password" class="form-control" value="">
                                <span class="font-14"><code style="color: green">Get Purchase code From Here.</code><a href="https://codecanyon.net/item/facebook-style-php-ajax-chat-zechat/16491266?clickthrough_id=16491266&license=regular&open_purchase_for_item_id=16491266&purchasable=source&redirect_back=true&ref=bylancer&utm_source=item_desc_link" target="_blank">Buy Zechat</a></span>
                            </div>
                        </div>


                        <?php
                        if(isset($config['wchat_purchase_code']) && $config['wchat_purchase_code'] != ""){
                            ?>
                            <div class="form-group bt-switch">
                                <label class="col-sm-4 control-label">Wchat on/off:</label>
                                <div class="col-sm-6">
                                    <label class="css-input switch switch-success">
                                        <input  name="wchat_on_off" type="checkbox" <?php if (get_option("wchat_on_off") == 'on') { echo "checked"; } ?> /><span></span>
                                    </label>

                                </div>
                            </div>

                        <?php
                        }
                        ?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Wchat Purchase Code:</label>
                            <div class="col-sm-6">
                                <?php
                                if(isset($config['wchat_purchase_code']) && $config['wchat_purchase_code'] != ""){
                                    ?>
                                    <div class="alert alert-success">
                                        <strong>Success!</strong> Wchat Purchase code verified, you can on/off</div>
                                <?php
                                }
                                ?>
                                <input name="wchat_purchase_code" type="password" class="form-control" value="">
                                <span class="font-14"><code style="color: green">Get Purchase code From Here.</code><a href="https://codecanyon.net/item/wchat-fully-responsive-phpajax-chat/18047319?clickthrough_id=18047319&license=regular&open_purchase_for_item_id=18047319&purchasable=source&redirect_back=true&ref=bylancer&utm_source=item_desc_link" target="_blank">Buy Wchat</a></span>
                            </div>
                        </div>
                        <!--Default Horizontal Form-->
                        <div class="form-group">
                            <label class="col-sm-4 control-label"></label>
                            <div class="col-sm-6">
                                <button name="update" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                            </div>
                        </div>
                        <!--Default Horizontal Form-->

                    </div>

                </form>
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
<script>
    $(".save-changes").click(function(){
        $(".save-changes").addClass("bookme-progress");
    });
</script>
</body>

</html>