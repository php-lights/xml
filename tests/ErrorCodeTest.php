<?php

namespace Neoncitylights\Xml\Tests;

use Neoncitylights\Xml\ErrorCode;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass( ErrorCode::class )]
class ErrorCodeTest extends TestCase {
	public function testAsErrorString(): void {
		$this->assertSame( 'No error', ErrorCode::None->asErrorString() );
	}

	#[DataProvider( "provideVariantEquals" )]
	public function testVariantEquals( ErrorCode $errorCode, int $errorCodeInt ): void {
		$this->assertSame( $errorCode->value, $errorCodeInt );
	}

	public static function provideVariantEquals(): array {
		return [
			[ ErrorCode::None, \XML_ERROR_NONE ],
			[ ErrorCode::NoMemory, \XML_ERROR_NO_MEMORY ],
			[ ErrorCode::Syntax, \XML_ERROR_SYNTAX ],
			[ ErrorCode::NoElements, \XML_ERROR_NO_ELEMENTS ],
			[ ErrorCode::InvalidToken, \XML_ERROR_INVALID_TOKEN ],
			[ ErrorCode::UnclosedToken, \XML_ERROR_UNCLOSED_TOKEN ],
			[ ErrorCode::PartialChar, \XML_ERROR_PARTIAL_CHAR ],
			[ ErrorCode::TagMismatch, \XML_ERROR_TAG_MISMATCH ],
			[ ErrorCode::DuplicateAttribute, \XML_ERROR_DUPLICATE_ATTRIBUTE ],
			[ ErrorCode::JunkAfterDocElement, \XML_ERROR_JUNK_AFTER_DOC_ELEMENT ],
			[ ErrorCode::ParamEntityRef, \XML_ERROR_PARAM_ENTITY_REF ],
			[ ErrorCode::UndefinedEntity, \XML_ERROR_UNDEFINED_ENTITY ],
			[ ErrorCode::EntityRef, \XML_ERROR_RECURSIVE_ENTITY_REF ],
			[ ErrorCode::AsyncEntity, \XML_ERROR_ASYNC_ENTITY ],
			[ ErrorCode::BadCharRef, \XML_ERROR_BAD_CHAR_REF ],
			[ ErrorCode::BinaryEntityRef, \XML_ERROR_BINARY_ENTITY_REF ],
			[ ErrorCode::AttributeExternalEntityRef, \XML_ERROR_ATTRIBUTE_EXTERNAL_ENTITY_REF ],
			[ ErrorCode::MisplacedXmlPi, \XML_ERROR_MISPLACED_XML_PI ],
			[ ErrorCode::UnknownEncoding, \XML_ERROR_UNKNOWN_ENCODING ],
			[ ErrorCode::IncorrectEncoding, \XML_ERROR_INCORRECT_ENCODING ],
			[ ErrorCode::UnclosedCDATASection, \XML_ERROR_UNCLOSED_CDATA_SECTION ],
			[ ErrorCode::ExternalEntityHandling, \XML_ERROR_EXTERNAL_ENTITY_HANDLING ],
		];
	}
}
