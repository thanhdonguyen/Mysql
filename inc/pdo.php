<?php

class pdocon{
	
	//トランザクション系は未定義
	var $pdo = null;
	//var $logdir = "/var/www/sch1/";
	//var $suf = ".log.html";
	//var $prefix = "logger01";
	
	function pdocon(){
		//echo "init start";
		try {
			$this->pdo = new PDO(DB_HOST.';'.DB_NAME.';charset=utf8'
			,DB_USER
			,DB_PASS
			,array(PDO::ATTR_EMULATE_PREPARES => false));
/*			$options = array(
				PDO::MYSQL_ATTR_READ_DEFAULT_FILE => '/etc/my.cnf',
			);
			$dsn = DB_HOST.';'.DB_NAME.';';
			$this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);			
		*/
			
			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			//echo "Can Open pdo";
		} catch (PDOException $e) {
			header('Content-Type: text/html; charset=utf-8');
			 exit('データベース接続失敗。'.$e->getMessage());
			 //var_dump($e->getMessage());
		}
		//echo "Init end";
	}

	function getStatement($sql){
		$stmt = $this->pdo->query($sql);
		return $stmt;
	}
	
	function setCloseCursor($stmt){
		// バージョンによってはきちんとcloseしないと次のSQLが実行されない
		$stmt->closeCursor();
	}
	
	function getStatementLike(){
		// クエリーの実行
		$name = "shuma";
		$sql = "select usr_mid,usr_vch0,usr_vch1,usr_vch2,usr_vch3 from tb_usr where usr_vch2 like ?";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(1, '%' . addcslashes($name, '\_%') . '%', PDO::PARAM_STR);	
		$stmt->execute();
		$red = $stmt->fetchAll();
		
		echo "count=".count($red)."<br>";
		echo "<br>";
		var_dump($red);
		echo "<br>";
	}
	
	function getStatementSample(){
		// クエリーの実行
		$sql = "select usr_mid,usr_vch0,usr_vch1,usr_vch2,usr_vch3 from tb_usr where usr_vch2 like '%shuma%'";
		//$sql = "SELECT * FROM tb_usr";
		$stmt = $this->pdo->query($sql);
		var_dump($stmt);
		$count = $stmt -> rowCount();
		echo "count=$count<br>";
		// 結果の取得
		$datas = array();
		foreach ($stmt as $row) {
				$datas[] = $row;
		}
		var_dump($datas);
		
		// バージョンによってはきちんとcloseしないと次のSQLが実行されない
		$stmt->closeCursor();

	}
	
	function pdo_query(){
		//PDOオブジェクト自体に指定。レスポンスは常に連想配列形式で取得するようになる
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		 
		$stmt = $pdo->query('SELECT * FROM Entry');
		//PDOStatement毎に指定することも可能
		//レスポンスをstdClassとして取得
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'stdClass');
		 
		var_dump($stmt->fetchAll());
		/*
		array(
			stdClass{...},
			stdClass{...},
			...
		)
		*/
	}
	
	function pdo_insert(){
		$stmt = $pdo -> prepare("INSERT INTO テーブル名 (name, value) VALUES (:name, :value)");
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindValue(':value', $value, PDO::PARAM_INT);
		
		$name = 'one';
		$value = 1;
		$stmt->execute();

		$sql = 'update テーブル名 set name =:name where id = :value';
		$stmt = $pdo -> prepare($sql);
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindValue(':value', $value, PDO::PARAM_INT);
		$stmt->execute();

		$sql = 'DELETE FROM テーブル名 where id = :delete_id';
		$stmt = $pdo -> prepare($sql);
		$stmt -> bindValue(':delete_id', $value, PDO::PARAM_INT);
		$stmt -> execute();

		$stmt = $pdo -> query("SELECT * FROM テーブル名");
		$count = $stmt -> rowCount();

	}
	/* 未使用
	function setTransuction(){
		// トランザクション開始
		$pdo->beginTransaction();
		
		// INSERTとか DELETEとか
		
		// トランザクション完了
		$pdo->commit();
		
		// トランザクション取り消し
		$pdo->rollBack();   
	}

	function mydb_query ($query="") {
			$logger = new logger();
			$logger->setWriteLog($query."<br>\n");
			//$logger->setWriteLog("ret=$ret<br>\n");

		   echo 'Could not run query: ' . mysql_error();
			print ("<br>query=$query<br>\n");	
	}
	
	function getConnect(){
		$conn = mysql_connect($this->dbhost.":".$this->dbport,$this->dbuser,$this->dbpass);
		if ($conn == False) {
			print ("can not connect db<br>\n");	
			//exit;
			return false;
		}else{
			return $conn;
		}
	}
	*/
	
}	
?>
