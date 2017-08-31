<?php
/**
 * @access public
 * @author Thuy AGL
 * @copyright All Grow Inc. All Rights Reserved
 * @category manage
 * @package bot01
 */

/**
 * initialize
 */
$tb_user_auth = new tb_user_auth();
$tb_user_auth->tableName="user_auth";

/**
 * マスタ情報(tb_bridb)に関するモデルとクラス
 * @package CQC
 * @subpackage connect
 */
class tb_user_auth extends connect {
	/**
	 * コンストラクタ<br>
	 * 項目名
	 * 型 vch:varchar,int:integer,dat:datetime
	 * vch:最小文字数、int:最小値、dat:最小文字数
	 * vch:最大文字数、int:最大値、dat:最大文字数
	 * 項目（ラベル）名
	 * プライマリキー
	 * 型
	 * デフォルト値
	 *
	 */
	var $Datalist 	= array();
	var $ad			= array();
	var $pdom		= null;
	var $conn		= null;
	
	function tb_user_auth(){
		$this->tableName	= "user_auth";
		$this->pdom = new mysqlpdo ();
		
		$this->ad[]=array("user_auth_mid",	"int",1,11	,"user_auth_mid",			"HankakuA0","not null");
		$this->ad[]=array("user_auth_email",	"vch",1,255	,"user_auth_email",			"HankakuA0","not null");
	}

	/**
	 *  概要：ログインした社員番号より所属先数を取得する(whereパラメータ可変)
	 *
	 *  詳細：tb_usaより社員番号(usa_int1)をキーに所属先一覧を取得
	 *
	 * @access public
	 * @param array型 $postData['usa_int1']
	 * @return array型 $datas tb_usaその他項目すべて
	 * @see pdocon
	 * @throws 例外についての記述
	 * @todo 未対応（改善）事項等
	 */
    function getRand(){
	$sql  = "
	SELECT user_auth_auth FROM `tb_user_auth` ORDER BY RAND() LIMIT 1
	";

	//echo $sql;
	$con = $this->pdom->getConnection();
	$stmt = $con->prepare($sql);

	$stmt->execute();
	//setDbg('SQL',$sql);
	//setDbg('ARR',$postData);

	unset($datas);
	$datas = $stmt->fetchAll();
	return $datas;
	}
}