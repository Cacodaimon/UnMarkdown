# UnMarkdown

A simple PHP library to convert Markdown back to plain text.

The purpose of this lib is to convert markdown to plain text for e.g. chat notifications….
 * Does not loose the whole text structure as it would happen with the following call `strip_tags(Parsedown::instance()->text('…'))`
 * It is more performant than using a full featured markdown parser with AST support.
 * Decorate some content with prefixes e.g.
   * 🔗 for links
   * 💬 for comments 
   * • for unordered list items.
 * 🏍️ Uses only regular expression for text transformation.
 * Provides a good level (Not 100% 🤷‍♂️) of compliance with [GitHub Flavored Markdown Spec](https://github.github.com/gfm/)
 * Testdriven with over 65 unit tests 💪 and more than 370 assertions.

## Usage

```php
$markdownRemover = new MarkdownRemover();
echo $markdownRemover->strip('Hello **World**');
```

Would produce `Hello World`.

You can change the prefixes easily when constructing an instance.

```php
$markdownRemover = new MarkdownRemover('"Link prefix" ', '"Image prefix️" ', '"Comment prefix" ', '… ');
echo $markdownRemover->strip('Wow look at this link [example.com](https://example.com/) isn't it **awesome**?');
```

Would produce `Wow look at this link example.com "Link prefix" https://example.com/ isn't it awesome?`.

You can change specific rules, remove or replace them easily.

```php
$classUnderTest = new MarkdownRemover();
$classUnderTest
    ->getReplacements()[8]
    ->setReplace(function ($matches) {
        return ReEmphasis::toBold($matches[2]);
    });
$classUnderTest
    ->getReplacements()[9]
    ->setReplace(function ($matches) {
        return ReEmphasis::toItalic($matches[2]);
    });
$classUnderTest
    ->getReplacements()[16]
    ->setReplace(function ($matches) {
        return ReEmphasis::toMonospaced($matches[1]);
    });
echo $classUnderTest->strip('**Test** *italic* `replacement`');
```

Would produce `𝗧𝗲𝘀𝘁 𝘪𝘵𝘢𝘭𝘪𝘤 𝚛𝚎𝚙𝚕𝚊𝚌𝚎𝚖𝚎𝚗𝚝`;

## Transformation example

The following Markdown:

```markdown
# Headings
Heading with `#` or as setext are supported.

Alt-H1 (Setext)
======

Alt-H2 (Setext)
------

## Emphasis, Strong emphasis & Strikethrough
Emphasis, aka italics, with *asterisks* or _underscores_.
Strong emphasis, aka bold, with **asterisks** or __underscores__.
Combined emphasis with **asterisks and _underscores_**.
Strikethrough uses two tildes. ~~Scratch this.~~

### Lists
1. Ordered lists gets
2. passed as they are
  4. As you can see the numbering 
  5. is not correct


* Unordered 
+ lists
- gets  
  + converted
  - to the bullet UTF-8 char 



- [ ] Task
- [x] List
- [ ] are
- [X] supported!

#### Links and images
[I'm an inline-style link](https://www.google.com)
[I'm an inline-style link with title](https://www.google.com "Google's Homepage")
[I'm a reference-style link][Arbitrary case-insensitive reference text]
[I'm a relative reference to a repository file](../blob/master/LICENSE)
[You can use numbers for reference-style link definitions][1]
![alt text](https://github.com/adam-p/markdown-here/raw/master/src/common/images/icon48.png "Logo Title Text 1")
![alt text][logo]

##### Code
Inline `code` and block code is supported, too.

\`\`\`no-highlight
This is a code block, **MD** is ~~not~~ *interpreted*.
\`\`\`

###### Blockquotes
> Blockquotes are very handy in **email** to emulate reply text.
>> This line is part of the same quote.

###### Escaping
You can use the \\ character to escape MD. So you can escape the asterisk in strong e.g. \\\* to archive this \*\*Not strong\*\*. 

###### Thematic breaks aka <hr>
All hr gets stripped, you should not see any chars below this line:

---

***

___



[arbitrary case-insensitive reference text]: https://www.mozilla.org
[1]: http://slashdot.org
[logo]: https://github.com/adam-p/markdown-here/raw/master/src/common/images/icon48.png "Logo Title Text 2"
```

Will be converted to this plain text:

```plaintext
Headings

Heading with # or as setext are supported.
Alt-H1 (Setext)

Alt-H2 (Setext)
Emphasis, Strong emphasis & Strikethrough

Emphasis, aka italics, with asterisks or underscores.
Strong emphasis, aka bold, with asterisks or underscores.
Combined emphasis with asterisks and underscores.
Strikethrough uses two tildes. Scratch this.
Lists

1. Ordered lists gets
2. passed as they are
  4. As you can see the numbering 
  5. is not correct

• Unordered 
• lists
• gets  
  • converted
  • to the bullet UTF-8 char 

• ⭕ Task
• ❌ List
• ⭕ are
• ❌ supported!
Links and images

I'm an inline-style link 🔗 https://www.google.com
I'm an inline-style link with title 🔗 https://www.google.com "Google's Homepage"
I'm a reference-style link 🔗 https://www.mozilla.org
I'm a relative reference to a repository file 🔗 ../blob/master/LICENSE
You can use numbers for reference-style link definitions 🔗 http://slashdot.org
🖼️ alt text
🖼️ alt text
Code

Inline code and block code is supported, too.

This is a code block, **MD** is ~~not~~ *interpreted*.

Blockquotes
💬 Blockquotes are very handy in email to emulate reply text.
💬 This line is part of the same quote.
Escaping

You can use the \ character to escape MD. So you can escape the asterisk in strong e.g. \* to archive this **Not strong**. 
Thematic breaks aka <hr>

All hr gets stripped, you should not see any chars below this line:


```
