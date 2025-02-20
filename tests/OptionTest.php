<?php

namespace Neoncitylights\Xml\Tests;

use Neoncitylights\Xml\Option;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass( Option::class )]
class OptionTest extends TestCase {
	#[DataProvider( "provideVariantEquals" )]
	public function testVariantEquals( Option $option, int $optionInt ): void {
		$this->assertEquals( $option->value, $optionInt );
	}

	public static function provideVariantEquals(): array {
		return [
			[ Option::CaseFolding, \XML_OPTION_CASE_FOLDING ],
			[ Option::SkipTagStart, \XML_OPTION_SKIP_TAGSTART ],
			[ Option::SkipWhite, \XML_OPTION_SKIP_WHITE ],
			[ Option::TargetEncoding, \XML_OPTION_TARGET_ENCODING ],
		];
	}
}
