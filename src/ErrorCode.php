<?php

namespace Neoncitylights\Xml;

/**
 * @see https://www.php.net/manual/en/xml.constants.php
 */
enum ErrorCode: int {
	case None = \XML_ERROR_NONE;
	case NoMemory = \XML_ERROR_NO_MEMORY;
	case Syntax = \XML_ERROR_SYNTAX;
	case NoElements = \XML_ERROR_NO_ELEMENTS;
	case InvalidToken = \XML_ERROR_INVALID_TOKEN;
	case UnclosedToken = \XML_ERROR_UNCLOSED_TOKEN;
	case PartialChar = \XML_ERROR_PARTIAL_CHAR;
	case TagMismatch = \XML_ERROR_TAG_MISMATCH;
	case DuplicateAttribute = \XML_ERROR_DUPLICATE_ATTRIBUTE;
	case JunkAfterDocElement = \XML_ERROR_JUNK_AFTER_DOC_ELEMENT;
	case ParamEntityRef = \XML_ERROR_PARAM_ENTITY_REF;
	case UndefinedEntity = \XML_ERROR_UNDEFINED_ENTITY;
	case EntityRef = \XML_ERROR_RECURSIVE_ENTITY_REF;
	case AsyncEntity = \XML_ERROR_ASYNC_ENTITY;
	case BadCharRef = \XML_ERROR_BAD_CHAR_REF;
	case BinaryEntityRef = \XML_ERROR_BINARY_ENTITY_REF;
	case AttributeExternalEntityRef = \XML_ERROR_ATTRIBUTE_EXTERNAL_ENTITY_REF;
	case MisplacedXmlPi = \XML_ERROR_MISPLACED_XML_PI;
	case UnknownEncoding = \XML_ERROR_UNKNOWN_ENCODING;
	case IncorrectEncoding = \XML_ERROR_INCORRECT_ENCODING;
	case UnclosedCDATASection = \XML_ERROR_UNCLOSED_CDATA_SECTION;
	case ExternalEntityHandling = \XML_ERROR_EXTERNAL_ENTITY_HANDLING;

	public function asErrorString(): ?string {
		return \xml_error_string( $this->value );
	}
}
