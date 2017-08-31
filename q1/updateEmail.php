<?php 
/**
 * @access public
 * @author Nguyen Thanh Do <thanhdo181@gmail.com>
 * @copyright All Grow Inc. All Rights Reserved
 * @category manage
 * @package bot01
 */
require_once(dirname(__FILE__)."/../inc/config.php");
$email = "@gmail.com";
$tb_q1->updateEmail($email);
echo "Update success";
// UPDATE `tb_q1` SET `q1_email`=CONCAT(`q1_email`,'a')
// UPDATE `tb_q1` SET `q1_email`=CONCAT(substring_index(`q1_email`,'@',1),'@test.com')
?>