<?php
require_once('../../includes/config.php');
require_once('../../includes/sql_builder/idiorm.php');
require_once('../../includes/db.php');
require_once('../../includes/functions/func.global.php');
require_once('../../includes/functions/func.admin.php');
require_once('../../includes/functions/func.users.php');
require_once('../../includes/functions/func.sqlquery.php');
require_once('../../includes/lang/lang_'.$config['lang'].'.php');

admin_session_start();
$pdo = ORM::get_db();