//<?php
/**
 * TinyMCE4 Mini
 *
 * Javascript rich text editor
 *
 * @category    plugin
 * @version     4.3.4.0
 * @license     http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @properties &width=Width;text;200px &height=Height;text;200px
 * @internal    @events OnRichTextEditorRegister,OnRichTextEditorInit,OnInterfaceSettingsRender
 * @internal    @modx_category Manager and Admin
 * @internal    @legacy_names TinyMCE4 Mini
 * @internal    @installset base
 *
 * @author Deesen / updated: 2016-02-28
 *
 * Latest Updates / Issues on Github : https://github.com/extras-evolution/tinymce4-for-modx-evo
 */
if (!defined('MODX_BASE_PATH')) { die('What are you doing? Get out of here!'); }

// Init
include_once(MODX_BASE_PATH."assets/plugins/tinymce4/class.modxRTEbridge.inc.php");
$rte = new modxRTEbridge('tinymce4','mini');

// Overwrite theme
$rte->force('width',          isset($width)  ? $width  : '200px', 'string' );  // Get/set width from plugin-configuration
$rte->force('height',         isset($height) ? $height : '200px', 'string' );  // Get/set height from plugin-configuration

// Internal Stuff - Don´t touch!
$showSettingsInterface = false; // Show/Hide interface in Modx- / user-configuration (false for "Mini")
$editorLabel = $rte->pluginParams['editorLabel'];

$e = &$modx->event;
switch ($e->name) {
    // register for manager
    case "OnRichTextEditorRegister":
        $e->output($editorLabel);
        break;

    // render script for JS-initialization
    case "OnRichTextEditorInit":
        if ($editor === $editorLabel) {
            $script = $rte->getEditorScript();
            $e->output($script);
        };
        break;

    // render Modx- / User-configuration settings-list
    case "OnInterfaceSettingsRender":
        if( $showSettingsInterface === true ) {
            $html = $rte->getModxSettings();
            $e->output($html);
        };
        break;

    default :
        return; // important! stop here!
        break;
}