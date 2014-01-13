<?php
/**
 * Item Relations
 * @copyright Copyright 2010-2014 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */
 
return $formalVocabularies = array(
    array(
        'name' => 'Dublin Core',
        'description' => 'Relations defined by DCMI Metadata Terms: http://dublincore.org/documents/dcmi-terms/',
        'namespace_prefix' => 'dcterms',
        'namespace_uri' => 'http://purl.org/dc/terms/',
        'properties' => array(
            array(
                'local_part' => 'relation',
                'label' => 'Relation',
                'description' => 'A related resource.'
            ),
            array(
                'local_part' => 'conformsTo',
                'label' => 'Conforms To',
                'description' => 'An established standard to which the described resource conforms.'
            ),
            array(
                'local_part' => 'hasFormat',
                'label' => 'Has Format',
                'description' => 'A related resource that is substantially the same as the pre-existing described resource, but in another format.'
            ),
            array(
                'local_part' => 'hasPart',
                'label' => 'Has Part',
                'description' => 'A related resource that is included either physically or logically in the described resource.'
            ),
            array(
                'local_part' => 'hasVersion',
                'label' => 'Has Version',
                'description' => 'A related resource that is a version, edition, or adaptation of the described resource.'
            ),
            array(
                'local_part' => 'isFormatOf',
                'label' => 'Is Format Of',
                'description' => 'A related resource that is substantially the same as the described resource, but in another format.'
            ),
            array(
                'local_part' => 'isPartOf',
                'label' => 'Is Part Of',
                'description' => 'A related resource in which the described resource is physically or logically included.'
            ),
            array(
                'local_part' => 'isReferencedBy',
                'label' => 'Is Referenced By',
                'description' => 'A related resource that references, cites, or otherwise points to the described resource.'
            ),
            array(
                'local_part' => 'isReplacedBy',
                'label' => 'Is Replaced By',
                'description' => 'A related resource that supplants, displaces, or supersedes the described resource.'
            ),
            array(
                'local_part' => 'isRequiredBy',
                'label' => 'Is Required By',
                'description' => 'A related resource that requires the described resource to support its function, delivery, or coherence.'
            ),
            array(
                'local_part' => 'isVersionOf',
                'label' => 'Is Version Of',
                'description' => 'A related resource of which the described resource is a version, edition, or adaptation.'
            ),
            array(
                'local_part' => 'references',
                'label' => 'References',
                'description' => 'A related resource that is referenced, cited, or otherwise pointed to by the described resource.'
            ),
            array(
                'local_part' => 'replaces',
                'label' => 'Replaces',
                'description' => 'A related resource that is supplanted, displaced, or superseded by the described resource.'
            ),
            array(
                'local_part' => 'requires',
                'label' => 'Requires',
                'description' => 'A related resource that is required by the described resource to support its function, delivery, or coherence.'
            ),
            array(
                'local_part' => 'source',
                'label' => 'Source',
                'description' => 'A related resource from which the described resource is derived.'
            ),
            array(
                'local_part' => 'abstract',
                'label' => 'Abstract',
                'description' => 'A summary of the resource.'
            ),
            array(
                'local_part' => 'accessRights',
                'label' => 'Access Rights',
                'description' => 'Information about who can access the resource or an indication of its security status.'
            ),
            array(
                'local_part' => 'accrualMethod',
                'label' => 'Accrual Method',
                'description' => 'The method by which items are added to a collection.'
            ),
            array(
                'local_part' => 'accrualPeriodicity',
                'label' => 'Accrual Periodicity',
                'description' => 'The frequency with which items are added to a collection.'
            ),
            array(
                'local_part' => 'accrualPolicy',
                'label' => 'Accrual Policy',
                'description' => 'The policy governing the addition of items to a collection.'
            ),
            array(
                'local_part' => 'audience',
                'label' => 'Audience',
                'description' => 'A class of entity for whom the resource is intended or useful.'
            ),
            array(
                'local_part' => 'contributor',
                'label' => 'Contributor',
                'description' => 'An entity responsible for making contributions to the resource.'
            ),
            array(
                'local_part' => 'coverage',
                'label' => 'Coverage',
                'description' => 'The spatial or temporal topic of the resource, the spatial applicability of the resource, or the jurisdiction under which the resource is relevant.'
            ),
            array(
                'local_part' => 'creator',
                'label' => 'Creator',
                'description' => 'An entity primarily responsible for making the resource.'
            ),
            array(
                'local_part' => 'description',
                'label' => 'Description',
                'description' => 'An account of the resource.'
            ),
            array(
                'local_part' => 'educationLevel',
                'label' => 'Audience Education Level',
                'description' => 'A class of entity, defined in terms of progression through an educational or training context, for which the described resource is intended.'
            ),
            array(
                'local_part' => 'extent',
                'label' => 'Extent',
                'description' => 'The size or duration of the resource.'
            ),
            array(
                'local_part' => 'format',
                'label' => 'Format',
                'description' => 'The file format, physical medium, or dimensions of the resource.'
            ),
            array(
                'local_part' => 'instructionalMethod',
                'label' => 'Instructional Method',
                'description' => 'A process, used to engender knowledge, attitudes and skills, that the described resource is designed to support.'
            ),
            array(
                'local_part' => 'language',
                'label' => 'Language',
                'description' => 'A language of the resource.'
            ),
            array(
                'local_part' => 'license',
                'label' => 'License',
                'description' => 'A legal document giving official permission to do something with the resource.'
            ),
            array(
                'local_part' => 'mediator',
                'label' => 'Mediator',
                'description' => 'An entity that mediates access to the resource and for whom the resource is intended or useful.'
            ),
            array(
                'local_part' => 'medium',
                'label' => 'Medium',
                'description' => 'The material or physical carrier of the resource.'
            ),
            array(
                'local_part' => 'provenance',
                'label' => 'Provenance',
                'description' => 'A statement of any changes in ownership and custody of the resource since its creation that are significant for its authenticity, integrity, and interpretation.'
            ),
            array(
                'local_part' => 'publisher',
                'label' => 'Publisher',
                'description' => 'An entity responsible for making the resource available.'
            ),
            array(
                'local_part' => 'rights',
                'label' => 'Rights',
                'description' => 'Information about rights held in and over the resource.'
            ),
            array(
                'local_part' => 'rightsHolder',
                'label' => 'Rights Holder',
                'description' => 'A person or organization owning or managing rights over the resource.'
            ),
            array(
                'local_part' => 'spatial',
                'label' => 'Spatial Coverage',
                'description' => 'Spatial characteristics of the resource.'
            ),
            array(
                'local_part' => 'subject',
                'label' => 'Subject',
                'description' => 'The topic of the resource.'
            ),
            array(
                'local_part' => 'tableOfContents',
                'label' => 'Table Of Contents',
                'description' => 'A list of subunits of the resource.'
            ),
            array(
                'local_part' => 'temporal',
                'label' => 'Temporal Coverage',
                'description' => 'Temporal characteristics of the resource.'
            ),
            array(
                'local_part' => 'type',
                'label' => 'Type',
                'description' => 'The nature or genre of the resource.'
            ),
        )
    ),
    array(
        'name' => 'BIBO',
        'description' => 'Relations defined by the Bibliographic Ontology (BIBO): http://bibotools.googlecode.com/svn/bibo-ontology/trunk/doc/index.html',
        'namespace_prefix' => 'bibo',
        'namespace_uri' => 'http://purl.org/ontology/bibo/',
        'properties' => array(
            array(
                'local_part' => 'annotates',
                'label' => 'annotates',
                'description' => 'Critical or explanatory note for a Document.'
            ),
            array(
                'local_part' => 'citedBy',
                'label' => 'cited by',
                'description' => 'Relates a document to another document that cites the first document.'
            ),
            array(
                'local_part' => 'cites',
                'label' => 'cites',
                'description' => 'Relates a document to another document that is cited by the first document as reference, comment, review, quotation or for another purpose.'
            ),
            array(
                'local_part' => 'reviewOf',
                'label' => 'review of',
                'description' => 'Relates a review document to a reviewed thing (resource, item, etc.).'
            ),
            array(
                'local_part' => 'reproducedIn',
                'label' => 'reproduced in',
                'description' => 'The resource in which another resource is reproduced.'
            ),
            array(
                'local_part' => 'affirmedBy',
                'label' => 'affirmed by',
                'description' => 'A legal decision that affirms a ruling.'
            ),
            array(
                'local_part' => 'reversedBy',
                'label' => 'reversed by',
                'description' => 'A legal decision that reverses a ruling.'
            ),
            array(
                'local_part' => 'subsequentLegalDecision',
                'label' => 'subsequent legal decision',
                'description' => 'A legal decision on appeal that takes action on a case (affirming it, reversing it, etc.).'
            ),
            array(
                'local_part' => 'transcriptOf',
                'label' => 'transcript of',
                'description' => 'Relates a document to some transcribed original.'
            ),
            array(
                'local_part' => 'translationOf',
                'label' => 'translation of',
                'description' => 'Relates a translated document to the original document.'
            ),
        )
    ),
    array(
        'name' => 'FOAF',
        'description' => 'Relations defined by the Friend of a Friend vocabulary (FOAF): http://xmlns.com/foaf/spec/',
        'namespace_prefix' => 'foaf',
        'namespace_uri' => 'http://xmlns.com/foaf/0.1/',
        'properties' => array(
            array(
                'local_part' => 'based_near',
                'label' => 'based near',
                'description' => 'A location that something is based near, for some broadly human notion of near.'
            ),
            array(
                'local_part' => 'depiction',
                'label' => 'depiction',
                'description' => 'A depiction of some thing.'
            ),
            array(
                'local_part' => 'depicts',
                'label' => 'depicts',
                'description' => 'A thing depicted in this representation.'
            ),
            array(
                'local_part' => 'fundedBy',
                'label' => 'funded by',
                'description' => 'An organization funding a project or person.'
            ),
            array(
                'local_part' => 'img',
                'label' => 'image',
                'description' => 'An image that can be used to represent some thing (ie. those depictions which are particularly representative of something, eg. one\'s photo on a homepage).'
            ),
            array(
                'local_part' => 'isPrimaryTopicOf',
                'label' => 'is primary topic of',
                'description' => 'A document that this thing is the primary topic of.'
            ),
            array(
                'local_part' => 'knows',
                'label' => 'knows',
                'description' => 'A person known by this person (indicating some level of reciprocated interaction between the parties).'
            ),
            array(
                'local_part' => 'logo',
                'label' => 'logo',
                'description' => 'A logo representing some thing.'
            ),
            array(
                'local_part' => 'made',
                'label' => 'made',
                'description' => 'Something that was made by this agent.'
            ),
            array(
                'local_part' => 'maker',
                'label' => 'maker',
                'description' => 'An agent that made this thing.'
            ),
            array(
                'local_part' => 'member',
                'label' => 'member',
                'description' => 'Indicates a member of a Group.'
            ),
            array(
                'local_part' => 'page',
                'label' => 'page',
                'description' => 'A page or document about this thing.'
            ),
            array(
                'local_part' => 'primaryTopic',
                'label' => 'primary topic',
                'description' => 'The primary topic of some page or document.'
            ),
            array(
                'local_part' => 'thumbnail',
                'label' => 'thumbnail',
                'description' => 'A derived thumbnail image.'
            ),
        )
    ),
    array(
        'name' => 'FRBR',
        'description' => 'Relations defined by the Functional Requirements for Bibliographic Records (FRBR): http://vocab.org/frbr/core.html',
        'namespace_prefix' => 'frbr',
        'namespace_uri' => 'http://purl.org/vocab/frbr/core#',
        'properties' => array(
            array(
                'local_part' => 'abridgement',
                'label' => 'abridgement',
                'description' => 'A property representing an abridgment of an expression.'
            ),
            array(
                'local_part' => 'abridgementOf',
                'label' => 'abridgement of',
                'description' => 'A property representing an expression that is abridged.'
            ),
            array(
                'local_part' => 'adaption',
                'label' => 'adaption',
                'description' => 'A property representing an adaption of a work or expression.'
            ),
            array(
                'local_part' => 'adaptionOf',
                'label' => 'adaption of',
                'description' => 'A property representing a work or expression that is adapted.'
            ),
            array(
                'local_part' => 'alternate',
                'label' => 'alternate',
                'description' => 'A property representing an alternative to a manifestation.'
            ),
            array(
                'local_part' => 'alternateOf',
                'label' => 'alternate of',
                'description' => 'A property representing a manifestation that is alternated.'
            ),
            array(
                'local_part' => 'arrangement',
                'label' => 'arrangement',
                'description' => 'A property representing an arrangement of an expression.'
            ),
            array(
                'local_part' => 'arrangementOf',
                'label' => 'arrangement of',
                'description' => 'A property representing an expression that is arranged.'
            ),
            array(
                'local_part' => 'complement',
                'label' => 'complement',
                'description' => 'A property representing a complement to a work or expression.'
            ),
            array(
                'local_part' => 'complementOf',
                'label' => 'complement of',
                'description' => 'A property representing a work or expression that is complemented.'
            ),
            array(
                'local_part' => 'creator',
                'label' => 'creator',
                'description' => 'A property representing an entity in some way responsible for the creation of a work.'
            ),
            array(
                'local_part' => 'creatorOf',
                'label' => 'creator of',
                'description' => 'A property representing a work that was in some way created by of an entity.'
            ),
            array(
                'local_part' => 'embodiment',
                'label' => 'embodiment',
                'description' => 'A property representing a manifestation that embodies an expression.'
            ),
            array(
                'local_part' => 'embodimentOf',
                'label' => 'embodiment of',
                'description' => 'A property representing an expression that is embodied by a manifestation.'
            ),
            array(
                'local_part' => 'exemplar',
                'label' => 'exemplar',
                'description' => 'A property representing an item that is an exemplar of a manifestation.'
            ),
            array(
                'local_part' => 'exemplarOf',
                'label' => 'exemplar of',
                'description' => 'A property representing the manifestation that is exemplified by a item.'
            ),
            array(
                'local_part' => 'imitation',
                'label' => 'imitation',
                'description' => 'A property representing an imitation of a work or expression.'
            ),
            array(
                'local_part' => 'imitationOf',
                'label' => 'imitation of',
                'description' => 'A property representing a work or expression that is imitated.'
            ),
            array(
                'local_part' => 'owner',
                'label' => 'owner',
                'description' => 'A property representing an entity that owns an item.'
            ),
            array(
                'local_part' => 'ownerOf',
                'label' => 'owner of',
                'description' => 'A property representing an item that is in some way owned an entity.'
            ),
            array(
                'local_part' => 'part',
                'label' => 'part',
                'description' => 'A property representing a part of an endeavour.'
            ),
            array(
                'local_part' => 'partOf',
                'label' => 'part of',
                'description' => 'A property representing an endeavour incorporating an endeavour.'
            ),
            array(
                'local_part' => 'producer',
                'label' => 'producer',
                'description' => 'A property representing an entity in some way responsible for producing a manifestation.'
            ),
            array(
                'local_part' => 'producerOf',
                'label' => 'producer of',
                'description' => 'A property representing a manifestation that was in some way produced an entity.'
            ),
            array(
                'local_part' => 'realization',
                'label' => 'realization',
                'description' => 'A property representing an expression that is an intellectual or artistic realization of a work.'
            ),
            array(
                'local_part' => 'realizationOf',
                'label' => 'realization of',
                'description' => 'A property representing the work that has been realized by an expression.'
            ),
            array(
                'local_part' => 'realizer',
                'label' => 'realizer',
                'description' => 'A property representing an entity in some way responsible for realizing an expression.'
            ),
            array(
                'local_part' => 'realizerOf',
                'label' => 'realizer of',
                'description' => 'A property representing an expression that was in some way realized by an entity.'
            ),
            array(
                'local_part' => 'reconfiguration',
                'label' => 'reconfiguration',
                'description' => 'A property representing a recongifuration of an item.'
            ),
            array(
                'local_part' => 'reconfigurationOf',
                'label' => 'reconfiguration of',
                'description' => 'A property representing an item that is reconfigured.'
            ),
            array(
                'local_part' => 'relatedEndeavour',
                'label' => 'related endeavour',
                'description' => 'A property representing another endeavour that is related in some way to an endeavour.'
            ),
            array(
                'local_part' => 'reproduction',
                'label' => 'reproduction',
                'description' => 'A property representing a reproduction of a manifestation or item.'
            ),
            array(
                'local_part' => 'reproductionOf',
                'label' => 'reproduction of',
                'description' => 'A property representing a manifestation or item that is reproduced.'
            ),
            array(
                'local_part' => 'responsibleEntity',
                'label' => 'responsible entity',
                'description' => 'A property representing an entity in some way responsible for an endeavour.'
            ),
            array(
                'local_part' => 'responsibleEntityOf',
                'label' => 'responsible entity of',
                'description' => 'A property representing an endeavour that is the responsibility of an entity.'
            ),
            array(
                'local_part' => 'revision',
                'label' => 'revision',
                'description' => 'A property representing a revision of an expression.'
            ),
            array(
                'local_part' => 'revisionOf',
                'label' => 'revision of',
                'description' => 'A property representing an expression that is revised.'
            ),
            array(
                'local_part' => 'successor',
                'label' => 'successor',
                'description' => 'A property representing a successor to a work or expression.'
            ),
            array(
                'local_part' => 'successorOf',
                'label' => 'successor of',
                'description' => 'A property representing a work or expression that is succeeded.'
            ),
            array(
                'local_part' => 'summarization',
                'label' => 'summarization',
                'description' => 'A property representing a summarization of a work or expression.'
            ),
            array(
                'local_part' => 'summarizationOf',
                'label' => 'summarization of',
                'description' => 'A property representing a work or expression that is summarized.'
            ),
            array(
                'local_part' => 'supplement',
                'label' => 'supplement',
                'description' => 'A property representing a supplement to a work or expression.'
            ),
            array(
                'local_part' => 'supplementOf',
                'label' => 'supplement of',
                'description' => 'A property representing a work or expression that is supplemented.'
            ),
            array(
                'local_part' => 'transformation',
                'label' => 'transformation',
                'description' => 'A property representing a transformation of a work or expression.'
            ),
            array(
                'local_part' => 'transformationOf',
                'label' => 'transformation of',
                'description' => 'A property representing a work or expression that is transformed.'
            ),
            array(
                'local_part' => 'translation',
                'label' => 'translation',
                'description' => 'A property representing a translation of an expression.'
            ),
            array(
                'local_part' => 'translationOf',
                'label' => 'translation of',
                'description' => 'A property representing an expression that is translated.'
            ),
        )
    ),
);
