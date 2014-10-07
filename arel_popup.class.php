<?php
/**
 * @copyright  Copyright 2012 metaio GmbH. All rights reserved.
 * @author     metaio GmbH
 **/

/**
 * 
 * arelオブジェクトのポップアップ要素
 *
 */
class ArelPopup
{
	private $buttons = array();
	private $description = NULL;
	
	/**
	 * ポップアップのボタンを設定
	 * @param Array $button：配列でボタンの要素を指定
	 * 例：array(array("url", "1", "http://www.junaio.com"), array("sound", "2", "http://www.junaio.com/song.mp3))
	 */
	public function setButtons($button){
		$this->buttons = $button;
	}
	
	/**
	 * ポップアップのボタンを取得
	 * @return Array：配列でボタンの要素を指定　
     * 例：array(array("url", "1", "http://www.junaio.com"), array("sound", "2", "http://www.junaio.com/song.mp3))
	 */ 
	public function getButtons(){
		return $this->buttons;
	}
	
	/** 
	 * ポップアップの単一なボタンを追加
	 * @param Array $button：配列でボタンの要素を指定
     * 例：array(array("url", "1", "http://www.junaio.com"), array("sound", "2", "http://www.junaio.com/song.mp3)))
	 */
	
	public function addButton($button){
		$this->buttons[] = $button;
	}
	
	/**
	 * ポップアップ上のテキストを設定
	 * @param String $description：説明文
	 */
	public function setDescription($description){
		$this->description = $description;
	}
	
	/**
	 * ポップアップ上のテキストを取得
	 * @return String：説明文
	 */
	public function getDescription(){
		return $this->description;
	}
}
