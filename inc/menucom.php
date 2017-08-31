<?php
/**
 *  概要：トップメニューの作成と埋め込み
 *
 *  詳細：トップメニューを作成し各ページのメニュー部分にＨＴＭＬ出力する
 *
 * @access public
 * @param 
 * @return 
 * @see 
 * @throws 例外についての記述
 * @todo 未対応（改善）事項等
 */
	function setTopMenu($html)	{
		// メニュー上段の削除
		$menuHeader = '<nav class="navbar navbar-fixed-top">';
		$menuFooter = '</div><!--/.nav -->';
		$menuHtml=substr($html,strpos($html,$menuHeader));
		$menuHtml=substr($menuHtml,0,strpos($menuHtml,$menuFooter)+strlen($menuFooter));
		$html = str_replace($menuHtml,"",$html);
		
		//メニュースクリプトの削除
		$html = str_replace('<script src="../menu/menu.js"></script>','',$html);
		
		// menu1.html（メニュー上段）の読み込み(抜き出し)
		$mnuHtml1 = getTemplate("../menu/menu1.html");
		$mnuHtml1=substr($mnuHtml1,strpos($mnuHtml1,$menuHeader));
		$mnuHtml1=substr($mnuHtml1,0,strpos($mnuHtml1,$menuFooter)+strlen($menuFooter));
		//get list template from htmltext
		
		// セッション内にユーザ情報が存在しているか、ない場合はログイン画面に強制遷移
		if( empty( $_SESSION['usr_mid'] ) ) {
			header("Location: ../login/index.html");
		}
		
		//第一階層の親メニューIDをセッションに埋め込む
		//Topと権限切替をクリックした場合はメニューID情報をそれぞれのPHPファイルでクリアする。
		if(!empty($_REQUEST['mnu_mid'])) $_SESSION['mnu_mid'] = $_REQUEST['mnu_mid'];
		
		// ユーザID(社員番号)と所属部署コードからメニュー情報を取得する。
		$tb_mnu = new tb_mnu();
		$mnuInfo = $tb_mnu->getMenuInfomation($_SESSION);
		
		// ユーザIDとユーザ名などの置換
		$mnuHtml1 = str_replace("<!--usr_mid-->",$_SESSION['usr_mid'],$mnuHtml1);
		$mnuHtml1 = str_replace("<!--usr_vch2-->",$_SESSION['usr_vch2'],$mnuHtml1);
		// ログイン情報をセットする
		$mnuHtml1 = str_replace("<!--usr_infomation-->","社員番号:".$_SESSION['usr_mid']."&nbsp;事業所:".$_SESSION['dpt_vch0']."&nbsp;権限:".$_SESSION['itm_vch0'],$mnuHtml1);
		
		for ($i=0;$i<count($mnuInfo);$i++) {
			$menuTxt = "<li><a href='".$mnuInfo[$i]['mnu_vch2']."'>".$mnuInfo[$i]['mnu_vch0']."</a></li>\n";
			$list .= $menuTxt;
		}
		
		// メニュー情報の変換
		$mnuHtml1 = str_replace("<!--menuList-->",$list,$mnuHtml1);
		
		// 取得したメニュー情報（上段）の設定
		$html = str_replace("<!--menu_1-->",$mnuHtml1,$html);
		
		//Headerの書き換え
		$html = str_replace("<title>Bootstrap, from Twitter</title>","<title>Bot01</title>",$html);
		
		//Footerの書き換え
		$pos1 = strpos($html, '<footer>');
		$pos2 = strpos($html, '</footer>');
		$tag=substr($html,$pos1,$pos2-$pos1);
		$replacement = '<footer class="text-center"><p>All Grow Inc&copy; All Right Reserved 2016</p></footer>';
		$html = str_replace($tag,$replacement,$html);		
	
		return $html;

	}
				
	function setLeftMenu($html)	{
		// メニュー左段の削除
		$menuHeader = '<!--span_start-->';
		$menuFooter = '</div><!--/span-->';
		$menuHtml = substr($html,strpos($html,$menuHeader));
		$menuHtml = substr($menuHtml,0,strpos($menuHtml,$menuFooter)+strlen($menuFooter));
		$html = str_replace($menuHtml,"",$html);
		//メニュースクリプトの削除
		$html = str_replace('<script src="../menu/menu.js"></script>','',$html);
	
		// menuCom.html（メニュー左段）の読み込み(抜き出し)
		$mnuHtmlCom = getTemplate("../menu/menu2.html");
		$mnuHtmlCom=substr($mnuHtmlCom,strpos($mnuHtmlCom,$menuHeader));
		$mnuHtmlCom=substr($mnuHtmlCom,0,strpos($mnuHtmlCom,$menuFooter)+strlen($menuFooter));
		//get list template from htmltext
	
		$tb_mnu = new tb_mnu();
		// ユーザID(社員番号)と所属部署コードからメニュー情報を取得する。
		
		if(!empty($_REQUEST['mnu_mid'])) {
			//Topメニューのばあい
			unset($_SESSION['mnu_sid']);
			$postData['mnu_mid'] = $_REQUEST['mnu_mid'];
		}else{
			$postData['mnu_mid'] = $_SESSION['mnu_mid'];
			if(!empty($_REQUEST['mnu_sid'])) $_SESSION['mnu_sid'] = $_REQUEST['mnu_sid'];
			$postData['mnu_sid'] = $_SESSION['mnu_sid'];
		}
		
		$mnuInfoCom = $tb_mnu->getMenuInfomationLeft($postData);
		//echo "menucom:mnu_sid=".$_REQUEST['mnu_sid'].":session mnu_mid:".$_SESSION['mnu_sid'].BR;
		
		// リスト初期化
		$list = "";
		for ($i=0;$i<count($mnuInfoCom);$i++) {
			$menuLeftTxt = "<li class='list-group-item active'>linkurl</li>\n";
			//echo "mnu_sid: $mnu_sid::".$mnuInfoCom[$i]['mnu_mid'].":".$mnuInfoCom[$i]['mnu_vch2'].BR;
				
			if($_SESSION['mnu_sid']!=$mnuInfoCom[$i]['mnu_mid']) $menuLeftTxt = str_replace(" active","",$menuLeftTxt);
				
			// mnu_vch2に値がなければ、aタグは外す
			if( empty($mnuInfoCom[$i]['mnu_vch2'] )) {
				$menuLeftTxt = str_replace("linkurl",$mnuInfoCom[$i]['mnu_vch0'],$menuLeftTxt);
			} else {
				if(!empty($mnuInfoCom[$i]['mnu_vch3']))
					$target=' target="'.$mnuInfoCom[$i]['mnu_vch3'].'"';
				else
					$target="";
				$mnuInfoCom[$i]['mnu_vch2'] .="?mnu_sid=".$mnuInfoCom[$i]['mnu_mid'];
				$linkurl = "<a href='".$mnuInfoCom[$i]['mnu_vch2']."' $target >".$mnuInfoCom[$i]['mnu_vch0']."</a>";
				$menuLeftTxt = str_replace("linkurl",$linkurl,$menuLeftTxt);
			}
			$list .= $menuLeftTxt;
		}
	
		// メニュー情報の変換
		$mnuHtmlCom = str_replace("<!--menuListSide-->",$list,$mnuHtmlCom);
	
		// 取得したメニュー情報（左）の設定
		$html = str_replace("<!--menu_left-->",$mnuHtmlCom,$html);
	
		return $html;
	}
	
?>