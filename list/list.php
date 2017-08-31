<?php

/**
 * @access public
 * @author Takeda Shuma <takeda_s@allgrow.co.jp>
 * @copyright All Grow Inc. All Rights Reserved
 * @category manage
 * @package bot01
 */

	require_once(dirname(__FILE__)."/../inc/config.php");
	//get template from htmlfile
	$html = getTemplate(str_replace(".php",".html",basename($_SERVER["PHP_SELF"])));
	$templateList = getListNo($html,0);
	 // echo $templateList;die();
	$html = str_replace($templateList,"<!--listLoop0-->",$html);
	
	if(empty($_POST['pageno'])) $pageno=1; else $pageno=$_POST['pageno'];
	// echo SARCH_MAX_NO."-".($pageno-1)*SARCH_MAX_NO;die();
	$sqlDatas = $tb_q1->getList(SARCH_MAX_NO,($pageno-1)*SARCH_MAX_NO);
    // pre($sqlDatas);die();
	$pager=getPager($pageno,$sqlDatas['cno'],SARCH_MAX_NO,SARCH_MAX_PG);
	$html = str_replace("<!--PAGERTEXT-->",$pager['pagerTxt'],$html);
	// pre($sqlDatas);die();
	for ($i=0;$i<count($sqlDatas)-1;$i++) {
		$listLine = $templateList;
		// pre($listLine);die();
		foreach ($sqlDatas[$i] as $key=>$value) {
			// 取得した項目があるかどうか
			if(!empty($value)){
				$listLine = str_replace("<!--".$key."-->",htmlspecialchars($value),$listLine);
			}
		}
		$list .= $listLine;
	}

	$html = str_replace("<!--listLoop0-->",$list,$html);

	echo $html;


?>
<?php 
function pre($val){
	echo "<pre>";
	print_r($val);
	echo "</pre>";
}
?>
