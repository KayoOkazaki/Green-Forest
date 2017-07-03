//***************************************
//クロスサイトスクリプティング（XSS）対応
//  引数：文字列 （$string as integer）
//  戻値：XSS対応した文字列
//***************************************
function h($string)
{
	return htmlspecialchars($string, ENT_QUOTES);

}
//***************************************
//
// 秘密の ID を作るための関数
// 機能：セッション ID を作成し、
// hash で暗号化(sha256)する
//
//***************************************
function getToken() {
	// セッション ID を作成し、hash で暗号化(sha256)する
	return hash('sha256',session_id());
}
