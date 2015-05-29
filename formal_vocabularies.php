<?php
/**
 * Item Relations
 * @copyright Copyright 2010-2014 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */
 
return $formalVocabularies = array(
    array(
        'name' => 'Dublin Core',
        'description' => __('Relations defined by DCMI Metadata Terms: http://dublincore.org/documents/dcmi-terms/'),
        'namespace_prefix' => 'dcterms',
        'namespace_uri' => 'http://purl.org/dc/terms/',
        'properties' => array(
            array(
                'local_part' => 'relation',
                'label' => __('Relation'),
                'description' => __('A related resource.')
            ),
            array(
                'local_part' => 'conformsTo',
                'label' => __('Conforms To'),
                'description' => __('An established standard to which the described resource conforms.')
            ),
            array(
                'local_part' => 'hasFormat',
                'label' => __('Has Format'),
                'description' => __('A related resource that is substantially the same as the pre-existing described resource, but in another format.')
            ),
            array(
                'local_part' => 'hasPart',
                'label' => __('Has Part'),
                'description' => __('A related resource that is included either physically or logically in the described resource.')
            ),
            array(
                'local_part' => 'hasVersion',
                'label' => __('Has Version'),
                'description' => __('A related resource that is a version, edition, or adaptation of the described resource.')
            ),
            array(
                'local_part' => 'isFormatOf',
                'label' => __('Is Format Of'),
                'description' => __('A related resource that is substantially the same as the described resource, but in another format.')
            ),
            array(
                'local_part' => 'isPartOf',
                'label' => __('Is Part Of'),
                'description' => __('A related resource in which the described resource is physically or logically included.')
            ),
            array(
                'local_part' => 'isReferencedBy',
                'label' => __('Is Referenced By'),
                'description' => __('A related resource that references, cites, or otherwise points to the described resource.')
            ),
            array(
                'local_part' => 'isReplacedBy',
                'label' => __('Is Replaced By'),
                'description' => __('A related resource that supplants, displaces, or supersedes the described resource.')
            ),
            array(
                'local_part' => 'isRequiredBy',
                'label' => __('Is Required By'),
                'description' => __('A related resource that requires the described resource to support its function, delivery, or coherence.')
            ),
            array(
                'local_part' => 'isVersionOf',
                'label' => __('Is Version Of'),
                'description' => __('A related resource of which the described resource is a version, edition, or adaptation.')
            ),
            array(
                'local_part' => 'references',
                'label' => __('References'),
                'description' => __('A related resource that is referenced, cited, or otherwise pointed to by the described resource.')
            ),
            array(
                'local_part' => 'replaces',
                'label' => __('Replaces'),
                'description' => __('A related resource that is supplanted, displaced, or superseded by the described resource.')
            ),
            array(
                'local_part' => 'requires',
                'label' => __('Requires'),
                'description' => __('A related resource that is required by the described resource to support its function, delivery, or coherence.')
            ),
            array(
                'local_part' => 'source',
                'label' => __('Source'),
                'description' => __('A related resource from which the described resource is derived.')
            ),
            array(
                'local_part' => 'abstract',
                'label' => __('Abstract'),
                'description' => __('A summary of the resource.')
            ),
            array(
                'local_part' => 'accessRights',
                'label' => __('Access Rights'),
                'description' => __('Information about who can access the resource or an indication of its security status.')
            ),
            array(
                'local_part' => 'accrualMethod',
                'label' => __('Accrual Method'),
                'description' => __('The method by which items are added to a collection.')
            ),
            array(
                'local_part' => 'accrualPeriodicity',
                'label' => __('Accrual Periodicity'),
                'description' => __('The frequency with which items are added to a collection.')
            ),
            array(
                'local_part' => 'accrualPolicy',
                'label' => __('Accrual Policy'),
                'description' => __('The policy governing the addition of items to a collection.')
            ),
            array(
                'local_part' => 'audience',
                'label' => __('Audience'),
                'description' => __('A class of entity for whom the resource is intended or useful.')
            ),
            array(
                'local_part' => 'contributor',
                'label' => __('Contributor'),
                'description' => __('An entity responsible for making contributions to the resource.')
            ),
            array(
                'local_part' => 'coverage',
                'label' => __('Coverage'),
                'description' => __('The spatial or temporal topic of the resource, the spatial applicability of the resource, or the jurisdiction under which the resource is relevant.')
            ),
            array(
                'local_part' => 'creator',
                'label' => __('Creator'),
                'description' => __('An entity primarily responsible for making the resource.')
            ),
            array(
                'local_part' => 'description',
                'label' => __('Description'),
                'description' => __('An account of the resource.')
            ),
            array(
                'local_part' => 'educationLevel',
                'label' => __('Audience Education Level'),
                'description' => __('A class of entity, defined in terms of progression through an educational or training context, for which the described resource is intended.')
            ),
            array(
                'local_part' => 'extent',
                'label' => __('Extent'),
                'description' => __('The size or duration of the resource.')
            ),
            array(
                'local_part' => 'format',
                'label' => __('Format'),
                'description' => __('The file format, physical medium, or dimensions of the resource.')
            ),
            array(
                'local_part' => 'instructionalMethod',
                'label' => __('Instructional Method'),
                'description' => __('A process, used to engender knowledge, attitudes and skills, that the described resource is designed to support.')
            ),
            array(
                'local_part' => 'language',
                'label' => __('Language'),
                'description' => __('A language of the resource.')
            ),
            array(
                'local_part' => 'license',
                'label' => __('License'),
                'description' => __('A legal document giving official permission to do something with the resource.')
            ),
            array(
                'local_part' => 'mediator',
                'label' => __('Mediator'),
                'description' => __('An entity that mediates access to the resource and for whom the resource is intended or useful.')
            ),
            array(
                'local_part' => 'medium',
                'label' => __('Medium'),
                'description' => __('The material or physical carrier of the resource.')
            ),
            array(
                'local_part' => 'provenance',
                'label' => __('Provenance'),
                'description' => __('A statement of any changes in ownership and custody of the resource since its creation that are significant for its authenticity, integrity, and interpretation.')
            ),
            array(
                'local_part' => 'publisher',
                'label' => __('Publisher'),
                'description' => __('An entity responsible for making the resource available.')
            ),
            array(
                'local_part' => 'rights',
                'label' => __('Rights'),
                'description' => __('Information about rights held in and over the resource.')
            ),
            array(
                'local_part' => 'rightsHolder',
                'label' => __('Rights Holder'),
                'description' => __('A person or organization owning or managing rights over the resource.')
            ),
            array(
                'local_part' => 'spatial',
                'label' => __('Spatial Coverage'),
                'description' => __('Spatial characteristics of the resource.')
            ),
            array(
                'local_part' => 'subject',
                'label' => __('Subject '),
                'description' => __('The topic of the resource.')
            ),
            array(
                'local_part' => 'tableOfContents',
                'label' => __('Table Of Contents'),
                'description' => __('A list of subunits of the resource.')
            ),
            array(
                'local_part' => 'temporal',
                'label' => __('Temporal Coverage'),
                'description' => __('Temporal characteristics of the resource.')
            ),
            array(
                'local_part' => 'type',
                'label' => __('Type'),
                'description' => __('The nature or genre of the resource.')
            ),
        )
    ),
    array(
        'name' => 'BIBO',
        'description' => __('Relations defined by the Bibliographic Ontology (BIBO): http://bibotools.googlecode.com/svn/bibo-ontology/trunk/doc/index.html'),
        'namespace_prefix' => 'bibo',
        'namespace_uri' => 'http://purl.org/ontology/bibo/',
        'properties' => array(
            array(
                'local_part' => 'annotates',
                'label' => __('annotates'),
                'description' => __('Critical or explanatory note for a Document.')
            ),
            array(
                'local_part' => 'citedBy',
                'label' => __('cited by'),
                'description' => __('Relates a document to another document that cites the first document.')
            ),
            array(
                'local_part' => 'cites',
                'label' => __('cites'),
                'description' => __('Relates a document to another document that is cited by the first document as reference, comment, review, quotation or for another purpose.')
            ),
            array(
                'local_part' => 'reviewOf',
                'label' => __('review of'),
                'description' => __('Relates a review document to a reviewed thing (resource, item, etc.).')
            ),
            array(
                'local_part' => 'reproducedIn',
                'label' => __('reproduced in'),
                'description' => __('The resource in which another resource is reproduced.')
            ),
            array(
                'local_part' => 'affirmedBy',
                'label' => __('affirmed by'),
                'description' => __('A legal decision that affirms a ruling.')
            ),
            array(
                'local_part' => 'reversedBy',
                'label' => __('reversed by'),
                'description' => __('A legal decision that reverses a ruling.')
            ),
            array(
                'local_part' => 'subsequentLegalDecision',
                'label' => __('subsequent legal decision'),
                'description' => __('A legal decision on appeal that takes action on a case (affirming it, reversing it, etc.).')
            ),
            array(
                'local_part' => 'transcriptOf',
                'label' => __('transcript of'),
                'description' => __('Relates a document to some transcribed original.')
            ),
            array(
                'local_part' => 'translationOf',
                'label' => __('translation of'),
                'description' => __('Relates a translated document to the original document.')
            ),
        )
    ),
    array(
        'name' => 'FOAF',
        'description' => __('Relations defined by the Friend of a Friend vocabulary (FOAF): http://xmlns.com/foaf/spec/'),
        'namespace_prefix' => 'foaf',
        'namespace_uri' => 'http://xmlns.com/foaf/0.1/',
        'properties' => array(
            array(
                'local_part' => 'based_near',
                'label' => __('based near'),
                'description' => __('A location that something is based near, for some broadly human notion of near.')
            ),
            array(
                'local_part' => 'depiction',
                'label' => __('depiction'),
                'description' => __('A depiction of some thing.')
            ),
            array(
                'local_part' => 'depicts',
                'label' => __('depicts'),
                'description' => __('A thing depicted in this representation.')
            ),
            array(
                'local_part' => 'fundedBy',
                'label' => __('funded by'),
                'description' => __('An organization funding a project or person.')
            ),
            array(
                'local_part' => 'img',
                'label' => __('image'),
                'description' => __('An image that can be used to represent some thing (ie. those depictions which are particularly representative of something, eg. one\'s photo on a homepage).')
            ),
            array(
                'local_part' => 'isPrimaryTopicOf',
                'label' => __('is primary topic of'),
                'description' => __('A document that this thing is the primary topic of.')
            ),
            array(
                'local_part' => 'knows',
                'label' => __('knows'),
                'description' => __('A person known by this person (indicating some level of reciprocated interaction between the parties).')
            ),
            array(
                'local_part' => 'logo',
                'label' => __('logo'),
                'description' => __('A logo representing some thing.')
            ),
            array(
                'local_part' => 'made',
                'label' => __('made'),
                'description' => __('Something that was made by this agent.')
            ),
            array(
                'local_part' => 'maker',
                'label' => __('maker'),
                'description' => __('An agent that made this thing.')
            ),
            array(
                'local_part' => 'member',
                'label' => __('member'),
                'description' => __('Indicates a member of a Group.')
            ),
            array(
                'local_part' => 'page',
                'label' => __('page'),
                'description' => __('A page or document about this thing.')
            ),
            array(
                'local_part' => 'primaryTopic',
                'label' => __('primary topic'),
                'description' => __('The primary topic of some page or document.')
            ),
            array(
                'local_part' => 'thumbnail',
                'label' => __('thumbnail'),
                'description' => __('A derived thumbnail image.')
            ),
        )
    ),
    array(
        'name' => 'FRBR',
        'description' => __('Relations defined by the Functional Requirements for Bibliographic Records (FRBR): http://vocab.org/frbr/core.html'),
        'namespace_prefix' => 'frbr',
        'namespace_uri' => 'http://purl.org/vocab/frbr/core#',
        'properties' => array(
            array(
                'local_part' => 'abridgement',
                'label' => __('abridgement'),
                'description' => __('A property representing an abridgment of an expression.')
            ),
            array(
                'local_part' => 'abridgementOf',
                'label' => __('abridgement of'),
                'description' => __('A property representing an expression that is abridged.')
            ),
            array(
                'local_part' => 'adaption',
                'label' => __('adaption'),
                'description' => __('A property representing an adaption of a work or expression.')
            ),
            array(
                'local_part' => 'adaptionOf',
                'label' => __('adaption of'),
                'description' => __('A property representing a work or expression that is adapted.')
            ),
            array(
                'local_part' => 'alternate',
                'label' => __('alternate'),
                'description' => __('A property representing an alternative to a manifestation.')
            ),
            array(
                'local_part' => 'alternateOf',
                'label' => __('alternate of'),
                'description' => __('A property representing a manifestation that is alternated.')
            ),
            array(
                'local_part' => 'arrangement',
                'label' => __('arrangement'),
                'description' => __('A property representing an arrangement of an expression.')
            ),
            array(
                'local_part' => 'arrangementOf',
                'label' => __('arrangement of'),
                'description' => __('A property representing an expression that is arranged.')
            ),
            array(
                'local_part' => 'complement',
                'label' => __('complement'),
                'description' => __('A property representing a complement to a work or expression.')
            ),
            array(
                'local_part' => 'complementOf',
                'label' => __('complement of'),
                'description' => __('A property representing a work or expression that is complemented.')
            ),
            array(
                'local_part' => 'creator',
                'label' => __('creator'),
                'description' => __('A property representing an entity in some way responsible for the creation of a work.')
            ),
            array(
                'local_part' => 'creatorOf',
                'label' => __('creator of'),
                'description' => __('A property representing a work that was in some way created by of an entity.')
            ),
            array(
                'local_part' => 'embodiment',
                'label' => __('embodiment'),
                'description' => __('A property representing a manifestation that embodies an expression.')
            ),
            array(
                'local_part' => 'embodimentOf',
                'label' => __('embodiment of'),
                'description' => __('A property representing an expression that is embodied by a manifestation.')
            ),
            array(
                'local_part' => 'exemplar',
                'label' => __('exemplar'),
                'description' => __('A property representing an item that is an exemplar of a manifestation.')
            ),
            array(
                'local_part' => 'exemplarOf',
                'label' => __('exemplar of'),
                'description' => __('A property representing the manifestation that is exemplified by a item.')
            ),
            array(
                'local_part' => 'imitation',
                'label' => __('imitation'),
                'description' => __('A property representing an imitation of a work or expression.')
            ),
            array(
                'local_part' => 'imitationOf',
                'label' => __('imitation of'),
                'description' => __('A property representing a work or expression that is imitated.')
            ),
            array(
                'local_part' => 'owner',
                'label' => __('owner'),
                'description' => __('A property representing an entity that owns an item.')
            ),
            array(
                'local_part' => 'ownerOf',
                'label' => __('owner of'),
                'description' => __('A property representing an item that is in some way owned an entity.')
            ),
            array(
                'local_part' => 'part',
                'label' => __('part'),
                'description' => __('A property representing a part of an endeavour.')
            ),
            array(
                'local_part' => 'partOf',
                'label' => __('part of'),
                'description' => __('A property representing an endeavour incorporating an endeavour.')
            ),
            array(
                'local_part' => 'producer',
                'label' => __('producer'),
                'description' => __('A property representing an entity in some way responsible for producing a manifestation.')
            ),
            array(
                'local_part' => 'producerOf',
                'label' => __('producer of'),
                'description' => __('A property representing a manifestation that was in some way produced an entity.')
            ),
            array(
                'local_part' => 'realization',
                'label' => __('realization'),
                'description' => __('A property representing an expression that is an intellectual or artistic realization of a work.')
            ),
            array(
                'local_part' => 'realizationOf',
                'label' => __('realization of'),
                'description' => __('A property representing the work that has been realized by an expression.')
            ),
            array(
                'local_part' => 'realizer',
                'label' => __('realizer'),
                'description' => __('A property representing an entity in some way responsible for realizing an expression.')
            ),
            array(
                'local_part' => 'realizerOf',
                'label' => __('realizer of'),
                'description' => __('A property representing an expression that was in some way realized by an entity.')
            ),
            array(
                'local_part' => 'reconfiguration',
                'label' => __('reconfiguration'),
                'description' => __('A property representing a recongifuration of an item.')
            ),
            array(
                'local_part' => 'reconfigurationOf',
                'label' => __('reconfiguration of'),
                'description' => __('A property representing an item that is reconfigured.')
            ),
            array(
                'local_part' => 'relatedEndeavour',
                'label' => __('related endeavour'),
                'description' => __('A property representing another endeavour that is related in some way to an endeavour.')
            ),
            array(
                'local_part' => 'reproduction',
                'label' => __('reproduction'),
                'description' => __('A property representing a reproduction of a manifestation or item.')
            ),
            array(
                'local_part' => 'reproductionOf',
                'label' => __('reproduction of'),
                'description' => __('A property representing a manifestation or item that is reproduced.')
            ),
            array(
                'local_part' => 'responsibleEntity',
                'label' => __('responsible entity'),
                'description' => __('A property representing an entity in some way responsible for an endeavour.')
            ),
            array(
                'local_part' => 'responsibleEntityOf',
                'label' => __('responsible entity of'),
                'description' => __('A property representing an endeavour that is the responsibility of an entity.')
            ),
            array(
                'local_part' => 'revision',
                'label' => __('revision'),
                'description' => __('A property representing a revision of an expression.')
            ),
            array(
                'local_part' => 'revisionOf',
                'label' => __('revision of'),
                'description' => __('A property representing an expression that is revised.')
            ),
            array(
                'local_part' => 'successor',
                'label' => __('successor'),
                'description' => __('A property representing a successor to a work or expression.')
            ),
            array(
                'local_part' => 'successorOf',
                'label' => __('successor of'),
                'description' => __('A property representing a work or expression that is succeeded.')
            ),
            array(
                'local_part' => 'summarization',
                'label' => __('summarization'),
                'description' => __('A property representing a summarization of a work or expression.')
            ),
            array(
                'local_part' => 'summarizationOf',
                'label' => __('summarization of'),
                'description' => __('A property representing a work or expression that is summarized.')
            ),
            array(
                'local_part' => 'supplement',
                'label' => __('supplement'),
                'description' => __('A property representing a supplement to a work or expression.')
            ),
            array(
                'local_part' => 'supplementOf',
                'label' => __('supplement of'),
                'description' => __('A property representing a work or expression that is supplemented.')
            ),
            array(
                'local_part' => 'transformation',
                'label' => __('transformation'),
                'description' => __('A property representing a transformation of a work or expression.')
            ),
            array(
                'local_part' => 'transformationOf',
                'label' => __('transformation of'),
                'description' => __('A property representing a work or expression that is transformed.')
            ),
            array(
                'local_part' => 'translation',
                'label' => __('translation'),
                'description' => __('A property representing a translation of an expression.')
            ),
            array(
                'local_part' => 'translationOf',
                'label' => __('translation of'),
                'description' => __('A property representing an expression that is translated.')
            ),
        )
    ),
);
