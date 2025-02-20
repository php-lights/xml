<?php

namespace Neoncitylights\Xml;

class XmlParseResult {
	public array $values;
	public array $index;

	public function __construct( array $values, array $index ) {
		$this->values = $values;
		$this->index = $index;
	}
}
