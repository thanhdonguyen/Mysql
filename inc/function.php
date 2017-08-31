<?php
  //session_start();

  //May be this statics will move config.php
  define('HEADERMARK', '<!--DontRead Header-->');
  define('FOOTERMARK', '<!--DontRead Footer-->');

  define('IMGHEADMARK', '<!--DontRead Image Header-->');
  define('IMGFOOTMARK', '<!--DontRead Image Footer-->');
  define('IMGREPLACETXT', '<!--IMGHTML-->');

  function getTemplate($htmlpath){
		$fileHandle = fopen($htmlpath,'r');
		$fileTxt	= fread($fileHandle, filesize($htmlpath));
		//Add for JQuery
		//$fileTxt	= str_replace(").html(","##.php##",$fileTxt);
		//$fileTxt	= str_replace(".html",".php",$fileTxt);
		//$fileTxt	= str_replace("##.php##",").html(",$fileTxt);

		//$fileTxt=substr($fileTxt,strpos($fileTxt,HEADERMARK)+strlen(HEADERMARK),strlen($fileTxt));
		//$fileTxt=substr($fileTxt,0,strpos($fileTxt,FOOTERMARK));

		return $fileTxt;
  }
  
  function setDbg($type,$param){
  	switch ($type) {
  		case "SQL":
			$_SESSION['DEBUG_SQL'] .= $param.BR;
  			break;
  		case "HTML":
			$_SESSION['DEBUG_HTML'] .= $param.BR;
  			//$html = str_replace("<!--".$arr[0]."-->",$sqlDatas[0]['max_sid'],$html);
  			break;
  		case "ARR":
			$_SESSION['DEBUG_ARR'] .= print_r($param,true).BR;
  			break;
  		case "OUP":
  			//$html = str_replace("<!--".$arr[0]."-->",$sqlDatas[0]['max_sort'],$html);
  			break;
  		default:
			$_SESSION['DEBUG_TXT'] .= $param.BR;
  	}
  }
  
  function setDispDbg($DEBUGMODE = null){
  	if($DEBUGMODE) echo $_SESSION['DEBUG_SQL'];
  	if($DEBUGMODE) echo $_SESSION['DEBUG_HTML'];
  	if($DEBUGMODE) echo $_SESSION['DEBUG_ARR'];
  	if($DEBUGMODE) echo $_SESSION['DEBUG_TXT'];
  	setClearDbg();
  }
  
  function setClearDbg(){
  	$_SESSION['DEBUG_SQL']	=null;
  	$_SESSION['DEBUG_HTML']	=null;
  	$_SESSION['DEBUG_ARR']	=null;
  	$_SESSION['DEBUG_TXT']	=null;
  }
  
  function getListNo($fileTxt,$no){
		$listHeader = "<!--Forloop_Header_$no-->";
		$listFooter = "<!--Forloop_Footer_$no-->";
		$fileTxt=substr($fileTxt,strpos($fileTxt,$listHeader)+strlen($listHeader),strlen($fileTxt));
		$fileTxt=substr($fileTxt,0,strpos($fileTxt,$listFooter));
		return $fileTxt;
  }

  function getImageTag($fileTxt){
	$searchTxt=substr($fileTxt,strpos($fileTxt,IMGHEADMARK)+strlen(IMGHEADMARK),strlen($fileTxt));
	$searchTxt=substr($searchTxt,0,strpos($searchTxt,IMGFOOTMARK));
	$fileTxt = str_replace($searchTxt,"<!--IMGHTML-->アップロードイメージなし",$fileTxt);

	return $fileTxt;
  }

  function cvUTF8($str){
	return mb_convert_encoding($str,'UTF-8','sjis-win');
  }

  function html2specialchars($str){
	$str=str_replace("''","'",$str);
	$str = htmlspecialchars($str);
	return $str;
  }
  function setSesseionOut(){
	  if(empty($_SESSION['usr_mid'])){
		  header("Location: ../login/login.php");
		  die();
	  }
  }

  function addDebugLog($key,$val){
	  if(empty($key))
		$_SESSION['debuglog'].="$val<BR>\n";
	  else
		$_SESSION['debuglog'].="$key=$val<BR>\n";
  }

  //Check for JPDate
  function getChkDate($value){
	mb_regex_encoding("UTF-8");
	$msg=null;
	if(!empty($value) && !strptime($value, '%Y/%m/%d' ) ){
		$msg = "<BR>日付形式の値ではありません。";
	}else{
		if(!empty($value)){
			list($y, $m, $d) = array_pad(explode('/', $value, 3), 3, 0);
			if(!checkdate($m, $d, $y)){
				$msg = "<BR>日付の値ではありません。";
			}
		}
	}
	return $msg;
  }


/**
 *  概要：一覧用ページャー作成
 *
 *  詳細：マスタ一覧等の一覧表示で使用するページャーの作成
 *
 * @access public
 * @param $mid キーの値
 * @return array型 $datas テーブルの項目すべて
 * @see　pdo
 * @throws 例外についての記述
 * @todo 未対応（改善）事項等
 */
   function getPager($offsetno,$rows,$srcMaxNo,$srcMaxPg,$parent_id = 0){

		$srcMaxPg = floor($srcMaxPg/2)*2+1; //ページャーの数は必ず奇数
		$pageTotalNo= ceil($rows / $srcMaxNo);	//全体のページ数
		if($pageTotalNo<$srcMaxPg) $srcMaxPg=$pageTotalNo;
		//Make Pager--------------------------------------------------------------------------------------------------------
		$pgStart = $offsetno - floor($srcMaxNo/2);

   		if($pgStart<1) $pgStart=1;
		$pgEnd = $pgStart + $srcMaxNo;

		if($pgEnd>$pageTotalNo)
		$pgEnd = $pageTotalNo;

		if($pgEnd>$pageTotalNo){
			$pgEnd=$pageTotalNo;
			$pgStart=$pgEnd - $srcMaxPg+1;
		}

		if($srcMaxNo<$pgEnd)
		$pgStart = $pgEnd - $srcMaxNo;

		$disp1=($offsetno-1)*$srcMaxNo+1;
		$disp2=($offsetno-1)*$srcMaxNo+$srcMaxNo;
		$pagerTxt="<span>[全".$rows."件&nbsp;$disp1:$disp2]";
		$pagerTxt .="<ul class='pager float_right' id='work_list_pager'>\n";
		for($i=$pgStart;$i<=$pgEnd;$i++){
			if($i>1 && $i==$pgStart){
			    if($parent_id == 0)
				$pagerTxt .="　<li class='currentPage passive'><a onclick='setPage(".($i-1).")'>前へ</a></li>\n";
                else
                $pagerTxt .="　<li class='currentPage passive'><a onclick='setPage(".($i-1).",".$parent_id.")'>前へ</a></li>\n";
			}
            if($parent_id == 0)
			$pagerTxt .="　<li><a onclick='setPage($i)'>$i</a></li>\n";
            else
            $pagerTxt .="　<li><a onclick='setPage($i,$parent_id)'>$i</a></li>\n";
		}
		if($pageTotalNo>=$i)
            if($parent_id == 0)
			$pagerTxt .="　<li class='currentPage passive'><a onclick='setPage($i)>$i'>次へ</a></li>\n";
            else
            $pagerTxt .="　<li class='currentPage passive'><a onclick='setPage($i,$parent_id)>$i'>次へ</a></li>\n";

		$pagerTxt .="</ul></span>\n";
		//Make Pager------------------------------------------------------------------------------------------------------------
		$pagData['pagerTxt']=$pagerTxt;
		$pagData['offsetno']=$offsetno;
		$pagData['rows']=$rows;

		return $pagData;
  }

  /**
   *  概要：一覧用ページャー作成
   *
   *  詳細：マスタ一覧等の一覧表示で使用するページャーの作成
   *
   * @access public
   * @param $mid キーの値
   * @return array型 $datas テーブルの項目すべて
   * @see　pdo
   * @throws 例外についての記述
   * @todo 未対応（改善）事項等
   */
  function setPageSubmissionWithURL($offsetno,$rows,$srcMaxNo,$srcMaxPg,$functionName){
  	$srcMaxPg = floor($srcMaxPg/2)*2+1; //ページャーの数は必ず奇数
  	$pageTotalNo= ceil($rows / $srcMaxNo);	//全体のページ数
  	if($pageTotalNo<$srcMaxPg) $srcMaxPg=$pageTotalNo;
  	//Make Pager--------------------------------------------------------------------------------------------------------
  	$pgStart = $offsetno - floor($srcMaxNo/2);
  	if($pgStart<1) $pgStart=1;
  	$pgEnd = $pgStart + $srcMaxNo;
  	if($pgEnd>$pageTotalNo){
  		$pgEnd=$pageTotalNo;
  		$pgStart=$pgEnd - $srcMaxPg+1;
  	}

  	$disp1=($offsetno-1)*$srcMaxNo+1;
  	$disp2=($offsetno-1)*$srcMaxNo+$srcMaxNo;
  	$pagerTxt="<span>[全".$rows."件&nbsp;$disp1:$disp2]";
  	$pagerTxt .="<ul class='pager float_right' id='work_list_pager'>\n";

  	for($i=$pgStart;$i<=$pgEnd;$i++){
  		if($i>1 && $i==$pgStart){
  			$pagerTxt .="　<li class='currentPage passive'><a onclick='$functionName(".($i-1).")'>前へ</a></li>\n";
  		}
  		$pagerTxt .="　<li><a onclick='$functionName($i)'>$i</a></li>\n";
  	}
  	if($pageTotalNo>=$i)
  		$pagerTxt .="　<li class='currentPage passive'><a onclick='$functionName($i)>$i'>次へ</a></li>\n";

  	$pagerTxt .="</ul></span>\n";
  	//Make Pager------------------------------------------------------------------------------------------------------------
  	$pagData['pagerTxt']=$pagerTxt;
  	$pagData['offsetno']=$offsetno;
  	$pagData['rows']=$rows;
  	return $pagData;
  }
	function setPageButton(){
		$bt='<form id="myForm" class="form-horizontal" role="form" action="index.html">';
    $bt .='<li>';
    $bt .='<button type="submit" class="btn btn-default">';

    $bt .='</li>';
    $bt .='</form>';

	}

	function cvDate($obj){
		if(empty($obj)) return "";
		$YY = substr($obj,0,4)."年";
		$MM = str_replace("0","",substr($obj,5,2)."月");
		$DD = str_replace("0","",substr($obj,8,2)."日");
		return $YY.$MM.$DD;
	}


	function vdump($obj){
		ob_start();
		var_dump($obj);
		$dump = ob_get_contents();
		ob_end_clean();
		return $dump;
	}


/**
 *  概要：カレンダーマスタ専用ページャー作成
 *
 *  詳細：マスタメンテナンスのカレンダーマスタ一覧表示で使用するページャーの作成
 *      ：月単位のページャー（年単位）
 *
 * @access public
 * @param $mid キーの値
 * @return array型 $datas テーブルの項目すべて
 * @see　pdo
 * @throws 例外についての記述
 * @todo 未対応（改善）事項等
 */
//	function getPagerForCalendar($year,$month){
//
//
//		$pagerTxt ="<span>";
//		$pagerTxt .="<ul class='pager float_right' id='work_list_pager'>\n";
//		if ( $year >= 2015 ) {
//			$pagerTxt .="　<li><a onclick='setPage(".($year-1).")'>".($year-1)."</a></li>\n";
//		}
//
//		for($i=1;$i<=12;$i++){
//			$pagerTxt .="　<li><a onclick='setPage(".$year.sprintf('%02d',$i).")'>$i</a></li>\n";
//		}
//
//		$pagerTxt .="　<li><a onclick='setPage(".($year+1).")'>".($year+1)."</a></li>\n";
//		$pagerTxt .="</ul></span>\n";
//		//Make Pager------------------------------------------------------------------------------------------------------------
//		$pagData['pagerTxt']=$pagerTxt;
//		return $pagData;
//	}

/**
 *  概要：日報一覧専用ページャー作成
 *
 *  詳細：事業所日報一覧で使用するページャーの作成
 *
 * @access public
 * @param $mid キーの値
 * @return array型 $datas テーブルの項目すべて
 * @see　pdo
 * @throws 例外についての記述
 * @todo 未対応（改善）事項等
 */
	function getPagerForPlantReport($targetDay) {

//		$pagerTxt ="<span>";
//		$pagerTxt .="<ul class='pager float_right' id='work_list_pager'>\n";
		$pagerTxt .="　<li><a onclick='setPage(".$targetDay.")'>"."<<"."</a></li>\n";
		$pagerTxt .="　<li><a onclick='setPage(".$targetDay.")'>".">>"."</a></li>\n";
//		$pagerTxt .="</ul></span>\n";
		//Make Pager------------------------------------------------------------------------------------------------------------
		$pagData['pagerTxt']=$pagerTxt;
		return $pagData;




	}

	/**
	 *  概要：長いテキストをMac風に短縮表示するテキスト作成
	 *
	 *  詳細：事業所日報一覧で使用するページャーの作成
	 *
	 * @access public
	 * @param $mid キーの値
	 * @return array型 $datas テーブルの項目すべて
	 * @see　pdo
	 * @throws 例外についての記述
	 * @todo 未対応（改善）事項等
	 */
	function getShortName($name) {
		define('TXT_LIMIT','6');
		if(TXT_LIMIT<=mb_strlen($name)){
			$top = mb_substr($name,0,2);
			$end = mb_substr($name ,-2);
			$name = $top."..".$end;
		}
		return $name;
	}

/**
 *  概要：2015年版PHPユーザエージェント判別・判定
 *
 *  詳細：iPadの判定用
 *
 * @access public
 * @param
 * @return
 * @see　https://w3g.jp/blog/php_ua_sniffing2015
 * @throws 例外についての記述
 * @todo 未対応（改善）事項等
 */
	class UserAgent{
		private $ua;
		private $device;
		public function set(){
			$this->ua = mb_strtolower($_SERVER['HTTP_USER_AGENT']);
			if(strpos($this->ua,'iphone') !== false){
				$this->device = 'mobile';
			}elseif(strpos($this->ua,'ipod') !== false){
				$this->device = 'mobile';
			}elseif((strpos($this->ua,'android') !== false) && (strpos($this->ua, 'mobile') !== false)){
				$this->device = 'mobile';
			}elseif((strpos($this->ua,'windows') !== false) && (strpos($this->ua, 'phone') !== false)){
				$this->device = 'mobile';
			}elseif((strpos($this->ua,'firefox') !== false) && (strpos($this->ua, 'mobile') !== false)){
				$this->device = 'mobile';
			}elseif(strpos($this->ua,'blackberry') !== false){
				$this->device = 'mobile';
			}elseif(strpos($this->ua,'ipad') !== false){
				$this->device = 'tablet';
			}elseif((strpos($this->ua,'windows') !== false) && (strpos($this->ua, 'touch') !== false && (strpos($this->ua, 'tablet pc') == false))){
				$this->device = 'tablet';
			}elseif((strpos($this->ua,'android') !== false) && (strpos($this->ua, 'mobile') === false)){
				$this->device = 'tablet';
			}elseif((strpos($this->ua,'firefox') !== false) && (strpos($this->ua, 'tablet') !== false)){
				$this->device = 'tablet';
			}elseif((strpos($this->ua,'kindle') !== false) || (strpos($this->ua, 'silk') !== false)){
				$this->device = 'tablet';
			}elseif((strpos($this->ua,'playbook') !== false)){
				$this->device = 'tablet';
			}else{
				$this->device = 'others';
			}
			return $this->device;
		}
	}
	$userAgent = new UserAgent();
    
    function getTextBetweenTags($string, $tagname) {
        $pattern = "/<$tagname ?.*>(.*)<\/$tagname>/";
        preg_match($pattern, $string, $matches);
        return $matches[1];
    }   
    
    $alphabets = array(
        'A' => 'alphabet',
        'B' => 'alphabet',
        'C' => 'alphabet',
        'D' => 'alphabet',
        'E' => 'alphabet',
        'F' => 'alphabet',
        'G' => 'alphabet',
        'H' => 'alphabet',
        'I' => 'alphabet',
        'J' => 'alphabet',
        'K' => 'alphabet',
        'L' => 'alphabet',
        'M' => 'alphabet',
        'N' => 'alphabet',
        'O' => 'alphabet',
        'P' => 'alphabet',
        'Q' => 'alphabet',
        'R' => 'alphabet',
        'S' => 'alphabet',
        'T' => 'alphabet',
        'U' => 'alphabet',
        'V' => 'alphabet',
        'W' => 'alphabet',
        'X' => 'alphabet',
        'Y' => 'alphabet',
        'Z' => 'alphabet',
        '09' => 'numeric',
        'a'=>'kana',
        'i'=>'kana',
        'u'=>'kana',
        'e'=>'kana',
        'o'=>'kana',
        'ka'=>'kana',
        'ki'=>'kana',
        'ku'=>'kana',
        'ke'=>'kana',
        'ko'=>'kana',
        'sa'=>'kana',
        'shi'=>'kana',
        'su'=>'kana',
        'se'=>'kana',
        'so'=>'kana',
        'ta'=>'kana',
        'ti'=>'kana',
        'tu'=>'kana',
        'te'=>'kana',
        'to'=>'kana',
        'na'=>'kana',
        'ni'=>'kana',
        'nu'=>'kana',
        'ne'=>'kana',
        'no'=>'kana',
        'ha'=>'kana',
        'hi'=>'kana',
        'hu'=>'kana',
        'he'=>'kana',
        'ho'=>'kana',
        'ma'=>'kana',
        'mi'=>'kana',
        'mu'=>'kana',
        'me'=>'kana',
        'mo'=>'kana',
        'ya'=>'kana',
        'yu'=>'kana',
        'yo'=>'kana',
        'ra'=>'kana',
        'ri'=>'kana',
        'ru'=>'kana',
        're'=>'kana',
        'ro'=>'kana',
        'wa'=>'kana',
        'wo'=>'kana',
        'nn'=>'kana',        
    );
    $categories = array(
        '2494' => 'レディースファッション',
        '2495' => 'メンズファッション',
        '2496' => '腕時計、アクセサリー',
        '2497' => 'ベビー、キッズ、マタニティ',
        '2498' => '食品',
        '2499' => 'ドリンク、お酒',        
        '2500' => 'ダイエット、健康',
        '2501' => 'コスメ、美容、ヘアケア',
        '2502' => 'スマホ、タブレット、パソコン',
        '2503' => '>DIY、工具',
        '2504' => 'テレビ、オーディオ、カメラ',
        '2505' => '家電',
        '2506' => '家具、インテリア',
        '2507' => '花、ガーデニング',
        '2508' => 'キッチン、日用品、文具',
        '2509' => 'ペット用品、生き物',
        '2510' => '楽器、手芸、コレクション',
        '2511' => '>ゲーム、おもちゃ',
        '2512' => 'スポーツ',
        '2513' => 'アウトドア、釣り、旅行用品',        
        '2514' => '車、バイク、自転車',
        '2516' => 'CD、音楽ソフト、チケット',
        '2517' => '>DVD、映像ソフト',
        '10002' => '本、雑誌、コミック',
        '13457' => 'ファッション',
    ); 
    
    function write_log_file($filename, $message)
    {
        $path = ROOT ."/logs/$filename.log";
        //echo $path;exit;
        if (is_array($message) || is_object($message))
        {
            $message = json_encode($message);
        }
    
        $message = date('d/m/Y H:i:s') . ":\t$message\n";
    
        if (!$fp = @fopen($path, 'a+'))
        {
            return false;
        }
    
        flock($fp, LOCK_EX);
        fwrite($fp, $message);
        flock($fp, LOCK_UN);
        fclose($fp);
    
        return true;
    } 
    
    function get_http_response_code($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    } 
    
    function getIframes($url){
        $cnt = 0;
        $page = null;
        $htmls = array();
//        while(gettype($page) != 'object' and $cnt == 0){
//            $page = @file_get_html($url);
//            $cnt++;
//        }
        
        $page = @file_get_html($url);
        if(gettype($page) == 'object'){
            $iframes = $page->find('iframe');
            foreach($iframes as $iframe){
                $html = $iframe->getAttribute('src');
                if(strpos($html, 'http') === false)
                //echo "Iframmmmmmmmmmmmmmmmmmme : $html ... \r\n";
                if(strpos($html, 'http') === false and strpos($html, '//') === false){
                    $html = $url.$html;
                }else if(strpos($html, '//') !== false){
                    $html = 'http:'.$html;
                } 
                $htmls[] = $html;
            }
        }            
 
        return $htmls;
    }   
    
    function checkTagInUrls($tag, $urls){
        foreach($urls as $url){
            //echo "Checking $url ... \r\n";
            $html = @file_get_contents($url);
            //echo "Finish Checking $url ... \r\n";
            $html = mb_convert_encoding($html, "UTF-8", "JIS, eucjp-win, sjis-win");
            if(strpos($html, $tag) !== false){
               return true; 
            }
        }
        return false;
    }  
    
    function exportExcelRakuten($content, $file_name){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $rowCount = 1;
        
        $csv_data = "カテゴリ,URL,ショップ名,TEL,FAX,Email,担当者,セキュリティ担当,開店日,会社名,レビュー数";
        $tmp = explode(',',$csv_data);
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, trim($tmp[0]));
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, trim($tmp[1]));
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, trim($tmp[2]));
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, trim($tmp[3]));
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, trim($tmp[4]));
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, trim($tmp[5]));
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, trim($tmp[6]));
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, trim($tmp[7]));
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, trim($tmp[8]));
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, trim($tmp[9]));
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, trim($tmp[10]));
        
        foreach($content as $line ){ 
           	if(is_array($line)){
           	    $rowCount++;
                $tmp = array();
            	foreach($line as $key => $value ){
            	    $tmp[] = $value;

            	}
                             
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, trim($tmp[0]));
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, trim($tmp[1]));
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, trim($tmp[2]));
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$rowCount, trim($tmp[3]));
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$rowCount, trim($tmp[4]));
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, trim($tmp[5]));
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, trim($tmp[6]));
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, trim($tmp[7]));
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, trim($tmp[8]));
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, trim($tmp[9]));
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, trim($tmp[10])); 
                
                $objPHPExcel->getActiveSheet()->getCell('C'.$rowCount)->getHyperlink()->setUrl(strip_tags(trim($tmp[1])));
                $objPHPExcel->getActiveSheet()->getCell('D'.$rowCount)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING2); 
                $objPHPExcel->getActiveSheet()->getCell('E'.$rowCount)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING2);
            }
        }
        
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=$file_name.xlsx");        
        $objWriter->save('php://output');      
    } 
    
    function exportExcelYahoo($content, $file_name){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $rowCount = 1;
        
        $csv_data = "カテゴリ,URL,ショップ名,TEL,FAX,Email,開店日,会社名,レビュー数,Review Point";
        $tmp = explode(',',$csv_data);
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, trim($tmp[0]));
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, trim($tmp[1]));
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, trim($tmp[2]));
        $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$rowCount, trim($tmp[3]));
        $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$rowCount, trim($tmp[4]));
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, trim($tmp[5]));
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, trim($tmp[6]));
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, trim($tmp[7]));
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, trim($tmp[8]));
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, trim($tmp[9]));
       
        foreach($content as $line ){ 
           	if(is_array($line)){
           	    $rowCount++;
                $tmp = array();
            	foreach($line as $key => $value ){
            	    $tmp[] = $value;

            	}
                
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, trim($tmp[0]));
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, trim($tmp[1]));
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, trim($tmp[2]));
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, trim($tmp[3]));
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, trim($tmp[4]));
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, trim($tmp[5]));
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, trim($tmp[6]));
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, trim($tmp[7]));
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, trim($tmp[8]));
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, trim($tmp[9]));
                
                $objPHPExcel->getActiveSheet()->getCell('C'.$rowCount)->getHyperlink()->setUrl(strip_tags(trim($tmp[1])));
                $objPHPExcel->getActiveSheet()->getCell('D'.$rowCount)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING2); 
                $objPHPExcel->getActiveSheet()->getCell('E'.$rowCount)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING2);                
            }
        }
        
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=$file_name.xlsx");        
        $objWriter->save('php://output');      
    }   
    
    function exportExcelCurama($content, $file_name){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $rowCount = 1;
        
        $csv_data = "カテゴリ,ショップ名,URL,TEL,ZIP,ADDRESS,Bussiness Hour,Holiday,Area";
        $tmp = explode(',',$csv_data);
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, trim($tmp[0]));
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, trim($tmp[1]));
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, trim($tmp[2]));
        $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$rowCount, trim($tmp[3]));
        $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$rowCount, trim($tmp[4]));
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, trim($tmp[5]));
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, trim($tmp[6]));
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, trim($tmp[7]));
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, trim($tmp[8]));
       
        foreach($content as $line ){ 
           	if(is_array($line)){
           	    $rowCount++;
                $tmp = array();
            	foreach($line as $key => $value ){
            	    $tmp[] = $value;
            	}
                
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, trim($tmp[0]));
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, trim($tmp[1]));
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, trim($tmp[2]));
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, trim($tmp[3]));
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, trim($tmp[4]));
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, trim($tmp[5]));
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, trim($tmp[6]));
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, trim($tmp[7]));
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, trim($tmp[8]));
                
                $objPHPExcel->getActiveSheet()->getCell('B'.$rowCount)->getHyperlink()->setUrl(strip_tags(trim($tmp[2])));
                //$objPHPExcel->getActiveSheet()->getCell('D'.$rowCount)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING2); 
                //$objPHPExcel->getActiveSheet()->getCell('E'.$rowCount)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING2);                
            }
        }
        
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=$file_name.xlsx");        
        $objWriter->save('php://output');      
    }         
?>
