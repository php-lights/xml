<?php

namespace Neoncitylights\Xml;

/**
 * Return type that wraps around values passed-by-reference
 * for `\xml_parse_into_struct()`. This is also returned by
 * calling XmlNativeParser::parseIntoStruct()`.
 */
class XmlParseResult {
	public array $values;
	public array $index;

	public function __construct( array $values, array $index ) {
		$this->values = $values;
		$this->index = $index;
	}
}
