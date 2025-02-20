<?php

namespace Neoncitylights\Xml;

/**
 * Options for configuring an XML parser
 *
 * @see https://www.php.net/manual/en/xml.constants.php
 */
enum Option: int {
	case CaseFolding = \XML_OPTION_CASE_FOLDING;
	case SkipTagStart = \XML_OPTION_SKIP_TAGSTART;
	case SkipWsp = \XML_OPTION_SKIP_WHITE;
	case TargetEncoding = \XML_OPTION_TARGET_ENCODING;
}
