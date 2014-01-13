<?php
/**
 * Item Relations
 * @copyright Copyright 2010-2014 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * Dummy index controller.
 *
 * Simply redirects to the VocabularyController.
 */
class ItemRelations_IndexController extends Omeka_Controller_AbstractActionController
{
    /**
     * Redirect to vocabularies/browse.
     */
    public function indexAction()
    {
        $this->_helper->redirector('browse', 'vocabularies');
    }
}
