<?php
/**
 * @copyright  Copyright 2012 metaio GmbH. All rights reserved.
 * @author     metaio GmbH
 **/

require_once 'arel_object_model3D.class.php';
require_once 'arel_object_poi.class.php';
require_once 'arel_anchor.class.php';
require_once 'SimpleXMLExtended.php';

/**
 * 
 * junaioのarelを出力(xml)を作成するヘルパークラス
 *
 */
class ArelXMLHelper
{	
	/**
	 * 追尾型GPS
	 */
	const TRACKING_GPS = "GPS";
	
	/**
	 * 追尾型適応性
	 */
	const TRACKING_ORIENTATION = "Orientation";
	
	/**
	 * 追尾型LLAマーカー
	 */
	const TRACKING_LLA_MARKER = "LLA";
	
	/**
	 * 追尾型バーコード及びQRコード
	 */
	const TRACKING_BARCODE_QR = "Code";


	/** @brief 3Dモデルベースの基本的なロケーションを作成
	 * @param String $id：arelオブジェクトのID
	 * @param String $title：ARELオブジェクトのタイトルも同様に、リストとマップとして（追加した場合）ポップアップで表示
	 * @param String $model:：オブジェクトのモデルに、またはすべての情報を保持するzipパッケージへのパス
	 * @param String $texture：オブジェクトのテクスチャへのパス（JPGまたはPNGファイル）
	 * @param Array $location：位置パラメータの配列（緯度、経度、高度）
	 * @param Array $scale：3軸に沿ってスケール値を提供(x, y, z)
	 * @param ArelRotation $rotation：回転情報を提供。オイラー（ラジアン/度）、四元、axisangleまたはマトリクスとして定義することが可能。
	 * @param String $icon：地図上に表示されるアイコンを提供する(オプション)
	 */
	static public function createLocationBasedModel3D($id, $title, $model, $texture, $location, $scale, $rotation, $icon = NULL)
	{
		$obj = new ArelObjectModel3D($id);
		$obj->setTitle($title);
		$obj->setModel($model);
		$obj->setTexture($texture);
		$obj->setScale($scale);
		$obj->setRotation($rotation);
		$obj->setLocation($location);
		$obj->setIcon($icon);
		
		return $obj;
	}
	
	/**
	 * @brief 3Dムービーテクスチャベースの基本的なロケーションを作成
	 * @param String $id：arelオブジェクトのID
	 * @param String $title：ARELオブジェクトのタイトルも同様に、リストとマップとして（追加した場合）ポップアップで表示
	 * @param String $moviePath：現実世界で表示する3g2動画へのパス
	 * @param Array $location：位置パラメータの配列（緯度、経度、高度）
	 * @param Array $scale：3軸に沿ってスケール値を提供(x, y, z)
	 * @param ArelRotation $rotation：回転情報を提供。オイラー（ラジアン/度）、四元、axisangleまたはマトリクスとして定義することが可能。
	 * @param String $icon：地図上に表示されるアイコンを提供する(オプション)
	 */
	static public function createLocationBasedModel3DFromMovie($id, $title, $moviePath, $location, $scale, $rotation, $icon = NULL)
	{
		$obj = ArelObjectModel3D::createFromMovie($id, $moviePath);
		
		$obj->setTitle($title);
		$obj->setScale($scale);
		$obj->setRotation($rotation);
		$obj->setLocation($location);
		$obj->setIcon($icon);
		
		return $obj;
	}
	
	/**
	 * @brief 基本的なロケーションベースの3次元画像を作成
	 * @param String $id：arelオブジェクトのID
	 * @param String $title：ARELオブジェクトのタイトルも同様に、リストとマップとして（追加した場合）ポップアップで表示
	 * @param String $imagePath：現実世界で表示するjpgやpng画像へのパス
	 * @param Array $location：位置パラメータの配列（緯度、経度、高度）
	 * @param Array $scale：3軸に沿ってスケール値を提供(x, y, z)
	 * @param ArelRotatio $rotation：回転情報を提供。オイラー（ラジアン/度）、四元、axisangleまたはマトリクスとして定義することが可能。
	 * @param String $icon：地図上に表示されるアイコンを提供する(オプション)
	 */
	
	static public function createLocationBasedModel3DFromImage($id, $title, $imagePath, $location, $scale, $rotation, $icon = NULL)
	{
		$obj = ArelObjectModel3D::createFromImage($id, $imagePath);
		
		$obj->setTitle($title);
		$obj->setScale($scale);
		$obj->setRotation($rotation);
		$obj->setLocation($location);
		$obj->setIcon($icon);
		
		return $obj;
	}

	/**
	 * @brief POIをベースとした位置情報を作成(デフォルトのデザインとテキスト表現)
	 * @param String $id：arelオブジェクトのID
	 * @param String $title：ARELオブジェクトのタイトルも同様に、リストとマップとして（追加した場合）ポップアップで表示
	 * @param Array $location：位置パラメータの配列（緯度、経度、高度）
	 * @param String $thumbnail：ライブビューで一覧に表示するサムネイルを提供
	 * @param String $icon：地図上に表示されるアイコンを提供する(オプション)
	 * @param String $description：ポップアップまたは付加情報に書き込まれる情報
	 * @param Array $buttons：ポップ·アップ/詳細表示で使うボタンを定義
	 
	 */
	static public function createLocationBasedPOI($id, $title, $location, $thumbnail, $icon, $description, $buttons = array())
	{
		$obj = new ArelObjectPoi($id);
		$obj->setTitle($title);
		$obj->setLocation($location);
		$obj->setThumbnail($thumbnail);
		$obj->setIcon($icon);
		
		if(!empty($description) || !empty($buttons))
		{
			$popup = new ArelPopup();
			$popup->setDescription($description);
			$popup->setButtons($buttons);
			
			$obj->setPopup($popup);
		}
		
		return $obj;
	}
	
	 /**
	 * @brief 360度のオブジェクトを作成(3Dモデル)
	 * @param String $id：arelオブジェクトのID
	 * @param String $model:：オブジェクトのモデルに、またはすべての情報を保持するzipパッケージへのパス
	 * @param String $texture：オブジェクトのテクスチャへのパス（JPGまたはPNGファイル）
	 * @param Array $translation：移動パラメータのx、y、z
	 * @param Array $scale：3軸に沿ってスケール値を提供(x, y, z)
	 * @param ArelRotation $rotation：回転情報を提供。オイラー（ラジアン/度）、四元、axisangleまたはマトリクスとして定義することが可能。
	 * @param Int $renderPosition If you have multiple 360Objects created with transparencies
	 */
	static public function create360Object($id, $model, $texture, $translation, $scale, $rotation, $renderPosition = NULL)
	{
		$obj = new ArelObjectModel3D($id);
		$obj->setModel($model);
		$obj->setTexture($texture);
		$obj->setScale($scale);
		$obj->setRotation($rotation);
		$obj->setTranslation($translation);
		$obj->setRenderOrderPosition($renderPosition);
		
		return $obj;
	}

	/**
	 * @brief Create a basic Glue 3D Model.
	 * @param String $id：arelオブジェクトのID
	 * @param String $model:：オブジェクトのモデルに、またはすべての情報を保持するzipパッケージへのパス
	 * @param String $texture：オブジェクトのテクスチャへのパス（JPGまたはPNGファイル）
	 * @param Array $translation：移動パラメータnの提供(x, y, z)
	 * @param Array $scale：3軸に沿ってスケール値を提供(x, y, z)
	 * @param ArelRotation $rotation：回転情報を提供。オイラー（ラジアン/度）、四元、axisangleまたはマトリクスとして定義することが可能。
	 * @param Int $coordinateSystemID：モデルを添付しなければならないcorrdinateSystemのID
	 */
	static public function createGLUEModel3D($id, $model, $texture, $translation, $scale, $rotation, $coordinateSystemID)
	{
		$obj = new ArelObjectModel3D($id);
		$obj->setModel($model);
		$obj->setTexture($texture);
		$obj->setScale($scale);
		$obj->setRotation($rotation);
		$obj->setTranslation($translation);
		$obj->setCoordinateSystemID($coordinateSystemID);
		
		return $obj;
	}
	
	/**
	 * @brief Glue Movie Textureの作成(動画は、実世界のオブジェクトを重ねて作成)
	 * @param String $id：arelオブジェクトのID
	 * @param String $moviePath：現実世界で表示する3g2動画へのパス
	 * @param $translation：移動パラメータnの提供(x, y, z)
	 * @param Array $scale：3軸に沿ってスケール値を提供(x, y, z)
	 * @param ArelRotation $rotation：回転情報を提供。オイラー（ラジアン/度）、四元、axisangleまたはマトリクスとして定義することが可能。
	 * @param Int $coordinateSystemID：モデルを添付しなければならないcorrdinateSystemのID
	 */
	
	static public function createGLUEModel3DFromMovie($id, $moviePath, $translation, $scale, $rotation, $coordinateSystemID)
	{
		$obj = ArelObjectModel3D::createFromMovie($id, $moviePath);
		
		$obj->setScale($scale);
		$obj->setRotation($rotation);
		$obj->setTranslation($translation);
		$obj->setCoordinateSystemID($coordinateSystemID);
		
		return $obj;
	}
	
	/**
	 * @brief Create a Glue Movie Texture (Movie overlaid a real world object)
	 * @param String $id：arelオブジェクトのID
	 * @param String $imagePath：現実世界で表示するjpgやpng画像へのパス
	 * @param $translation：移動パラメータnの提供(x, y, z)
	 * @param Array $scale：3軸に沿ってスケール値を提供(x, y, z)
	 * @param ArelRotation $rotation：回転情報を提供。オイラー（ラジアン/度）、四元、axisangleまたはマトリクスとして定義することが可能。
	 * @param Int $coordinateSystemID：モデルを添付しなければならないcorrdinateSystemのID
	 */
	static public function createGLUEModel3DFromImage($id, $imagePath, $translation, $scale, $rotation, $coordinateSystemID)
	{
		$obj = ArelObjectModel3D::createFromImage($id, $imagePath);
		
		$obj->setScale($scale);
		$obj->setRotation($rotation);
		$obj->setTranslation($translation);
		$obj->setCoordinateSystemID($coordinateSystemID);
		
		return $obj;
	}
	
	/**
	 * @brief Create a screen fixed 3D Model, meaning it is always stuck to the devices screen
	 * @param String $id：arelオブジェクトのID
	 * @param String $model:：オブジェクトのモデルに、またはすべての情報を保持するzipパッケージへのパス
	 * @param String $texture：オブジェクトのテクスチャへのパス（JPGまたはPNGファイル）
	 * @param int $screenAnchor：定数ArelAnchor@see の画面アンカーを定義
	 * @param Array $scale：3軸に沿ってスケール値を提供(x, y, z)
	 * @param ArelRotation $rotation：回転情報を提供。オイラー（ラジアン/度）、四元、axisangleまたはマトリクスとして定義することが可能。
	 * @return 作成されたArelObjectModel3Dを返す
	 */
	static public function createScreenFixedModel3D($id, $model, $texture, $screenAnchor, $scale, $rotation)
	{
		$obj = new ArelObjectModel3D($id);
		$obj->setModel($model);
		$obj->setTexture($texture);
		$obj->setScale($scale);
		$obj->setRotation($rotation);
		$obj->setScreenAnchor($screenAnchor);
		
		return $obj;
	}
	
	/**
	 * @brief junaioへの出力を開始する
	 * @param string $resourcesPath：すべてのリソース（モデル、画像、シェーダー、マテリアル）を保持するZIPへのパス
	 * @param string $arelPath：arel JSホスティングとGUIを定義したHTMLへのパス
	 * @param string $trackingXML：xmlのトラッキングもしくは識別子へのパス(LLAマーカー、バーコード/QRコード)。何も提供しない場合は、GPSが提供される。
	 * @param Array $sceneOptions：シーンオプションを提供
	 */
	static public function start($resourcesPath = NULL, $arelPath = NULL, $trackingXML = null, $sceneOptions = NULL)
	{
		$arelBackUpPath = "";
		
		ob_start();
		ob_clean();
		
		if(isset($trackingXML) && $trackingXML != "")
	 		echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><results trackingurl=\"$trackingXML\">";
		else
			echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><results>";
			
		if(isset($resourcesPath) && !empty($resourcesPath))
		{
			echo "<resources><![CDATA[$resourcesPath]]></resources>";
		}
		
		if(isset($arelPath) && !empty($arelPath))
		{
			echo "<arel><![CDATA[$arelPath]]></arel>";
		}
		else
			echo "<arel><![CDATA[$arelBackUpPath]]></arel>";
			
		if(isset($sceneOptions) && !empty($sceneOptions))
		{
			echo "<sceneoptions>";
			foreach ($sceneOptions as $sceneOptionKey => $sceneOptionValue)
			{
				echo "<sceneoption key=\"$sceneOptionKey\"><![CDATA[$sceneOptionValue]]></sceneoption>";
			}
			echo "</sceneoptions>";
		}
	}
	
	/**
	 * @brief junaioへのXML出力を終了
	 */
	static public function end()
	{
		echo "</results>";
		ob_end_flush();	
	}
	
	/**
	 * @brief ARELオブジェクトのXML出力を作成し、junaioサーバーに送信
	 * @param ArelObject $oObject：オブジェクトを指定
	 */
	static public function outputObject($oObject)
	{
		$object = new SimpleXMLExtended("<object></object>");
		$object->addAttribute('id', (string)$oObject->getID());
		
		if($oObject->getTitle())
			$object->addCData('title', $oObject->getTitle());
			
		if($oObject->getThumbnail())
			$object->addCData('thumbnail', $oObject->getThumbnail());
			
		if($oObject->getIcon())
			$object->addCData('icon', $oObject->getIcon());
			
		//location
		if($oObject->getLocation())
		{
		   	$location = $object->addChild("location");
		   	$oLocation = $oObject->getLocation();
	    	
		   	try {
		   		$location->addChild('lat', $oLocation[0]);
	    		$location->addChild('lon', $oLocation[1]);
	    		$location->addChild('alt', $oLocation[2]);
		   	}
		   	catch(Exception $e)
		   	{
		   		return $e;
		   	}	    		    	 
		}
		
		//popup
		if($oObject->getPopup())
		{
			$popup = $object->addChild("popup");
		   	$oPopUp = $oObject->getPopup();
		   	
		   	if($oPopUp->getDescription())
		   		$popup->addCData('description', $oPopUp->getDescription());
		   		
		   	if($oPopUp->getButtons())
		   	{
		   		$buttons = $popup->addChild("buttons");
		   		$aButtons = $oPopUp->getButtons();
		   		
		   		foreach($aButtons as $oButton)
		   		{
		   			$button = $buttons->addCData("button", $oButton[2]);
		   			$button->addAttribute("id", $oButton[1]);
		   			$button->addAttribute("name", $oButton[0]);		   			
		   		}
		   	}		   	
		}
		
		if($oObject instanceof ArelObjectModel3D)
		{
			//assets3D
			$assets3D = $object->addChild("assets3d");
					
			if($oObject->getModel())
		   		$assets3D->addCData('model', $oObject->getModel());
		   		
		   	if($oObject->getMovie())
		   		$assets3D->addCData('movie', $oObject->getMovie());
		   		
		   	if($oObject->getTexture())
		   		$assets3D->addCData('texture', $oObject->getTexture());
		   		
		   	//transform
		   	$transform = $assets3D->addChild("transform");
			
			$oTransform = $oObject->getTransformParent();
			if (isset($oTransform))
				$transform->addAttribute("parent", $oTransform);
		   	
		   	try {
		   		
		   		//translation
		   		$translation = $transform->addChild("translation");
		   		$oTranslation = $oObject->getTranslation();
		   		$translation->addChild("x", $oTranslation[0]);
		   		$translation->addChild("y", $oTranslation[1]);
		   		$translation->addChild("z", $oTranslation[2]);
		   		
		   		//rotation
		   		$rotation = $transform->addChild("rotation");
		   		$oRotationElement = $oObject->getRotation();
		   		$oRotation = $oRotationElement->getRotationValues();
		   		$oRotationType = $oRotationElement->getRotationType();
		   		
		   		$rotation->addAttribute("type", $oRotationType);
		   		
		   		if($oRotationType !== ArelRotation::ROTATION_MATRIX)
		   		{
		   			$rotation->addChild("x", $oRotation[0]);
			   		$rotation->addChild("y", $oRotation[1]);
			   		$rotation->addChild("z", $oRotation[2]);
			   		
			   		if($oRotationType == ArelRotation::ROTATION_QUATERNION)
			   			$rotation->addChild("w", $oRotation[3]);
			   		else if($oRotationType == ArelRotation::ROTATION_AXISANGLE)
			   			$rotation->addChild("angle", $oRotation[3]);
		   		}
		   		else //Matrix
		   		{
		   			$rotation->addChild("m0", $oRotation[0]);
		   			$rotation->addChild("m1", $oRotation[1]);
		   			$rotation->addChild("m2", $oRotation[2]);
		   			$rotation->addChild("m3", $oRotation[3]);
		   			$rotation->addChild("m4", $oRotation[4]);
		   			$rotation->addChild("m5", $oRotation[5]);
		   			$rotation->addChild("m6", $oRotation[6]);
		   			$rotation->addChild("m7", $oRotation[7]);
		   			$rotation->addChild("m8", $oRotation[8]);
		   		}
		   		
		   		//scale
		   		$scale = $transform->addChild("scale");
		   		$oScale = $oObject->getScale();
		   		$scale->addChild("x", $oScale[0]);
		   		$scale->addChild("y", $oScale[1]);
		   		$scale->addChild("z", $oScale[2]);
		   		
		   	}
		   	catch(Exception $e)
		   	{
		   		return $e;
		   	}
		
	   		//properties
	   		$pickingEnabled = $oObject->isPickingEnabled();
	   		$cosID = $oObject->getCoordinateSystemID();
			$shaderMaterial = $oObject->getShaderMaterial();
	   		$occluding = $oObject->isOccluding();
	   		$transparency = $oObject->getTransparency();
	   		$renderPosition = $oObject->getRenderOrderPosition();
            $screenAnchor = $oObject->getScreenAnchor();
	   		   	
		   	if(	isset($cosID) || isset($shaderMaterial) || isset($occluding) || isset($pickingEnabled) || 
		   		isset($screenAnchor) || isset($transparency) || isset($renderPosition))
		   	{
		   		$properties = $assets3D->addChild("properties");
		   		
		   		if(isset($cosID))
		   			$properties->addChild("coordinatesystemid", $cosID);
					
				if(isset($shaderMaterial))
		   			$properties->addChild("shadermaterial", $shaderMaterial);	
		   			
		   		if($occluding)
		   			$properties->addChild("occluding", "true");
		   			
		   		if(isset($transparency) && $transparency > 0)
		   			$properties->addChild("transparency", $oObject->getTransparency());
		   			
		   		if(isset($pickingEnabled) && !$pickingEnabled)
		   			$properties->addChild("pickingenabled", "false");
		   			
		   		if(isset($renderPosition))
		   			$properties->addChild("renderorder", $oObject->getRenderOrderPosition());

                if(isset($screenAnchor)) {
                    $screenAnchorProperty = $properties->addChild("screenanchor", $oObject->getScreenAnchor());
                    if( $oObject->getScreenAnchorFlag() != NULL)
                        $screenAnchorProperty->addAttribute("flags", $oObject->getScreenAnchorFlag(), null);
                }
		   	}
	   	}
	   	
	   	//viewparameters
	   	if($oObject->getVisibility() || $oObject->getMinAccuracy() || $oObject->getMinDistance() || $oObject->getMaxDistance())
	   	{
	   		$viewparameter = $object->addChild("viewparameters");
	   		
	   		if($oObject->getVisibility())
	   		{
	   			$visibility = $viewparameter->addChild("visibility");
	   			$oVisibility = $oObject->getVisibility();
	   			
	   			if((isset($oVisibility["liveview"]) && !$oVisibility["liveview"]))
	   				$visibility->addChild("liveview", "false");
	   				
	   			if(isset($oVisibility["maplist"]) && !$oVisibility["maplist"])
	   				$visibility->addChild("maplist", "false");
	   				
	   			if(isset($oVisibility["radar"]) && !$oVisibility["radar"])
	   				$visibility->addChild("radar", "false");
	   				
	   			//alternatively for 0,1,2
	   			if((isset($oVisibility[0]) && !$oVisibility[0]))
	   				$visibility->addChild("liveview", "false");
	   				
	   			if(isset($oVisibility[1]) && !$oVisibility[1])
	   				$visibility->addChild("maplist", "false");
	   				
	   			if(isset($oVisibility[2]) && !$oVisibility[2])
	   				$visibility->addChild("radar", "false");
	   		}
	   		
	   		if($oObject->getMinAccuracy())
	   			$viewparameter->addChild("minaccuracy", $oObject->getMinAccuracy());
	   			
	   		if($oObject->getMinDistance())
	   			$viewparameter->addChild("mindistance", $oObject->getMinDistance());
	   			
	   		if($oObject->getMaxDistance())
	   			$viewparameter->addChild("maxdistance", $oObject->getMaxDistance());
	   	}
	   	
	   	//parameters
	   	if($oObject->getParameters())
	   	{
	   		$parameters = $object->addChild("parameters");
	   		
	   		foreach($oObject->getParameters() as $key => $parValue)
	   		{
	   			$parameter = $parameters->addCData("parameter", $parValue);
	   			$parameter->addAttribute("key", $key);
	   		}
	   	}
	   	    	
    	$out = $object->asXML();
    	$pos = strpos($out, "?>");
	    echo utf8_encode(trim(substr($out, $pos + 2)));
	    ob_flush();		
	}	
	
	/**
	 * @brief junaioへの出力を開始する際に、引数から現在サポートしているシーンオプションの配列(予期したkeyと提供場所から)を作成
	 * @param String $environmentMapLocation：相対パスまたは環境マップへのURL
	 * @param Array $shaderMaterialsLocation：相対パスまたはシェーダ素材へのURL
	 * @return Array：現在サポートしているシーンオプションの配列
	 */
	public static function createSceneOptions($environmentMapLocation, $shaderMaterialsLocation = NULL)
	{
		$aSceneOptions = array();
		if (!is_null($environmentMapLocation))
		{
			$aSceneOptions['environmentmap'] = $environmentMapLocation;
		}
		if (!is_null($shaderMaterialsLocation))
		{
			$aSceneOptions['shadermaterials'] = $shaderMaterialsLocation;
		}
		return $aSceneOptions;
	}
}
?>