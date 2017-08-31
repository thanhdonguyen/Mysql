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
$tb_serial = new tb_serial();
$tb_serial->tableName="serial";

/**
 * マスタ情報(tb_bridb)に関するモデルとクラス
 * @package CQC
 * @subpackage connect
 */
class tb_serial extends connect {
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
	
	function tb_serial(){
		$this->tableName	= "serial";
		$this->pdom = new mysqlpdo ();
		
		$this->ad[]=array("serial_mid",	"int",1,11	,"serial_mid",			"HankakuA0","not null");
		$this->ad[]=array("serial_email",	"vch",1,255	,"serial_email",			"HankakuA0","not null");
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
        $sql = "select count(*) as cntno from tb_serial";
        $con = $this->pdom->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->execute();
        unset($datas);
        $datas = $stmt->fetchAll();
        return $datas[0]['cntno'];
    }
    function getSerial($offset){
        $sql = "select * from tb_serial limit 1 offset $offset";
        $con = $this->pdom->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->execute();
        unset($datas);
        $datas = $stmt->fetchAll();
        return $datas[0];
    }
    function getMaxMIDSerial(){
		$sql = "select max(".$this->tableName."_mid)+1 as maxmid from tb_".$this->tableName."";
		$pdocon = new pdocon();
		$statement = $pdocon->pdo->query($sql);
		$members = array();
		foreach ($statement as $row) {
				$members[] = $row;
		}
		// バージョンによってはきちんとcloseしないと次のSQLが実行されない
		$statement->closeCursor();
		
		if(empty($members[0]["maxmid"])) $maxmid=1000001; else $maxmid=$members[0]["maxmid"];
		//echo "<br>maxmid2=$maxmid<BR>";

		return $maxmid;
	}
	function insertSerial(){
		$sql1 = 'INSERT INTO tb_serial(serial_mid) values ';
		for($i = 1000001; $i<2000000; $i++){
			$sql1=$sql1."($i),";
		}
		$sql2=$sql1."/";
		$sql = str_replace(",/", ";", $sql2);
		// echo $sql; exit();
		$con = $this->pdom->getConnection();
        $stmt = $con->prepare($sql);
        $stmt->execute();
        unset($datas);
        $datas = $stmt->fetchAll();
        return $datas;
	}
}