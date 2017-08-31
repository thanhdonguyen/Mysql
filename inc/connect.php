<?php
class connect{
	var $tableName	= "bse";
	function getConnect(){
		$dbaccess = new dbaccess();
		return $dbaccess->getConnect();
	}
	
	function unsets($postData){
		unset($postData['PHPSESSID']);
		unset($postData['files']);
		unset($postData['guestTxt']);
		unset($postData['SQLiteManager_currentLangue']);
		return $postData;
	}
	
/**
 *  概要：最大値+1取得
 *
 *  詳細：各テーブルにある[xxx_mid]の最大値+1を取得する
 *
 * @access public
 * @param 
 * @return string型  テーブルの項目すべて
 * @see
 * @throws 例外についての記述
 * @todo 未対応（改善）事項等
 */

	function getMaxMID(){
		$sql = "select max(".$this->tableName."_mid)+1 as maxmid from tb_".$this->tableName."";
		$pdocon = new pdocon();
		$statement = $pdocon->pdo->query($sql);
		$members = array();
		foreach ($statement as $row) {
				$members[] = $row;
		}
		// バージョンによってはきちんとcloseしないと次のSQLが実行されない
		$statement->closeCursor();
		
		if(empty($members[0]["maxmid"])) $maxmid=100001; else $maxmid=$members[0]["maxmid"];
		//echo "<br>maxmid2=$maxmid<BR>";

		return $maxmid;
	}

/**
 *  概要：SubID 取得
 *
 *  詳細：SubID のＭＡＸ値
 *
 * @access public
 * @param 
 * @return string型  
 * @see
 * @throws 例外についての記述
 * @todo 未対応（改善）事項等
 */	
	function getMaxSID($key_mid){

		$sql = "select max(".$this->tableName."_sid)+1 
						as maxsid 
						from tb_".$this->tableName." 
						where ".$this->tableName."_mid = :key_mid";
		
		$pdocon = new pdocon();
		$stmt = $pdocon->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		
		$stmt->bindValue(  ":key_mid", $key_mid, PDO::PARAM_INT);
		echo $sql = str_replace(":key_mid", $key_mid,$sql);
				
		$stmt->execute();
		unset($datas);
		$datas = $stmt->fetchAll();
		
		if(empty($datas[0]["maxsid"])) $maxsid=1; else $maxsid=$datas[0]["maxsid"];
		//echo "maxsid=".$maxsid.br;

		return $maxsid;
	}

	
	
	
	
/**
 *  概要：データインサート
 *
 *  詳細：
 *
 * @access public
 * @param 
 * @return string型  テーブルの項目すべて
 * @see
 * @throws 例外についての記述
 * @todo 未対応（改善）事項等
 */
	function setInsert($postData){
		$postData = $this->unsets($postData);
		// $postData[$this->tableName."_inday"] = date("Y-m-d H:i:s");
		// $postData[$this->tableName."_upday"] = date("Y-m-d H:i:s");
        try{		
    		foreach ($postData as $key=>$value) {
    			if($value==null || $value==""){
    				unset($postData[$key]);
    			}else{
    				$sqlFields .= $key." , ";
    				$sqlValues .= ":".$key.", ";
    			}
    		}
    		$sqlFields = substr($sqlFields,0,-2);
    		$sqlValues = substr($sqlValues,0,-2);
    		
    		$sql = "insert into tb_".$this->tableName."($sqlFields) values ($sqlValues)";
    		//echo BR.$sql.BR;
    		
    		$pdocon = new pdocon();
    		$stmt = $pdocon->pdo->prepare($sql);
			//var_dump($stmt);
			//die;
    		foreach ($postData as $key=>$value) {
    			if(preg_match('/(vch|dat|txt|day)/', $key)){
    				//echo "s:$key=$value<BR>";
    				$stmt->bindValue(':'.$key, $value, PDO::PARAM_STR);
    				$sql = str_replace(':'.$key, "'".$value."'", $sql);
    			}
				else{
    				//echo "$key=$value".BR;
    				$stmt->bindValue(':'.$key, $value, PDO::PARAM_INT);
    				$sql = str_replace(':'.$key, $value, $sql);
    			}
    		}
    	//var_dump($stmt);
    		setDbg('SQL',$sql);
    //echo BR.$sql.BR;
    		$flg=$stmt->execute();
    //var_dump($flg);
			//echo $sql;
			//die;
    		return $postData[$this->tableName."_mid"];
    	
        }catch(PDOException $e) {
                echo $e->getMessage();
        }   
    } 

//	function setInsert($postData){
//		$postData = $this->unsets($postData);
//		$postData[$this->tableName."_inday"] = date("Y-m-d H:i:s");
//		$postData[$this->tableName."_upday"] = date("Y-m-d H:i:s");
//        try{		
//    		foreach ($postData as $key=>$value) {
//    			if($value==null || $value==""){
//    				unset($postData[$key]);
//    			}else{
//    				$sqlFields .= $key." , ";
//    				$sqlValues .= "'".$value."', ";
//    			}
//    		}
//    		$sqlFields = substr($sqlFields,0,-2);
//    		$sqlValues = substr($sqlValues,0,-2);
//    		
//    		$sql = "insert into tb_".$this->tableName."($sqlFields) values ($sqlValues)";
//    		//echo BR.$sql.BR;
//echo "$sql \r\n";    		
//    		$pdocon = new pdocon();
//    		$stmt = $pdocon->pdo->prepare($sql);
//   /* 		foreach ($postData as $key=>$value) {
//    			if(preg_match('/(vch|dat|txt|day)/', $key)){
//    				echo "s:$key=$value<BR>";
//    				$stmt->bindValue(':'.$key, $value, PDO::PARAM_STR);
//    				//$sql = str_replace(':'.$key, "'".$value."'", $sql);
//    			}else{
//    				//echo "$key=$value".BR;
//    				$stmt->bindValue(':'.$key, $value, PDO::PARAM_INT);
//    				//$sql = str_replace(':'.$key, $value, $sql);
//    			}
//    		}
//  */          
//    //var_dump($stmt);		
//    		//setDbg('SQL',$sql);
//    		//echo BR.$sql.BR;
//    		$flg=$stmt->execute();
//    var_dump($flg);
//    		return $postData[$this->tableName."_mid"];
//    	
//        }catch(PDOException $e) {
//                echo $e->getMessage();
//        }   
//    }
    
//	function setInsert($postData){
//		$postData = $this->unsets($postData);
//		$postData[$this->tableName."_inday"] = date("Y-m-d H:i:s");
//		$postData[$this->tableName."_upday"] = date("Y-m-d H:i:s");
//		
//		foreach ($postData as $key=>$value) {
//			if($value==null || $value==""){
//				unset($postData[$key]);
//			}else{
//				$sqlFields .= $key." , ";
//				$sqlValues .= "? , ";
//			}
//		}
//		$sqlFields = substr($sqlFields,0,-2);
//		$sqlValues = substr($sqlValues,0,-2);
//		
//		$sql = "insert into tb_".$this->tableName."($sqlFields) values ($sqlValues)";
//		//echo BR.$sql.BR;
//		
//		$pdocon = new pdocon();
//		$stmt = $pdocon->pdo->prepare($sql);
//        $i=1;
//		foreach ($postData as $key=>$value) {
//			if(preg_match('/(vch|dat|txt|day)/', $key)){
//				//echo "s:$key=$value<BR>";
//                $value = "'".$value."'";
//				$stmt->bindParam($i, $value, PDO::PARAM_STR);
//				//$sql = str_replace(':'.$key, "'".$value."'", $sql);
//			}else{
//				//echo "$key=$value".BR;
//				$stmt->bindParam($i, $value, PDO::PARAM_INT);
//				//$sql = str_replace(':'.$key, $value, $sql);
//			}
//            $i++;
//		}
//var_dump($stmt);		
//		//setDbg('SQL',$sql);
//		//echo BR.$sql.BR;
//		$flg=$stmt->execute();
//var_dump($stmt);exit;
//		return $postData[$this->tableName."_mid"];
//	}

/**
 *  概要：データ更新
 *
 *  詳細：where条件が「xxx_mid」の条件で更新
 *
 * @access public
 * @param 
 * @return string型  テーブルの項目すべて
 * @see
 * @throws 例外についての記述
 * @todo 未対応（改善）事項等
 */
	function setUpdate($postData){
		$postData = $this->unsets($postData);

		// $postData[$this->tableName."_upday"] = date("Y-m-d H:i:s");
		$mid=$postData[$this->tableName."_mid"];
		unset($postData[$this->tableName."_mid"]);
		
		foreach ($postData as $key=>$value) {
			$sqlValues .= $key." =:".$key." , ";
		}
		$sqlValues = substr($sqlValues,0,-2);
		
		$sql = "update tb_".$this->tableName." set $sqlValues where ".$this->tableName."_mid = :".$this->tableName."_mid ";
		// echo "sql:$sql";
		$postData[$this->tableName."_mid"]=$mid;
		//print_r($postData);
		$dispsql=$sql;

		$pdocon = new pdocon();
		$stmt = $pdocon->pdo->prepare($sql);
		foreach ($postData as $key=>$value) {
			if(preg_match('/(vch|dat|txt|day|dat)/', $key)){
				if(!empty($value)){
					//echo "s:$key=$value\n";
					$stmt->bindValue(':'.$key, $value, PDO::PARAM_STR);
					$dispsql = str_replace(':'.$key, "'".$value."'", $dispsql);
				}else{
					$stmt->bindValue(':'.$key, null, PDO::PARAM_STR);
					$dispsql = str_replace(':'.$key, nul, $dispsql);
				}
			}else{
				if(empty($value)) {
					//echo "i0:$key=$value\n";
					//$stmt->bindValue(':'.$key, null, PDO::PARAM_INT);
					$stmt->bindValue(':'.$key, 0, PDO::PARAM_INT);
					$dispsql = str_replace(':'.$key, 0, $dispsql);
				}else{
					//echo "ii:$key=$value\n";
					$stmt->bindValue(':'.$key, $value, PDO::PARAM_INT);
					$dispsql = str_replace(':'.$key, $value, $dispsql);
				}
			}				
		}
		//echo $dispsql."\r\n";
		
		$flg=$stmt->execute();
        //var_dump($flg);
		$count = $stmt->rowCount();
		if($count>0) $mid = $postData[$this->tableName."_mid"]; else $mid=0;
		
		return $mid;
	}
	
/**
 *  概要：データ更新
 *
 *  詳細：where条件が「xxx_mid」+「xxx_sid」の条件で更新
 *
 * @access public
 * @param 
 * @return string型  テーブルの項目すべて
 * @see
 * @throws 例外についての記述
 * @todo 未対応（改善）事項等
 */
	function setUpdate2Key($postData){
		$postData = $this->unsets($postData);

		$postData[$this->tableName."_upday"] = date("Y-m-d H:i:s");
		$mid=$postData[$this->tableName."_mid"];
		unset($postData[$this->tableName."_mid"]);

		$sid=$postData[$this->tableName."_sid"];
		unset($postData[$this->tableName."_sid"]);
		
		
		foreach ($postData as $key=>$value) {
			if($value==null || $value==""){
				$sqlValues .= $key." =null , ";
				unset($postData[$key]);
			}else{
				$sqlValues .= $key." =:".$key." , ";
			}
		}
		$sqlValues = substr($sqlValues,0,-2);
		
		$sql = "update tb_".$this->tableName." set $sqlValues where ".$this->tableName."_mid = :".$this->tableName."_mid and ".$this->tableName."_sid = :".$this->tableName."_sid";
		$postData[$this->tableName."_mid"]=$mid;
		$postData[$this->tableName."_sid"]=$sid;
//echo "sql  ---->".$sql.BR;
		
		
		//echo BR.$sql.BR."\n";
		
		$pdocon = new pdocon();
		$stmt = $pdocon->pdo->prepare($sql);
		foreach ($postData as $key=>$value) {
			if(preg_match('/(vch|dat|txt|day)/', $key)){
				//echo "s:$key=$value\n";
				$stmt->bindValue(':'.$key, $value, PDO::PARAM_STR);
		}else{
				//echo "i:$key=$value\n";
				$stmt->bindValue(':'.$key, $value, PDO::PARAM_INT);
			}
		}
		
		$flg=$stmt->execute();
		if($flg) {
			$returnData[$this->tableName."_mid"] = $postData[$this->tableName."_mid"]; 
			$returnData[$this->tableName."_sid"] = $postData[$this->tableName."_sid"]; 
		} else  {
			$returnData[$this->tableName."_mid"] = 0;
			$returnData[$this->tableName."_sid"] = 0;
		}

		return $returnData;
	}

	
/**
 *  概要：データ更新（稼働日カレンダー専用）
 *
 *  詳細：where条件が日付、事業者SEQの条件で更新
 *
 * @access public
 * @param 
 * @return string型  テーブルの項目すべて
 * @see
 * @throws 例外についての記述
 * @todo 未対応（改善）事項等
 */
	function setUpdateCalendar($postData){

		$postData[$this->tableName."_upday"] = date("Y-m-d H:i:s");

		$dat=$postData[$this->tableName."_dat0"];
		unset($postData[$this->tableName."_dat0"]);

		$plt=$postData[$this->tableName."_int0"];
		unset($postData[$this->tableName."_int0"]);

		foreach ($postData as $key=>$value) {
			if(!empty($value)){
				$sqlValues .= $key." =:".$key." , ";
			}else{
				//unset($postData[$key]);
				$sqlValues .= $key." =null , ";
			}
		}
		$sqlValues = substr($sqlValues,0,-2);
		
		$sql = "update tb_".$this->tableName." set $sqlValues where ".$this->tableName."_dat0 = :".$this->tableName."_dat0 and ".$this->tableName."_int0 = :".$this->tableName."_int0";
		$postData[$this->tableName."_dat0"]=$dat;
		$postData[$this->tableName."_int0"]=$plt;

		$pdocon = new pdocon();
		$stmt = $pdocon->pdo->prepare($sql);
		foreach ($postData as $key=>$value) {

			if(!empty($value)){
				if(preg_match('/(vch|dat|txt|day)/', $key)){
					//echo "s:$key=$value\n";
					$stmt->bindValue(':'.$key, $value, PDO::PARAM_STR);
				}else{
					//echo "i:$key=$value\n";
					$stmt->bindValue(':'.$key, $value, PDO::PARAM_INT);
				}				
			}else{
			}
				
		}
		
		$flg=$stmt->execute();
		if($flg) $dat = $postData[$this->tableName."_dat0"]; else $dat=0;

		return $dat;
	}

/**
 *  概要：データ更新（カレンダーマスタ）
 *
 *  詳細：where条件が日付の条件で更新
 *
 * @access public
 * @param 
 * @return string型  テーブルの項目すべて
 * @see
 * @throws 例外についての記述
 * @todo 未対応（改善）事項等
 */
	function setUpdateCalendarMst($postData){

		$postData[$this->tableName."_upday"] = date("Y-m-d H:i:s");

		$dat=$postData[$this->tableName."_dat0"];
		unset($postData[$this->tableName."_dat0"]);

		foreach ($postData as $key=>$value) {
			if(!empty($value)){
				$sqlValues .= $key." =:".$key." , ";
			}else{
				//unset($postData[$key]);
				$sqlValues .= $key." =null , ";
			}
		}
		$sqlValues = substr($sqlValues,0,-2);
		
		$sql = "update tb_".$this->tableName." set $sqlValues where ".$this->tableName."_dat0 = :".$this->tableName."_dat0";
		$postData[$this->tableName."_dat0"]=$dat;

		$pdocon = new pdocon();
		$stmt = $pdocon->pdo->prepare($sql);
		foreach ($postData as $key=>$value) {

			if(!empty($value)){
				if(preg_match('/(vch|dat|txt|day)/', $key)){
					//echo "s:$key=$value\n";
					$stmt->bindValue(':'.$key, $value, PDO::PARAM_STR);
				}else{
					//echo "i:$key=$value\n";
					$stmt->bindValue(':'.$key, $value, PDO::PARAM_INT);
				}				
			}else{
			}
				
		}
		
		$flg=$stmt->execute();
		if($flg) $dat = $postData[$this->tableName."_dat0"]; else $dat=0;

		return $dat;
	}
	
	
	function setDelete($postData){
		$postData = $this->unsets($postData);
		//SQL文を実行する
		$sql  = "update tb_".$this->tableName." set ".$this->tableName."_dlday=now()  where ".$this->tableName."_mid= :mid ";
		$pdocon = new pdocon();
		$stmt = $pdocon->pdo->prepare($sql);
		//echo $sql.BR.$this->tableName.'_mid'.$postData[$this->tableName.'_mid'].BR.$sql;
		$stmt->bindValue(':mid', $postData[$this->tableName.'_mid'], PDO::PARAM_INT);
		$flg=$stmt->execute();
		if($flg) $mid = $postData[$this->tableName."_mid"]; else $mid=0;
		//var_dump($flg);

		return $mid;
	}

	function setDelete2Key($postData){
		$postData = $this->unsets($postData);
		//var_dump($postData);
		//SQL文を実行する
		$sql  = "update tb_".$this->tableName." set ".$this->tableName."_dlday=now()  where ".$this->tableName."_mid= :mid and ".$this->tableName."_sid= :sid";
		$pdocon = new pdocon();
		$stmt = $pdocon->pdo->prepare($sql);
		//echo $sql.BR.$this->tableName.'_mid'.$postData[$this->tableName.'_mid'].BR.$sql;
		$stmt->bindValue(':mid', $postData[$this->tableName.'_mid'], PDO::PARAM_INT);
		$stmt->bindValue(':sid', $postData[$this->tableName.'_sid'], PDO::PARAM_INT);
		//$sql = str_replace(':mid', $postData[$this->tableName.'_mid'],$sql);
		//echo $sql = str_replace(':sid', $postData[$this->tableName.'_sid'],$sql);
		$flg=$stmt->execute();
		if($flg) {
			$returnData[$this->tableName."_mid"] = $postData[$this->tableName."_mid"]; 
			$returnData[$this->tableName."_sid"] = $postData[$this->tableName."_sid"]; 
		} else  {
			$returnData[$this->tableName."_mid"] = 0;
			$returnData[$this->tableName."_sid"] = 0;
		}
		//var_dump($stmt);

		return $returnData;
	}
	
	function getObjects(){
		$obj="";
		for ($i = 0; $i < sizeof($this->ad); $i++) {
			$key=$this->ad[$i][0];
			$typ=$this->ad[$i][1];
			if($typ=="dat"){
				//$obj .= " DATE_FORMAT($key,'%Y/%m/%d') as $key, ";
				$obj .= " DATE_FORMAT($key,'%Y-%m-%d %H:%i:%s') as $key, ";
			}else{
				$obj .= " $key, ";
			}
		}
		$obj = substr($obj,0,-2);
		return $obj;	
	}
	
	function setBinds($stmt,$sql,$postData){
		//echo $sql;
		//print_r($postData);
		foreach ($postData as $key=>$value) {
			if(preg_match("/:$key/", $sql)){
				if(!empty($value)){
					if(preg_match('/vch/',$key)){
						$stmt->bindValue(":".$key, "%".$value."%", PDO::PARAM_STR);
						$sql = str_replace(":".$key, "'%".$value."%'",$sql);
					}elseif(preg_match('/dat/',$key)){
						$stmt->bindValue(":".$key, $value, PDO::PARAM_STR);
						$sql = str_replace(":".$key, "'".$value."'",$sql);
					}else{
						//echo BR.$key.";".$value.BR; 
						if(empty($value)) $value=0;
						$sql = str_replace(":".$key, $value,$sql);
						$stmt->bindValue(":".$key, $value, PDO::PARAM_INT);
					}
				}
			}
		}
		//echo $sql;
		return $stmt;
	}
	
//Not Use------------------------------------------------------------------------------
 	 	  
	
	function getCheckValues($postDatas,$errMsg){
		$ad = $this->ad;
		mb_regex_encoding("UTF-8");
		mb_internal_encoding("UTF-8");
		$errMsg['errflg'] = 0;
		
		foreach($postDatas as $key=>$value){
			$strErrorMessage 	=	null;
			$strErrorID			=	0;
			$errMsg[$key] = "";
			
			for($j=0;$j<sizeof($ad);$j++){
				if($ad[$j][0]==$key){
					$arrayno=$j;
					if(!empty($ad[$j][7])){
						$errMsg[$key] = $this->getChkType($value,$ad[$j][7]);
						//echo ":$key:ugl_int15=".$ad[$j][5].";".$ad[$j][7].";".$errMsg[$key].";<BR>";
						if(!empty($errMsg[$key])){
							$errMsg['errflg'] = 1;
							$errMsg[$key] = $ad[$j][4].$errMsg[$key];
							//echo "errMsg=".$errMsg[$key]."<BR>";
						}
					}
					//echo "key=$key:$value;".$ad[$j][7].":".$errMsg[$key].'<br>';
				}
			}
			
			if($strErrorID != 1){
				if ($ad[$arrayno][1]==="str"||$ad[$arrayno][1]==="vch") {
					//echo "key=".$key.$ad[$arrayno][1].";".$value;
					if(($value!=null)){
						$charNo=mb_strlen($value);
					}else{
						$charNo=0;
					}
					//echo "<br>charNo=".$charNo.":min:".$ad[$arrayno][2]."max:".$ad[$arrayno][3].$value;//."<br>";				
					if ($ad[$arrayno][2]===$ad[$arrayno][3] && $charNo!=$ad[$arrayno][3]) {
						$errMsg[$key] = $ad[$arrayno][4]."は".$ad[$arrayno][2]."文字で入力してください。";
						$errMsg['errflg'] = 1;
					}else{
						if ($charNo>$ad[$arrayno][3]) {
							$errMsg[$key] = $ad[$arrayno][4]."は".$ad[$arrayno][2]."文字以上、".$ad[$arrayno][3]."文字以下で入力してください。";
							$errMsg['errflg'] = 1;
						}
						
						if ($charNo<$ad[$arrayno][2]) {
							$errMsg[$key] = $ad[$arrayno][4]."は".$ad[$arrayno][2]."文字以上、".$ad[$arrayno][3]."文字以下で入力してください。";
							$errMsg['errflg'] = 1;
						}
					}
				}elseif ($ad[$arrayno][1]==="int"){
					//$str = mb_convert_encoding($value, "UTF-8", "auto");
					//$numVal = intval($str);
					//$numVal = intval($value);
					//echo $key.":".$ad[$arrayno][2]."<".$value."<=".$ad[$arrayno][3]."<br>";					
					if(is_numeric($value)){
						if (strlen($value) >= $ad[$arrayno][3]) {

							$errMsg[$key] = $ad[$arrayno][4]."は".$ad[$arrayno][2]."以上".$ad[$arrayno][3]."以下の数値で入力してください。";
							$errMsg['errflg'] = 1;
						}
						if (strlen($value) <= $ad[$arrayno][2]) {
							$errMsg[$key] = $ad[$arrayno][4]."は".$ad[$arrayno][2]."以上".$ad[$arrayno][3]."以下の数値で入力してください。";
							$errMsg['errflg'] = 1;
						}
					}else{
						$errMsg[$key] = $ad[$arrayno][4]."は".$ad[$arrayno][2]."以上".$ad[$arrayno][3]."以下の数値で入力してください。。";
						$errMsg['errflg'] = 1;
						$value=0;
					}
						
				}elseif ($ad[$arrayno][1]=="dat"){

					//echo $postDatas[$i]["Key"].";";
					if($value!=""){
						if(strtotime($value)=== false){
							$errMsg[$key] = $ad[$arrayno][4]."の入力値が日付ではありません。$key:$value";
							$errMsg['errflg'] = 1;
						}else{
							//$value.":".$ad[$arrayno][5]."の入力値が日付です。";
						}
					}else{
						if ($ad[$arrayno][2]<$ad[$arrayno][3]) {
							$errMsg[$key] = $ad[$arrayno][4]."の入力値を日付形式で入力してください。";
							$errMsg['errflg'] = 1;
						}else{
							//echo $value.":".$ad[$arrayno][4]."の入力値は日付です。";
						}
					}
				}elseif ($ad[$arrayno][1]=="txt"){
					
				}
				//echo "errflg=".$errMsg['errflg']."<br>";
			}		
		}
		//var_dump($errMsg);
		return $errMsg;
	}
	
	function getChkType($value,$chkType){
		mb_regex_encoding("UTF-8");
		/*
		$chkType == "ZenkakuA0";//全角のみ使用可能です。";
		$chkType == "Zenkaku10";//全角英数のみ使用可能です。";
		$chkType == "ZenkakuKn";//全角カナのみ使用可能です。";
		$chkType == "ZenkakuHn";//全角かなのみ使用可能です。";
		$chkType == "HankakuAZ";//半角英字のみ使用可能です。";
		$chkType == "Hankaku10";//半角数字のみ使用可能です。";
		$chkType == "HankakuA0";//半角英数字のみ使用可能です。";
		$chkType == "HankakuA0";//半角英数字記号のみ使用可能です。";
		$chkType == "NotHyphen";//(ハイフン)は使用できません。";
		$chkType == "Emailadrs";//DoCoMoの変メールをカバーした正しいメアド。";
		$chkType == "SelectInt";//セレクトボックスやラジオボタンの必須の場合";
		*/
		
		$errMsg=null;
		//addDebugLog("chkType",$chkType.";".$value);
		if($chkType == "SelectInt" && empty($value)){
			$errMsg = "を選択してください。";
			return $errMsg;
		}else{
			//return $errMsg = "を選択しています。";
		}		
	
		if (empty($value)) return $errMsg;
		
		switch ($chkType) {
			case "ZenkakuA0":
				if (!preg_match("/[^ -~｡-ﾟ]+$/u",$value)) 
				$errMsg = "は全角のみ使用可能です。";
				break;
			case "Zenkaku10":
				if (!preg_match("/[０-９ａ-ｚＡ-Ｚ]+$/u",$value)) 
				$errMsg = "は全角英数のみ使用可能です。";
				break;
			case "ZenkakuKn":
				if (!preg_match("/^[ァ-ヶー（），「　」．－／]+$/u",$value))
				$errMsg = "は全角カナのみ使用可能です。";
				break;
			case "ZenkakuKA":
				if (!preg_match("/^[ァ-ヶーａ-ｚＡ-Ｚ（），「　」．－／]+$/u",$value))
				$errMsg = "は全角カタカナと全角英字のみ使用可能です。";
				break;
			case "ZenkakuHn":
				if (!preg_match("/^[ぁ-ん]+$/u",$value))
				$errMsg = "は全角かなのみ使用可能です。";
				break;
			case "HankakuAZ":
				if (!preg_match("/^[a-zA-Z]+$/",$value))
				$errMsg = "は半角英字のみ使用可能です。";
				break;
			case "Hankaku10":
				if (!preg_match("/^[0-9]+$/",$value))
				$errMsg = "は半角数字のみ使用可能です。";
				break;
			case "HankakuA0":
				if (!preg_match("/^[a-zA-Z0-9]+$/",$value))
				$errMsg = "は半角英数字のみ使用可能です。";
				break;
			case "HankakuA-":
				if (!preg_match("/^[[:graph:]|[:space:]]+$/i",$value))
				$errMsg = "は半角英数記号のみ使用可能です。";
				break;
			case "NotHyphen":
				if (strpos($value,"-")===true)
				$errMsg = "は-(ハイフン)は使用できません。";
				break;
			case "Emailaddrs":
				if(!preg_match('/^[-+.\\w]+@[-a-z0-9]+(\\.[-a-z0-9]+)*\\.[a-z]{2,6}$/i', $value))
				$errMsg = "にはこのEMailアドレスは使用できません。";
				break;
		}
		addDebugLog("errMsg",$errMsg.":".$value);
		return $errMsg;
	}
	
	function getChkRange(){
		if(empty($spc_int1_err) && empty($spc_int1E_err)){
			if(!empty($_REQUEST["spc_int1"])&& !empty($_REQUEST["spc_int1E"]) && $_REQUEST["spc_int1"]>$_REQUEST["spc_int1E"]){
				$_REQUEST['spc_int1E']=null;
				$spc_int1_err = "<BR>数値範囲が逆に入力されています。";
			}
		}
	}
	
}
?>
