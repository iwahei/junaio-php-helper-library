<?php
/**
 * SimpleXMLElememntの拡張例
 * http://trirand.com/blog/phpjqgrid/docs/jqGrid/SimpleXMLExtended.html
 */
class SimpleXMLExtended extends SimpleXMLElement
{
  
	public function addCData($sNode, $cdata_text)
	{
		$newNode = $this->addChild($sNode);
		$node= dom_import_simplexml($newNode);
		$nodeOwner = $node->ownerDocument;
		$node->appendChild($nodeOwner->createCDATASection($cdata_text));
		
		return $newNode;
	}
}
?>