<?php
require_once('includes/config.php');
require_once('includes/sql_builder/idiorm.php');
require_once('includes/db.php');
require_once('includes/classes/class.template_engine.php');
require_once('includes/classes/class.country.php');
require_once('includes/functions/func.global.php');
require_once('includes/functions/func.users.php');
require_once('includes/functions/func.sqlquery.php');
require_once('includes/lang/lang_'.$config['lang'].'.php');
require_once('includes/seo-url.php');

sec_session_start();

error($lang['PAGE_NOT_FOUND'], __LINE__, __FILE__, 1);


?>