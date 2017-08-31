<?php
/**
 * @access public
 * @author Nguyen Thanh Do <thanhdo181@gmail.com>
 * @copyright All Grow Inc. All Rights Reserved
 * @category manage
 * @package bot01
 */
require_once(dirname(__FILE__)."/../inc/config.php");
$tb_userq3->updateAuthno();
echo "Update autho no 1 million user success";	
//UPDATE `tb_userq3` as a SET `userq3_authno`=(select user_auth_mid from tb_user_auth as b where a.userq3_auth = b.user_auth_auth)


function pre($val){
    echo "<pre>";
    print_r($val);
    echo "</pre>";
}
?>
