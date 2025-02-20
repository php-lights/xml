<?php

namespace Neoncitylights\Xml;

use XMLParser;

class XmlNativeParser {
	public readonly XMLParser $parser;

	public static function new( ?Encoding $encoding = null ): self {
		return new XmlNativeParser( \xml_parser_create(
			( $encoding === null )
				? null
				: $encoding->value
		) );
	}

	public static function newWithNamespace(
		?Encoding $encoding = null,

		?string $separator = ':',
	): self {
		return new XmlNativeParser( \xml_parser_create_ns(
			( $encoding === null )
				? null
				: $encoding->value,
			$separator,
		) );
	}

	public function getErrorString( ErrorCode $errorCode ): ?string {
		return \xml_error_string( $errorCode->value );
	}

	public function getCurrentByteIndex(): int|false {
		return \xml_get_current_byte_index( $this->parser );
	}

	public function getCurrentColumn(): int|false {
		return \xml_get_current_column_number( $this->parser );
	}

	public function getCurrentLine(): int|false {
		return \xml_get_current_line_number( $this->parser );
	}

	public function getErrorCode(): ErrorCode {
		return ErrorCode::from( \xml_get_error_code( $this->parser ) );
	}

	public function parse( string $data, bool $isFinal = false ): int {
		return \xml_parse( $this->parser, $data, $isFinal );
	}

	public function parseFinalize(): int {
		return \xml_parse( $this->parser, '', true );
	}

	public function parseIntoStruct(
		string $data,
	): XmlParseResult|false {
		$result = \xml_parse_into_struct( $this->parser, $data, $values, $index );
		if ( $result === 0 ) {
			return false;
		} else {
			return new XmlParseResult( $values, $index );
		}
	}

	public function getOption( Option $option ): int|bool {
		return \xml_parser_get_option( $this->parser, $option->value );
	}

	public function setOption( Option $option, string|int|bool $value ): bool {
		return \xml_parser_set_option( $this->parser, $option->value, $value );
	}

	/**
	 * A method wrapping around `xml_set_character_data_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 */
	public function setCharacterDataHandler( callable|null $handler ): true {
		return \xml_set_character_data_handler( $this->parser, $handler );
	}

	/**
	 * A method wrapping around `xml_set_default_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 */
	public function setDefaultHandler( callable|null $handler ): true {
		return \xml_set_default_handler( $this->parser, $handler );
	}

	/**
	 * A method wrapping around `xml_set_element_handler()`.
	 *
	 * @param (callable(string): void)|null $startHandler
	 * @param (callable(string): void)|null $endHandler
	 */
	public function setElementHandler( callable|null $startHandler, callable|null $endHandler ): true {
		return \xml_set_element_handler( $this->parser, $startHandler, $endHandler );
	}

	/**
	 * A method wrapping around `xml_set_end_namespace_decl_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 */
	public function setEndNamespaceDeclhandler( callable|null $handler ): true {
		return \xml_set_end_namespace_decl_handler( $this->parser, $handler );
	}

	/**
	 * A method wrapping around `xml_set_notation_decl_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 */
	public function setNotationDeclHandler( callable|null $handler ): true {
		return \xml_set_notation_decl_handler( $this->parser, $handler );
	}

	/**
	 * A method wrapping around `xml_set_processing_instruction_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 */
	public function setProcessingInstructionHandler( callable|null $handler ): true {
		return \xml_set_processing_instruction_handler( $this->parser, $handler );
	}

	/**
	 * A method wrapping around `xml_set_start_namespace_decl_handler()`.
	 *
	 * @param (callable(XmlDocumentParser, string): void)|null $handler
	 */
	public function setStartNamespaceDeclHandler( callable|null $handler ): true {
		return \xml_set_start_namespace_decl_handler( $this->parser, $handler );
	}

	/**
	 * A method wrapping around `xml_set_unparsed_entity_decl_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 */
	public function setUnparsedEntityDeclHandler( callable|null $handler ): true {
		return \xml_set_unparsed_entity_decl_handler( $this->parser, $handler );
	}
}
