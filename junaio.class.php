<?php
/**
 * @copyright  Copyright 2012 metaio GmbH. All rights reserved.
 * @author     Frank Angermann
 *
 * このクラスは、開発者のサーバー上で認証を提供します。Authorizationヘッダーをチェックし、定義された認証に対して検証されます。
 * これが成功しない場合、junaioからコールバックが来ていません。
 **/

class Junaio {

	/**
	junaio認証に対する許可ヘッダーを確認
	@return Boolean：true(成功)、false(失敗)
	*/
	public static function checkAuthentication() {

		$_HEADERS = getallheaders();
		
		// 許可ヘッダーがあるかどうか確認
		if (!isset($_HEADERS['Authorization'])) {
			return FALSE;
		}
		$sAuthentication = $_HEADERS['Authorization'];

		// 許可ヘッダーが"junaio"タイプであるか確認
		if(strpos($sAuthentication, 'junaio') != 0) {
			return FALSE;
		}

		// 日付ヘッダーの確認
		$sDate = $_HEADERS['Date'];
		$iParsedDate = strtotime($sDate);
		$iNow = time();
		if($iParsedDate < $iNow - AUTH_DATE_TOLERANCE || $iParsedDate > $iNow + AUTH_DATE_TOLERANCE) {
			// Header is outdated
			return FALSE;
		}

		// 署名変数を確認
		$aTokens = explode(' ', $sAuthentication);
		if (!isset($aTokens[1]) || trim($aTokens[1]) == '') {
			// No signature string there
			return FALSE;
		}
		$sRequestSignature = base64_decode(trim($aTokens[1]));

		// サーバーへ署名の要求
		$sServerRequestSignature = sha1(
			JUNAIO_KEY . sha1(
				JUNAIO_KEY .
				$_SERVER['REQUEST_METHOD'] . "\n" .
				$_SERVER['REQUEST_URI'] . "\n" .
				'Date: ' . $sDate . "\n"
			)
		);

		// 署名の要求の比較
		if(strcmp($sRequestSignature, $sServerRequestSignature) !== 0) {
			// Incorrect authentication
			return FALSE;
		} else {
			return TRUE;
		}
	}
}

if (!function_exists('getallheaders'))
{
    function getallheaders()
    {
       foreach ($_SERVER as $name => $value)
       {
           if (substr($name, 0, 5) == 'HTTP_')
           {
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
           }
           else if (substr($name, 0, 14) == 'REDIRECT_HTTP_')
           {
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 14)))))] = $value;
           } 
       }
       return $headers;
    }
}