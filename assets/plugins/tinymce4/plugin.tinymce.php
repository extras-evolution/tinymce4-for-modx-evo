<?php
if(!defined('MODX_BASE_PATH')){die('What are you doing? Get out of here!');}
// Set the name of the plugin folder

global $usersettings,$settings;

// Set path and base setting variables

$plugin_dir = 'tinymce';
include_once(dirname(__FILE__).'/plugin.class.inc.php');

$mce4 = new TinyMCE4();

// Handle event
$e = &$modx->event; 
switch ($e->name)
{
	case "OnRichTextEditorRegister": // register only for backend
		$e->output('TinyMCE4');
		break;
	case "OnRichTextEditorInit":
		if($editor!=='TinyMCE4') return;
		$script = $mce4->get_mce_script();
		$e->output($script);
		break;
	case "OnInterfaceSettingsRender":
//		$html = $mce4->get_mce_settings();
//		$e->output($html);
		break;
   default :
      return; // stop here - this is very important. 
}
