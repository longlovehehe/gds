<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:27
         compiled from "..\static\style\modules\report\review.tpl.css" */ ?>
<?php /*%%SmartyHeaderCode:269825762236b6cb679-24299702%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd098cf5da570965bc38fe88f77f7454366fe8f7d' => 
    array (
      0 => '..\\static\\style\\modules\\report\\review.tpl.css',
      1 => 1457923928,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '269825762236b6cb679-24299702',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762236b6f65f6_26128540',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762236b6f65f6_26128540')) {function content_5762236b6f65f6_26128540($_smarty_tpl) {?>div.content.pies{
    
}
/* Styles for jQuery menu widget
Author:	Maggie Wachs, maggie@filamentgroup.com
Date:		September 2008
*/


/* REQUIRED STYLES - the menus will only render correctly with these rules */	

.fg-menu-container { position: absolute; top:0; left:-999px; padding: .4em;  overflow: hidden; }
.fg-menu-container.fg-menu-flyout { overflow: visible; }

.fg-menu, .fg-menu ul { list-style-type:none; padding: 0; margin:0; }

.fg-menu { position:relative; }
.fg-menu-flyout .fg-menu { position:static; }

.fg-menu ul { position:absolute; top:0; }
.fg-menu ul ul { top:-1px; }

.fg-menu-container.fg-menu-ipod .fg-menu-content, 
.fg-menu-container.fg-menu-ipod .fg-menu-content ul { background: none !important; }

.fg-menu.fg-menu-scroll,
.fg-menu ul.fg-menu-scroll { overflow: scroll;  overflow-x: hidden; }

.fg-menu li { clear:both; float:left; width:100%; margin: 0; padding:0; border: 0; }	
.fg-menu li li { font-size:1em; } /* inner li font size must be reset so that they don't blow up */

.fg-menu-flyout ul ul { padding: .4em; }
.fg-menu-flyout li { position:relative; }

.fg-menu-scroll { overflow: scroll; overflow-x: hidden; }

.fg-menu-breadcrumb { margin: 0; padding: 0; }

.fg-menu-footer {  margin-top: .4em; padding: .4em; }
.fg-menu-header {  margin-bottom: .4em; padding: .4em; }

.fg-menu-breadcrumb li { float: left; list-style: none; margin: 0; padding: 0 .2em; font-size: .9em; opacity: .7; }
.fg-menu-breadcrumb li.fg-menu-prev-list,
.fg-menu-breadcrumb li.fg-menu-current-crumb { clear: left; float: none; opacity: 1; }
.fg-menu-breadcrumb li.fg-menu-current-crumb { padding-top: .2em; }

.fg-menu-breadcrumb a, 
.fg-menu-breadcrumb span { float: left; }

.fg-menu-footer a:link,
.fg-menu-footer a:visited { float:left; width:100%; text-decoration: none; }
.fg-menu-footer a:hover,
.fg-menu-footer a:active {  }

.fg-menu-footer a span { float:left; cursor: pointer; }

.fg-menu-breadcrumb .fg-menu-prev-list a:link,
.fg-menu-breadcrumb .fg-menu-prev-list a:visited,
.fg-menu-breadcrumb .fg-menu-prev-list a:hover,
.fg-menu-breadcrumb .fg-menu-prev-list a:active { background-image: none; text-decoration:none; }
	
.fg-menu-breadcrumb .fg-menu-prev-list a { float: left; padding-right: .4em; }
.fg-menu-breadcrumb .fg-menu-prev-list a .ui-icon { float: left; }
	
.fg-menu-breadcrumb .fg-menu-current-crumb a:link,
.fg-menu-breadcrumb .fg-menu-current-crumb a:visited,
.fg-menu-breadcrumb .fg-menu-current-crumb a:hover,
.fg-menu-breadcrumb .fg-menu-current-crumb a:active { display:block; background-image:none; font-size:1.3em; text-decoration:none; }



/* REQUIRED LINK STYLES: links are "display:block" by default; if the menu options are split into 
	selectable node links and 'next' links, the script floats the node links left and floats the 'next' links to the right	*/

.fg-menu a:link,
.fg-menu a:visited,
.fg-menu a:hover,
.fg-menu a:active { float:left; width:92%; padding:.3em 3%; text-decoration:none; outline: 0 !important; }

.fg-menu a { border: 1px dashed transparent; }

.fg-menu a.ui-state-default:link,
.fg-menu a.ui-state-default:visited,
.fg-menu a.ui-state-default:hover,
.fg-menu a.ui-state-default:active,
.fg-menu a.ui-state-hover:link,
.fg-menu a.ui-state-hover:visited,
.fg-menu a.ui-state-hover:hover,
.fg-menu a.ui-state-hover:active,
 .fg-menu a.ui-state-active:link,
 .fg-menu a.ui-state-active:visited,
 .fg-menu a.ui-state-active:hover,
.fg-menu a.ui-state-active:active { border-style: solid; font-weight: normal; }

.fg-menu a span { display:block; cursor:pointer; }


 /* SUGGESTED STYLES - for use with jQuery UI Themeroller CSS */	
 
.fg-menu-indicator span { float:left; }
.fg-menu-indicator span.ui-icon { float:right; }

.fg-menu-content.ui-widget-content, 
.fg-menu-content ul.ui-widget-content { border:0; }


/* ICONS AND DIVIDERS */

.fg-menu.fg-menu-has-icons a:link,
.fg-menu.fg-menu-has-icons a:visited,
.fg-menu.fg-menu-has-icons a:hover,
.fg-menu.fg-menu-has-icons a:active { padding-left:20px; }

.fg-menu .horizontal-divider hr, .fg-menu .horizontal-divider span { padding:0; margin:5px .6em; }
.fg-menu .horizontal-divider hr { border:0; height:1px; }
.fg-menu .horizontal-divider span { font-size:.9em; text-transform: uppercase; padding-left:.2em; }

<?php }} ?>