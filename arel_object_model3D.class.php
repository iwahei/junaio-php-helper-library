<?php

/**
 * @copyright  Copyright 2012 metaio GmbH. All rights reserved.
 * @author     metaio GmbH
 **/
require_once("arel_object.class.php");
require_once("arel_rotation.class.php");

/**
 * 
 * Arel Object Model3D Element.
 *
 */
class ArelObjectModel3D extends ArelObject
{
	private $onscreen = NULL;
	private $transformParent = NULL;
	private $translation = array(0,0,0);
	private $rotation = NULL;
	private $scale = array(1,1,1);
	private $occlusion = NULL;
	private $model = NULL;
	private $texture = NULL;
	private $movie = NULL;
	private $coordinateSystemID = NULL;
	private $shaderMaterial = NULL;	
	private $transparency = NULL;
	private $renderorderposition = NULL;
	private $picking = NULL;
	private $screenAnchor = NULL;
	private $screenAnchorFlag = NULL;

	/**
	 * モデル作成
	 * @param String $id
	 */
	public function __construct($id)
	{
		parent::__construct($id);
		
		$this->rotation = new ArelRotation();
	}	
			
	/**
	 * 現在定義されている親オブジェクトを取得
	 * @return String the currently defined parent
	 */
	public function getTransformParent(){
		return $this->transformParent;
	}
	
	/**
	 * オブジェクトを設定
	 * @param String：親オブジェクト
	 */
	public function setTransformParent($transformParent){
		$this->transformParent = $transformParent;
	}

	/**
	 * 移動に関するオブジェクト取得
	 * @return Array：x,y,z
	 */
	public function getTranslation(){
		return $this->translation;
	}
	/**
	 * 移動に関するオブジェクト設定
	 * @param Array $translation：x,y,z
	 */
	public function setTranslation($translation){
		$this->translation = $translation;
	}
	
	/**
	 * 回転に関するオブジェクト取得
	 * @return オブジェクトの回転に関する情報
	 */
	public function getRotation(){
		return $this->rotation;
	}

	/**
	 * 回転に関するオブジェクト設定
	 * @param ArelRotation $rotation：角度, 四元数, 軸の角度 or マトリックスを設定
	 */
	public function setRotation($rotation){
		$this->rotation = $rotation;		
	}
	
	/**
	 * オブジェクトのスケールを取得
	 * @return Array：スケール情報
	 */
	public function getScale(){
		return $this->scale;
	}

	/**
	 * オブジェクトのスケールを設定
	 * @param Array An array providing scale values along three axis (x, y, z)
	 */
	public function setScale($scale){
		$this->scale = $scale;
	}

	/**
	 * オブジェクトが閉塞かどうかの判定
	 * @return Boolean：trueであれば閉塞モデル
	 */  
	public function isOccluding(){
		return $this->occlusion;
	}

	/**
	 * 閉塞オブジェクトを設定
	 * @param Boolean $occlusion：trueであれば、閉塞モデルを設定
	 */ 
	public function setOccluding($occlusion){
		$this->occlusion = $occlusion;
	}

	/**
	 * モデルファイルを取得（ファイル：md2 or zip）
	 *  @see getMovie()
	 *  @see getTexture()
	 * @return String model path
	 */  
	public function getModel(){
		return $this->model;
	}

	/**
	 * モデルファイルを設定（ファイル：md2 or zip）
	 * @see setMovie()
	 * @see setTexture()
	 * @param String $model： モデルリソースのパス。（md2 or zip）
	 */ 
	public function setModel($model){
		$this->model = $model;
	}

	/**
	 * モデルに貼るテクスチャファイルのパス（jpg/png）の取得 （md2 or zip or movieがセットされている場合、undefindになりうる）
	 * @see getModel()
	 * @see getMovie()
	 * @return String：テクスチャファイルのパス
	 */  
	public function getTexture(){
		return $this->texture;
	}

	/**
	 * モデルに貼るテクスチャファイルのパス（jpg/png）の設定 （md2 or zip or movieがセットされている場合、undefindになりうる）
	 * @see setModel()
	 * @see setTexture()
	 * @param String $texture：モデルのテクスチャファイルのパス
	 */ 
	public function setTexture($texture){
		$this->texture = $texture;
	}

	/**
	 * モデルに貼るmovieファイル（3g2）の取得 （md2 or zip のテクスチャファイルがセットされている場合、undefindになりうる）
	 * @see getModel()
	 * @see getTexture()
	 * @return String：movieファイルのパス
	 */  
	public function getMovie(){
		return $this->movie;
	}

	/**
	 * モデルに貼るmovieファイル（3g2）の設定
	 * @see setModel()
	 * @see setTexture()
	 * @see createFromMovie()
	 * @param String $movie：movieファイルのパス
	 */ 
	public function setMovie($movie){
		$this->movie = $movie;
	}

	/**
	 * コーディネートシステムIDを取得（GLUE channels/objects に対してのみ有効なフィードバック）
	 * @return int：コーディネートシステムID
	 */  
	public function getCoordinateSystemID(){
		return $this->coordinateSystemID;
	}

	/**
	 * コーディネートシステムIDを設定（GLUE channels/objects に対してのみ有効なフィードバック）
	 * @param int $coordinateSystemID：コーディネートシステムID
	 */ 
	public function setCoordinateSystemID($coordinateSystemID){
		$this->coordinateSystemID = $coordinateSystemID;
	}
	
	/**
	 * 現在定義されているシェーダマテリアルを取得
	 * @return String：シェーダマテリアル
	 */  
	public function getShaderMaterial(){
		return $this->shaderMaterial;
	}

	/**
	 * シェーダマテリアルをセット。（機能させるためには、グローバルシェーダマテリアルを定義する必要有り）
	 * @param String：シェーダマテリアルのファイルのパスをセット
	 */ 
	public function setShaderMaterial($shaderMaterial){
		$this->shaderMaterial = $shaderMaterial;
	}
	
    /**
     * スクリーンアンカーに物体の座標を設定。
     * @param int $screenAnchor：配置するスクリーンアンカーの定数を指定
     */
    public function setScreenAnchor($screenAnchor) {
        $this->screenAnchor = $screenAnchor;
    }

    /**
     * オブジェクトのスクリーンアンカーの位置を取得
     * @return int：スクリーン上にあるアンカーの位置
     */
    public function getScreenAnchor() {
        return $this->screenAnchor;
    }

    /**
     * 画面に相対的に配置されたオブジェクトの動作を変更するか否かのフラグを設定
     * @param int $screenAnchorFlag：@see のアンカーの動作を定義
     */
    public function setScreenAnchorFlag($screenAnchorFlag) {
        $this->screenAnchorFlag = $screenAnchorFlag;
    }

    /**
     * 画面に相対的に配置されたオブジェクトの動作を変更するか否かのフラグを取得
     * @return int：@see のスクリーン上の位置
     */
    public function getScreenAnchorFlag() {
        return $this->screenAnchorFlag;
    }

   	/**
	 * 3Dモデルの透明度を取得
	 * @return Float：透明度（1：不可視モデルに対応、0：完全に不透明なモデルに対応）
	 */
	public function getTransparency(){
		return $this->transparency;
	}
	
	/**
	 * 3Dモデルの透明度を設定
	 * @param Float $transparency：透明度（1：不可視モデルに対応、0：完全に不透明なモデルに対応）
	 */
	public function setTransparency($transparency){
		$this->transparency = $transparency;
	}

	/**
	 * オブジェクトがレンダリングされる位置を取得（Zバッファは無視される）

	 * @return int：オブジェクトがレンダリングされる場所（計算されたzバッファは無視される）
	 */
	public function getRenderorderPosition(){
		return $this->renderorderposition;
	}

	/**
	 * オブジェクトがレンダリングされる位置を設定（Zバッファは無視される）

	 * @param int $renderorderposition：オブジェクトがレンダリングされる場所（計算されたzバッファは無視される）
	 */
	public function setRenderOrderPosition($renderorderposition){
		$this->renderorderposition = $renderorderposition;
	}

	/**
	 * オブジェクトがピックアップされるかどうかの判定
	 * @return Boolean true：ピックアップする、false：ピックアップしない
	 */
	public function isPickingEnabled(){
		return $this->picking;
	}

	/**
	 * オブジェクトがピックアップするように設定
	 * @param Boolean $picking：true or false
	 */
	public function setPickingEnabled($picking){
		$this->picking = $picking;
	}
	
	/**
	 * 画像に基いて3Dモデルを作成
	 * @param String $_id：オブジェクトID
	 * @param String $_imagePath：画像のパス
	 * @static
	 */
	public static function createFromImage($_id, $_imagePath)
	{
		$obj = new ArelObjectModel3D($_id);
		$obj->setTexture($_imagePath);
		
		return $obj;
	}

	/**
	 * 動画に基いて3Dモデルを作成
	 * @param String $_id：オブジェクトID
	 * @param String $_moviePath：動画のパス
	 * @static
	 */
	public static function createFromMovie($_id, $_moviePath)
	{
		$obj = new ArelObjectModel3D($_id);
		$obj->setMovie($_moviePath);
		
		return $obj;
	}
	
	/**
	 * モデルやテクスチャに基いて3Dモデルを作成
	 * @param String $_id：オブジェクトID
	 * @param String $_modelPath：モデルのパス
	 * @param String $_texturePath：テクスチャのパス
	 * @static
	 */
	public static function create($_id, $_modelPath, $_texturePath)
	{
		$obj = new ArelObjectModel3D($_id);
		$obj->setModel($_modelPath);
		$obj->setTexture($_texturePath);
		
		return $obj;
	}
}
?>
