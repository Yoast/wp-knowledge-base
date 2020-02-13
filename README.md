This is a fork of [WP Knowledge Base by ibericode](https://github.com/ibericode/wp-knowledge-base).

We've removed:

* The code highlighting.
* The breadcrumbs code (we use the Yoast SEO breadcrumbs).
* The keywords taxonomy (we don't use it).
* The rating code (we don't use it).
* The search functionality (we use Algolia).

We've changed:

* The slug to be `/help/`.
* The post type is now called `Help articles`.

WP Knowledge Base
=======

WordPress powered knowledge base for your products. Beautiful.

# Usage

This plugin provides you with a custom post type, some taxonomies and other useful tools for building a knowledge base of documentation articles.

### Functions & Shortcodes

```php
wpkb_article_list( array( 'category' => 'Getting Started', 'title' => 'Start here..' ) );
wpkb_table_of_contents( array( 'title' => 'In this article' ) );
wpkb_category_list();
```

### Settings

On top of that, it comes with some useful rewriting & settings.

- Use a custom page (incl. slug & title) as your overview (archive) page.
- Quickly hide certain articles from overview pages, for example to phase out deprecated articles.

# License

GPL v2
