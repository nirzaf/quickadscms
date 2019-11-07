<?php
if(file_exists("../includes/config.php")){
    require_once('../includes/config.php');
}

require_once('installer.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Check if SSL enabled
$protocol = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] && $_SERVER["HTTPS"] != "off"    ? "https://" : "http://";

$site_url = $protocol . $_SERVER['HTTP_HOST'] . str_replace ("index.php", "", str_replace ("install/", "", $_SERVER['PHP_SELF']));
$error = '';
$filename = '';
$installing_version = $config['version'];

if(isset($_GET['lang']))
{
    $_POST['lang'] = $_GET['lang'];
}

if(isset($_POST['lang']))
{
    require_once('lang/lang_'.$_POST['lang'].'.php');
}



if(isset($config['installed']))
{
    if($config['version'] == $installing_version){
        exit('Quickad is already installed.');
        header('Location: ../index.php');
        exit;
    }
    else {
        if(file_exists("upgrade_'.$installing_version.'.php'")){
            header('Location: upgrade_'.$installing_version.'.php');
            exit;
        }
    }
}

if(is_writable('../includes/config.php'))
{
    if(!isset($_POST['lang']))
        $step = 1;
    else {
        if (!isset($_POST['PCode']))
            $step = 2;
        else {
			$step = 3;
            if (isset($_POST['DBHost'])) {
                if (mysqli_connect($_POST['DBHost'], $_POST['DBUser'], $_POST['DBPass'])) {
                    if ($conLink = mysqli_select_db(mysqli_connect($_POST['DBHost'], $_POST['DBUser'], $_POST['DBPass']), $_POST['DBName'])) {
                        if (isset($_POST['adminuser'])) {
                            if (trim($_POST['adminuser']) == '')
                                $step = 4;
                            else {

                                // Create connection in MYsqli
                                $con = new mysqli($_POST['DBHost'], $_POST['DBUser'], $_POST['DBPass'], $_POST['DBName']);
                                // Check connection
                                if ($con->connect_error) {
                                    die("Connection failed: " . $con->connect_error);
                                }

                                importSchemaSql($con, $_POST['DBPre']);
                                importDataSql($con, $_POST['DBPre']);
                                importGeonamesSql($con, $_POST['DBPre'], $_POST['default_country']);

                                $password = $_POST["adminpass"];
                                $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);


                                /*Insert Data in table*/
                                $con->query("TRUNCATE TABLE `" . addslashes($_POST['DBPre']) . "admins`");
                                $con->query("INSERT INTO `" . addslashes($_POST['DBPre']) . "admins` (`id`, `username`, `password_hash`, `name`, `email`, `image`, `permission`) VALUES
(1, '" . addslashes($_POST['adminuser']) . "', '" . $pass_hash . "', 'Admin', '" . addslashes($_POST['admin_email']) . "', '', '0');");


                                $con->query("UPDATE `" . addslashes($_POST['DBPre']) . "countries` set active='1' WHERE `code` = '" . $_POST['default_country'] . "'");

                                $con->query("INSERT INTO " . addslashes($_POST['DBPre']) . "options (`option_name`, `option_value`) VALUES ('specific_country', '" . $_POST['default_country'] . "')");

                                $con->query("INSERT INTO " . addslashes($_POST['DBPre']) . "options (`option_name`, `option_value`) VALUES ('site_url', '" . $site_url . "')");

                                $con->close();

                                // Content that will be written to the config file
                                $content = "<?php\n";
                                $content .= "\$config['db']['host'] = '" . addslashes($_POST['DBHost']) . "';\n";
                                $content .= "\$config['db']['name'] = '" . addslashes($_POST['DBName']) . "';\n";
                                $content .= "\$config['db']['user'] = '" . addslashes($_POST['DBUser']) . "';\n";
                                $content .= "\$config['db']['pass'] = '" . addslashes($_POST['DBPass']) . "';\n";
                                $content .= "\$config['db']['pre'] = '" . addslashes($_POST['DBPre']) . "';\n";
                                $content .= "\n";
                                $content .= "\$config['version'] = '" . $installing_version . "';\n";
                                $content .= "\$config['installed'] = '1';\n";
                                $content .= "?>";

                                // Open the config.php for writting
                                $handle = fopen('../includes/config.php', 'w');
                                // Write the config file
                                fwrite($handle, $content);
                                // Close the file
                                fclose($handle);

                                $step = 5;
                            }
                        } else {
                            $step = 4;
                        }
                    } else {

                        $error_number = mysqli_connect_errno();

                        if ($error_number == '1044') {
                            $error = $lang['ERROR1044'];
                        } elseif ($error_number == '1046') {
                            $error = $lang['ERROR1046'];
                        } elseif ($error_number = '1049') {
                            $error = $lang['ERROR1049'];
                        } else {
                            $error = mysqli_connect_error() . ' - ' . $error_number;
                        }
                        $step = 3;
                    }
                } else {
                    $error_number = mysqli_connect_error();

                    if ($error_number == '1045') {
                        $error = $lang['ERROR1045'];
                    } elseif ($error_number == '2005') {
                        $error = $lang['ERROR2005'];
                    } else {
                        $error = mysqli_connect_error() . ' - ' . $error_number;
                    }
                    $step = 3;
                }
            }
        }
    }
}
else
{
    $step = 0;
    $error = $error.'Could not write to your config.php file.<br><br>Please check that you have set the chmod/permisions to 0777';
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Quickad Installation</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>

<?php
if($step == 0)
{
    ?>
    <table width="500"  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td><table width="500%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><span class="style1">Quickad Installation : Error</span></td>
                        <td align="right" valign="bottom">&nbsp;</td>
                    </tr>
                </table></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td>
                <br><br>
                <span class="error"><?php echo $error;?></span><br><br><br>
                <a href="index.php">Click here</a> once you have corrected this.<br><br><br><br><bR>
            </td>
        </tr>
        <tr>
            <td><div align="center"><span class="style5">&copy; 2008 <a href="https://bylancer.com" target="_blank">Bylancer.com</a></span> Version <?php echo $installing_version ?></div></td>
        </tr>
    </table>

<?php
}
elseif($step == 1)
{
    ?>

    <div class="container">
        <table border="0" align="center" cellpadding="10" cellspacing="3" align="center">
            <tr>
                <td>
                    <table border="0" cellspacing="10" cellpadding="3" align="center">
                        <tr>
                            <td><span class="style1">Quickad Installation - Step: 1-4</span></td>
                            <td align="right" valign="bottom">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>Please select the language you would like Quickad to use:<br><small style="color:#FF0000;">*Some parts of the installation may not be in your chosen language</small><Br><br>

                    <table  border="0" cellspacing="0" cellpadding="10">
                        <tr>
                            <td width="33%" height="140" align="left">
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td align="center"><a href="index.php?lang=english"><img src="images/flag_en.gif" alt="English" width="130" height="87" vspace="2" border="0"></a><br><a href="index.php?lang=english">English</a></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="33%" height="140" align="left">
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center"><a href="index.php?lang=german"><img src="images/flag_german.gif" alt="Deutsch" width="130" height="87" vspace="2" border="0"></a><br><a href="index.php?lang=german">Deutsch</a></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="33%" height="140" align="left">
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center"><a href="index.php?lang=french"><img src="images/flag_french.gif" alt="French" width="130" height="87" vspace="2" border="0"></a><br><a href="index.php?lang=french">Fran&ccedil;ais</a></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td width="33%" height="140" align="left">
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center"><a href="index.php?lang=spanish"><img src="images/flag_spanish.gif" alt="Espanol" width="130" height="87" vspace="2" border="0"></a><br><a href="index.php?lang=spanish">Espa&ntilde;ol</a></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="33%" height="140" align="left">
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center"><a href="index.php?lang=italian"><img src="images/flag_italian.gif" alt="Italian" width="130" height="87" vspace="2" border="0"></a><br><a href="index.php?lang=italian">Italian</a></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="33%" height="140" align="left"></td>
                        </tr>
                    </table>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td><div align="center"><span class="style5">&copy; <?php echo date("Y"); ?> <a href="https://bylancer.com" target="_blank">Bylancer.com</a></span></div></td>
            </tr>
        </table>
    </div>

<?php
}
elseif($step == 2)
{
    ?>

    <div class="container">
        <table  border="0" align="center" cellpadding="10" cellspacing="3" align="center">
            <tr>
                <td>
                    <table border="0" cellspacing="10" cellpadding="3" align="center">
                        <tr>
                            <td><span class="style1">Quickad Installation - Step: 2-4</span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <form name="form1" method="post" action="index.php" style="padding:0px;margin:0px;">
                        <table border="0" cellspacing="10" cellpadding="3" align="center">
                            <tr>
                                <td align="center">Enter Quickad envato purchase code.</td>
                            <tr/>
                            <tr>
                                <td align="center">
                                    <?php
                                    if($error != '')
                                    {
                                        echo '<span class="byMsg byMsgError">! '.$error.'</span><br><Br>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <table border="0" cellspacing="0" cellpadding="3" align="center">
                            <tr>
                                <td><span class="style12">Purchase Code: </span></td>
                                <td><input name="PCode" placeholder="nulled" type="text" id="PCode" value="<?php if(isset($_POST['PCode'])){ echo $_POST['PCode']; } ?>"></td>
                                <td><span class="style12">&nbsp;<a href="javascript:alert('Quickad Purchase code');">(?)</a> </span></td>
                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><button type="submit" id="confirm" name="Submit" class="btn btn-success confirm"><?php echo $lang['NEXT'];?></button></td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                        <br><br><br>
                        <input name="lang" type="hidden" value="<?php echo $_POST['lang'];?>">
                    </form>
                </td>
            </tr>
            <tr>
                <td><div align="center"><span class="style5">&copy; <?php echo date("Y"); ?> <a href="https://bylancer.com" target="_blank">Bylancer.com</a></span></div></td>
            </tr>
        </table>
    </div>

<?php
}
elseif($step == 3)
{
    ?>

    <div class="container">
        <table  border="0" align="center" cellpadding="10" cellspacing="3" align="center">
            <tr>
                <td>
                    <table border="0" cellspacing="10" cellpadding="3" align="center">
                        <tr>
                            <td><span class="style1">Quickad Installation Step: 3-4</span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <form name="form1" method="post" action="index.php" style="padding:0px;margin:0px;">
                        <table border="0" cellspacing="10" cellpadding="3" align="center">
                            <tr>
                                <td align="center"><?php echo $lang['MYSQLFILL']; ?></td>
                            <tr/>
                            <tr>
                                <td align="center">
                                    <?php
                                    if($error != '')
                                    {
                                        echo '<span class="byMsg byMsgError">! '.$error.'</span><br><Br>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <table border="0" cellspacing="0" cellpadding="3" align="center">
                            <tr>
                                <td><span class="style12"><?php echo $lang['MYSQLHOST'];?>: </span></td>
                                <td><input name="DBHost" type="text" id="DBHost" value="<?php if(isset($_POST['DBHost'])){ echo $_POST['DBHost']; } else { echo 'localhost'; } ?>"></td>
                                <td><span class="style12">&nbsp;<a href="javascript:alert('<?php echo $lang['HOSTHELP'];?>');">(?)</a> </span></td>
                            </tr>
                            <tr>
                                <td><span class="style12"><?php echo $lang['MYSQLUSER'];?>:</span></td>
                                <td><input name="DBUser" type="text" id="DBUser" value="<?php if(isset($_POST['DBUser'])){ echo $_POST['DBUser']; } ?>"></td>
                                <td><span class="style12">&nbsp;<a href="javascript:alert('<?php echo $lang['USERHELP'];?>');">(?)</a> </span></td>
                            </tr>
                            <tr>
                                <td><span class="style12"><?php echo $lang['MYSQLPASS'];?>:</span></td>
                                <td><input name="DBPass" type="password" id="DBPass" value="<?php if(isset($_POST['DBPass'])){ echo $_POST['DBPass']; } ?>"></td>
                                <td><span class="style12">&nbsp;<a href="javascript:alert('<?php echo $lang['PASSHELP'];?>');">(?)</a> </span></td>
                            </tr>
                            <tr>
                                <td><span class="style12"><?php echo $lang['MYSQLNAME'];?>: </span></td>
                                <td><input name="DBName" type="text" id="DBName" value="<?php if(isset($_POST['DBName'])){ echo $_POST['DBName']; } ?>"></td>
                                <td><span class="style12">&nbsp;<a href="javascript:alert('<?php echo $lang['NAMEHELP'];?>');">(?)</a> </span></td>
                            </tr>
                            <tr>
                                <td><span class="style12"><?php echo $lang['MYSQLPRE'];?>: </span></td>
                                <td><input name="DBPre" type="text" id="DBPre" value="<?php if(isset($_POST['DBPre'])){ echo $_POST['DBPre']; } else { echo 'ad_'; } ?>"></td>
                                <td><span class="style12">&nbsp;<a href="javascript:alert('<?php echo $lang['PREHELP'];?>');">(?)</a> </span></td>
                            </tr>
                            <tr>
                                <td><span class="style12"><?php echo $lang['MYSQLDEFCOUNTRY'];?>: </span></td>
                                <td><select name="default_country" required>
                                        <option><?php echo $lang['MYSQLSELCOUNTRY'];?></option>
                                        <?php
                                        $country = get_all_country_list();
                                        foreach($country as $key => $value){
                                            echo "<option value=".strtolower($key).">".$value."</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <button type="submit" id="confirm" name="Submit" class="btn btn-success confirm"><?php echo $lang['NEXT'];?></button>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                        <br><br><br>
                        <input name="PCode" type="hidden" id="PCode" value="<?php echo $_POST['PCode'];?>">
                        <input name="lang" type="hidden" value="<?php echo $_POST['lang'];?>">
                    </form>
                </td>
            </tr>
            <tr>
                <td><div align="center"><span class="style5">&copy; <?php echo date("Y"); ?> <a href="https://bylancer.com" target="_blank">Bylancer.com</a> Version <?php echo $installing_version ?></span></div></td>
            </tr>
        </table>
    </div>

<?php
}
elseif($step == '4')
{
    ?>

    <div class="container">
        <table border="0" align="center" cellpadding="10" cellspacing="3" align="center">
            <tr>
                <td>
                    <table border="0" cellspacing="10" cellpadding="3" align="center">
                        <tr>
                            <td><span class="style1">Quickad Installation Step: 4-4</span></td>
                            <td align="right" valign="bottom">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <form name="form1" method="post" action="index.php" style="padding:0px;margin:0px;">
                        <?php echo $lang['ADMFILL'];?>
                        <br><br><br>
                        <table border="0" cellspacing="0" cellpadding="3" align="center">
                            <tr>
                                <td><span class="style12">Admin Email: </span></td>
                                <td><input name="admin_email" type="email" id="admin_email" value="<?php if(isset($_POST['admin_email'])){ echo $_POST['admin_email']; } ?>"></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><span class="style12"><?php echo $lang['ADMUSER'];?>: </span></td>
                                <td><input name="adminuser" type="text" id="adminuser" value="<?php if(isset($_POST['adminuser'])){ echo $_POST['adminuser']; } ?>"></td>
                                <td><span class="style12">&nbsp;<a href="javascript:alert('<?php echo $lang['ADMUSERHELP'];?>');">(?)</a> </span></td>
                            </tr>
                            <tr>
                                <td><span class="style12"><?php echo $lang['ADMPASS'];?>: </span></td>
                                <td><input name="adminpass" type="password" id="adminpass" value="<?php if(isset($_POST['adminpass'])){ echo $_POST['adminpass']; } ?>"></td>
                                <td><span class="style12">&nbsp;<a href="javascript:alert('<?php echo $lang['ADMPASSHELP'];?>');">(?)</a> </span></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>

                                <td>&nbsp;</td>
                                <td><button type="submit" id="confirm" name="Submit" class="btn btn-success confirm"><?php echo $lang['NEXT'];?></button>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="alert alert-success hide" id="alert">
                                        <strong>Please wait!</strong> Installation take 5-10 minutes.
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br><br>
                        <input name="DBHost" type="hidden" id="DBHost" value="<?php echo $_POST['DBHost'];?>">
                        <input name="DBName" type="hidden" id="DBName" value="<?php echo $_POST['DBName'];?>">
                        <input name="DBUser" type="hidden" id="DBUser" value="<?php echo $_POST['DBUser'];?>">
                        <input name="DBPass" type="hidden" id="DBPass" value="<?php echo $_POST['DBPass'];?>">
                        <input name="DBPre" type="hidden" id="DBPre" value="<?php echo $_POST['DBPre'];?>">
                        <input name="PCode" type="hidden" id="PCode" value="<?php echo $_POST['PCode'];?>">
                        <input name="default_country" type="hidden" id="default_country" value="<?php echo $_POST['default_country'];?>">
                        <input name="lang" type="hidden" value="<?php echo $_POST['lang'];?>">
                    </form>
                </td>
            </tr>
            <tr>
                <td><div align="center"><span class="style5">&copy; <?php echo date("Y"); ?> <a href="https://bylancer.com" target="_blank">Bylancer.com</a> Version <?php echo $installing_version ?></span></div></td>
            </tr>
        </table>
    </div>

<?php
}
elseif($step == '5')
{
    ?>

    <div class="container">
        <table border="0" align="center" cellpadding="10" cellspacing="3" align="center">
            <tr>
                <td>
                    <table border="0" cellspacing="10" cellpadding="3" align="center">
                        <tr>
                            <td><span class="style1">Quickad Installation</span></td>
                            <td align="right" valign="bottom">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr><td>Thank you for installing Quickad, please use the links below:</td></tr>
            <tr><td>- <a href="../home">Front End</a> <br>- <a href="../admin/">Admin</a><br></td></tr>

            <tr>
                <td>
                    <div class="alert alert-warning">
                        <strong>Note!</strong> Delete the install directory.
                    </div>
                </td>
            </tr>

            <tr>
                <td><div align="center"><span class="style5">&copy; <?php echo date("Y"); ?> <a href="https://bylancer.com" target="_blank">Bylancer.com</a> Version <?php echo $installing_version ?></span></div>
                    <br>
                </td>
            </tr>
        </table>
    </div>

<?php
}
?>

<script>
    var confirm = document.getElementById('confirm');
    var alert = document.getElementById('alert');
    confirm.onclick = function() {
        confirm.className = 'bookme-progress btn btn-success confirm';
        alert.className = 'alert alert-success';
    }
</script>
</body>
</html>