<?php
/**
 * Model and Class for PDO Connectioni (MySQL,MariaDB)
 *
 * @access public
 * @author Takeda Shuma <takeda_s@allgrow.co.jp>
 * @copyright AllGrow Inc. All Rights Reserved
 * @category Libraly
 * @package ABTest
 */
class mysqlpdo {
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
	 */
	var $pdo = null;
	//function mysqlpdo(){
	//	return $this->getConnection();
	//}
	
	/**
	 * Outline： Get Connection
	 *
	 * Detail：
	 *
	 * @access public
	 * @param        	
	 *
	 * @return PDO
	 * @see
	 *
	 * @throws 例外についての記述
	 * @todo 未対応（改善）事項等
	 */
	function getConnection() {
		//echo "init start mysql pdo";
		//echo DB_HOST . ';' . DB_NAME . ';charset=utf8'.DB_USER.":".DB_PASS;
		try {
			// For Linux server
			$pdo = new PDO (
					 DB_HOST . ';' . DB_NAME . ';charset=utf8'
					,DB_USER, DB_PASS
					,array (PDO::ATTR_EMULATE_PREPARES => false ) 
					);
			/*
			 * This is for Windows Server
			 * $options = array(
			 * PDO::MYSQL_ATTR_READ_DEFAULT_FILE => '/etc/my.cnf',
			 * );
			 * $dsn = DB_HOST.';'.DB_NAME.';';
			 * $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
			 */
			
			$pdo->setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
			return $pdo;
			// echo "Can Open pdo";
		} catch ( PDOException $e ) {
			return null;
			// header('Content-Type: text/html; charset=utf-8');
			// exit('データベース接続失敗。'.$e->getMessage());
			// var_dump($e->getMessage());
		}
	}
	function getStatement($sql) {
		$stmt = $this->pdo->query ( $sql );
		return $stmt;
	}
	function setCloseCursor($stmt) {
		// バージョンによってはきちんとcloseしないと次のSQLが実行されない
		$stmt->closeCursor ();
	}
	function getStatementLike() {
		// クエリーの実行
		$name = "shuma";
		$sql = "select usr_mid,usr_vch0,usr_vch1,usr_vch2,usr_vch3 from tb_usr where usr_vch2 like ?";
		$stmt = $this->pdo->prepare ( $sql );
		$stmt->bindValue ( 1, '%' . addcslashes ( $name, '\_%' ) . '%', PDO::PARAM_STR );
		$stmt->execute ();
		$red = $stmt->fetchAll ();
		
		echo "count=" . count ( $red ) . "<br>";
		echo "<br>";
		var_dump ( $red );
		echo "<br>";
	}
	function getStatementSample() {
		// クエリーの実行
		$sql = "select usr_mid,usr_vch0,usr_vch1,usr_vch2,usr_vch3 from tb_usr where usr_vch2 like '%shuma%'";
		// $sql = "SELECT * FROM tb_usr";
		$stmt = $this->pdo->query ( $sql );
		var_dump ( $stmt );
		$count = $stmt->rowCount ();
		echo "count=$count<br>";
		// 結果の取得
		$datas = array ();
		foreach ( $stmt as $row ) {
			$datas [] = $row;
		}
		var_dump ( $datas );
		
		// バージョンによってはきちんとcloseしないと次のSQLが実行されない
		$stmt->closeCursor ();
	}
	function pdo_query() {
		// PDOオブジェクト自体に指定。レスポンスは常に連想配列形式で取得するようになる
		$pdo->setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
		
		$stmt = $pdo->query ( 'SELECT * FROM Entry' );
		// PDOStatement毎に指定することも可能
		// レスポンスをstdClassとして取得
		$stmt->setFetchMode ( PDO::FETCH_CLASS, 'stdClass' );
		
		var_dump ( $stmt->fetchAll () );
		/*
		 * array(
		 * stdClass{...},
		 * stdClass{...},
		 * ...
		 * )
		 */
	}
	function pdo_insert() {
		$stmt = $pdo->prepare ( "INSERT INTO テーブル名 (name, value) VALUES (:name, :value)" );
		$stmt->bindParam ( ':name', $name, PDO::PARAM_STR );
		$stmt->bindValue ( ':value', $value, PDO::PARAM_INT );
		
		$name = 'one';
		$value = 1;
		$stmt->execute ();
		
		$sql = 'update テーブル名 set name =:name where id = :value';
		$stmt = $pdo->prepare ( $sql );
		$stmt->bindParam ( ':name', $name, PDO::PARAM_STR );
		$stmt->bindValue ( ':value', $value, PDO::PARAM_INT );
		$stmt->execute ();
		
		$sql = 'DELETE FROM テーブル名 where id = :delete_id';
		$stmt = $pdo->prepare ( $sql );
		$stmt->bindValue ( ':delete_id', $value, PDO::PARAM_INT );
		$stmt->execute ();
		
		$stmt = $pdo->query ( "SELECT * FROM テーブル名" );
		$count = $stmt->rowCount ();
	}
	/*
	 * 未使用
	 * function setTransuction(){
	 * // トランザクション開始
	 * $pdo->beginTransaction();
	 *
	 * // INSERTとか DELETEとか
	 *
	 * // トランザクション完了
	 * $pdo->commit();
	 *
	 * // トランザクション取り消し
	 * $pdo->rollBack();
	 * }
	 *
	 * function mydb_query ($query="") {
	 * $logger = new logger();
	 * $logger->setWriteLog($query."<br>\n");
	 * //$logger->setWriteLog("ret=$ret<br>\n");
	 *
	 * echo 'Could not run query: ' . mysql_error();
	 * print ("<br>query=$query<br>\n");
	 * }
	 *
	 * function getConnect(){
	 * $conn = mysql_connect($this->dbhost.":".$this->dbport,$this->dbuser,$this->dbpass);
	 * if ($conn == False) {
	 * print ("can not connect db<br>\n");
	 * //exit;
	 * return false;
	 * }else{
	 * return $conn;
	 * }
	 * }
	 */
}
?>
