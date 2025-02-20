<?php

namespace Neoncitylights\Xml\Tests;

use Neoncitylights\Xml\XmlParseResult;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass( XmlParseResult::class )]
class XmlParseResultTest extends TestCase {
	#[DataProvider( "provideParseResult" )]
	public function testIndex( XmlParseResult $result ): void {
		$this->assertEquals(
			[ 'PARA' => [ 0, 2 ], 'NOTE' => [ 1 ] ],
			$result->index,
		);
	}

	#[DataProvider( "provideParseResult" )]
	public function testValues( XmlParseResult $result ): void {
		$this->assertEquals(
			[
				[
					"tag" => "PARA",
					"type" => "open",
					"level" => 1
				],
				[
					"tag" => "NOTE",
					"type" => "complete",
					"level" => 2,
					"value" => "simple note"
				],
				[
					"tag" => "PARA",
					"type" => "close",
					"level" => 1
				],
			],
			$result->values,
		);
	}

	public static function provideParseResult(): array {
		return [
			[
				new XmlParseResult(
					[
						[
							"tag" => "PARA",
							"type" => "open",
							"level" => 1
						],
						[
							"tag" => "NOTE",
							"type" => "complete",
							"level" => 2,
							"value" => "simple note"
						],
						[
							"tag" => "PARA",
							"type" => "close",
							"level" => 1
						],
					],
					[
						'PARA' => [ 0, 2 ],
						'NOTE' => [ 1 ],
					],
				),
			]
		];
	}
}
