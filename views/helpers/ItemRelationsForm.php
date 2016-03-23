<?php
/**
 * Helper to display the Item Relations Form.
 */
class ItemRelations_View_Helper_ItemRelationsForm extends Zend_View_Helper_Abstract
{
    /**
     * Returns the form code to add item relations.
     *
     * @param Item $item
     * @return string Html string.
     */
    public function itemRelationsForm($item)
    {
        $view = $this->view;
        $db = get_db();

        $html = $view->partial('common/item-relations-form.php', array(
            'item' => $item,
            'provideRelationComments' => get_option('item_relations_provide_relation_comments'),
            'formSelectProperties' => get_table_options('ItemRelationsProperty'),
            'allRelations' => ItemRelationsPlugin::prepareAllRelations($item),
        ));

        if (!defined("LITYLOADED")) {
          $html .= '<link href="' . css_src('lity.min', 'javascripts/lity') . '" rel="stylesheet">';
          $html .= js_tag('lity.min', $dir = 'javascripts/lity');
          DEFINE("LITYLOADED", 1);
        }
        $html .= '<link href="' . css_src('item-relations') . '" rel="stylesheet">';
        $html .= '<script type="text/javascript">';
        $html .= 'var url = ' . json_encode(url('item-relations/lookup/')) . ';';
        $html .= 'var itemRelationsSearchAndSelect = ' . json_encode(__('[Search and Select Below]')) . ';';
        $html .= '</script>';
        $html .= js_tag('item-relations');

        return $html;
    }
}
