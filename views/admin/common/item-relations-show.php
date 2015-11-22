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
        <?php else:
            echo common('item-relations-show-list', array(
                'item' => $item,
                'subjectRelations' => $subjectRelations,
                'objectRelations' => $objectRelations,
            ));
        endif; ?>
    </div>
</div>
