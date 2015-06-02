<?php
	// All code related to 'SIMULATION' and 'if (defined("SIMULATION"))'
	// is meant only to tickle the complexity to check scalability
	# DEFINE("SIMULATION", true); // uncomment this line to use simulation
	DEFINE("SIM_CATEGORIES",12);
	DEFINE("SIM_CATLEN",16);
	DEFINE("SIM_ITEMS",5000);
	DEFINE("SIM_ITEMLEN",48);
?>
<p>
<?php
$link = '<a href="' . url('item-relations/vocabularies/') . '">'
      . __('Browse Vocabularies') . '</a>';

echo __('Here you can relate this item to another item and delete existing '
     . 'relations. For descriptions of the relations, see the %s page. Invalid '
     . 'item IDs will be ignored.', $link
);
?>
</p>
<table>
    <thead>
    <tr>
        <th><?php echo __('Subject '); ?></th>
        <th><?php echo __('Relation'); ?></th>
        <th><?php echo __('Object'); ?></th>
        <th><?php echo __('Delete'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($subjectRelations as $subjectRelation): ?>
    <tr>
        <td><?php echo __('This Item'); ?></td>
        <td><?php echo $subjectRelation['relation_text']; ?></td>
        <td><a href="<?php echo url('items/show/' . $subjectRelation['object_item_id']); ?>" target="_blank"><?php echo $subjectRelation['object_item_title']; ?></a></td>
        <td><input type="checkbox" name="item_relations_item_relation_delete[]" value="<?php echo $subjectRelation['item_relation_id']; ?>" /></td>
    </tr>
    <?php endforeach; ?>
    <?php foreach ($objectRelations as $objectRelation): ?>
    <tr>
        <td><a href="<?php echo url('items/show/' . $objectRelation['subject_item_id']); ?>" target="_blank"><?php echo $objectRelation['subject_item_title']; ?></a></td>
        <td><?php echo $objectRelation['relation_text']; ?></td>
        <td><?php echo __('This Item'); ?></td>
        <td><input type="checkbox" name="item_relations_item_relation_delete[]" value="<?php echo $objectRelation['item_relation_id']; ?>" /></td>
    </tr>
    <?php endforeach; ?>
    <tr class="item-relations-entry">
        <td><?php echo __('This Item'); ?></td>
        <td><?php echo get_view()->formSelect('item_relations_property_id[]', null, array('multiple' => false), $formSelectProperties); ?></td>
        <td>
					<span class="item_relations_idbox">
						<?php echo __('Item ID'); ?><br>
						<a href="#" class="selectObjectIdHref">[<?php echo __('Select ID'); ?>]</a><br>
						<?php echo get_view()->formText('item_relations_item_relation_object_item_id[]', null, array('size' => 8)); ?>
					</span>
				</td>
        <td><span style="color:#ccc;"><?php echo __("[n/a]") ?></span></td>
    </tr>
    </tbody>
</table>
<button type="button" class="item-relations-add-relation"><?php echo __('Add a Relation'); ?></button>
<link href="<?php echo PUBLIC_BASE_URL; ?>/plugins/ItemRelations/lity/lity.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo PUBLIC_BASE_URL; ?>/plugins/ItemRelations/lity/lity.min.js"></script>
<link href="<?php echo PUBLIC_BASE_URL; ?>/plugins/ItemRelations/item_relations_styles.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo PUBLIC_BASE_URL; ?>/plugins/ItemRelations/item_relations_script.js"></script>
<?php
	$db = get_db();
	// Put all database items into JavaScript arrays, that will later be used via jQuery.
	echo "<script type='text/javascript'>\n";
	// --- 1. Fetch all item typs together with ther IDs and names
	if (defined("SIMULATION")) {
		$itemtypes=array();
		for($i=1; ($i<=SIM_CATEGORIES); $i++) { $itemtypes[]=array("id" => $i, "name" => substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, SIM_CATLEN)); }
	}
	else {
		$sql = "SELECT id, name from {$db->Item_Types} ORDER BY id";
		$itemtypes = $db->fetchAll($sql);
	}
	$lines=array();
	$lines[]="0:'".__("[n/a]")."'";
	foreach($itemtypes as $itemtyp) {
		$lines[]=$itemtyp["id"].":'".htmlspecialchars($itemtyp["name"], ENT_QUOTES)."'";
	}
	// JavaScript object
	echo "var itemTypes={\n".
				implode(",\n",$lines)."\n".
				"};\n";
	// --- 2. Fetch all items together with their IDs, titles, and item type IDs and names
	if (defined("SIMULATION")) {
		$items=array();
		for($i=1; ($i<=SIM_ITEMS); $i++) {
			$items[]=array($i, substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, SIM_ITEMLEN), rand(0,SIM_CATEGORIES), time()-rand(0,3600));
		}
		usort($items, function($a, $b) { return ( $a[2]!=$b[2] ? $a[2]-$b[2] : ( $a[1]!=$b[1] ? ($a[1]>$b[1] ? 1 : -1 ) : 0  ) ); } );
	}
	else {
		$sql = "SELECT items.id, text, item_type_id, UNIX_TIMESTAMP(modified)
						FROM {$db->Item} items
						LEFT JOIN {$db->Element_Texts} elementtexts on (items.id=elementtexts.record_id)
						WHERE elementtexts.element_id=50 and items.id<>".$item->id."
						ORDER BY items.item_type_id ASC, text ASC";
		$items = $db->fetchAll($sql);
	}
	// For efficiency, we use a regular JavaScript array  notation instead of JSON
	$lines=array();
	foreach($items as $item) {
		foreach (array_keys($item) as $key) {
			if (!$item[$key]) { $item[$key]=0; } # Transform all empty values to zero
			if (intval($item[$key])!==$item[$key]) { $item[$key]="'".htmlspecialchars($item[$key], ENT_QUOTES)."'"; } # Non-ints i.e. string into apostrophes
		}
		$lines[]="[[".implode("],[", $item)."]]"; # Item as a new array element - with its components in another array
	}
	echo "var allItemsArr=[\n".
				implode(",\n",$lines)."\n".
				"];\n";
	// --------
	echo "var itemTypesTxt='".__("Item Types")."';\n";
	echo "var allTxt='".__("All")."';\n";
	echo "var itemTypeTxt='".__("Item Type")."';\n";
	echo "var sortWithinItemTypeByTxt='".__("Sort within item types by")."';\n";
	echo "var updDateDescTxt='".__("Last Update (desc)")."';\n";
	echo "var nameAscTxt='".__("Name (asc)")."';\n";
	echo "var searchTermTxt='".__("Search Term")."';\n";
	echo "var resetTxt='".__("Reset")."';\n";
	echo "</script>\n";
	# echo "$sql<br>\n";
?>
<div id="lightboxJsContent" class="lity-hide"></div>