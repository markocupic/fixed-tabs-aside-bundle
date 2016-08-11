<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'MCupic',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Elements
	'MCupic\FixedTabsAsideItem' => 'system/modules/fixed_tabs_aside/elements/FixedTabsAsideItem.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_fixed_tabs_aside_item' => 'system/modules/fixed_tabs_aside/templates',
	'j_fixed_tabs_aside'       => 'system/modules/fixed_tabs_aside/templates',
));
