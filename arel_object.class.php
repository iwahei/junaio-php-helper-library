<?php
/**
 * @copyright  Copyright 2012 metaio GmbH. All rights reserved.
 * @author     metaio GmbH
 **/
require_once("arel_popup.class.php");

/**
 * 
 * Arelオブジェクト
 * このクラスはインスタンス化されていませんが, 仮想基本クラスです。
 * @see ArelObjectModel3D 
 * @see ArelObjectPOI
 *
 */
class ArelObject
{
	private $id = NULL;
	private $title = NULL;
	private $popup = NULL;
	private $location = NULL;
	private $iconPath = NULL;
	private $thumbnailPath = NULL;
	private $minaccuracy = NULL;
	private $maxdistance = NULL;
	private $mindistance = NULL;
	private $parameters = array();
	private $visibility = NULL;
	
	/**
	*		
	*/
	protected function __construct($id)
	{
		$this->id = $id; 
	}
	
	/**
	 * オブジェクトIDを取得
	 * @return オブジェクトID
	 */
	public function getID(){
		return $this->id;
	}

	/**
	 * オブジェクトIDをセット
	 * @param アルファベットと数字を組み合わせたID
	 */
	public function setID($id){
		$this->id = $id;
	}
	
	/**
	 * タイトルを取得
	 * @param タイトル
	 */
	public function getTitle(){
		return $this->title;
	}

	/**
	 * タイトルをセット
	 * @param タイトル
	 */
	public function setTitle($title){
		$this->title = $title;
	}

	/**
	 * ポップアップ情報を取得
	 * @return ポップアップ情報（ボックス情報）
	 */
	public function getPopup(){
		return $this->popup;
	}

	/**
	 * ポップアップ情報をセット
	 * @param $popup:ポップアップ情報
	 */
	public function setPopup($popup){
		$this->popup = $popup;
	}

	/**
	 * 位置情報を取得 (位置情報取得サービス対応機種のみ)
	 * @return Array 緯度、経度、高度
	 */
	public function getLocation(){
		return $this->location;
	}

	/**
	 * 位置情報をセット (位置情報取得サービス対応機種のみ)
	 * @param Array $location:緯度、経度、高度
	 */
	public function setLocation($location){
		$this->location = $location;
	}

	/**
	 * マップビューに表示するアイコン画像のパスを取得（位置情報取得サービス対応機種のみ）
	 * @return マップアイコンの画像パス
	 */
	public function getIcon(){
		return $this->iconPath;
	}

	/**
	 * マップビューに表示するアイコン画像のパスをセット（位置情報取得サービス対応機種のみ）
	 * @param $iconPath：マップアイコンの画像パス
	 */
	public function setIcon($iconPath){
		$this->iconPath = $iconPath;
	}

	/**
	 * リストビューに表示するサムネイル画像を取得（位置情報取得サービス対応機種のみ）
	 * @return サムネイル画像のパス
	 */
	public function getThumbnail(){
		return $this->thumbnailPath;
	}

	/**
	 * リストビューに表示するサムネイル画像をセット（位置情報取得サービス対応機種のみ）
	 * @param $thumbnailPath：サムネイル画像のパス
	 */
	public function setThumbnail($thumbnailPath){
		$this->thumbnailPath = $thumbnailPath;
	}

	/**
	 * ディスプレイセンサーの正確さを取得（位置情報取得サービス対応機種のみ）
	 * @return 数値 (LLAマーカーがスキャンされた場合のみ、1になる)  
	 */
	public function getMinAccuracy(){
		return $this->minaccuracy;
	}

	/**
	 * ディスプレイセンサーの正確さをセット（位置情報取得サービス対応機種のみ）
	 * @param int $minaccuracy：(LLAマーカーがスキャンされた場合のみ、1になる)  
	 */
	public function setMinAccuracy($minaccuracy){
		$this->minaccuracy = $minaccuracy;
	}

	/**
	 * 最大距離を取得 (位置情報取得サービス対応機種のみ)
	 * @return int：最大距離
	 */
	public function getMaxDistance(){
		return $this->maxdistance;
	}

	/**
	 * 最大距離をセット (位置情報取得サービス対応機種のみ)
	 * @param int $maxdistance：最大距離
	 */
	public function setMaxDistance($maxdistance){
		$this->maxdistance = $maxdistance;
	}

	/**
	 * 最小距離を取得 (位置情報取得サービス対応機種のみ)
	 * @return int mindistance：最小距離
	 */
	public function getMinDistance(){
		return $this->mindistance;
	}

	/**
	 * 最小距離をセット (位置情報取得サービス対応機種のみ)
	 * @param int $mindistance：最小距離
	 */
	public function setMinDistance($mindistance){
		$this->mindistance = $mindistance;
	}

	/** すべてのパラメーターを取得
	 * @return Array object：KEY => VALUE 
	 */
	public function getParameters(){
		return $this->parameters;
	}

	/**
	 * パラメータをセット
	 * @param Array $parameters：パラメーター example:{"test" : 1, "url": "www.junaio.com"}
	 */
	public function setParameters($parameters){
		$this->parameters = $parameters;
	}
	
	/**
	 * 一つのパラメータを追加
	 * @param String $key：パラメータのkeyをセット
	 * @param String $value：パラメーターの値をセット
	 */
	public function addParameter($key, $value){
		$this->parameters[$key] = $value;
	}
	
	/**
	 * マップビュー、リストビュー、ライブビュー、レーダーの表示設定。（GLUEに関しては、ライブビューのみサポート）
	 * @param Boolean $liveview true：表示, false：非表示, undefined：変更無し
	 * @param Boolean $maplist true：表示, false：非表示, undefined：変更無し
	 * @param Boolean $radar true：表示, false：非表示, undefined：変更無し
	 */
	public function setVisibility($liveview, $maplist, $radar){
		$this->visibility = array("liveview" => $liveview, "maplist" => $maplist, "radar" => $radar);
	}
	
	/**
	 * オブジェクトがクリックされたか否かでメソッド使用の判定
	 * @param Array 表示情報 exapmle:{"liveview": bool, "maplist": bool, "radar": bool}  
	 */
	public function getVisibility(){
		return $this->visibility;
	}
}
