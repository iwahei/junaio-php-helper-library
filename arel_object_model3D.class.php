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
     * Get the screen anchor where the object is placed
     * @return int Anchor constant of the screen position @see ArelAnchor
     */
    public function getScreenAnchor() {
        return $this->screenAnchor;
    }

    /**
     * Sets the flags that will be used to modify the object behavior when placed relative to the screen
     * @param int $screenAnchorFlag Constant defining the behavior of the object @see ArelAnchor
     */
    public function setScreenAnchorFlag($screenAnchorFlag) {
        $this->screenAnchorFlag = $screenAnchorFlag;
    }

    /**
     * Get the screen anchor flag used to modify the objects behavior when it is placed relative to the screen
     * @return int Anchor constant of the screen position @see ArelAnchor
     */
    public function getScreenAnchorFlag() {
        return $this->screenAnchorFlag;
    }

   	/**
	 * Get the transparency of the 3D model.
	 * @return Float The transparency value, where 1 corresponds to an invisible model and 0 corresponds to a fully opaque model).
	 */
	public function getTransparency(){
		return $this->transparency;
	}
	
	/**
	 * Set the transparency of the 3D model.
	 * @param Float $transparency The transparency value, where 1 corresponds to an invisible model and 0 corresponds to a fully opaque model).
	 */
	public function setTransparency($transparency){
		$this->transparency = $transparency;
	}

	/**
	 * Get the position where the object will be rendered. The z-Buffer will be ignored.

	 * @return int Get the z-Buffer position of where the object shall be rendered. The "calculated" z-Buffer will be ignored. 
	 */
	public function getRenderorderPosition(){
		return $this->renderorderposition;
	}

	/**
	 * Set the position where the object will be rendered. The z-Buffer will be ignored.

	 * @param int $renderorderposition set the z-Buffer position of where the object shall be rendered. The "calculated" z-Buffer will be ignored. 
	 */
	public function setRenderOrderPosition($renderorderposition){
		$this->renderorderposition = $renderorderposition;
	}

	/**
	 * Use this method to determine whether an object can be picked or not (clicked)
	 * @return Boolean true if picking is enabled, false otherwise
	 */
	public function isPickingEnabled(){
		return $this->picking;
	}

	/**
	 * Use this method to declare whether an object can be picked or not (clicked)
	 * @param Boolean $picking true to enable picking of this model, false to disable it 
	 */
	public function setPickingEnabled($picking){
		$this->picking = $picking;
	}
	
	/**
	 * Create an Image 3D Model based on an image provided.
	 * @param String $_id object id
	 * @param String $_imagePath path to the image that shall be rendered
	 * @static
	 */
	public static function createFromImage($_id, $_imagePath)
	{
		$obj = new ArelObjectModel3D($_id);
		$obj->setTexture($_imagePath);
		
		return $obj;
	}

	/**
	 * Create a Movie 3D Model based on an the movie file provided.
	 * @param String $_id object id
	 * @param String $_moviePath path to the image that shall be rendered
	 * @static
	 */
	public static function createFromMovie($_id, $_moviePath)
	{
		$obj = new ArelObjectModel3D($_id);
		$obj->setMovie($_moviePath);
		
		return $obj;
	}
	
	/**
	 * Create an 3D Model based on model and texture (can also only have modelPath if the model is a zipped obj or md2 including the texture) 
	 * @param String $_id object id
	 * @param String $_modelPath path to the model's texture
	 * @param String $_texturePath path to the model's texture
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
