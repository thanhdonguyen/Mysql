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
$tb_q1 = new tb_q1();
$tb_q1->tableName="q1";

/**
 * マスタ情報(tb_bridb)に関するモデルとクラス
 * @package CQC
 * @subpackage connect
 */
class tb_q1 extends connect {
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
	
	function tb_q1(){
		$this->tableName	= "q1";
		$this->pdom = new mysqlpdo ();
		
		$this->ad[]=array("q1_mid",	"int",1,11	,"q1_mid",			"HankakuA0","not null");
		$this->ad[]=array("q1_email",	"vch",1,255	,"q1_email",			"HankakuA0","not null");
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
	function rand_string( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyz";
		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
		 }
		return $str;
	}
	function getListCount(){
        $sql = "select count(*) as cntno from tb_q1";
        $con = $this->pdom->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->execute();
        unset($datas);
        $datas = $stmt->fetchAll();
        return $datas[0]['cntno'];
    }
    function getEmailInfo($offset){
        $sql = "select * from tb_q1 limit 1 offset $offset";
        $con = $this->pdom->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->execute();
        unset($datas);
        $datas = $stmt->fetchAll();
        return $datas[0];
    }
    	function getList($limit,$offset){
		$sql  = "
		select *
		from tb_q1
		";
		// $offset = 0;
  //   	$limit = 100;
		if($limit>0 && $offset>0)
			$limitoffset =" order by q1_mid ASC limit $limit offset $offset";
		else
			$limitoffset =" order by q1_mid ASC limit $limit offset 0";
		// echo $sql;exit();
		$pdocon = new pdocon();
		$sqlc = "select count(*) as cno from ($sql) as a ";
		$stmt = $pdocon->pdo->prepare($sqlc, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->execute();
		$datas = $stmt->fetchAll();
		$cno = $datas[0]['cno'];

		$sql .= $where.$limitoffset;
		// echo $sql;exit();
		$stmt = $pdocon->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		//echo $sql;
		//$this->setBindMasterList($stmt,$postData['searchKey']);
		$stmt->execute();
		unset($datas);

		$datas = $stmt->fetchAll();
		$datas['cno']=$cno;
		return $datas;
	}
	function updateEmail($email){
        $sql = "UPDATE `tb_q1` SET `q1_email`=CONCAT(substring_index(`q1_email`,'@',1),'$email')";
        // echo $sql; exit();
        $con = $this->pdom->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->execute();
        unset($datas);
        $datas = $stmt->fetchAll();
        return $datas;
    }
    function insertEmail($sql){
    	$con = $this->pdom->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->execute();
        unset($datas);
        $datas = $stmt->fetchAll();
        return $datas;
    }
    //--------------------------------------
  
}