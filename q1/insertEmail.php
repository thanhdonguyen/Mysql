<?php
/**
 * @access public
 * @author Nguyen Thanh Do <thanhdo181@gmail.com>
 * @copyright All Grow Inc. All Rights Reserved
 * @category manage
 * @package bot01
 */
require_once(dirname(__FILE__)."/../inc/config.php");

$a=array("com","org","co.jp","jp","net","vn","edu.com","uk","us");

// pre($random_keys);
// echo $a[$random_keys[0]];die();

$sql1 = 'INSERT INTO tb_q1(q1_mid,q1_email) values ';
// echo $sql1; exit();
for($i = 10001; $i<=13500; $i++){
	$random_keys=array_rand($a,2);
    $email = $tb_q1->rand_string( 5 )."@".$tb_q1->rand_string( 4 ).".".$a[$random_keys[0]];
	$sql1=$sql1."('$i','$email'),";
}
$sql2=$sql1."/";
$sql = str_replace(",/", ";", $sql2);
// echo $sql;die();
$tb_q1->insertEmail($sql);
echo "Insert 13500 Email succsess !";
		


function pre($val){
    echo "<pre>";
    print_r($val);
    echo "</pre>";
}
?>
