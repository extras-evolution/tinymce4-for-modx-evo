//<?php
/**
 * TinyMCE4
 *
 * Javascript rich text editor
 *
 * @category    plugin
 * @version     4.3.4.0
 * @license     http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @properties &pluginStyleFormats=Custom Style Formats;textarea;Title,cssClass|Title2,cssClass &pluginCustomParams=Custom Parameters <b>(Be careful or leave empty!)</b>;textarea; &pluginEntityEncoding=Entity Encoding;list;named,numeric,raw;named &pluginEntities=Entities;text; &pluginPathOptions=Path Options;list;Site config,Absolute path,Root relative,URL,No convert;Site config &pluginResizing=Advanced Resizing;list;true,false;false &pluginDisabledButtons=Disabled Buttons;text; &pluginWebTheme=Web Theme;test;webuser &pluginWebPlugins=Web Plugins;text; &pluginWebButtons1=Web Buttons 1;text;bold italic underline strikethrough removeformat alignleft aligncenter alignright &pluginWebButtons2=Web Buttons 2;text;link unlink image undo redo &pluginWebButtons3=Web Buttons 3;text; &pluginWebButtons4=Web Buttons 4;text; &pluginWebAlign=Web Toolbar Alignment;list;ltr,rtl;ltr &width=Width;text;100% &height=Height;text;400px
 * @internal    @events OnRichTextEditorRegister,OnRichTextEditorInit,OnInterfaceSettingsRender
 * @internal    @modx_category Manager and Admin
 * @internal    @legacy_names TinyMCE4
 * @internal    @installset base
 *
 * @author Yama / updated: 2015-01-16
 * @author Dmi3yy / updated: 2016-01-07
 * @author Deesen / rewritten: 2016-02-28
 *
 * Latest Updates / Issues on Github : https://github.com/extras-evolution/tinymce4-for-modx-evo
 */
if (!defined('MODX_BASE_PATH')) { die('What are you doing? Get out of here!'); }

// Init
include_once(MODX_BASE_PATH."assets/plugins/tinymce4/class.modxRTEbridge.inc.php");
$rte = new modxRTEbridge('tinymce4');

// Overwrite theme
// $rte->force('width',          '75%', 'string' );                               // Overwrite width parameter
// $rte->force('height',         isset($height) ? $height : '400px', 'string' );  // Get/set height from plugin-configuration
// $rte->force('height',         NULL );                                          // Removes "height" completely from editor-init

// Internal Stuff - Don´t touch!
$showSettingsInterface = true;  // Show/Hide interface in Modx- / user-configuration (false for "Mini")
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