<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package Gallery Creator
 * @link    http://www.contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

$GLOBALS['TL_DCA']['tl_content']['palettes']['fixedTabsAsideItem'] = 'name,type;{link_legend},fixedTabsAsideUrl,target;{content_legend},titleText,headline,bodyContent,footerContent;{template_legend:hide},customTpl;{icon_legend},iconFontClass;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('tl_content_fixed_tabs_aside', 'showJsLibraryHint');


/**
 * Add fields to tl_content
 */

$GLOBALS['TL_DCA']['tl_content']['fields']['bodyContent'] = array(
    'label'       => &$GLOBALS['TL_LANG']['tl_content']['bodyContent'],
    'exclude'     => true,
    'search'      => true,
    'inputType'   => 'textarea',
    'eval'        => array('mandatory' => false, 'rte' => 'tinyMCE', 'helpwizard' => true),
    'explanation' => 'insertTags',
    'sql'         => "mediumtext NULL",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['footerContent'] = array(
    'label'       => &$GLOBALS['TL_LANG']['tl_content']['footerContent'],
    'exclude'     => true,
    'search'      => true,
    'inputType'   => 'textarea',
    'eval'        => array('mandatory' => false, 'rte' => 'tinyMCE', 'helpwizard' => true),
    'explanation' => 'insertTags',
    'sql'         => "mediumtext NULL",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['iconFontClass'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['iconFontClass'],
    'exclude'   => true,
    'search'    => true,
    'inputType' => 'text',
    'eval'      => array('maxlength' => 200),
    'sql'       => "varchar(255) NOT NULL default ''",
);
$GLOBALS['TL_DCA']['tl_content']['fields']['fixedTabsAsideUrl'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['fixedTabsAsideUrl'],
    'exclude'   => true,
    'search'    => true,
    'inputType' => 'text',
    'eval'      => array('mandatory' => false, 'rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'fieldType' => 'radio', 'filesOnly' => true, 'tl_class' => 'w50 wizard'),
    'wizard'    => array(
        array('tl_content', 'pagePicker'),
    ),
    'sql'       => "varchar(255) NOT NULL default ''"
);

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class tl_content_fixed_tabs_aside extends Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * Show a hint if a JavaScript library needs to be included in the page layout
     *
     * @param object
     */
    public function showJsLibraryHint($dc)
    {
        if ($_POST || Input::get('act') != 'edit')
        {
            return;
        }

        // Return if the user cannot access the layout module (see #6190)
        if (!$this->User->hasAccess('themes', 'modules') || !$this->User->hasAccess('layout', 'themes'))
        {
            return;
        }

        $objCte = ContentModel::findByPk($dc->id);

        if ($objCte === null)
        {
            return;
        }

        switch ($objCte->type)
        {
            case 'fixedTabsAsideItem':
                Message::addInfo(sprintf($GLOBALS['TL_LANG']['tl_content']['includeTemplate'], 'j_fixed_tabs_aside'));
                break;
        }
    }
}
