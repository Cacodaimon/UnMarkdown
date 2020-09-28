# UnMarkdown

A simple PHP library to convert Markdown back to plain text.

The goal is to convert markdown to plain text for chat notifications….
 * Without losing the text's structure.
 * Be more performant than using a full featured markdown parser with AST support.
 * Decorate some content with prefixes e.g.
   * 🔗 for links
   * 💬 for comments 
   * ⚫ for unordered list items.
 * Do not lose the whole text structure as it would happen with the following call `strip_tags(Parsedown::instance()->text('…'))`

## TODO

- [ ] Fix "block" tests to be compliant with [GitHub Flavored Markdown Spec](https://github.github.com/gfm/#tables-extension-)
- [ ] Support of reference links and images
- [ ] Support quoting: `\*\*foo\*\*` should become `**foo**` and not `\\foo\\`
- [x] Merge similar regex (e.g. strong with _ and strong with *) into single regex, should improve performance.
- [x] [Task list items](https://github.github.com/gfm/#task-list-items-extension-) support with ⭕ ️and ❌?
- [x] Do not touch content of code blocks
- [x] Convert to non capturing groups where possible .e.g. `([A-Z]+)` to `(?:[A-Z]+)`.
## Danger

This is currently a WIP do not use this library!

## Usage

```php
$stripper = new Stripper();
echo $stripper->strip('Hello **World**');
```

Would produce `Hello World`.


```php
$stripper = new Stripper('"Link prefix" ', '"Image prefix️" ', '"Comment prefix" ', '… ');
echo $stripper->strip('Wow look at this link [example.com](https://example.com/) isn't it **awesome**?');
```

Would produce `Wow look at this link "Link prefix" https://example.com/ isn't it awesome?`.
