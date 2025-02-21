# php-xml

[![License][license-badge]][license-url]
[![Docs][docs-badge]][docs-url]
[![CI][ci-badge]][ci-url]
[![Codecov][codecov-badge]][codecov-url]

[license-badge]: https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square
[license-url]: #license
[docs-badge]: https://img.shields.io/github/deployments/php-lights/php-xml/github-pages?label=docs&style=flat-square
[docs-url]: https://php-lights.github.io/php-xml/
[ci-badge]: https://img.shields.io/github/actions/workflow/status/php-lights/php-xml/.github/workflows/php.yml?style=flat-square
[ci-url]: https://github.com/php-lights/php-xml/actions/workflows/php.yml
[codecov-badge]: https://img.shields.io/codecov/c/github/php-lights/php-xml?style=flat-square
[codecov-url]: https://app.codecov.io/gh/php-lights/php-xml

A PHP library that provides a nicer, lightweight wrapper around PHP's native XML API.

## Install
```sh
composer install neoncitylights/xml
```

### Requirements
- PHP 8.3+
- [libxml](https://www.php.net/manual/en/book.libxml.php) (enabled by default in PHP)

## Usage

```php
<?php
use Neoncitylights\Xml\Encoding;
use Neoncitylights\Xml\XmlNativeParser;

// create a parser normally, or with an XML namespace
$parser = XmlNativeParser::new(Encoding::Utf8);
$parserNs = XmlNativeParser::newWithNamespace(Encoding::Utf8, ':');

// parse XML
$xmlFileStream = \fopen('example.xml');
while (($data = \fread($xmlFileStream, 16384))) {
    $parser->parse($data); // parse the current chunk
}
$parser->parseFinalize();
\fclose($xmlFileStream);
```

### API Reference
- `Neoncitylights\Xml\Encoding` - A string enum of the possible XML text encodings.
- `Neoncitylights\Xml\ErrorCode` - An integer enum of the possible XML error codes, backed by core constants.
- `Neoncitylights\Xml\Option` - An integer enum of the possible XML options that can be get or set, backed by core constants.
- `Neoncitylights\Xml\XmlNativeParser` - A class that wraps around the native `XmlParser` class and built-in XML parsing functions.
- `Neoncitylights\Xml\XmlParseResult` - A class that represents the values passed-by-reference from the `xml_parse_into_struct()` function.

## License
This software is licensed under the MIT license ([`LICENSE`](./LICENSE) or <http://opensource.org/licenses/MIT>).

### Contribution
Unless you explicitly state otherwise, any contribution intentionally submitted for inclusion in the work by you, as defined in the MIT license, shall be licensed as above, without any additional terms or conditions.
