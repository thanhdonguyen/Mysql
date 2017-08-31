<?php
/**
 * @access public
 * @author Nguyen Thanh Do <thanhdo181@gmail.com>
 * @copyright All Grow Inc. All Rights Reserved
 * @category manage
 * @package bot01
 */
require_once(dirname(__FILE__)."/../inc/config.php");
    $email = "@test.com";
    $tb_user->insertUser($email);
    echo "Update 1 million email succsess !";
    //INSERT INTO `tb_user` select serial_mid,concat(serial_mid,'@test.com') from tb_serial


function pre($val){
    echo "<pre>";
    print_r($val);
    echo "</pre>";
}
?>
