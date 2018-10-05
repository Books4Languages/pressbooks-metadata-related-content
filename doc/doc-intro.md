# Simple Metadata Education

This is an extension of Simple Metadata plugin for the Wordpress CMS that can be used to extend the metadata on a website (single installation or multisite installation).

The aim of Simple Metadata Education is to accomplish a detailed description of the full schema educational metadata for a WordPress installation.

This plugin is unbranded! This means that we don’t even put the name “Simple Metadata Education” anywhere within the WordPress interface, aside from the plugin activation page.
This plugin makes great use of the default WordPress interface elements, like as if this plugin is part of WordPress. No ads, no nags.

Nobody has to know about the tools you’ve used to create your or someone else’s website. A clean interface, for everyone.

## About Simple Metadata for Google
A search engine for finding learning resources by searching LRMI-tagged web pages can be found here: [Google Search for AlignmentObject property](hhttps://cse.google.com/cse?cx=010657885947752667116:tlz9ob0l3s8). The custom search engine hosted by Google will offer just resources tagged with the LRMI AlignmentObject property.

Be sure to test your structured data using the [Structured Data Testing Tool](https://search.google.com/structured-data/testing-tool/u/0/) during development, and the [Search Console Structured Data report](https://www.google.com/webmasters/tools/structured-data?pli=1) after deployment, to monitor the health of your pages, which might break after deployment due to templating or serving issues.

## vocabularies

This is plugin extend Simple metadata plugin functionality with a detailed description of the schema metadata with educational vocabularies:
 * Educational metadata (LRMI) trough schema
 * Squema.org
 * Dublin Core
 * Google schoolar
 * Coins
 * LOM

This plugin is unbranded! This means that we don’t even put the name “Simple metadata education” anywhere within the WordPress interface, aside from the plugin activation page.
This plugin makes great use of the default WordPress interface elements, like as if this plugin is part of WordPress. No ads, no nags.

Nobody has to know about the tools you’ve used to create your or someone else’s website. A clean interface, for everyone.

### LRMI

The [LRMI](http://lrmi.dublincore.net/) has developed a common metadata framework for describing or ‘tagging’ learning resources on the web. This framework is a key first step in developing a richer, more fruitful search experience for educators and learners. The [Learning Resource Metadata](http://lrmi.dublincore.net/lrmi-1-1/) Initiative aimed to help people discover useful learning resources by adding to the schema.org ontology properties to describe educational characteristics of [CreativeWork](https://schema.org/CreativeWork).

More information:
* [https://blogs.pjjk.net/phil/projects/lrmi-metadata/](https://blogs.pjjk.net/phil/projects/lrmi-metadata/)

### Squema.org (under development)

Other important characteristics of learning resources that are covered from [Schema.org](http://schema.org/).

Schema.org represents two things: 1, an ontology for describing resources on the web, with a hierarchical set of resource types each with defined properties that relate to their characteristics and relationships with other things in the schema hierarchy; and 2, a syntax for embedding these into HTML pages–well. The inclusion of the LRMI properties means that you can use schema.org to mark up your descriptions of the resources characteristics as a creative work.

### Dublin Core  (under development)
[Dublin Core](http://dublincore.org/documents/2000/07/16/usageguide/)  is an initiative to create a digital "library card catalog" for the Web. Dublin Core is made up of 15 metadata (data that describes data) elements that offer expanded cataloging information and improved document indexing for search engine programs.

Two forms of Dublin Core exist: [Simple Dublin Core](http://dublincore.org/documents/dces/) and [Qualified Dublin Core](http://dublincore.org/documents/dcmi-terms/). Simple Dublin Core expresses elements as attribute-value pairs using just the 15 metadata elements from the Dublin Core Metadata Element Set. Qualified Dublin Core increases the specificity of metadata by adding information about encoding schemes, enumerated lists of values, or other processing clues. While enabling searches to be more specific, qualifiers are also more complex and can pose challenges to interoperability.

### Google schoolar (under development)
[Google Scholar](https://scholar.google.es/) is a search engine focused specifically on the discovery of scholarly literature as opposed to the broader google.com web search engine. Google Scholar provides search across many disciplines and sources: articles, theses, books, abstracts and court opinions, from academic publishers, professional societies, online repositories, universities and other web sites.

[Google schoolar overview](https://scholar.google.com/intl/en-US/scholar/inclusion.html#overview).

### Coins (under development)
COinS (ContextObjects in Spans) is as “a simple, ad hoc community specification for publishing OpenURL references in HTML.” A microformat developed particularly to embed citation information. This extends the types information we can provide to tools that focus more on scholarly needs.

For example, the citation manager [Zotero](http://www.zotero.org/) knows how to read COinS. So, when viewing one of our publications in a browser with Zotero installed, a folder icon will appear in the URL bar.

### LOM (under development)
Learning Object Metadata is a data model, usually encoded in XML, used to describe a learning object and similar digital resources used to support learning. The purpose of learning object metadata is to support the reusability of learning objects, to aid discoverability, and to facilitate their interoperability, usually in the context of online learning management systems (LMS).

### Other vocabularies (under development)
A [vocabulary](https://www.w3.org/standards/semanticweb/ontology) allows the markup of structured data in HTML documents.

On the Semantic Web, vocabularies define the concepts and relationships (also referred to as “terms”) used to describe and represent an area of concern. Vocabularies are used to classify the terms that can be used in a particular application, characterize possible relationships, and define possible constraints on using those terms. In practice, vocabularies can be very complex (with several thousands of terms) or very simple (describing one or two concepts only).

## Syntaxes

Syntaxes define attributes that get added to your existing HTML elements. You can mix them up as you like. (You could use both vocabularies with both syntaxes on the same page. You could use both vocabularies with only one syntax. You could use only one vocabulary with both syntaxes, or with only one syntax. …). It totally depends on your specific use case.

What do you want to achieve? If you are interested in a specific 3rd party parsing your content, you should check their documentation. They typically support only certain vocabularies with certain syntaxes.

But if you want to mark up your content with semantic metadata without having a specific use case in mind, you could stick to one syntax and use whichever vocabularies are appropriate for your content.

### Microdata

In the web context, [Microdata](https://html.spec.whatwg.org/multipage/microdata.html) is a WHATWG HTML specification for embedding semantically meaningful markup chiefly within the HTML body. Microdata isn’t the same thing as metadata, as microdata isn’t restricted to conveying only information about the creation of the text. Microdata becomes part of the web document itself and serves somewhat like an annotation within the HTML body text. Microdata tells machines something more about the meaning of the text.

Basically, microdata is an HTML specification that allows for the expression of other vocabularies, such as Schema.org, within a webpage.

By using Microdata, you are not directly playing part in the Semantic Web (and AFAIK Microdata doesn’t intend to), mostly because it’s not defined as RDF serialization (although there are ways to extract RDF from Microdata).

---
[Readme](/Readme.md)
