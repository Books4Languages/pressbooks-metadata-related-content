
## General
This category groups the general information that describes this learning object as a whole.

| Field             | Definitions
| ----------------- | -----------
| Identifier        | Using sub-elements Catalog and Entry, provide a name for the identification scheme and a unique value to identify the learning resource.
|  └Catalog         | Use the common abbreviation or the standard name for the identification scheme that is used to reference the learning resource.
|  └Entry           | Provide the actual value of the URN or identifier as derived from any specified identification scheme.
| Title             | Name given to this learning object.
| Language          | Language or languages used within this learning object to communicate to the intended user.
| Description       | Provide a neutral and concise yet thorough description of the learning resource.
| Keyword           | Use the most specific terms that are descriptive of the subject covered by the learning resource. Use a separate keyword element for each term or phrase, avoiding lengthy phrases.
| Coverage          | Indicate the time period, areas, regions, and/or jurisdictions covered by the content of the resource.
| Structure         | Indicate the way in which the learning resource is logically related to other resources to form an aggregate or composite resource.
| Aggregation Level | Indicate the number of times that the learning resource or its component parts can be decomposed into still smaller components.

## Life Cycle
This category describes the history and current state of this learning object and those entities that have affected this learning object during its evolution.

| Field       | Definitions
| ----------- | -----------
| Version     | Version
| Status      | The completion status or condition of this learning object.
| Contribute  | Those entities (i.e., people, organizations) that have contributed to the state of this learning object during its life cycle (e.g., creation, edits, publication).
|  └Role      | Kind of contribution.
|  └Entity    | The identification of and information about entities contributing to this learning object.
|  └Date      | The date of the contribution.

## Meta-Metadata
This category describes this metadata record itself.
This category describes how the metadata instance can be identified, who created this metadata instance, how, when, and with what references.

| Field           | Definitions
| --------------- | -----------
| Identifier      | A globally unique label that identifies this metadata record.
|  └Catalog       | The name or designator of the identification or cataloging scheme for this entry. A namespace scheme.
|  └Entry         | The value of the identifier within the identification or cataloging scheme that designates or identifies this metadata record.
| Contribute      | Those entities (i.e., people, organizations) that have affected the state of this metadata during its life cycle (e.g., creation, validation).
|  └Role          | Kind of contribution.
|  └entity        | The identification of and information about entities (i.e., people, organizations) contributing to this metadata. The entities shall be ordered as most relevant first.
|  └Date          | The date of the contribution.
| Metadata Schema | The name and version of the authoritative specification used to create this metadata instance.
| Language        | Language of this metadata instance.

## Technical
This category describes the technical requirements and characteristics of this learning object.

| Field             | Definitions
| ----------------- | -----------
| Format            | Technical datatype(s) of (all the components of) this learning object.
| Size              | The size of the digital learning object in bytes (octets).
| Location          | Provide the Web address,
| Explanation       | NA
|  └Type            | The technology required to use this learning object, e.g., hardware, software,network.
|  └Name            | Name of the required technology to use this learning object.
|  └Minimum Version | Lowest possible version of the required technology to use this learning object
|  └Maximum Version | Highest possible version of the required technology to use this learning object.
| Installation Remarks        | Description of how to install this learning object.
| Other Platform Requirements | Information about other software and hardware requirements.
| Duration          | Time a continuous learning object takes when played at intended speed.

## Educational

| Field                  | Definitions
| ---------------------- | -----------
| Interactivity Type     | Predominant mode of learning supported by this learning object.
| Learning Resource Type | Specific kind of learning object. The most dominant kind shall be first.
| Interactivity Level    | The degree of interactivity characterizing this learning object. Interactivity in this context refers to the degree to which the learner can influence the aspect or behavior of the learning object.
| Semantic Density       | The degree of conciseness of a learning object. The semantic density of a learning object may be estimated in terms of its size, span, or—in the case of self-timed resources such as audio or video— duration.
| Intended End User Role | Principal user(s) for which this learning object was designed, most dominant first.
| Context                | The principal environment within which the learning and use of this learning object is intended to take place.
| Typical Age Range      | Age of the typical intended user. This data element shall refer to developmental age, if that would be different from chronological age.
| Difficulty             | How hard it is to work with or through this learning object for the typical intended target audience.
| Typical Learning Time  | Approximate or typical time it takes to work with or through this learning object for the typical intended target audience.
| Description            | Comments on how this learning object is to be used.
| Language               | The human language used by the typical intended user of this learning object.


## Rights
This category describes the intellectual property rights and conditions of use for this learning object.

| Field                            | Definitions
| -------------------------------- | -----------
| Cost                             | Whether use of this learning object requires payment.
| Copyright and Other Restrictions | Whether copyright or other restrictions apply to the use of this learning object.
| Description                      | Comments on the conditions of use of this learning object.

## Relation
This category defines the relationship between this learning object and other learning objects, if any.

| Field       | Definitions
| ----------- | -----------
| Kind        | Nature of the relationship between this learning object and the target learning object, identified by 7.2:Relation.Resource.
| Resource    | NA
| Identifier  | NA
|  └Catalog   | The name or designator of the identification or cataloging scheme for this entry. A namespace scheme.
| Entry       | The value of the identifier within the identification or cataloging scheme that designates or identifies the target learning object. A namespace-specific string
| Description | Description of the target learning object.

## Annotation
This category provides comments on the educational use of this learning object, and information on when and by whom the comments were created.

| Field       | Definitions
| ----------- | -----------
| Entity      | Entity (i.e., people, organizations) that created this annotation.
| Date        | Date this annotation was created.
| Description | The content of this annotation.


## Classification
This category describes where this learning object falls within a particular classification system.

| Field       | Definitions
| ----------- | -----------
| Purpose     | The purpose of classifying this learning object.
| Taxon Path  | NA
|  └Source    | The name of the classification system.
|  └Taxon     | NA
|    └Id      | The identifier of the taxon, such as a number or letter combination provided by the source of the taxonomy.
|    └Entry   | The textual label of the taxon.
| Description | Description of the learning object relative to the stated 9.1:Classification.
| Keyword     | Keywords and phrases descriptive of the learning object relative to the stated 9.1:Classification.
