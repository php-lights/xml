<?php

namespace Neoncitylights\Xml;

use XMLParser;

/**
 * A lightweight wrapper around PHP's native XML API.
 */
class XmlNativeParser {
	public readonly XMLParser $parser;

	private function __construct( XMLParser $parser ) {
		$this->parser = $parser;
	}

	/**
	 * Create a new `XmlNativeParser` instance, which may use a specific text encoding.
	 */
	public static function new( ?Encoding $encoding = null ): self {
		return new XmlNativeParser( \xml_parser_create(
			( $encoding === null )
				? null
				: $encoding->value
		) );
	}

	/**
	 * Create a new `XmlNativeParser` instance that supports XML namespaces,
	 * which may use a specific text encoding and a separator.
	 */
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

	/**
	 * Gets the parser's current byte index in its data buffer.
	 *
	 * Internally calls `xml_get_current_byte_index()`.
	 */
	public function getCurrentByteIndex(): int {
		return \xml_get_current_byte_index( $this->parser );
	}

	/**
	 * Gets the parser's current column number in its data buffer.
	 *
	 * Internally calls `xml_get_current_column_number()`.
	 */
	public function getCurrentColumn(): int {
		return \xml_get_current_column_number( $this->parser );
	}

	/**
	 * Gets the parser's current line number in its data buffer.
	 *
	 * Internally calls `xml_get_current_line_number()`.
	 */
	public function getCurrentLine(): int {
		return \xml_get_current_line_number( $this->parser );
	}

	/**
	 * Gets the error code for the last error that occurred.
	 *
	 * Internally calls `xml_get_error_code()`.
	 */
	public function getErrorCode(): ErrorCode {
		return ErrorCode::from( \xml_get_error_code( $this->parser ) );
	}

	/**
	 * Parses an XML document.
	 *
	 * Internally calls `xml_parse()`.
	 *
	 * @param string $data The XML data to parse.
	 * @param bool $isFinal Whether this data is the last piece of the document.
	 * @return int Returns 1 on success, 0 on failure.
	 */
	public function parse( string $data, bool $isFinal = false ): int {
		return \xml_parse( $this->parser, $data, $isFinal );
	}

	/**
	 * Finalizes the parsing of an XML document.
	 *
	 * Internally calls `xml_parse()`.
	 *
	 * @return int Returns 1 on success, 0 on failure.
	 */
	public function parseFinalize(): int {
		return \xml_parse( $this->parser, '', true );
	}

	/**
	 * Parses an XML document into a typed `XmlParseResult` instance.
	 * If the parsing failed, it will return `false`.
	 *
	 * Internally calls `xml_parse_into_struct()`.
	 */
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

	/**
	 * Retrieve a parser option.
	 *
	 * Internally calls `xml_parser_get_option`.
	 */
	public function getOption( Option $option ): string|int|bool {
		return \xml_parser_get_option( $this->parser, $option->value );
	}

	/**
	 * Retrieve the parser option value of
	 * `XML_OPTION_CASE_FOLDING`.
	 */
	public function getCaseFolding(): bool {
		return $this->getOption( Option::CaseFolding );
	}

	/**
	 * Retrieve the parser option value of
	 * `XML_OPTION_SKIP_TAGSTART`.
	 */
	public function getSkipTagStart(): int {
		return $this->getOption( Option::SkipTagStart );
	}

	/**
	 * Retrieve the parser option value of
	 * `XML_OPTION_SKIP_WHITE`.
	 */
	public function getSkipWsp(): bool {
		return $this->getOption( Option::SkipWsp );
	}

	/**
	 * Retrieve the parser option value of
	 * `XML_OPTION_TARGET_ENCODING`.
	 */
	public function getTargetEncoding(): Encoding {
		return Encoding::from( $this->getOption( Option::TargetEncoding ) );
	}

	/**
	 * Sets a parser option.
	 *
	 * Internally calls `xml_parser_set_option()`.
	 *
	 * @return bool Returns a boolean for whether or not
	 * setting the option was a success.
	 */
	public function setOption( Option $option, string|int|bool $value ): bool {
		return \xml_parser_set_option( $this->parser, $option->value, $value );
	}

	/**
	 * Sets the parser option of `XML_OPTION_CASE_FOLDING`.
	 *
	 * @return bool Returns a boolean for whether or not
	 * setting the option was a success.
	 */
	public function setCaseFolding( bool $value ): bool {
		return $this->setOption( Option::CaseFolding, $value );
	}

	/**
	 * Sets the parser option of `XML_OPTION_SKIP_TAGSTART`.
	 *
	 * @return bool Returns a boolean for whether or not
	 * setting the option was a success.
	 */
	public function setSkipTagStart( int $value ): bool {
		return $this->setOption( Option::SkipTagStart, $value );
	}

	/**
	 * Sets the parser option of `XML_OPTION_SKIP_WHITE`.
	 *
	 * @return bool Returns a boolean for whether or not
	 * setting the option was a success.
	 */
	public function setSkipWsp( bool $value ): bool {
		return $this->setOption( Option::SkipWsp, $value );
	}

	/**
	 * Sets the parser option of `XML_OPTION_TARGET_ENCODING`.
	 *
	 * @return bool Returns a boolean for whether or not
	 * setting the option was a success.
	 */
	public function setTargetEncoding( Encoding $encoding ): bool {
		return $this->setOption( Option::TargetEncoding, $encoding->value );
	}

	/**
	 * Calls a user-defined function when the parser
	 * encounters a character data node.
	 *
	 * Internally calls `xml_set_character_data_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 * @return true Always returns true
	 */
	public function onCharacterData( callable|null $handler ): true {
		return \xml_set_character_data_handler( $this->parser, $handler );
	}

	/**
	 * Calls a user-defined function that runs by default
	 * in the event-driven parser.
	 *
	 * Internally calls `xml_set_default_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 * @return true Always returns true
	 */
	public function onDefault( callable|null $handler ): true {
		return \xml_set_default_handler( $this->parser, $handler );
	}

	/**
	 * Calls a function that will run when the parser
	 * encounters an XML element.
	 *
	 * Internally calls `xml_set_element_handler()`.
	 *
	 * @param (callable(string): void)|null $startHandler
	 * @param (callable(string): void)|null $endHandler
	 * @return true Always returns true
	 */
	public function onElement( callable|null $startHandler, callable|null $endHandler ): true {
		return \xml_set_element_handler( $this->parser, $startHandler, $endHandler );
	}

	/**
	 * Calls a user-defined function when the parser
	 * encounters the end of a namespace declaration.
	 *
	 * Internally calls `xml_set_end_namespace_decl_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 * @return true Always returns true
	 */
	public function onEndNamespaceDecl( callable|null $handler ): true {
		return \xml_set_end_namespace_decl_handler( $this->parser, $handler );
	}

	/**
	 * Calls a user-defined function when the parser
	 * encounters an external entity reference.
	 *
	 * Internally calls `xml_set_external_entity_ref_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 * @return true Always returns true
	 */
	public function onExternalEntityRef( callable|null $handler ): true {
		return \xml_set_external_entity_ref_handler( $this->parser, $handler );
	}

	/**
	 * Calls a user-defined function when the parser
	 * encounters a notation declaration.
	 *
	 * Internally calls `xml_set_notation_decl_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 * @return true Always returns true
	 */
	public function onNotationDecl( callable|null $handler ): true {
		return \xml_set_notation_decl_handler( $this->parser, $handler );
	}

	/**
	 * Calls a user-defined function when the parser
	 * encounters a processing instruction.
	 *
	 * Internally calls `xml_set_processing_instruction_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 * @return true Always returns true
	 */
	public function onProcessingInstruction( callable|null $handler ): true {
		return \xml_set_processing_instruction_handler( $this->parser, $handler );
	}

	/**
	 * Calls a user-defined function when the parser
	 * encounters the start of a namespace declaration.
	 *
	 * Internally calls `xml_set_start_namespace_decl_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 * @return true Always returns true
	 */
	public function onStartNamespaceDecl( callable|null $handler ): true {
		return \xml_set_start_namespace_decl_handler( $this->parser, $handler );
	}

	/**
	 * Calls a user-defined function when the parser
	 * encounters an unparsed entity declaration.
	 *
	 * Internally calls `xml_set_unparsed_entity_decl_handler()`.
	 *
	 * @param (callable(string): void)|null $handler
	 * @return true Always returns true
	 */
	public function onUnparsedEntityDecl( callable|null $handler ): true {
		return \xml_set_unparsed_entity_decl_handler( $this->parser, $handler );
	}
}
