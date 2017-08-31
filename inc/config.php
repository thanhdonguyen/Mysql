<?php
/**
 * PHPDocumentorのサンプル
 * これ以降、本システムではPHPDocumentorのフォーマットにのっとってやろうと思う。
 * 以下はその記述例
 * 参考 http://qiita.com/itosho/items/0f809e067a9e4a41515e
 * 参考 http://blog.shimabox.net/2013/05/04/example-phpdocumentor/
 * 出来るだけ細かく書いたほうがよいが、詳細な説明は各メソッドに任せる。
 * 全体での共通ルールとか仕様を書く。
 * /login/login.phpに簡単なサンプルを記述してますので見てください。
 *
 * @access public
 * @author Takeda Shuma <Takeda.Shuma@trans-cosmos.co.jp>
 * @copyright Trans Cosmos Inc. All Rights Reserved
 * @category login
 * @package CQC
 */

/**
 * initialize & error
 */
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1 );

/**
 * encode
 */
mb_regex_encoding("UTF-8");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

/**
 * Debug mode
 */
$DEBUGMODE = TRUE;

/**
 * require & initialize
 */
require_once(dirname(__FILE__)."/simple_html_dom.php");
require_once(dirname(__FILE__)."/function.php");
require_once(dirname(__FILE__)."/mysqlpdo.php");
require_once(dirname(__FILE__)."/pdo.php");
require_once(dirname(__FILE__)."/connect.php");
require_once(dirname(__FILE__)."/function.php");
require_once(dirname(__FILE__)."/model_tb_q1.php");
require_once(dirname(__FILE__)."/model_tb_serial.php");
require_once(dirname(__FILE__)."/model_tb_user.php");
require_once(dirname(__FILE__)."/model_tb_userq3.php");
require_once(dirname(__FILE__)."/model_tb_user_auth.php");
// require_once(dirname(__FILE__)."/model_tb_btc.php");
// require_once(dirname(__FILE__)."/model_tb_btl.php");
// require_once(dirname(__FILE__)."/model_tb_test.php");
// require_once(dirname(__FILE__)."/model_tb_shif.php");
// //require_once(dirname(__FILE__)."/model_tb_lgp.php");
// require_once(dirname(__FILE__)."/model_tb_itm.php");
// require_once(dirname(__FILE__)."/model_tb_log.php");
// require_once(dirname(__FILE__)."/model_tb_grp.php");
// require_once(dirname(__FILE__)."/model_tb_mnu.php");
// require_once(dirname(__FILE__)."/model_tb_usa.php");
// require_once(dirname(__FILE__)."/model_tb_usr.php");
// require_once(dirname(__FILE__)."/model_tb_yhs.php");
// require_once(dirname(__FILE__)."/model_tb_cat.php");
// require_once(dirname(__FILE__)."/model_tb_yhc.php");
// require_once(dirname(__FILE__)."/model_tb_cth.php");
// require_once(dirname(__FILE__)."/model_tb_lgc.php");
// require_once(dirname(__FILE__)."/model_tb_ctr.php");
// require_once(dirname(__FILE__)."/model_tb_bto.php");
// require_once(dirname(__FILE__)."/model_tb_yho.php");
// require_once(dirname(__FILE__)."/model_tb_shc.php");
// require_once(dirname(__FILE__)."/model_tb_shp.php");
// require_once(dirname(__FILE__)."/model_tb_shb.php");
// /*add day: 5-9-2017*/
// require_once(dirname(__FILE__)."/model_tb_kwd.php");
// require_once(dirname(__FILE__)."/model_tb_kws.php");
// require_once(dirname(__FILE__)."/model_tb_god.php");
// require_once(dirname(__FILE__)."/model_tb_gol.php");
// /*end add day: 5-9-2017*/
// require_once(dirname(__FILE__)."/menucom.php");
// require_once(dirname(__FILE__)."/Encoding.php");
// require_once dirname(__FILE__).'/lib/excel/PHPExcel.php';
// require_once dirname(__FILE__).'/lib/excel/PHPExcel/IOFactory.php';
/**
 * Statics
 */
define('BR','<BR>\n');

define('SENDADDRESS','takeda_s@allgrow.co.jp');
define('FROMADDRESS','From: info@allgrow.co.jp');

define('LIST_CELL_NO','36');
define('SARCH_MAX_NO','20');
define('SARCH_MAX_PG','20');
define('DISP_COLUMN_CNT','10');
define('PLANT_OFFER_CD','213');
define('CHK_LISTCNT','48');
define('RAKUTEN_NEWSHOP_CRAWL',3);

/**
 * MySQL DB (use PDO)
 */
//define('DB_HOST', 'mysql:host=192.168.11.84');
//define('DB_HOST', 'mysql:host=133.130.127.69');
//define('DB_HOST', 'mysql:host=133.130.127.69');
////define('DB_HOST', 'mysql:host=133.130.127.69;port=3306;unix_socket=/var/run/mysqld/mysqld.sock');
//define('DB_USER', 'root');
//define('DB_PASS', 'iiyudana');
//define('DB_NAME', 'dbname=db_bot_01');
 
require_once(dirname(__FILE__)."/config_local.php");

define('ENC_KEY', 'CQC');
define('ENC_CODE', 'AES-128-ECB');
/**
 * File Uploads
 */
//define('UPLOADURL','./upload/');
//Mac用
//define('UPLOADTMP','/Users/user1/Documents/workspace/cqc_step2/upload/files/');
//define('UPLOADDIR','/Users/user1/Documents/workspace/cqc_step2/upload/files/');
//define('UPLOADTHM','/Users/user1/Documents/workspace/cqc_step2/upload/files/thumbnail/');

define('UPLOADTMP','/var/www/upload/files/');
define('UPLOADDIR','/var/www/upload/files/');
define('UPLOADTHM','/var/www/upload/files/thumbnail/');
define('GETURL','../upload/getfile.php?fil_vch0=');
define('ROOT', str_replace('/inc', '', dirname(__FILE__)));

?>