<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 23.07.2016
 * Time: 12:33
 */

/**
use Contao\CoreBundle\Util\SymlinkUtil;
if(!is_link(TL_ROOT . '/web/system/modules/fixed_tabs_aside/assets/') && !is_dir(TL_ROOT . '/web/system/modules/fixed_tabs_aside/assets'))
{
    SymlinkUtil::symlink('system/modules/fixed_tabs_aside/assets/', 'web/system/modules/fixed_tabs_aside/assets/', TL_ROOT);
}
 *
 * **/

// Content element
$GLOBALS['TL_CTE']['fixedTabsAside']['fixedTabsAsideItem'] = 'MCupic\FixedTabsAsideItem';
