<?php
/**
 * Item Relations
 * @copyright 2015 Michael Slone
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * Lookup controller.
 */
class ItemRelations_LookupController extends Omeka_Controller_AbstractActionController
{
    public function indexAction() {
        if (!$this->_hasParam('partial')) {
            $this->_setParam('partial', '');
        }
        if (!$this->_hasParam('item_type')) {
            $this->_setParam('item_type', -1);
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

        $partial = preg_replace('/[^\p{L}\p{N}\p{Mc}]/ui', '', $this->_getParam('partial'));
        $where_text = '';
        if (strlen($partial) > 0) {
            $where_text = "AND text RLIKE '$partial'";
        }

        $item_type = intval($this->_getParam('item_type'));
        $where_item_type = '';
        if ($item_type > 0) {
            $where_item_type = "AND items.item_type_id = $item_type";
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

        $title = 50;
        $db = get_db();
#SELECT items.id AS id, text, item_type_id, UNIX_TIMESTAMP(modified)
        $query = <<<QUERY
SELECT items.id AS id, text
FROM {$db->Item} items
LEFT JOIN {$db->Element_Texts} elementtexts
ON (items.id = elementtexts.record_id)
WHERE elementtexts.element_id = $title
$where_item_type
$where_text
GROUP BY elementtexts.record_id
$order_clause
LIMIT $per_page
OFFSET $offset
QUERY;
        $items = $db->fetchAll($query);
        $metadata = array(
            'response' => array(
                'numFound' => count($items),
                'docs' => array(),
            ),
        );
        foreach ($items as $item) {
            $metadata['response']['docs'][] = array(
                'id' => $item['id'],
                'text' => $item['text'],
            );
        }

        $this->view->metadata = $metadata;
    }
}
