<?php

namespace Neoncitylights\Xml;

enum Option: int {
	case CaseFolding = \XML_OPTION_CASE_FOLDING;
	case SkipTagStart = \XML_OPTION_SKIP_TAGSTART;
	case SkipWhite = \XML_OPTION_SKIP_WHITE;
	case TargetEncoding = \XML_OPTION_TARGET_ENCODING;
}
