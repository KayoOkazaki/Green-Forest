<?php
require_once 'util.inc.php';
require_once 'libs/qd/qdmail.php';
require_once 'libs/qd/qdsmtp.php';
session_start();

// もしセッション変数が登録されていれば値を引き出す。
if (isset($_SESSION["contact"])) {

		$contact = $_SESSION["contact"];

		$name = $contact["name"];
		$kana = $contact["kana"];
		$mail = $contact["mail"];
		$mailcnf = $contact["mailcnf"];
		$telno = $contact["telno"];
		$message = $contact["message"];
		$token = $contact["token"];

		// IDが違う場合
		if ($token !== getToken()) {

			  //入力フォーム画面に戻す
			  header("Location:contact.php");
			  exit;
		}

// セッション変数が取得できなかった時
} else {

	 	// 不正なアクセスとして入力画面に戻す
	  header("Location:contact.php");
	  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	//送信ボタンクリック時
	if (isset($_POST["send"])) {

// メール本文作成
$body=<<<EOT
■お名前
{$name}

■フリガナ
{$kana}

■メールアドレス
{$mail}

■電話番号
{$telno}

■問い合わせ内容
{$message}

EOT;


	  	// SMTPの設定
		$param = array(
			"host" => "w1.sim.zdrv.com",
			"port" => 25,
			"from" => "zd2B03@sim.zdrv.com",
			"protocol" => "SMTP"

		);

		// メールの送信
		$mail = new Qdmail();

		//エラーを非表示
		$mail->errorDisplay(FALSE);
		$mail->smtpObject()->error_display = FALSE;

		//送信内容
		$mail->from("zd2B03@sim.zdrv.com", "Green Forest Web");//サーバー上のメールアドレス
		$mail->to("zd2B03@sim.zdrv.com","Green Forest 管理者（岡崎カヨ）");
		$mail->subject("Green Forest Web予約フォームからの送信");
		$mail->text($body);
		$mail->smtp(TRUE);
		$mail->smtpServer($param);

		//送信
		$flag = TRUE;

		//もし送信に成功したならば
		if (($flag === FALSE) || ($flag === TRUE)){

		  // セッション変数を破棄
		  unset($_SESSION["contact"]);

		  // 完了画面へ遷移
		  header("Location:contact_done.php");
		  exit;

		} else {

		// エラー画面へ遷移
	  	header("Location:contact_error.php");
	  	exit;
  		}

	}

	//修正ボタンクリック時
	if (isset($_POST["back"])) {

		// 入力画面へ遷移
		header("Location:contact.php");
		exit;
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
    <title>Contact confirm | Forest Green</title>
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
    <link rel="icon" type="image/ico" href="../images/favicon.png">
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
                <li><a href="first.php">初めての方へ</a></li>
                <li><a href="menu.php">施術料金</a></li>
                <li><a href="faq.php">よくある質問</a></li>
                <li><a href="contact.php">お問合せ</a></li>
                <li><a href="news.php">ブログ</a></li>
            </ul>
        </div>
        <div id="breadcrumb">
            <ul>
                <li><a href="index.php">ホーム</a></li>
                <li><a href="contact.php">お問合せ・予約</a></li>
                <li>送信確認</li>
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
                    <!-- フォーム画面 -->
	                <form action="" method="post">
	                    <table>
	                        <tr><th>お名前：</th>
	                            <td><?php echo $name; ?></td></tr>
	                        <tr><th>フリガナ：</th>
	                            <td><?php echo $kana; ?></td></tr>
	                        <tr><th>電話番号：</th>
	                            <td><?php echo $telno; ?></td></tr>
	                        <tr><th>E-mail：</th>
	                            <td><?php echo $mail; ?></td></tr>
	                        <tr><th>お問合せ:</th>
	                            <td><?php echo nl2br($message); ?></td></tr>
	                        <tr><td colspan="2">
	                            <input type="submit" name="send" value="送信する">
	                            <input type="submit" name="back" value="修正する">
	                        </td></tr>
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