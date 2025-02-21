<?php

namespace Neoncitylights\Xml\Tests;

use Neoncitylights\Xml\Encoding;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass( Encoding::class )]
class EncodingTest extends TestCase {
	#[DataProvider( "provideVariantEquals" )]
	public function testVariantEquals( Encoding $encoding, string $encodingString ): void {
		$this->assertSame( $encoding->value, $encodingString );
	}

	public static function provideVariantEquals(): array {
		return [
			[ Encoding::Iso8859_1, 'ISO-8859-1' ],
			[ Encoding::UsAscii, 'US-ASCII' ],
			[ Encoding::Utf8, 'UTF-8' ],
		];
	}
}
