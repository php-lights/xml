<?php

namespace Neoncitylights\Xml\Tests;

use Neoncitylights\Xml\Encoding;
use Neoncitylights\Xml\ErrorCode;
use Neoncitylights\Xml\Option;
use Neoncitylights\Xml\XmlNativeParser;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass( XmlNativeParser::class )]
class XmlNativeParserTest extends TestCase {
	#[DataProvider( "provideNew" )]
	public function testNew( ?Encoding $encoding ): void {
		$parser = XmlNativeParser::new( $encoding );
		$this->assertInstanceOf( XmlNativeParser::class, $parser );
	}

	public static function provideNew(): array {
		return [
			[ null ],
			[ Encoding::Utf8 ],
			[ Encoding::UsAscii ],
			[ Encoding::Iso8859_1 ],
		];
	}

	#[DataProvider( "provideNewWithNamespace" )]
	public function testNewWithNamespace( ?Encoding $encoding, ?string $separator ): void {
		$parser = XmlNativeParser::newWithNamespace( $encoding, $separator );
		$this->assertInstanceOf( XmlNativeParser::class, $parser );
	}

	public static function provideNewWithNamespace(): array {
		return [
			[ null, ':' ],
			[ Encoding::Utf8, ':' ],
			[ Encoding::UsAscii, ':' ],
			[ Encoding::Iso8859_1, ':' ],
		];
	}

	public function testGetCurrentByteIndex(): void {
		$parser = XmlNativeParser::new();
		$byteIndex = $parser->getCurrentByteIndex();

		$this->assertSame( 0, $byteIndex );
	}

	public function testGetCurrentColumn(): void {
		$parser = XmlNativeParser::new();
		$column = $parser->getCurrentColumn();

		$this->assertSame( 1, $column );
	}

	public function testGetCurrentLine(): void {
		$parser = XmlNativeParser::new();
		$line = $parser->getCurrentLine();

		$this->assertSame( 1, $line );
	}

	public function testGetErrorCode(): void {
		$parser = XmlNativeParser::new();
		$this->assertSame( ErrorCode::None, $parser->getErrorCode() );
	}

	#[DataProvider( "provideGetOption" )]
	public function testGetOption( Option $option, string|int|bool $expectedValue ): void {
		$parser = XmlNativeParser::new(Encoding::Utf8);
		$actualValue = $parser->getOption( $option );
		$this->assertSame( $expectedValue, $actualValue );
	}

	public static function provideGetOption(): array {
		return [
			[ Option::CaseFolding, true ],
			[ Option::SkipTagStart, 0 ],
			[ Option::SkipWhite, false ],
			// [ Option::TargetEncoding, 'UTF-8' ],
		];
	}
}
