
educationalAlignment
educationalUse

## General
This category groups the general information that describes this learning object as a whole.

| Field             | LOM              | LRMI    | Schema   | DC
| ----------------- | ---------------- | ------- | -------- | --
| Identifier        | --               | NA      | NA       | DC.identifier
|  └Catalog         | catalog          | NA      | NA       | NA
|  └Entry           | entry            | NA      | NA       | NA
| Title             | title            | NA      | title    | DC.title
| Language          | language         | NA      | language | DC.language
| Description       | description      | NA      | NA       | DC.description
| Keyword           | keyword          | NA      | topic??  | DC.subject (ARTICLESECTION SCHEMA)
| Coverage          | coverage         | NA      | NA       | DC.coverage
| Structure         | structure        | NA      | NA       | NA
| Aggregation Level | aggregationLevel | NA      | NA       | NA

## Life Cycle
This category describes the history and current state of this learning object and those entities that have affected this learning object during its evolution.

| Field       | LOM     | LRMI    | Schema.org | DC
| ----------- | ------- | ------- | ---------- | --
| Version     | version | NA      | NA         | NA
| Status      | status  | NA      | NA         | NA
| Contribute  | --      | NA      | NA         | NA
|  └Role      | role    | NA      | NA         | NA
|  └Entity    | entity  | NA      | creator   ?? publisher ?? | DC.contributor, DC.creator, DC.publisher
|  └Date      | date    | NA      | created??  | DC.date??

## Meta-Metadata
This category describes this metadata record itself.
This category describes how the metadata instance can be identified, who created this metadata instance, how, when, and with what references.

| Field           | LOM            | LRMI | Schema.org | DC
| --------------- | -------------- | ---- | ---------- | --
| Identifier      | --             | NA   | NA         | NA
|  └Catalog       | catalog        | NA   | NA         | NA
|  └Entry         | entry          | NA   | NA         | NA
| Contribute      | --             | NA   | NA         | NA
|  └Role          | role           | NA   | NA         | NA
|  └entity        | entity         | NA   | NA         | NA
|  └Date          | date           | NA   | NA         | NA
| Metadata Schema | metadataSchema | NA   | NA         | NA
| Language        | language       | NA   | NA         | NA

## Technical
This category describes the technical requirements and characteristics of this learning object.

| Field                       | LOM                       | LRMI | Schema.org | DC
| --------------------------- | ------------------------- | ---- | ---------- | --
| Format                      | format                    | NA   | NA         | DC.format
| Size                        | size                      | NA   | NA         | NA
| Location                    | location                  | NA   | NA         | NA
| Requirement                 | --                        | NA   | NA         | NA
|  └OrComposite               | --                        | NA   | NA         | NA
|    └Type                    | type                      | NA   | NA         | DC.type
|    └Name                    | name                      | NA   | NA         | NA
|    └Minimum Version         | minimumVersion            | NA   | NA         | NA
|    └Maximum Version         | maximumVersion            | NA   | NA         | NA
| Installation Remarks        | installationRemarks       | NA   | NA         | NA
| Other Platform Requirements | otherPlatformRequirements | NA   | NA         | NA
| Duration                    | duration                  | NA   | NA         | NA

## Educational

| Field                  | LOM                  | LRMI                 | Schema.org | DC
| ---------------------- | -------------------- | -------------------- | ---------- | --
| Interactivity Type     | interactivityType    | interactivityType    | NA         | NA
| Learning Resource Type | learningResourceType | learningResourceType | NA         | NA
| Interactivity Level    | interactivityLevel   | NA                   | NA         | NA
| Semantic Density       | semanticDensity      | NA                   | NA         | NA
| Intended End User Role | intendedEndUserRole  | NA-OLD               | NA         | NA
| Context                | context              | NA                   | NA         | NA
| Typical Age Range      | typicalAgeRange      | typicalAgeRange      | NA         | NA
| Difficulty             | difficulty           | NA                   | NA         | NA
| Typical Learning Time  | typicalLearningTime  | timeRequired         | NA         | NA
| Description            | description          | NA                   | NA         | NA
| Language               | language             | NA                   | NA         | NA


## Rights
This category describes the intellectual property rights and conditions of use for this learning object.

| Field                            | LOM                           | LRMI         | Schema.org | DC
| -------------------------------- | ----------------------------- | ------------ | ---------- | --
| Cost                             | cost                          | NA           | NA         | NA
| Copyright and Other Restrictions | copyrightAndOtherRestrictions | useRightsUrl | NA         | DC.rights
| Description                      | description                   | NA           | NA         | NA

## Relation
This category defines the relationship between this learning object and other learning objects, if any.

| Field       | LOM         | LRMI          | Schema.org | DC
| ----------- | ----------- | ------------- | ---------- | --
| Kind        | kind        | NA           | NA         | NA
| Resource    | NA          | isBasedOnUrl | NA         | DC.source, DC.*relation*
| Identifier  | --          | NA           | NA         | NA
|  └Catalog   | catalog     | NA           | NA         | NA
|  └Entry     | entry       | NA            | NA         | NA
| Description | description | NA            | NA         | NA

## Annotation
This category provides comments on the educational use of this learning object, and information on when and by whom the comments were created.

| Field       | LOM         | LRMI | Schema.org | DC
| ----------- | ----------- | ---- | ---------- | --
| Entity      | entity      | NA   | NA         | NA
| Date        | date        | NA   | NA         | NA
| Description | description | NA   | NA         | NA


## Classification
This category describes where this learning object falls within a particular classification system.

| Field       | LOM         | LRMI | Schema.org | DC
| ----------- | ----------- | ---- | ---------- | --
| Purpose     | purpose     | NA   | NA         | NA
| Taxon Path  | --          | NA   | NA         | NA
|  └Source    | source      | NA   | NA         | NA
|  └Taxon     | --          | NA   | NA         | NA
|    └Id      | id          | NA   | NA         | NA
|    └Entry   | entry       | NA   | NA         | NA
| Description | description | NA   | NA         | NA
| Keyword     | keyword     | NA   | NA         | NA


== lrmi ==
AlignmentObject
└alignmentType
└educationalFramework
└targetDescription
└targetName
└targetUrl


EducationalAudience
└educationalRole






OLD: intendedEndUserRole
