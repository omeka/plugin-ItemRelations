<?php
	$adminSidebarOrMaincontent = get_option('item_relations_admin_sidebar_or_maincontent');
	$h4h2 = ($adminSidebarOrMaincontent == "maincontent" ? "2" : "4");
	$relationsclass = ($adminSidebarOrMaincontent == "maincontent" ? "element_set" : "item-relations panel");

	$subjectRelations = $objectRelations = $allRelations = false;
	$mode = get_option('item_relations_admin_display_mode') ?: 'table';
	if ($mode == "list-by-item-type") {
		$subjectRelations = ItemRelationsPlugin::prepareSubjectRelations($item);
		$objectRelations = ItemRelationsPlugin::prepareObjectRelations($item);
	}
	else {
		$allRelations = ItemRelationsPlugin::prepareAllRelations($item);
	}
	$noRelations = ( !$subjectRelations && !$objectRelations && !$allRelations );
?>
<div class="<?php echo $relationsclass; ?>">
    <h<?php echo $h4h2; ?>><?php echo __('Item Relations'); ?></h<?php echo $h4h2; ?>>
    <div>
        <?php if ($noRelations): ?>
        <p><?php echo __('This item has no relations.'); ?></p>
        <?php else:
            echo common('item-relations-show-' . $mode, array(
                'item' => $item,
                'subjectRelations' => $subjectRelations,
                'objectRelations' => $objectRelations,
								'allRelations' => $allRelations,
            ));
        endif; ?>
    </div>
</div>
