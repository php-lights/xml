<?php

namespace Neoncitylights\Xml;

/**
 * @see https://www.php.net/manual/en/xml.encoding.php
 */
enum Encoding: string {
	case Iso8859_1 = 'ISO-8859-1';
	case Utf8 = 'UTF-8';
	case UsAscii = 'US-ASCII';
}
