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
	 * @brief Construct a rotation object
	 * @param String $type one of ArelRotation::ROTATION_EULERDEG, ArelRotation::ROTATION_EULERRAD, ArelRotation::ROTATION_AXISANGLE, ArelRotation::ROTATION_MATRIX or ArelRotation::ROTATION_QUATERNION
	 * @param Array $values Rotation values according to the type specified 
	 */
	public function __construct($type = NULL, $values = NULL)
	{
		if(!empty($type))
			$this->rotationType = $type;
			
		if(!empty($values))
			$this->rotation = $values;		
	}
	
	/**
	 * @brief Get the rotation values 
	 * @return Array Rotation values
	 */
	public function getRotationValues(){
		return $this->rotation;
	}

	/**
	 * @brief Set the rotation values
	 * @param Array $rotationValueArray Rotation values according to the type specified
	 */
	public function setRotationValues($rotationValueArray){
		$this->rotation = $rotationValueArray;
	}
	
	/**
	 * @brief Get the rotation type
	 * @return String one of ArelRotation::ROTATION_EULERDEG, ArelRotation::ROTATION_EULERRAD, ArelRotation::ROTATION_AXISANGLE, ArelRotation::ROTATION_MATRIX or ArelRotation::ROTATION_QUATERNION
	 */
	public function getRotationType(){
		return $this->rotationType;
	}
	
	/**
	 * @brief Set rotation type
	 * @param String one of ArelRotation::ROTATION_EULERDEG, ArelRotation::ROTATION_EULERRAD, ArelRotation::ROTATION_AXISANGLE, ArelRotation::ROTATION_MATRIX or ArelRotation::ROTATION_QUATERNION
	 */
	public function setRotationType($rotationType){
		$this->rotationType = $rotationType;		
	}
}
