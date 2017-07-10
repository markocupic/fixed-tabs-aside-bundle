<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Markocupic\FixedTabsAsideBundle;


/**
 * Class FixedTabsAsideItem
 * @package Markocupic\FixedTabsAside
 */
class FixedTabsAsideItem extends \ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_fixed_tabs_aside_item';

    /**
     * @return string
     */
    public function generate()
    {
        return parent::generate();
    }


    /**
     * Generate the content element
     */
    protected function compile()
    {
        global $objPage;

        // Clean the RTE output
        if ($objPage->outputFormat == 'xhtml')
        {
            $this->bodyContent = \StringUtil::toXhtml($this->bodyContent);
            $this->footerContent = \StringUtil::toXhtml($this->footerContent);

        }
        else
        {
            $this->bodyContent = \StringUtil::toHtml5($this->bodyContent);
            $this->footerContent = \StringUtil::toXhtml($this->footerContent);
        }


        $this->Template->bodyContent = \StringUtil::encodeEmail($this->bodyContent);
        $this->Template->footerContent = \StringUtil::encodeEmail($this->footerContent);
    }
}