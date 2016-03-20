<?php
/**
 * Item Relations
 * LookupController
 * @copyright 2015 Michael Slone
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * Lookup controller.
 */
class ItemRelations_LookupController extends Omeka_Controller_AbstractActionController
{
    public function indexAction()
    {
        $db = get_db();

        if (!$this->_hasParam('subject_id')) {
            $this->_setParam('subject_id', -1);
        }
        if (!$this->_hasParam('partial')) {
            $this->_setParam('partial', '');
        }
        if (!$this->_hasParam('item_type')) {
            $this->_setParam('item_type', -1);
        }
        if (!$this->_hasParam('collection')) {
            $this->_setParam('collection', -1);
        }
        if (!$this->_hasParam('sort')) {
            $this->_setParam('sort', 'mod_desc');
        }
        if (!$this->_hasParam('page')) {
            $this->_setParam('page', 0);
        }
        if (!$this->_hasParam('per_page')) {
            $this->_setParam('per_page', 15);
        }

        $subject_id = intval($this->_getParam('subject_id'));
        $where_subject_id = '';
        if ($subject_id > 0) {
            $where_subject_id = "AND items.id != $subject_id";
        }

        $partial = preg_replace('/[^ \.,\!\?\p{L}\p{N}\p{Mc}]/ui', '', $this->_getParam('partial'));
        $where_text = '';
        if (strlen($partial) > 0) {
            $where_text = 'AND text RLIKE ' . $db->quote($partial);
        }

        $item_type = intval($this->_getParam('item_type'));
        $where_item_type = '';
        if ($item_type > 0) {
            $where_item_type = "AND items.item_type_id = $item_type";
        }

        $collection = intval($this->_getParam('collection'));
        $where_collection = '';
        if ($collection > 0) {
            $where_collection = "AND items.collection_id = $collection";
        }

        $per_page = intval($this->_getParam('per_page'));
        $page = intval($this->_getParam('page'));
        $offset = $page * $per_page;

        $order_clause = 'ORDER BY items.item_type_id ASC, text ASC';
        switch ($this->_getParam('sort')) {
        case 'mod_desc':
            $order_clause = 'ORDER BY UNIX_TIMESTAMP(modified) DESC, items.item_type_id ASC, text ASC';
            break;
        case 'mod_asc':
            $order_clause = 'ORDER BY UNIX_TIMESTAMP(modified) ASC, items.item_type_id ASC, text ASC';
            break;
        case 'alpha_desc':
            $order_clause = 'ORDER BY items.item_type_id ASC, text DESC';
            break;
        case 'alpha_asc':
            $order_clause = 'ORDER BY items.item_type_id ASC, text ASC';
            break;
        default:
            /* do nothing */
            break;
        }

        $titleId = 50;
        $query = <<<QCOUNT
SELECT count(*) AS count
FROM {$db->Item} items
LEFT JOIN {$db->Element_Texts} elementtexts
ON (items.id = elementtexts.record_id) AND (elementtexts.record_type = 'Item')
WHERE elementtexts.element_id = $titleId
$where_subject_id
$where_item_type
$where_collection
$where_text
GROUP BY elementtexts.record_id
QCOUNT;
        $m_count = count($db->fetchAll($query));

        $max_page = floor($m_count / $per_page);
        if ($page > $max_page) {
            $page = $max_page;
            $offset = $page * $per_page;
        }

        $query = <<<QUERY
SELECT items.id AS id, text
FROM {$db->Item} items
LEFT JOIN {$db->Element_Texts} elementtexts
ON (items.id = elementtexts.record_id) AND (elementtexts.record_type = 'Item')
WHERE elementtexts.element_id = $titleId
$where_subject_id
$where_item_type
$where_collection
$where_text
GROUP BY elementtexts.record_id
$order_clause
LIMIT $per_page
OFFSET $offset
QUERY;
        $items = $db->fetchAll($query);
        $m_items = array();

        foreach ($items as $item) {
            $m_items[] = array(
                'value' => $item['id'],
                'label' => $item['text'],
            );
        }

        $metadata = array(
            'count' => $m_count,
            'items' => $m_items,
        );

        $this->_helper->json($metadata);
    }
}
