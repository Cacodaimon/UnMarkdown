# UnMarkdown

A simple PHP library to convert Markdown back to plain text.

The goal is to convert markdown to plain text for chat notifications….
 * Be more performant than using a full featured markdown parser with AST support.
 * Decorate some content with prefixes e.g.
   * 🔗 for links
   * 💬 for comments 
   * • for unordered list items.
 * Do not loose the whole text structure as it would happen with the following call `strip_tags(Parsedown::instance()->text('…'))`

## TODO

- [ ] Optional replace with unicode http://slothsoft.net/getResource.php/slothsoft/unicode-mapper
- [ ] Perform a global check (e.g. doc looks still "good")
- [x] Support of reference links
- [x] Be more precise when parsing "setext headings", e.g. [example 67](https://github.github.com/gfm/#example-67)
- [x] Better links without loosing link name
- [x] Support "Thematic breaks" with spaces  e.g. [example 17](https://github.github.com/gfm/#example-17), [example 21](https://github.github.com/gfm/#example-21), [example 22](https://github.github.com/gfm/#example-22), [example 24](https://github.github.com/gfm/#example-24) …
- [x] Fix "block" tests to be compliant with [GitHub Flavored Markdown Spec](https://github.github.com/gfm/#tables-extension-)
- [x] Support quoting: `\*\*foo\*\*` should become `**foo**` and not `\\foo\\`
- [x] Merge similar regex (e.g. strong with _ and strong with *) into single regex, should improve performance.
- [x] [Task list items](https://github.github.com/gfm/#task-list-items-extension-) support with ⭕ ️and ❌?
- [x] Do not touch content of code blocks
- [x] Convert to non capturing groups where possible .e.g. `([A-Z]+)` to `(?:[A-Z]+)`.
## Danger

This is currently a WIP do not use this library!

## Usage

```php
$markdownRemover = new MarkdownRemover();
echo $markdownRemover->strip('Hello **World**');
```

Would produce `Hello World`.


```php
$markdownRemover = new MarkdownRemover('"Link prefix" ', '"Image prefix️" ', '"Comment prefix" ', '… ');
echo $markdownRemover->strip('Wow look at this link [example.com](https://example.com/) isn't it **awesome**?');
```

Would produce `Wow look at this link "Link prefix" https://example.com/ isn't it awesome?`.
