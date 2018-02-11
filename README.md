# frontmatter

[![Packagist Version](https://img.shields.io/packagist/v/hkod/frontmatter.svg?style=flat-square)](https://packagist.org/packages/hkod/frontmatter)
[![Build Status](https://img.shields.io/travis/hanneskod/frontmatter/master.svg?style=flat-square)](https://travis-ci.org/hanneskod/frontmatter)

A context aware frontmatter parser that supports multiple formats and uses a clean
OOP architecture.

Supported formats:

* Json
* INI
* YAML (`require symfony/yaml`)
* Markdown (`require erusev/parsedown`)
* Mustache (`require mustache/mustache`)

Parsers are simple callables, super easy to add more formats.

## Installation

```shell
composer require hkod/frontmatter:^1
```

## Usage

A standard parser with yaml frontmatter and markdown body:

<!-- @expectOutput /value/ -->
<!-- @expectOutput /template/ -->
<!-- @expectOutput /strong/ -->
```php

$parser = new \hkod\frontmatter\Parser(
    new \hkod\frontmatter\YamlParser,
    new \hkod\frontmatter\MarkdownParser
);

$result = $parser->parse("---
key: value
---
This is a **template**
");

// value
echo $result->getFrontmatter()['key'];

// <p>This is a <strong>template</strong></p>
echo $result->getBody();
```

### Putting the frontmatter last

*Frontmatter* also supports an inverted block parser, where the frontmatter is
expected to bee last instead of first.

<!-- @expectOutput "This is the frontmatter" -->
```php

$parser = new \hkod\frontmatter\Parser(
    new \hkod\frontmatter\VoidParser,
    new \hkod\frontmatter\VoidParser,
    new \hkod\frontmatter\InvertedBlockParser
);

$result = $parser->parse("
This is a the body
---
This is the frontmatter
---
");

// "This is the frontmatter"
echo $result->getFrontmatter();
```

### Creating complex parsers

<!-- @expectOutput /value/ -->
<!-- @expectOutput /markdown/ -->
<!-- @expectOutput /strong/ -->
```php

$parser = (new \hkod\frontmatter\ParserBuilder)
    ->addFrontmatterPass(new \hkod\frontmatter\MustacheParser)
    ->addFrontmatterPass(new \hkod\frontmatter\YamlParser)
    ->addBodyPass(new \hkod\frontmatter\MustacheParser)
    ->addBodyPass(new \hkod\frontmatter\MarkdownParser)
    ->setBlockParser(new \hkod\frontmatter\BlockParser('***', '***'))
    ->buildParser();

$document = "***
key: {{variable}}
***
This is a **{{text}}** template
";

$context = ['variable' => 'value', 'text' => 'markdown'];

$result = $parser->parse($document, $context);

// value
echo $result->getFrontmatter()['key'];

// <p>This is a <strong>markdown</strong> template</p>
echo $result->getBody();
```
