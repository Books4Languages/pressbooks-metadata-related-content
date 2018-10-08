# Site Meta

Simple Metadata Education offer fields where extra information can be attached to the site or pots. Simple Metadata Education offer two metaboxes. Educational Metadata, where are the lkdsjfsñljfsñljflsñkdjf fields and Classification Metadata.

## Educational Metadata

The related properties from the [Creative Work](https://schema.org/CreativeWork "https://schema.org/CreativeWork") type that matters to the project are:

| ID  | From                   | Property             | Description                                                                                                                 |
| --- | ---------------------- | -------------------- | --------------------------------------------------------------------------------------------------------------------------- |
| E2  | Learning Resource Type | learningResourceType | Specific kind of learning object. The most dominant kind shall be first.                                                    |
| E13 | Educational Use        | educationalUse       |	The purpose of a work in the context of education.                                                                          |
| E5  | Intended End User Role | intendedEndUserRole  | Principal user(s) for which this learning object was designed.                                                              |
| E7  | Age Range              | typicalAgeRange      | Age of the typical intended user.                                                                                           |
| E1  | Interactivity Type     | interactivityType    | Predominant mode of learning supported by this learning object.                                                             |
| E3  | Interactivity Level    | interactivityLevel   | The degree of interactivity characterizing this learning object.                                                            |
| E8  | Difficulty             | difficulty           | How hard it is to work with or through this learning object for the typical intended target audience.                       |
| E9  | Class Learning Time    | typicalLearningTime  | Approximate or typical time it takes to work with or through this learning object for the typical intended target audience. |
| E10 | Description            | Description          | Comments on how this learning object is to be used. (soon as annotation plugin)                                             |
| E11 | Language               | translationOfWork    | Original language of the content.                                                                                           |

The related properties from the [Thing](https://schema.org/Thing "https://schema.org/Thing") type that matters to the project are:

| ID  | From    | Property | Description                  |
| --- | ------- | -------- | ---------------------------- |
| --- | --      | --       | --                           |

* If no Featured image in the Post, user avatar will be the Post image.

## Classification Metadata

The related properties from the [Creative Work](https://schema.org/CreativeWork "https://schema.org/CreativeWork") type that matters to the project are:
educationalAlignment = AlignmentObject

| ID       | From                                       |Property                      | Definitions                                                          |
| -------- | ------------------------------------------ | ---------------------------- | -------------------------------------------------------------------- |
| I1-0     | SME                                        | AlignmentObject              | ISCED level of education.                                            |
| I1-1     | SME                                        |  └alignmentType              | Alignment Type.                                                      |
| I1-2     | SME                                        |  └educationalFramework       | The curriculum name: ISCED-P                                         |
| I1-3     | SME                                        |  └targetDescription          | The description of the ISCED-P level.                                |
| I1-4     | ISCED level of education                   |  └targetName                 | Level of education according to ISCED-P 2011.--                      |
| I1-5     | SME                                        |  └targetUrl                  | The URL which extend information about the level.                    |
| I1-6     | SME                                        |  └alternateName *            | An alias for the level.                                              |
| I2-0     | SME                                        | AlignmentObject              | Educational objective                                                |
| I2-1     | SME                                        |  └alignmentType              | Alignment Type.                                                      |
| I2-2     | Educational Framework                      |  └educationalFramework       | The curriculum name.                                                 |
| I2-3     | Educational Objective description          |  └targetDescription          | The description of the Subject.                                      |
| I2-4     | Educational Objective name                 |  └targetName                 | The name of the Subject.                                             |
| I2-5     | Educational Objective URL                  |  └targetUrl                  | The URL which extended information about the Subject.                |
| I3-0     | SME                                        | AlignmentObject              | Detailed Educational Subject                                         |
| I3-1     | SME                                        |  └alignmentType              | Alignment Type.                                                      |
| I3-2     | Educational Framework                      |  └educationalFramework       | The curriculum name.                                                 |
| I3-3     | Detailed Educational Objective description |  └targetDescription          | The description of the Subject.                                      |
| I3-4     | Detailed Educational Objective name        |  └targetName                 | The name of the Subject.                                             |
| I3-4     | Detailed Educational Objective name        |  └targetName                 | The name of the Subject.                                             |
| I3-4     | Detailed Educational Objective name        |  └targetName                 | The name of the Subject.                                             |
| I3-4     | Detailed Educational Objective name        |  └targetName                 | The name of the Subject.                                             |
| I3-5     | Detailed Educational Objective URL         |  └targetUrl                  | The URL which extended information about the Subject.                |
| I4-0     | SME                                        | AlignmentObject              | Educational level                                                    |
| I4-1     | SME                                        |  └alignmentType              | Alignment Type.                                                      |
| I4-2     | Educational Framework                      |  └educationalFramework       | The curriculum name.                                                 |
| I4-3     | Educational Level description              |  └targetDescription          | The description of the level.                                        |
| I4-4     | Educational level name                     |  └targetName                 | The name of the level.                                               |
| I4-5     | Educational Level URL                      |  └targetUrl                  | The URL which extend information about the level.                    |
| I4-6     | Educational Level other name               |  └alternateName *            | An alias for the level.                                              |
| I4-7     | Educational level image                    |  └image *                    | An image of the level. This can be a URL                             |
| I5-0     | SME                                        | AlignmentObject              | The name of the teach resource in the topic.                         |
| I5-1     | SME                                        |  └alignmentType              | Alignment Type.                                                      |
| I5-2     | Educational Framework                      |  └educationalFramework       | The curriculum name.                                                 |
| I5-3     | Teaches description                        |  └targetDescription          | The description of the Lesson or Subject.                            |
| I5-4     | Teaches name                               |  └targetName                 | The name of the lesson or Subject.                                   |
| I5-5     | Teaches URL                                |  └targetUrl                  | The URL of the lesson or Subject.                                    |
| I6-0     | SME                                        | AlignmentObject              | Required resource before to start the topic.                         |
| I6-1     | SME                                        |  └alignmentType              | Alignment Type.                                                      |
| I6-2     | Educational Framework                      |  └educationalFramework       | The curriculum name.                                                 |
| I6-3     | Requirement description                    |  └targetDescription          | The description of the Lesson, Subject or Course.                    |
| I6-4     | Requirement name                           |  └targetName                 | The name of the Lesson, Subject or Course.                           |
| I6-5     | Requirement URL                            |  └targetUrl                  | The URL of the Lesson, Subject or Course.                            |
| I7-0     | SME                                        | AlignmentObject              | Evaluated resource in our task/activity/exercise.                    |
| I7-1     | SME                                        |  └alignmentType              | Alignment Type                                                       |
| I7-2     | Educational Framework                      |  └educationalFramework       | The curriculum name.                                                 |
| I7-3     | Assesses description                       |  └targetDescription          | The description of the Lesson, Subject or Course.                    |
| I7-4     | Assesses name                              |  └targetName                 | The name of the evaluated Lesson, Subject or Course.                 |
| I7-5     | Assesses URL                               |  └targetUrl                  | The URL of the evaluated Lesson, Subject or Course.                  |
| I7-6     | --                                         |  └ --                        | --                                                                   |

Teaches should be automatic - Requires and Assesses should be automatic by writing an URL in the language option.

The related properties from the [Thing](https://schema.org/Thing "https://schema.org/Thing") type that matters to the project are:

| ID  | From    | Property | Description                  |
| --- | ------- | -------- | ---------------------------- |
| A30 | WP-Core | image    | Featured image of the Post*  |

* If no Featured image in the Post, user avatar will be the Post image.

# Screenshots
Settings site
![settings-post](/doc/images/conf-tools-site_meta.png)

Structured data
![structured-data-post](/doc/images/structured-data-site.png)

---

[Readme](//Readme.md)
