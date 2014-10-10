<?php

/**
 * @copyright  Copyright 2012 metaio GmbH. All rights reserved.
 * @author     metaio GmbH
 **/

/**
 * @brief ArelRotationは3D回転を表すために使用
 *
 */
class ArelRotation
{
	/**
	 * @brief 度の値を持つオイラー回転である時の回転を定義
	 */
	const ROTATION_EULERDEG = "eulerdeg";
	
	/**
	 * @brief ラジアン値を持つオイラー回転である時の回転を定義
	*/
	const ROTATION_EULERRAD = "eulerrad";
	
	/**
	 * @brief 回転AxisAngleの定義 (x,y,z　ラジアン角)
	*/
	const ROTATION_AXISANGLE = "axisangle";
	
	/**
	 * @brief 回転マトリックスの定義 (m0..m8)
	*/
	const ROTATION_MATRIX = "matrix";
	
	/**
	 * @brief 4元数回転の定義 (q1..q4)
	*/
	const ROTATION_QUATERNION = "quaternion";
	
	private $rotationType = ArelRotation::ROTATION_EULERDEG;
	private $rotation = array(0,0,0);
	
	/**
	 * @brief 回転オブジェクトの構築
	 * @param String $type：ArelRotation::ROTATION_EULERDEG, ArelRotation::ROTATION_EULERRAD, ArelRotation::ROTATION_AXISANGLE, ArelRotation::ROTATION_MATRIX もしくは ArelRotation::ROTATION_QUATERNIONの一つ
	 * @param Array $values：指定した型に応じた回転値
	 */
	public function __construct($type = NULL, $values = NULL)
	{
		if(!empty($type))
			$this->rotationType = $type;していｓ
			
		if(!empty($values))
			$this->rotation = $values;		
	}
	
	/**
	 * @brief 回転値の取得
	 * @return Array：回転値
	 */
	public function getRotationValues(){
		return $this->rotation;
	}

	/**
	 * @brief 回転値の設定 
	 * @param Array $rotationValueArray：指定した型に応じた回転値
	 */
	public function setRotationValues($rotationValueArray){
		$this->rotation = $rotationValueArray;
	}
	
	/**
	 * @brief 回転のタイプを取得
	 * @return String：ArelRotation::ROTATION_EULERDEG, ArelRotation::ROTATION_EULERRAD, ArelRotation::ROTATION_AXISANGLE, ArelRotation::ROTATION_MATRIX もしくは ArelRotation::ROTATION_QUATERNIONの一つ
	 */
	public function getRotationType(){
		return $this->rotationType;
	}
	
	/**
	 * @brief 回転のタイプを設置
	 * @param String：ArelRotation::ROTATION_EULERDEG, ArelRotation::ROTATION_EULERRAD, ArelRotation::ROTATION_AXISANGLE, ArelRotation::ROTATION_MATRIX もしくは ArelRotation::ROTATION_QUATERNIONの一つ
	 */
	public function setRotationType($rotationType){
		$this->rotationType = $rotationType;		
	}
}
