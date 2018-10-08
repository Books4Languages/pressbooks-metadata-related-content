# Metadata Properties relationships

##  Educational

| Cod   | Key                    | LOM                  | LRMI                    | Schema.org                                                      | LOM                  | DC
| ----- | ---------------------- | -------------------- | ----------------------- | --------------------------------------------------------------- | -------------------- | -----------
| E1-0  | Interactivity Type     | interactivityType    | interactivityType       | [interactivityType](https://schema.org/interactivityType)       | interactivityType    | --
| E2-0  | Learning Resource Type | learningResourceType | learningResourceType    | [learningResourceType](https://schema.org/learningResourceType) | learningResourceType | DC.type
| E3-0  | Interactivity Level    | interactivityLevel   | --                      | --                                                              | interactivityLevel   | --
| E4-0  | Semantic Density (no)  | semanticDensity      | --                      | --                                                              | semanticDensity      | --
| E5-0  | Intended End User Role | intendedEndUserRole  | EducationalAudience (1) | [EducationalAudience](https://schema.org/EducationalAudience)   | intendedEndUserRole  | --
| E6-0  | Context (no)           | context              | ## Classification       | --                                                              | context              | --
| E7-0  | Typical Age Range      | typicalAgeRange      | typicalAgeRange         | [typicalAgeRange](https://schema.org/typicalAgeRange)           | typicalAgeRange      | --
| E8-0  | Difficulty             | difficulty           | --                      | --                                                              | difficulty           | --
| E9-0  | Typical Learning Time  | typicalLearningTime  | timeRequired            | [timeRequired](https://schema.org/timeRequired)                 | typicalLearningTime  | --
| E10-0 | Description            | description          | ## Annotation (soon)    | [backstory](https://schema.org/backstory) (2) - ## Annotation   | description          | --
| E11-0 | Original Language      | language             | --                      | [translationOfWork ](https://schema.org/translationOfWork)      | language             | --
| E12-0 | Cognitive Process (no) | cognitiveProcess (ES)| --                      | --                                                              | cognitiveProcess (ES)| --
| E13-0 | Educational Use        | --                   | educationalUse          | [educationalUse](https://schema.org/educationalUse)             | --                   | --
| E14-0 | About                  | --                   | --                      | [About](https://schema.org/About)                               | --                   | --                   

* 1 EducationalAudience
     └educationalRole
* 2 Article

## Classification
This category describes where this learning object falls within a particular classification system.

| Cod      | Key                                         | LOM                   | LRMI                 | Schema.org                                                      | DC
| -------- | ------------------------------------------- | --------------------- | -------------------- | --------------------------------------------------------------- | --------------
| I1-0     | ISCED level of education                    | educational level     | AlignmentObject      | [AlignmentObject](https://schema.org/AlignmentObject)           | --
| I1-1     |  Alignment Type                             | --                    | alignmentType        | [alignmentType](https://schema.org/alignmentType)               | --
| I1-2     |  ISCED Educational Framework                | --                    | educationalFramework | [educationalFramework](https://schema.org/educationalFramework) | --
| I1-3     |  ISCED level of education Description       | --                    | targetDescription    | [etargetDescription](https://schema.org/etargetDescription)     | --
| I1-4     |  ISCED level of education                   | --                    | targetName           | [targetName](https://schema.org/targetName)                     | --
| I1-5     |  ISCED URL                                  | --                    | targetUrl            | [targetUrl](https://schema.org/targetUrl)                       | --
| I1-6     |  ISCED Level alias name                     | --                    | alternateName        | [alternateName](https://schema.org/alternateName)               | --
| I2-0     | Educational Subject                         | educational objective | AlignmentObject      | [AlignmentObject](https://schema.org/AlignmentObject)           | --
| I2-1     |  Alignment Type                             | --                    | alignmentType        | [alignmentType](https://schema.org/alignmentType)               | --
| I2-2     |  Educational Framework                      | --                    | educationalFramework | [educationalFramework](https://schema.org/educationalFramework) | --
| I2-3     |  Educational Objective description          | --                    | targetDescription    | [etargetDescription](https://schema.org/etargetDescription)     | --
| I2-4     |  Educational Objective name                 | --                    | targetName           | [targetName](https://schema.org/targetName)                     | --
| I2-5     |  Educational Objective URL                  | --                    | targetUrl            | [targetUrl](https://schema.org/targetUrl)                       | --
| I3-0     | Detailed Educational Subject                | educational objective | AlignmentObject      | [AlignmentObject](https://schema.org/AlignmentObject)           | --
| I3-1     |  Alignment Type                             | --                    | alignmentType        | [alignmentType](https://schema.org/alignmentType)               | --
| I3-2     |  Educational Framework                      | --                    | educationalFramework | [educationalFramework](https://schema.org/educationalFramework) | --
| I3-3     |  Detailed Educational Objective description | --                    | targetDescription    | [educationalFramework](https://schema.org/etargetDescription)   | --
| I3-4     |  Detailed Educational Objective name        | --                    | targetName           | [targetName](https://schema.org/targetName)                     | --
| I3-5     |  Detailed Educational Objective URL         | --                    | targetUrl            | [targetUrl](https://schema.org/targetUrl)                       | --
| I4-0     | Educational Level                           | educational level     | AlignmentObject      | [AlignmentObject](https://schema.org/AlignmentObject)           | --
| I4-1     |  Alignment Type                             | --                    | alignmentType        | [alignmentType](https://schema.org/alignmentType)               | --
| I4-2     |  Educational Framework                      | --                    | educationalFramework | [educationalFramework](https://schema.org/educationalFramework) | --
| I4-3     |  Educational Level description              | --                    | targetDescription    | [etargetDescription](https://schema.org/etargetDescription)     | --
| I4-4     |  Educational level name                     | --                    | targetName           | [targetName](https://schema.org/targetName)                     | --
| I4-5     |  Educational Level URL                      | --                    | targetUrl            | [targetUrl](https://schema.org/targetUrl)                       | --
| I4-6     |  Educational Level other name               | --                    | alternateName        | [alternateName](https://schema.org/alternateName)               | --
| I4-7     |  Educational level image                    | --                    | image                | [image](https://schema.org/image)                               | --
| I5-0     | Teaches                                     | --                    | AlignmentObject      | [AlignmentObject](https://schema.org/AlignmentObject)           | --
| I5-1     |  Alignment Type                             | --                    | alignmentType        | [alignmentType](https://schema.org/alignmentType)               | --
| I5-2     |  Educational Framework                      | --                    | educationalFramework | [educationalFramework](https://schema.org/educationalFramework) | --
| I5-3     |  Current resource description               | --                    | targetDescription    | [etargetDescription](https://schema.org/etargetDescription)     | --
| I5-4     |  Current resource name                      | --                    | targetName           | [targetName](https://schema.org/targetName)                     | --
| I5-5     |  Current resource URL                       | --                    | targetUrl            | [targetUrl](https://schema.org/targetUrl)                       | --
| I6-0     | Requires                                    | prerequisite          | alignmentType        | [AlignmentObject](https://schema.org/AlignmentObject)           | --
| I6-1     |  Alignment Type                             | --                    | alignmentType        | [alignmentType](https://schema.org/alignmentType)               | --
| I6-2     |  Educational Framework                      | --                    | educationalFramework | [educationalFramework](https://schema.org/educationalFramework) | --
| I6-3     |  Required resource description              | --                    | targetDescription    | [etargetDescription](https://schema.org/etargetDescription)     | --
| I6-4     |  Required resource name                     | --                    | targetName           | [targetName](https://schema.org/targetName)                     | --
| I6-5     |  Required resource URL                      | --                    | targetUrl            | [targetUrl](https://schema.org/targetUrl)                       | --
| I7-0     | Assesses                                    |                       | AlignmentObject      | [AlignmentObject](https://schema.org/AlignmentObject)           | --
| I7-1     |  Alignment Type                             | --                    | alignmentType        | [alignmentType](https://schema.org/alignmentType)               | --
| I7-2     |  Educational Framework                      | --                    | educationalFramework | [educationalFramework](https://schema.org/educationalFramework) | --
| I7-3     |  Evaluated resource description             | --                    | targetDescription    | [etargetDescription](https://schema.org/etargetDescription)     | --
| I7-4     |  Evaluated resource name                    | --                    | targetName           | [targetName](https://schema.org/targetName)                     | --
| I7-5     |  Evaluated resource URL                     | --                    | targetUrl            | [targetUrl](https://schema.org/targetUrl)                       | --
| I8-0     | Text Complexity                             | --                    | alignmentType        | [AlignmentObject](https://schema.org/AlignmentObject)           | --
| I8-1     |  Alignment Type                             | --                    | alignmentType        | [alignmentType](https://schema.org/alignmentType)               | --
| I8-2     |  Educational Framework                      | --                    | educationalFramework | [educationalFramework](https://schema.org/educationalFramework) | --
| I8-3     |  Required resource description              | --                    | targetDescription    | [etargetDescription](https://schema.org/etargetDescription)     | --
| I8-4     |  Required resource name                     | --                    | targetName           | [targetName](https://schema.org/targetName)                     | --
| I8-5     |  Required resource URL                      | --                    | targetUrl            | [targetUrl](https://schema.org/targetUrl)                       | --
| I9-0     | Reading Level                               |                       | AlignmentObject      | [AlignmentObject](https://schema.org/AlignmentObject)           | --
| I9-1     |  Alignment Type                             | --                    | alignmentType        | [alignmentType](https://schema.org/alignmentType)               | --
| I9-2     |  Educational Framework                      | --                    | educationalFramework | [educationalFramework](https://schema.org/educationalFramework) | --
| I9-3     |  Evaluated resource description             | --                    | targetDescription    | [etargetDescription](https://schema.org/etargetDescription)     | --
| I9-4     |  Evaluated resource name                    | --                    | targetName           | [targetName](https://schema.org/targetName)                     | --
| I9-5     |  Evaluated resource URL                     | --                    | targetUrl            | [targetUrl](https://schema.org/targetUrl)                       | --

LOM: discipline,  accessibility restrictions (https://schema.org/accessMode), skill level, security level and competency.

* AlignmentObject
  └alignmentType
  └educationalFramework
  └targetDescription
  └targetName
  └targetUrl  

https://blogs.pjjk.net/phil/explaining-the-lrmi-alignment-object/

# Fields Definitions

## Educational
| Cod   | Key                         | Definitions                                                                                                                              | Values
| ----- | --------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------
| E1-0  | Interactivity Type          | Predominant mode of learning supported by this learning object.                                                                          | active - expositive - mixed
| E2-0  | Learning Resource Type      | Specific kind of learning object. The most dominant kind shall be first.                                                                 | activities - articles - assignments - courses - examination - exercise - glosaries - lectures - lessons - lessons plans - papers - quizes (more in Spanish version)
| E3-0  | Interactivity Level         | The degree of interactivity characterizing this L.O.(The degree to which the learner can influence the aspect or behavior of the L.O.)   | very low - low - medium - high - very high
| E4-0  | Semantic Density            | The degree of conciseness of a learning object. (In terms of its size, span, or—in the case of audio or video— duration.)                | very low - low - medium - high - very high (NO UTILIZAR)
| E5-0  | Intended End User Role      | Principal user(s) for which this learning object was designed, most dominant first.                                                      | learner - author - teacher - manager (more in Spanish versions)
| E6-0  | Context (## Classification) | The principal environment within which the learning and use of this learning object is intended to take place.                           | school - higher education - training - other
| E7-0  | Typical Age Range           | Age of the typical intended user. This data element shall refer to developmental age, if that would be different from chronological age. | --
| E8-0  | Difficulty                  | How hard it is to work with or through this learning object for the typical intended target audience.                                    | very easy - easy - medium - difficult - very difficult
| E9-0  | Typical Learning Time       | Approximate or typical time it takes to work with or through this learning object for the typical intended target audience.              | --
| E10-0 | Description                 | Comments on how this learning object is to be used.                                                                                      | --
| E11-0 | Language                    | Language which content is about.                                                                                                         | ISO 639
| E12-0 | Cognitive Process           | --                                                                                                                                       | (Spanish version have options)
| E13-0 | Educational Use             | --                                                                                                                                       |
| E14-0 | About                       | (subject?)                                                                                                                               |  Grammar - Orthography - Vocabulary - Culture (in language books books and/or to duplicate it, maybe)

## Classification
This category describes where this learning object falls within a particular classification system.

| Cod      | Key                          | Definitions                                                          | Values
| -------- | ----------------------       | -------------------------------------------------------------------- | --------------------------------------------------------------
| I1-0     | Level of Education           | ISCED level of education.                                            | NA
| I1-1     |  └alignmentType              | Alignment Type.                                                      | `educationalLevel`
| I1-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      | `ISCED`
| I1-3     |  └targetDescription          | The description of a node in an established educational framework.   | see: http://uis.unesco.org/sites/default/files/documents/international-standard-classification-of-education-fields-of-education-and-training-2013-detailed-field-descriptions-2015-en.pdf
| I1-4     |  └targetName                 | The name of a node in an established educational framework.          | Early childhood education - Primary education - Lower secondary education - Upper secondary education - Post-secondary non-tertiary education - Short-cycle tertiary education - Bachelor’s or equivalent level - Master’s or equivalent level - Doctoral or equivalent level - Not elsewhere classified
| I1-5     |  └targetUrl                  | The URL of a node in an established educational framework.           | `http://uis.unesco.org/en/topic/international-standard-classification-education-isced`
| I1-6     |  └alternateName *            | An alias for the item.                                               | 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 - 0
| I1-7     |  └image *                    | An image of the level.                                               |
| I2-0     | Educational Subject          | educational objective                                                | NA
| I2-1     |  └alignmentType              | Alignment Type.                                                      | `educationalSubject`
| I2-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      | `ISCED-2013`
| I2-3     |  └targetDescription          | The description of a node in an established educational framework.   | see: http://uis.unesco.org/sites/default/files/documents/international-standard-classification-of-education-fields-of-education-and-training-2013-detailed-field-descriptions-2015-en.pdf
| I2-4     |  └targetName                 | The name of a node in an established educational framework.          | Generic programmes and qualifications - Education - Arts and humanities - Social sciences and journalism and information - Business, admin
istration and law - Natural sciences, mathematics and statistics - Information and Communication Technologies - Engineering, manufacturing and construction - Agriculture, forestry
| I2-5     |  └targetUrl                  | The URL of a node in an established educational framework.           | `http://uis.unesco.org/en/topic/international-standard-classification-education-isced`
| I2-6     |  └alternateName *            | An alias for the item.                                               | 00 - 01 - 02 - 03 - 04 - 05 - 06 - 07 - 08 - 09 - 10
| I3-0     | Detailed Educational Subject | educational objective                                                | NA
| I3-1     |  └alignmentType              | Alignment Type.                                                      | `educationalSubject`
| I3-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      |
| I3-3     |  └targetDescription          | The description of a node in an established educational framework.   |
| I3-4     |  └targetName                 | The name of a node in an established educational framework.          |
| I3-5     |  └targetUrl                  | The URL of a node in an established educational framework.           |
| I3-6     |  └alternateName *            | An alias for the item.                                               |
| I4-0     | Educational Level            | The educational level                                                | NA
| I4-1     |  └alignmentType              | Alignment Type.                                                      | `educationalLevel`
| I4-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      |
| I4-3     |  └targetDescription          | The description of a node in an established educational framework.   |
| I4-4     |  └targetName                 | The name of a node in an established educational framework.          |
| I4-5     |  └targetUrl                  | The URL of a node in an established educational framework.           |
| I4-6     |  └alternateName *            | An alias for the item.                                               |
| I4-7     |  └image *                    | An image of the level.                                               |
| I5-0     | Teaches                      | Lesson or Subject.                                                   | NA
| I5-1     |  └alignmentType              | Alignment Type.                                                      | `teaches`
| I5-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      |
| I5-3     |  └targetDescription          | The description of a node in an established educational framework.   |
| I5-4     |  └targetName                 | The name of a node in an established educational framework.          |
| I5-5     |  └targetUrl                  | The URL of a node in an established educational framework.           |
| I5-6     |  └ --                        | --                                                                   |
| I6-0     | Requires                     | The name of the required Lesson, Subject or Course.                  | NA
| I6-1     |  └alignmentType              | Alignment Type.                                                      |`requires`
| I6-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      |
| I6-3     |  └targetDescription          | The description of a node in an established educational framework.   |
| I6-4     |  └targetName                 | The name of a node in an established educational framework.          |
| I6-5     |  └targetUrl                  | The URL of a node in an established educational framework.           |
| I6-6     |  └ --                        | --                                                                   |
| I7-0     | Assesses                     | Evaluates Lesson/Subject or Courses.                                 | NA
| I7-1     |  └alignmentType              | Alignment Type                                                       | `assesses`
| I7-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      |
| I7-3     |  └targetDescription          | The description of a node in an established educational framework.   |
| I7-4     |  └targetName                 | The name of a node in an established educational framework.          |
| I7-5     |  └targetUrl                  | The URL of a node in an established educational framework.           |
| I7-6     |  └ --                        | --                                                                   |
| I8-0     | Text Complexity              | --                                                                   | NA
| I8-1     |  └alignmentType              | Alignment Type.                                                      |`textComplexity`
| I8-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      |
| I8-3     |  └targetDescription          | The description of a node in an established educational framework.   |
| I8-4     |  └targetName                 | The name of a node in an established educational framework.          |
| I8-5     |  └targetUrl                  | The URL of a node in an established educational framework.           |
| I8-6     |  └ --                        | --                                                                   |
| I9-0     | Reading Level                | --                                                                   | NA
| I9-1     |  └alignmentType              | Alignment Type.                                                      |`readingLevel`
| I9-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      |
| I9-3     |  └targetDescription          | The description of a node in an established educational framework.   |
| I9-4     |  └targetName                 | The name of a node in an established educational framework.          |
| I9-5     |  └targetUrl                  | The URL of a node in an established educational framework.           |
| I9-6     |  └ --                        | --                                                                   |

* Thing type

## Classification if the Content is for languages education
This category automatizes some of the fields with language values.
| Cod      | Key                          | Definitions                                                          | Values
| -------- | ----------------------       | -------------------------------------------------------------------- | --------------------------------------------------------------
| I1-0     | Level of Education           | ISCED level of education.                                            | NA
| I1-1     |  └alignmentType              | Alignment Type.                                                      | `educationalLevel`
| I1-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      | `ISCED`
| I1-3     |  └targetDescription          | The description of a node in an established educational framework.   | The International Standard Classification of Education (ISCED 2011) provides a comprehensive framework for organising education programmes and qualification by applying uniform and internationally agreed definitions to facilitate comparisons of education systems across countries.
| I1-4     |  └targetName                 | The name of a node in an established educational framework.          | Early childhood education - Primary education - Lower secondary education - Upper secondary education - Post-secondary non-tertiary education - Short-cycle tertiary education - Bachelor’s or equivalent level - Master’s or equivalent level - Doctoral or equivalent level - Not elsewhere classified
| I1-5     |  └targetUrl                  | The URL of a node in an established educational framework.           | `http://uis.unesco.org/en/topic/international-standard-classification-education-isced`
| I1-6     |  └alternateName *            | An alias for the item.                                               | 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8
| I1-7     |  └image *                    | An image of the level.                                               |
| I2-0     | Educational Subject          | educational objective                                                | NA
| I2-1     |  └alignmentType              | Alignment Type.                                                      | `educationalSubject`
| I2-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      | `ISCED-2013`
| I2-3     |  └targetDescription          | The description of a node in an established educational framework.   | `Language acquisition is the  study  of  the  structure  and  composition  of  languages taught as second or foreign languages (i.e. that are intended for non-native or non-fluent speakers of the language). It includes the study of related cultures, literature, linguistics and phonetics if related to the specific language being acquired and forms part of the same programme or qualification. Classical or dead languages are included here as it is assumed there are no native speakers of the  language  and  hence  the  manner  of  teaching  and  the  content  of  the  curriculum are more similar to the teaching of foreign languages.`
| I2-4     |  └targetName                 | The name of a node in an established educational framework.          | `Arts and humanities`
| I2-6     |  └alternateName *            | An alias for the item.                                               | `00`
| I2-4     |  └targetName                 | The name of a node in an established educational framework.          | `Languages`
| I2-6     |  └alternateName *            | An alias for the item.                                               | `01`
| I2-4     |  └targetName                 | The name of a node in an established educational framework.          | `Language acquisition`
| I2-6     |  └alternateName *            | An alias for the item.                                               | `02`
| I2-5     |  └targetUrl                  | The URL of a node in an established educational framework.           | `http://uis.unesco.org/en/topic/international-standard-classification-education-isced`
| I2-4     |  └targetName                 | The name of a node in an established educational framework.          | Languages Name
| I2-6     |  └alternateName *            | An alias for the item.                                               | Languages Codes
| I3-0     | Detailed Educational Subject | educational objective                                                | NA
| I3-1     |  └alignmentType              | Alignment Type.                                                      | `educationalSubject`
| I3-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      | `Common European Framework of Reference for Languages`
| I3-3     |  └targetDescription          | The description of a node in an established educational framework.   | "Integrated with about"
| I3-4     |  └targetName                 | The name of a node in an established educational framework.          |
| I3-5     |  └targetName                 | The name of a node in an established educational framework.          |
| I3-6     |  └targetName                 | The name of a node in an established educational framework.          |
| I3-7     |  └targetUrl                  | The URL of a node in an established educational framework.           | `https://www.coe.int/en/web/common-european-framework-reference-languages/level-descriptions`
| I4-0     | Educational Level            | The educational level                                                | NA
| I4-1     |  └alignmentType              | Alignment Type.                                                      | `educationalLevel`
| I4-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      | `Common European Framework of Reference for Languages`
| I4-3     |  └targetDescription          | The description of a node in an established educational framework.   | see: https://www.coe.int/en/web/common-european-framework-reference-languages/level-descriptions
| I4-4     |  └targetName                 | The name of a node in an established educational framework.          | A1 - A2 - B1 - B2 - C1 - C2
| I4-6     |  └alternateName *            | An alias for the item.                                               | Breakthrough - Waystage - Threshold - Vantage - Effective Operational Proficiency - Mastery
| I4-5     |  └targetUrl                  | The URL of a node in an established educational framework.           | `https://www.coe.int/en/web/common-european-framework-reference-languages/level-descriptions`
| I4-7     |  └image *                    | An image of the level.                                               |
| I5-0     | Teaches                      | Lesson or Subject.                                                   | NA
| I5-1     |  └alignmentType              | Alignment Type.                                                      | `teaches`
| I5-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      |
| I5-3     |  └targetDescription          | The description of a node in an established educational framework.   |
| I5-4     |  └targetName                 | The name of a node in an established educational framework.          |
| I5-5     |  └targetUrl                  | The URL of a node in an established educational framework.           |
| I5-6     |  └ --                        | --                                                                   |
| I6-0     | Requires                     | The name of the required Lesson, Subject or Course.                  | NA
| I6-1     |  └alignmentType              | Alignment Type.                                                      |`requires`
| I6-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      |
| I6-3     |  └targetDescription          | The description of a node in an established educational framework.   |
| I6-4     |  └targetName                 | The name of a node in an established educational framework.          |
| I6-5     |  └targetUrl                  | The URL of a node in an established educational framework.           |
| I6-6     |  └ --                        | --                                                                   |
| I7-0     | Assesses                     | Evaluates Lesson/Subject or Courses.                                 | NA
| I7-1     |  └alignmentType              | Alignment Type                                                       | `assesses`
| I7-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      |
| I7-3     |  └targetDescription          | The description of a node in an established educational framework.   |
| I7-4     |  └targetName                 | The name of a node in an established educational framework.          |
| I7-5     |  └targetUrl                  | The URL of a node in an established educational framework.           |
| I7-6     |  └ --                        | --                                                                   |
| I8-0     | Text Complexity              | --                                                                   | NA
| I8-1     |  └alignmentType              | Alignment Type.                                                      |`textComplexity`
| I8-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      |
| I8-3     |  └targetDescription          | The description of a node in an established educational framework.   |
| I8-4     |  └targetName                 | The name of a node in an established educational framework.          |
| I8-5     |  └targetUrl                  | The URL of a node in an established educational framework.           |
| I8-6     |  └ --                        | --                                                                   |
| I9-0     | Reading Level                | --                                                                   | NA
| I9-1     |  └alignmentType              | Alignment Type.                                                      |`readingLevel`
| I9-2     |  └educationalFramework       | The framework to which the resource being described is aligned.      |
| I9-3     |  └targetDescription          | The description of a node in an established educational framework.   |
| I9-4     |  └targetName                 | The name of a node in an established educational framework.          |
| I9-5     |  └targetUrl                  | The URL of a node in an established educational framework.           |
| I9-6     |  └ --                        | --                                                                   |

https://www.coe.int/en/web/common-european-framework-reference-languages/level-descriptions



* Thing type

# Vocabulary recommendations

## Educational

**Interactivity Type** Vocabulary Recommendations
* **active**: "Existing in action, working, effective, having practical operation or results" (OED).
* **expositive**: "Tending to set forth or describe in detail; descriptive; serving to explain" (OED).
* **mixed**: "Consisting of different or dissimilar elements or qualities; not of one kind, not pure or simple; composite" (OED).

**Learning Resource Type** Vocabulary Recommendations
* **exercise**:
An exercise is "the use of or method of using; a task prescribed or performed for the sake of attaining proficiency, for training either body or mind, or as an exhibition or test of proficiency or skill" (OED).
Use for any learning resource that is associated with a planned sequence of actions that are not evaluated and not part of a simulation (e.g., critical thinking activity, brainstorming, assignment, tutorial, worksheet.) Note that some alternative or custom vocabularies may classify educational resource types as types of educational activities. In such cases, the LOM value of Exercise may be the closest equivalent value that is available for any and all values from such vocabularies.
* **simulation**:
A simulation is "the technique of imitating the behaviour of some situation or process (whether economic, military, mechanical, etc.) by means of a suitably analogous situation or apparatus" (OED).
* **questionnaire**:
A questionnaire is "a list of questions by which information is sought from a selected group, usually for statistical analysis" (OED).
* **diagram**:
A diagram is "an illustrative figure which, without representing the exact appearance of a resource, gives an outline or general scheme of it, so as to exhibit the shape and relations of its various parts; a set of lines, marks, or tracings which represent symbolically the course or results of any action or process, or the variations which characterize it" (OED).
Use figure as a preferred container term.
* **figure**:
A figure is "the image, likeness, or representation of something material or immaterial" (OED).
Use for any learning resource that consists of or contains visual representation(s) other than text, including photographs, maps, video, animations, and visual hypermedia.
* **graph**:
A graph is "a kind of symbolic diagram (used in Chemistry, Mathematics, etc.) in which a system of connections is expressed by spots or circles, some pairs of which are colligated by one or more lines" (OED).
Use figure as a preferred container term.
* **index**:
An index is "a reference list; an alphabetical list" (OED).
Use for any resource that constitutes a dataset, collection, list of links, references or pointers, or a searchable database (e.g., clearinghouse, search engine, glossary, reference). This value does not include a list of objectives or goals.
* **slide**:
A slide is "a photographic transparency for use in a slide projector" (OED). Use figure as a preferred container term.
* **table**:
A table is "an arrangement in columns and lines…as the multiplication table, tables of weights and measures, a table of logarithms, astronomical tables,
insurance tables, time-tables, etc. " (OED).
* **narrative text**:
A narrative text is "an account or narration; a history, tale, story, recital (of facts, etc.) that is a portion of the contents of a manuscript or printed book, or of a page, which constitutes the original matter, as distinct from the notes or other critical appendages" (OED).
Use for any learning resource that consists of or contains text (including hypertext, and text-based communications), except where that text is a listing (use Index) or serves an evaluative purpose (use Exam).
* **exam**:
An exam is "the process of testing, by questions oral or written, the knowledge or ability of pupils, or of candidates for office, degrees, etc." (OED).
Use for any learning resource whose primary purpose is the evaluation of the user's actions or input (e.g., assessment item, quiz).
* **experiment**:
An experiment is "an action or operation undertaken in order to discover something unknown, to test a hypothesis, or establish or illustrate some known truth" (OED).
Use Exercise as a preferred container term when the learning resource does not specifically correspond to or contain an experiment.
* **problem statement**:
A problem statement is "a written or oral communication setting forth… a difficult or puzzling question proposed for solution" (OED).
Use for any learning resource that helps define instruction (e.g., objectives, outcomes, lesson plan, problem set, syllabus, prerequisites, attractor, curriculum).
* **self-assessment**:
A self-assessment is an "assessment or evaluation of oneself, one's actions or attitudes by oneself" (OED).
Use Exam as a preferred container term.
* **lecture**:
A lecture is "a discourse given before an audience upon a given subject, usually for the purpose of instruction" (OED).
Use the value narrative text instead of lecture if the lecture is in textual form.
Use for any audio or sound recording.

**Interactivity Level** Vocabulary Recommendations
(Examples for different situations)
* for Interactivity Type: Active:
 * Very Low: Test questions formatted for printing.
 * Low: Links provided with instructions for their exploration.
 * Medium: Online multiplechoice exercise providing feedback.
 * High: Dissection simulation with pre- and post-tests.
 * Very High: Immersive simulation for completing prescribed series of steps.
* for Interactivity Type: Active:
 * Very Low: Essay formatted for printing.
 * Low: Video clip with play, pause, and replay controls.
 * Medium: Hypertext in which readers choose ending.
 * High: Dissection simulation without evaluation components.
 * Very High: Immersive environment for exploring remote location.

**Intended End User Role** Vocabulary Recommendations
* **teacher**: A teacher is "one who or that which teaches or instructs; an instructor" (OED).
* **author**: An author is "the person who originates or gives existence to anything" (OED).
* **learner**: A learner is "one who learns or receives instruction" (OED).
* **manager**: A manager is "a person who organizes, directs, or plots something; a person who regulates or deploys resources" (OED). Note that manager can be considered as a broad equivalent for more specific values not included in this listing, such as parent, guardian, or supervisor.

**Context** Vocabulary Recommendations
* **school**: A school is "an establishment in which boys or girls, or both, receive instruction" (OED).
* **higher education** Higher education refers to "education at universities or similar educational establishments, especially to degree level" (OCED).
* **training**: Training refers to "systematic instruction and exercise in some art, profession, or occupation, with a view to proficiency in it" (OED).

LRMI - old: intendedEndUserRole


Metadata Properties relationships

future integration with LOM (discotinued for now)

| Cod      | Info                                | LOM         | LRMI                   | Schema.org      | DC
| -------- | ----------------------------------- | ----------- | ---------------------- | --------------- | --
| I1-1     | Purpose: discipline                 | purpose     | --                     | --              | --
| I2-1     | Taxon Path                          | taxonpath   | NA                     | NA              | NA
| I2.1-1   |  └Source                            | source      | --                     | --              | --
| I2.2-1   |  └Taxon                             | taxon       | NA                     | NA              | NA
| I2.2.1-1 |    └Id                              | id          | --                     | --              | --
| I2.2.2-1 |    └Entry                           | entry       | --                     | --              | --
| I3-1     | Description                         | description | --                     | --              | --
| I4-1     | Keyword                             | keyword     | --                     | --              | --
| I1-2     | Purpose: prerequisite               | purpose     | --                     | --              | --
| I2-2     | Taxon Path                          | taxonpath   | NA                     | NA              | NA
| I2.1-2   |  └Source                            | source      | --                     | --              | --
| I2.2-2   |  └Taxon                             | taxon       | NA                     | NA              | NA
| I2.2.1-2 |    └Id                              | id          | --                     | --              | --
| I2.2.2-2 |    └Entry                           | entry       | --                     | --              | --
| I3-2     | Description                         | description | --                     | --              | --
| I4-2     | Keyword                             | keyword     | --                     | --              | --
| I1-3     | Purpose: educational objective      | purpose     | NA                     | --              | --
| I2-3     | Taxon Path                          | taxonpath   | --                     | NA              | NA
| I2.1-3   |  └Source                            | source      | --                     | --              | --
| I2.2-3   |  └Taxon                             | taxon       | NA                     | NA              | NA
| I2.2.1-3 |    └Id                              | id          | --                     | --              | --
| I2.2.2-3 |    └Entry                           | entry       | --                     | --              | --
| I3-3     | Description                         | description | --                     | --              | --
| I4-3     | Keyword                             | keyword     | --                     | --              | --
| I1-4     | Purpose: accessibility restrictions | purpose     | --                     | --              | --
| I2-4     | Taxon Path                          | taxonpath   | NA                     | NA              | NA
| I2.1-4   |  └Source                            | source      | --                     | --              | --
| I2.2-4   |  └Taxon                             | taxon       | NA                     | NA              | NA
| I2.2.1-4 |    └Id                              | id          | --                     | --              | --
| I2.2.2-4 |    └Entry                           | entry       | --                     | --              | --
| I3-4     | Description                         | description | --                     | --              | --
| I4-4     | Keyword                             | keyword     | --                     | --              | --
| I1-5     | Purpose: educational level          | purpose     | --                     | --              | --
| I2-5     | Taxon Path                          | taxonpath   | NA                     | NA              | NA
| I2.1-5   |  └Source                            | source      | --                     | --              | --
| I2.2-5   |  └Taxon                             | taxon       | NA                     | NA              | NA
| I2.2.1-5 |    └Id                              | id          | --                     | --              | --
| I2.2.2-5 |    └Entry                           | entry       | --                     | --              | --
| I3-5     | Description                         | description | --                     | --              | --
| I4-5     | Keyword                             | keyword     | --                     | --              | --
| I1-6     | Purpose: skill level                | purpose     | --                     | --              | --
| I2-6     | Taxon Path                          | taxonpath   | NA                     | NA              | NA
| I2.1-6   |  └Source                            | source      | --                     | --              | --
| I2.2-6   |  └Taxon                             | taxon       | NA                     | NA              | NA
| I2.2.1-6 |    └Id                              | id          | --                     | --              | --
| I2.2.2-6 |    └Entry                           | entry       | --                     | --              | --
| I3-6     | Description                         | description | --                     | --              | --
| I4-6     | Keyword                             | keyword     | --                     | --              | --
| I1-7     | Purpose: security level             | purpose     | --                     | --              | --
| I2-7     | Taxon Path                          | taxonpath   | NA                     | NA              | NA
| I2.1-7   |  └Source                            | source      | --                     | --              | --
| I2.2-7   |  └Taxon                             | taxon       | NA                     | NA              | NA
| I2.2.1-7 |    └Id                              | id          | --                     | --              | --
| I2.2.2-7 |    └Entry                           | entry       | --                     | --              | --
| I3-7     | Description                         | description | --                     | --              | --
| I4-7     | Keyword                             | keyword     | --                     | --              | --
| I1-8     | Purpose: competency                 | purpose     | --                     | --              | --
| I2-8     | Taxon Path                          | taxonpath   | NA                     | NA              | NA
| I2.1-8   |  └Source                            | source      | --                     | --              | --
| I2.2-8   |  └Taxon                             | taxon       | NA                     | NA              | NA
| I2.2.1-8 |    └Id                              | id          | --                     | --              | --
| I2.2.2-8 |    └Entry                           | entry       | --                     | --              | --
| I3-8     | Description                         | description | --                     | --              | --
| I4-8     | Keyword                             | keyword     | --                     | --              | --

Fields Definitions

| Source  | Info        | Definitions                                                                                                 | --
| ------- | ----------- | ----------------------------------------------------------------------------------------------------------- | Values
| ------- | Purpose     | The purpose of classifying this learning object.                                                            | `discipline`
| ------- | Taxon Path  | Use this element aggregate to trace the path set out in a structured taxonomy for any given term.           | --
| ------- |  └Source    | The name of the classification system.                                                                      | --
| ------- |  └Taxon     | Taxon and its sub-elements to indicate a taxon term or the hierarchical series of taxon terms.              | --
| ------- |    └Id      | The identifier of the taxon, such as a number or letter combination provided by the source of the taxonomy. | --
| ------- |    └Entry   | The textual label of the taxon.                                                                             | --
| ------- | Description | Description of the learning object relative to the stated 9.1:Classification.                               | --
| ------- | Keyword     | Keywords and phrases descriptive of the learning object relative to the stated 9.1:Classification.          | --
| ------- | Purpose     | The purpose of classifying this learning object.                                                            | `prerequisite`
| ------- | Taxon Path  | Use this element aggregate to trace the path set out in a structured taxonomy for any given term.           | --
| ------- |  └Source    | The name of the classification system.                                                                      | --
| ------- |  └Taxon     | Taxon and its sub-elements to indicate a taxon term or the hierarchical series of taxon terms.              | --
| ------- |    └Id      | The identifier of the taxon, such as a number or letter combination provided by the source of the taxonomy. | --
| ------- |    └Entry   | The textual label of the taxon.                                                                             | --
| ------- | Description | Description of the learning object relative to the stated 9.1:Classification.                               | --
| ------- | Keyword     | Keywords and phrases descriptive of the learning object relative to the stated 9.1:Classification.          | --
| ------- | Purpose     | The purpose of classifying this learning object.                                                            | `educational objective`
| ------- | Taxon Path  | Use this element aggregate to trace the path set out in a structured taxonomy for any given term.           | --
| ------- |  └Source    | The name of the classification system.                                                                      | --
| ------- |  └Taxon     | Taxon and its sub-elements to indicate a taxon term or the hierarchical series of taxon terms.              | --
| ------- |    └Id      | The identifier of the taxon, such as a number or letter combination provided by the source of the taxonomy. | --
| ------- |    └Entry   | The textual label of the taxon.                                                                             | --
| ------- | Description | Description of the learning object relative to the stated 9.1:Classification.                               | --
| ------- | Keyword     | Keywords and phrases descriptive of the learning object relative to the stated 9.1:Classification.          | --
| ------- | Purpose     | The purpose of classifying this learning object.                                                            | `accessibility restrictions`
| ------- | Taxon Path  | Use this element aggregate to trace the path set out in a structured taxonomy for any given term.           | --
| ------- |  └Source    | The name of the classification system.                                                                      | --
| ------- |  └Taxon     | Taxon and its sub-elements to indicate a taxon term or the hierarchical series of taxon terms.              | --
| ------- |    └Id      | The identifier of the taxon, such as a number or letter combination provided by the source of the taxonomy. | --
| ------- |    └Entry   | The textual label of the taxon.                                                                             | --
| ------- | Description | Description of the learning object relative to the stated 9.1:Classification.                               | --
| ------- | Keyword     | Keywords and phrases descriptive of the learning object relative to the stated 9.1:Classification.          | --
| ------- | Purpose     | The purpose of classifying this learning object.                                                            | `educational level`
| ------- | Taxon Path  | Use this element aggregate to trace the path set out in a structured taxonomy for any given term.           | --
| ------- |  └Source    | The name of the classification system.                                                                      | --
| ------- |  └Taxon     | Taxon and its sub-elements to indicate a taxon term or the hierarchical series of taxon terms.              | --
| ------- |    └Id      | The identifier of the taxon, such as a number or letter combination provided by the source of the taxonomy. | --
| ------- |    └Entry   | The textual label of the taxon.                                                                             | --
| ------- | Description | Description of the learning object relative to the stated 9.1:Classification.                               | --
| ------- | Keyword     | Keywords and phrases descriptive of the learning object relative to the stated 9.1:Classification.          | --
| ------- | Purpose     | The purpose of classifying this learning object.                                                            | `skill level`
| ------- | Taxon Path  | Use this element aggregate to trace the path set out in a structured taxonomy for any given term.           | --
| ------- |  └Source    | The name of the classification system.                                                                      | --
| ------- |  └Taxon     | Taxon and its sub-elements to indicate a taxon term or the hierarchical series of taxon terms.              | --
| ------- |    └Id      | The identifier of the taxon, such as a number or letter combination provided by the source of the taxonomy. | --
| ------- |    └Entry   | The textual label of the taxon.                                                                             | --
| ------- | Description | Description of the learning object relative to the stated 9.1:Classification.                               | --
| ------- | Keyword     | Keywords and phrases descriptive of the learning object relative to the stated 9.1:Classification.          | --
| ------- | Purpose     | The purpose of classifying this learning object.                                                            | `competency`
| ------- | Taxon Path  | Use this element aggregate to trace the path set out in a structured taxonomy for any given term.           | --
| ------- |  └Source    | The name of the classification system.                                                                      | --
| ------- |  └Taxon     | Taxon and its sub-elements to indicate a taxon term or the hierarchical series of taxon terms.              | --
| ------- |    └Id      | The identifier of the taxon, such as a number or letter combination provided by the source of the taxonomy. | --
| ------- |    └Entry   | The textual label of the taxon.                                                                             | --
| ------- | Description | Description of the learning object relative to the stated 9.1:Classification.                               | --
| ------- | Keyword     | Keywords and phrases descriptive of the learning object relative to the stated 9.1:Classification.          | --


---

[Readme](/Readme.md)


https://en.wikiversity.org/wiki/Help:Resource_types
