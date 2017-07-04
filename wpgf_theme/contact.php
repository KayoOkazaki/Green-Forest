<?php
require_once 'util.inc.php';

// クリックジャッキング対策
header("X-FRAME-OPTIONS: SAMEORIGIN");

// セッション開始
session_start();

// 変数初期化
$errMsg = array();
$name = "";
$kana = "";
$telno = "";
$mail = "";
$mailcnf = "";
$ymd = "";
$hm = "";
$number = "";
$message = "";


// 確認画面で修正ボタンがクリックされた時
if (isset($_SESSION["contact"])) {

	$contact = $_SESSION["contact"];

	$name = $contact["name"];
	$kana = $contact["kana"];
	$mail = $contact["mail"];
	$mailcnf = $contact["mailcnf"];
	$telno = $contact["telno"];
	$message= $contact["message"];

}
// ポスト送信の時
if ($_SERVER["REQUEST_METHOD"] === "POST") {

	// 入力値を取得
	$name = $_POST["name"];
	$kana = $_POST["kana"];
	$telno = $_POST["telno"];
	$mail = $_POST["mail"];
	$mailcnf = $_POST["mailcnf"];
	$message = $_POST["message"];
	$token= $_POST["token"];

	// バリデーションチェック
	if (trim($name=="")) {
		$errMsg["name"] = "名前を入力してください";
	}
	if (trim($kana=="")) {
		$errMsg[] = "フリガナを入力してください";
	} elseif (!preg_match("/^[ァ-ヶー 　]+$/u", $kana)) {
		$errMsg[] = "フリガナの形式が正しくありません";

	}
	if (trim($telno=="")) {
		$errMsg[] = "電話番号を入力してください";

	} elseif (!preg_match("/^0\d{9,10}$/", $telno)) {
		$errMsg[] = "電話番号の形式が正しくありません";

	}
	if (trim($mail=="")) {
		$errMsg[] = "メールアドレスを入力してください";

	} elseif (!preg_match("/^[^@]+@[^@]+\.[^@]+$/", $mail)) {
		$errMsg[] = "メールアドレスの形式が正しくありません";

	}
	if (trim($mailcnf=="")) {
		$errMsg[] = "確認用メールアドレスを入力してください";

	} elseif (trim($mailcnf) != trim($mail)) {
		$errMsg[] = "ご入力頂いたメールアドレスと一致しません";

	}
	if (trim($message=="")) {
		$errMsg[] = "お問い合わせ内容を入力してください";

	}

	// バリデーションチェックOKの時
	if (count($errMsg) == 0) {

		//入力値を一旦連想配列として保存
		$contact = array(
				"name" => $name,
				"kana" => $kana,
				"telno" => $telno,
				"mail" => $mail,
				"mailcnf" => $mailcnf,
				"message" => $message,
				"token" => $token
		);

		// 連想配列（入力値）ごとセッション変数に保存
		$_SESSION["contact"] = $contact;

		// 確認画面へ遷移
		header("Location: contact_conf.php");
		exit();
		$errMsg[]="確認画面へ遷移";
	}
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="癒しサロンForestGreenへようこそ。ForestGreenは心と体の総合癒しサロンです。">
    <meta name="keywords" content="Forest Green,癒し,ヒーリング,リラクゼーション,整体,マッサージ,西新宿,大久保,カードリーディング,フラワーエッセンス">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Contact | Forest Green</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.inview.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
    <link rel="stylesheet" href="../css/jq.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css" media="screen and (max-width: 480px)"> -->
    <link rel="icon" type="image/ico" href="images/favicon.png">
</head>
<body>
    <header id="top">
        <div class="mainimg">
            <div class="intro_a">
              <h1>Green Forest</h1>
              <p>Welcome to Green Forest!<br>
                 A relaxing paradise for your body and mind.<br><br>
                 TEL: 080-1234-5678<br><br>
                <a class="buttn" href="#"><span>ご予約はこちら</span></a>
              </p>
            </div>
        </div>
        <div id="globalNavi">
            <ul class="nav">
                <li><a href="../first.html">初めての方へ</a></li>
                <li><a href="../menu.html">施術料金</a></li>
                <li><a href="../faq.html">よくある質問</a></li>
                <li><a href="../contact.html">お問合せ</a></li>
                <li><a href="../news.html">ブログ</a></li>
            </ul>
        </div>
        <div id="breadcrumb">
            <ul>
                <li><a href="../index.html">ホーム</a></li>
                <li>お問合せ・予約</li>
            </ul>
        </div>
    </header>
    <div id="contact">
       <!-- 戻るボタン -->
       <div id="page-top">
            <a id="move-page-top" href="#top"><i class="fa fa-chevron-circle-up fa-5x"></i></a>
       </div>
       <div id="contentsInner">
            <div id="main">
                <section id="mailform">
                    <h2>contact お問合せ・予約</h2>
                    <p>ご予約に関する以下注意事項をご確認のうえ必要事項をご記入いただき、送信確認ボタンをクリックしてください。</p><br>
                    <ul style="list-style-type:square">
                        <li>ご予約の場合は、お問合せ欄に施術内容と時間、<strong>ご希望日時を第3希望</strong>までご記入ください。<br></li>
                        <li>※本メール送信のみでご予約は確定しておりません。<br></li>
                        <li>折り返し予約可能日時をメールまたはお電話にてご連絡いたします。</li>
                    </ul>
	               <?php
	                    // エラーが在る時
	                if(count($errMsg) >0) {
	                    	// エラーメッセージを表示する
	                    	foreach($errMsg as $value) {
	                    		echo "<span style='color:red;'>" . $value . "</span><br>" . "\n";
	                    	}
	                    }
	                ?>
				    <!-- フォーム画面 -->
	                <form action="" method="post" novalidate>
						<!-- 隠し項目：token -->
		            	<input type="hidden" name ="token" value="<?php echo getToken(); ?>"/>
                        <table>
	                        <tr><th>お名前：</th>
	                            <td><input type="text" name="name" placeholder="（必須）" value="<?php echo h($name); ?>"></td></tr>
	                        <tr><th>フリガナ：</th>
	                            <td><input type="text" name="kana" placeholder="（必須）" value="<?php echo h($kana); ?>"></td></tr>
	                        <tr><th>電話番号 ハイフンなし:</th>
	                            <td><input type="tel" name="telno" placeholder="（必須）" value="<?php echo h($telno); ?>"> 例：08012345678</td></tr>
	                        <tr><th>E-mail：</th>
	                            <td><input type="email" name="mail" placeholder="（必須）" value="<?php echo h($mail); ?>"></td></tr>
	                        <tr><th>E-mail(確認用)：</th>
                            <td><input type="email" name="mailcnf" placeholder="（必須）" value="<?php echo h($mailcnf); ?>"></td></tr>
                            <tr><th>お問合せ:</th>
	                            <td><textarea name="message" rows="10" cols="40" placeholder=""><?php echo h($message); ?></textarea></td></tr>
                            <tr><td colspan="2"><input type="submit" value="送信確認"></td></tr>
                        </table>
                    </form>
                </section>
            </div>
        </div>
    </div>
    </body>
    <footer>
        <!-- <p id="pagetop"><a href="#top">ページの先頭へ戻る</a></p> -->
        <!--twitter-->
        <a href="https://twitter.com/share?url=#" target="_blank" class="flat_ss"><span class="iconback tw"><i class="fa fa-twitter"></i></span><span class="btnttl">Tweet</span></a>
        <!--facebook-->
        <a href="https://www.facebook.com/sharer/sharer.php?u=#" target="_blank" class="flat_ss"><span class="iconback fb"><i class="fa fa-facebook"></i></span><span class="btnttl">Share</span></a>
        <!--pocket-->
        <a href="https://getpocket.com/edit?url=#" target="_blank" class="flat_ss"><span class="iconback pkt"><i class="fa fa-get-pocket"></i></span><span class="btnttl">Poket</span></a>
        <!--feedly-->
        <a href="#" class="flat_ss"><span class="iconback fdly"><span class="fa fa-rss"></span></span><span class="btnttl">Feedly</span></a>
        <div id="foot">
            <address>Green Forest Shinjyuku tel: 03-1234-5678 完全予約制</address>
            <p id="copyright"><small>Copyright 2017 Green Forest All rights reserved.</small></p>
        </div>
    </footer>
</html>