<?php
/**
 * @access public
 * @author Nguyen Thanh Do <thanhdo181@gmail.com>
 * @copyright All Grow Inc. All Rights Reserved
 * @category manage
 * @package bot01
 */
require_once(dirname(__FILE__)."/../inc/config.php");

$sql1 = 'INSERT INTO tb_userq3(userq3_mid,userq3_email,userq3_auth,userq3_authno) values ';
// echo $sql1; exit();
for($i = 1000001; $i<2000000; $i++){
	$Item = $tb_user_auth->getRand();
	// pre($Item);die();
	$auth = $Item[0]['user_auth_auth'];
    
	$sql1=$sql1."('$i','$i@test.com','$auth','user_auth_no'),";
}
$sql2=$sql1."/";
$sql = str_replace(",/", ";", $sql2);
$tb_userq3->insertUser($sql);
echo "Insert 1 million user succsess !";
		


function pre($val){
    echo "<pre>";
    print_r($val);
    echo "</pre>";
}
?>
