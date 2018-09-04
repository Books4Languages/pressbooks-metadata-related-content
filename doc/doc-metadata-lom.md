

## General
This category groups the general information that describes this learning object as a whole.

| LOM           | LOM | LRMI | DC
| ------------- | -- | ----
|  Identifier   | Identifier | NA
|  └Catalog     | catalog | The name or designator of the identification or cataloging scheme for this entry. A namespace scheme.
|  └Entry       | entry | The value of the identifier within the identification or cataloging scheme that designates or identifies this learning object. A namespace-specific string.
|  Title        | title | Name given to this learning object.
|  Language     | language | language or languages used within this learning object to communicate to the intended user.
|  Description  | description | A textual description of the content of this learning object.
|  Keyword      | keyword | A keyword or phrase describing the topic of this learning object.
|  Coverage     | NA | NA
|  Structure    | NA | NA
|  Aggregation Level | aggregationLevel | The functional granularity of this learning object.

## Life Cycle
This category describes the history and current state of this learning object and those entities that have affected this learning object during its evolution.

| LOM          | LOM | LRMI | DC
| ------------ | -- | ----
|  Version     | version | Version
|  Status      | status  | The completion status or condition of this learning object.
|  Contribute  | NA | NA
|  └Role       | role | Kind of contribution.
|  └Entity     | entity | The identification of and information about entities contributing to this learning object.
|  └Date       | date | The date of the contribution.

## Meta-Metadata
This category describes this metadata record itself.
This category describes how the metadata instance can be identified, who created this metadata instance, how, when, and with what references.

| LOM              | LOM | LRMI | DC
| ---------------- | -- | ----
|  Identifier      | NA | NA
|  └Catalog        | catalog | The name or designator of the identification or cataloging scheme for this entry. A namespace scheme.
|  └Entry          | entry | The value of the identifier within the identification or cataloging scheme that designates or identifies this metadata record.
|  Contribute      | NA | NA
|  └Role           | NA | NA
|  └entity??       | ?? | ??
|  └Date           | date | The date of the contribution.
|  Metadata Schema | metadataSchema | The name and version of the authoritative specification used to create this metadata instance.
|  Language        | language | Language of this metadata instance.

## Technical
This category describes the technical requirements and characteristics of this learning object.

| LOM               | LOM | LRMI | DC
| ----------------- | -- | ----
|  Format           | format         | Technical datatype(s) of (all the components of) this learning object.
|  Size             | size           | The size of the digital learning object in bytes (octets).
|  Location         | location       | A string that is used to access this learning object.
|  Explanation      | NA             | NA
|  └Type            | type           | The technology required to use this learning object, e.g., hardware, software,network.
|  └Name            | name           | Name of the required technology to use this learning object.
|  └Minimum Version | minimumVersion | Lowest possible version of the required technology to use this learning object
|  └Maximum Version | maximumVersion | Highest possible version of the required technology to use this learning object.
|  Installation Remarks        | installationRemarks | Description of how to install this learning object.
|  Other Platform Requirements | otherPlatformRequirements | Information about other software and hardware requirements.
|  Duration         | duration       | Time a continuous learning object takes when played at intended speed.

## Educational

| LOM                     | LOM                  | LRMI | DC
| ----------------------- | -------------------- | ----
|  Interactivity Type     | interactivityType    | Predominant mode of learning supported by this learning object.
|  Learning Resource Type | learningResourceType | Specific kind of learning object. The most dominant kind shall be first.
|  Interactivity Level    | interactivityLevel   | The degree of interactivity characterizing this learning object. Interactivity in this context refers to the degree to which the learner can influence the aspect or behavior of the learning object.
|  Semantic Density       | semanticDensity      | The degree of conciseness of a learning object. The semantic density of a learning object may be estimated in terms of its size, span, or—in the case of self-timed resources such as audio or video— duration.
|  Intended End User Role | intendedEndUserRole  | Principal user(s) for which this learning object was designed, most dominant first.
|  Context                | context              | The principal environment within which the learning and use of this learning object is intended to take place.
|  Typical Age Range      | typicalAgeRange      |  Age of the typical intended user. This data element shall refer to developmental age, if that would be different from chronological age.
|  Difficulty             | difficulty           |  How hard it is to work with or through this learning object for the typical intended target audience.
|  Typical Learning Time  | typicalLearningTime  | Approximate or typical time it takes to work with or through this learning object for the typical intended target audience.
|  Description            | description          | Comments on how this learning object is to be used.
|  Language               | language             | The human language used by the typical intended user of this learning object.


## Rights
This category describes the intellectual property rights and conditions of use for this learning object.

| LOM                               | LOM | LRMI | DC
| --------------------------------- | -- | ----
|  Cost                             | cost | Whether use of this learning object requires payment.
|  Copyright and Other Restrictions | copyrightAndOtherRestrictions | Whether copyright or other restrictions apply to the use of this learning object.
|  Description                      | description | Comments on the conditions of use of this learning object.

## Relation
This category defines the relationship between this learning object and other learning objects, if any.

| LOM           | LOM         | LRMI | DC
| ------------- | ----------- | ----
|  Kind         | kind        | Nature of the relationship between this learning object and the target learning object, identified by 7.2:Relation.Resource.
|  Resource     | NA | NA
|  Identifier   | NA | NA
|  └Catalog     | catalog     | The name or designator of the identification or cataloging scheme for this entry. A namespace scheme.
|  Entry        | entry       | The value of the identifier within the identification or cataloging scheme that designates or identifies the target learning object. A namespace-specific string
|  Description  | description | Description of the target learning object.

## Annotation
This category provides comments on the educational use of this learning object, and information on when and by whom the comments were created.

| LOM          | LOM | LRMI | DC
| ------------ | -- | ----
|  Entity      | entity | Entity (i.e., people, organizations) that created this annotation.
|  Date        | date | Date this annotation was created.
|  Description | description | The content of this annotation.


## Classification
This category describes where this learning object falls within a particular classification system.

| LOM          | LOM | LRMI | DC
| ------------ | -- | ----
|  Purpose     | purpose | The purpose of classifying this learning object.
|  Taxon Path  | NA | NA
|  └Source      | source | The name of the classification system.
|  Taxon       | NA | NA
|  └Id          | id | The identifier of the taxon, such as a number or letter combination provided by the source of the taxonomy.
|  └Entry       | entry | The textual label of the taxon.
|  Description | description | Description of the learning object relative to the stated 9.1:Classification.
|  Keyword     | keyword | Keywords and phrases descriptive of the learning object relative to the stated 9.1:Classification.
