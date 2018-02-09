# frontmatter

A context aware frontmatter parser that supports multiple formats.

* Json
* YAML (`require symfony/yaml`)
* Markdown (`require erusev/parsedown`)
* Mustache (`require mustache/mustache`)

Parser are simple callables, super easy to add more formats.

A standard parser with yaml frontmatter and markdown body.

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

Includes interface for creating complex parsers.

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
