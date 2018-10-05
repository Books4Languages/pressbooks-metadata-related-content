# Page metadata
Simple Metadata will create Page Type options in Page (metabox).

## Settings
Page type have 13 options which allow the configuration of the metadata. Pick the one that describes better the Page:
* WebPage *Activated by default*
  * AboutPage
  * CheckoutPage
  * CollectionPage
    * ImageGallery
    * VideoGallery
  * ContactPage
  * FAQPage
  * ItemPage
  * MedicalWebPage
  * ProfilePage
  * QAPage
  * SearchResultsPage

## Page types and properties

### WebPage

Properties from: [WebPage](https://schema.org/Article "https://schema.org/WebPage")
The related properties from the type that matters to the project.

| ID  | From    | Property           | Description                                                                                               |
| --- | ------- | ------------------ |---------------------------------------------------------------------------------------------------------- |
| A19 | WP-Core | lastReviewed       | Date on which the content on this web page was last reviewed for accuracy and/or completeness.            |
| A20 | WP-Core | reviewebBy         | People or organizations that have reviewed the content on this web page for accuracy and/or completeness. |
| A28 | WP-Core | primaryImageOfPage | Indicates the main image on the page.                                                                     |


primaryImageOfPage

#### AboutPage

[AboutPage](https://schema.org/AboutPage "https://schema.org/AboutPage") type uses the related properties from the WebPage type.

#### CheckoutPage

[CheckoutPage](https://schema.org/CheckoutPage "https://schema.org/CheckoutPage") type uses the related properties from the WebPage type.

#### CollectionPage

[CollectionPage](https://schema.org/CollectionPage "https://schema.org/CollectionPage") type uses the related properties from the WebPage type.

#### ImageGallery

[ImageGallery](https://schema.org/ImageGallery "https://schema.org/ImageGallery") type uses the related properties from the WebPage type.

#### VideoGallery

[VideoGallery](https://schema.org/VideoGallery "https://schema.org/VideoGallery") type uses the related properties from the WebPage type.

#### ContactPage

[ContactPage](https://schema.org/ContactPage "https://schema.org/ContactPage") type uses the related properties from the WebPage type.

#### FAQPage

[FAQPage](https://schema.org/FAQPage "https://schema.org/FAQPage") type uses the related properties from the WebPage type.

#### ItemPage

[ItemPage](https://schema.org/ItemPage "https://schema.org/ItemPage") type uses the related properties from the WebPage type.

#### MedicalWebPage

[MedicalWebPage](https://schema.org/MedicalWebPage "https://schema.org/MedicalWebPage") type uses the related properties from the WebPage type.

#### ProfilePage

[ProfilePage](https://schema.org/ProfilePage "https://schema.org/ProfilePage") type uses the related properties from the WebPage type.

#### QAPage

[QAPage](https://schema.org/QAPage "https://schema.org/QAPage") type uses the related properties from the WebPage type.

#### SearchResultsPage

[SearchResultsPage](https://schema.org/SearchResultsPage "https://schema.org/SearchResultsPage") type uses the related properties from the WebPage type.

### General Article properties

Properties from: [Creative Work](https://schema.org/CreativeWork "https://schema.org/CreativeWork")
The related properties from the type that matters to the project.

| ID  | From    | Property           | Description                             |
| --- | ------- | ------------------ | --------------------------------------- |
| A4  | WP-Core | headline           | Title of the Page.                      |
| A18 | WP-Core | publisher          | T--                                     |
| A22 | WP-Core | author             | The author of this Page.                |
| A23 | WP-Core | Author last editor | The last user that modify this Page.    |
| A24 | WP-Core | dateCreated        | The date on which the Page was created. |
| A25 | WP-Core | datePublished      |                                         |
| A26 | WP-Core | dateModified       | Date of first Page.                     |
| A29 | WP-Core | thumbnailUrl*      | A thumbnail image relevant to the Page. |
| --- | --      |                    |                                         |
| --  | WP-Core | editor             | The last user that modify this Page.    |
| A14 | Order   | --                 | position                                | -- xxxxxxxxxxxxx

*(if thumbnailUrl do not exist, gravatar administraor images is taken.)*

Properties from: [Thing](https://schema.org/Thing "https://schema.org/Thing")
The related properties from the type that matters to the project.

| ID | From    | Property | Description |
| -- | ------- | -------- | ----------- |
| -- | WP-Core | --       | --          |

image

# Screenshots

Simple Metadata will create Page Type options in Pages (metabox)

![settings post](/doc/images/settings-post.png)

![structured data page](/doc/images/structured-data-page.png)

---




[Readme](//Readme.md)