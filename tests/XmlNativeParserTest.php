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
		$parser = XmlNativeParser::new( Encoding::Utf8 );
		$actualValue = $parser->getOption( $option );
		$this->assertSame( $expectedValue, $actualValue );
	}

	public static function provideGetOption(): array {
		return [
			[ Option::CaseFolding, true ],
			[ Option::SkipTagStart, 0 ],
			[ Option::SkipWsp, false ],
			[ Option::TargetEncoding, Encoding::Utf8->value ],
		];
	}

	public function testGetOptionTyped() {
		$parser = XmlNativeParser::new( Encoding::Utf8 );
		$this->assertTrue( $parser->getCaseFolding() );
		$this->assertSame( 0, $parser->getSkipTagStart() );
		$this->assertFalse( $parser->getSkipWsp() );
		$this->assertSame( Encoding::Utf8, $parser->getTargetEncoding() );
	}

	#[DataProvider( "provideSetOption" )]
	public function testSetOption( Option $option, string|int|bool $settingValue ): void {
		$parser = XmlNativeParser::new( Encoding::Utf8 );
		$wasSuccess = $parser->setOption( $option, $settingValue );
		$this->assertTrue( $wasSuccess );
	}

	public static function provideSetOption(): array {
		return [
			[ Option::CaseFolding, false ],
			[ Option::SkipTagStart, 1 ],
			[ Option::SkipWsp, true ],
			[ Option::TargetEncoding, Encoding::UsAscii->value ],
		];
	}

	public function testSetOptionTyped() {
		$parser = XmlNativeParser::new( Encoding::Utf8 );
		$this->assertTrue( $parser->setCaseFolding( false ) );
		$this->assertTrue( $parser->setSkipTagStart( 1 ) );
		$this->assertTrue( $parser->setSkipWsp( true ) );
		$this->assertTrue( $parser->setTargetEncoding( Encoding::UsAscii ) );
	}

	public function testOnCharacterData() {
		$parser = XmlNativeParser::new( Encoding::Utf8 );
		$this->assertTrue( $parser->onCharacterData( null ) );
	}

	public function testOnDefault() {
		$parser = XmlNativeParser::new( Encoding::Utf8 );
		$this->assertTrue( $parser->onDefault( null ) );
	}

	public function testOnElement() {
		$parser = XmlNativeParser::new( Encoding::Utf8 );
		$this->assertTrue( $parser->onElement( null, null ) );
	}

	public function testOnEndNamespaceDecl() {
		$parser = XmlNativeParser::new( Encoding::Utf8 );
		$this->assertTrue( $parser->onEndNamespaceDecl( null ) );
	}

	public function testOnExternalEntityRef() {
		$parser = XmlNativeParser::new( Encoding::Utf8 );
		$this->assertTrue( $parser->onExternalEntityRef( null ) );
	}

	public function testOnNotationDecl() {
		$parser = XmlNativeParser::new( Encoding::Utf8 );
		$this->assertTrue( $parser->onNotationDecl( null ) );
	}

	public function testOnProcessingInstruction() {
		$parser = XmlNativeParser::new( Encoding::Utf8 );
		$this->assertTrue( $parser->onProcessingInstruction( null ) );
	}

	public function testOnStartNamespaceDecl() {
		$parser = XmlNativeParser::new( Encoding::Utf8 );
		$this->assertTrue( $parser->onStartNamespaceDecl( null ) );
	}

	public function testOnUnparsedEntityDecl() {
		$parser = XmlNativeParser::new( Encoding::Utf8 );
		$this->assertTrue( $parser->onUnparsedEntityDecl( null ) );
	}
}
