<?php $provideRelationComments = get_option('item_relations_provide_relation_comments'); ?>
<?php
	$adminSidebarOrMaincontent = get_option('item_relations_admin_sidebar_or_maincontent');
	$h4h2 = ($adminSidebarOrMaincontent == "maincontent" ? "2" : "4");
	$relationsclass = ($adminSidebarOrMaincontent == "maincontent" ? "element_set" : "item-relations panel");
?>
<div class="<?php echo $relationsclass; ?>">
    <h<?php echo $h4h2; ?>><?php echo __('Item Relations'); ?></h<?php echo $h4h2; ?>>
    <div>
        <?php if (!$subjectRelations && !$objectRelations): ?>
        <p><?php echo __('This item has no relations.'); ?></p>
        <?php else: ?>
        <ul>
            <?php foreach ($subjectRelations as $subjectRelation): ?>
            <li>
                <?php echo __('This Item'); ?>
                <strong><?php echo $subjectRelation['relation_text']; ?></strong>
                <a href="<?php echo url('items/show/' . $subjectRelation['object_item_id']); ?>"><?php echo $subjectRelation['object_item_title']; ?></a>
                <?php
                  if ( ($provideRelationComments) and ($subjectRelation['relation_comment']) ):
                    echo "(".$subjectRelation['relation_comment'].")";
                  endif;
                ?>
            </li>
            <?php endforeach; ?>
            <?php foreach ($objectRelations as $objectRelation): ?>
            <li>
                <a href="<?php echo url('items/show/' . $objectRelation['subject_item_id']); ?>"><?php echo $objectRelation['subject_item_title']; ?></a>
                <strong><?php echo $objectRelation['relation_text']; ?></strong>
                <?php echo __('This Item'); ?>
                <?php
                  if ( ($provideRelationComments) and ($objectRelation['relation_comment']) ):
                    echo "(".$objectRelation['relation_comment'].")";
                  endif;
                ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>
