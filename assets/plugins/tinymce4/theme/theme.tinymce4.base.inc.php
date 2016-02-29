<?php
/*
 * All available config-params of TinyMCE4
 * https://www.tinymce.com/docs/configure/
 *
 * Belows default configuration setup assures all editor-params have a fallback-value, and type per key is known
 * $this->set( $editorParam, $value, $type, $emptyAllowed=false )
 *
 * $editorParam     = param to set
 * $value           = value to set
 * $type            = string, number, bool, json (array or string)
 * $emptyAllowed    = true, false (allows param:'' instead of falling back to default)
 * If $editorParam is empty and $emptyAllowed is true, $defaultValue will be ignored
 *
 * $modxParams holds an array of actual Modx- / user-settings
 *
 * */

// TinyMCE4 - Base config --- See gsettings/bridge.tinymce4.inc.php for more base params

// Migration-Info
// These plugins where removed in 4.0: advhr, advimage, advlink, iespell, inlinepopups, style, emotions, xhtmlxtras
// These are the new plugins in 4.0:   anchor, charmap, compat3x, hr, image, link, emoticons, code, textcolor


// $this->set('toolbar_items_size', 'small',                        'string');      // @todo: No docs - deprecated parameter?
// @todo: make "styleprops"-button work with "compat3x-plugin"? http://archive.tinymce.com/forum/viewtopic.php?pid=115507#p115507
// @todo: "pasteword"-button is now commercial -> https://www.tinymce.com/docs/enterprise/paste-from-word/
// @todo: layer-Plugin: Buttons broken
// @todo: selectall-Button broken

$this->set('skin',                  'lightgray',                    'string' );     // Set default skin (setting param first time sets its value also as default val)
$this->set('skin',                  $modxParams['skin'] );                          // Overwrite with Modx-setting (if empty, default is used))
$this->set('width',                 $this->pluginParams['width'],   'string' );     // https://www.tinymce.com/docs/configure/editor-appearance/#width
$this->set('height',                $this->pluginParams['height'],  'string' );     // https://www.tinymce.com/docs/configure/editor-appearance/#height

// @todo: Make optional in Modx-configuration?
$this->set('menubar',               true,                           'bool' );       // https://www.tinymce.com/docs/configure/editor-appearance/#menubar
$this->set('statusbar',             true,                           'bool' );       // https://www.tinymce.com/docs/get-started/customize-ui/#hidingthestatusbar

$this->set('document_base_url',     MODX_SITE_URL,                  'string' );     // https://www.tinymce.com/docs/configure/url-handling/#document_base_url
$this->set('entity_encoding', $this->pluginParams['pluginEntityEncoding'],'string');// https://www.tinymce.com/docs/configure/content-filtering/#encodingtypes
$this->set('entities',        $this->pluginParams['pluginEntities'],      'string');// https://www.tinymce.com/docs/configure/content-filtering/#entities
//$this->set('language',              $this->lang('lang_code'),       'string');      // https://www.tinymce.com/docs/configure/localization/#language
//$this->set('language_url',          $this->pluginParams['base_url'].'tinymce/langs/'. $this->lang('lang_code') .'.js', 'string');   // https://www.tinymce.com/docs/configure/localization/#language_url
$this->set('schema',                $modxParams['schema'],          'string' );     // https://www.tinymce.com/docs/configure/content-filtering/#schema
$this->set('element_format',        $modxParams['element_format'],  'string' );     // https://www.tinymce.com/docs/configure/content-filtering/#element_format

// Avoid set empty content_css - accepts comma-separated list of multiple css-files
if( !empty( $modx->config['editor_css_path'] )) {
    $this->set('content_css', explode(',',$modx->config['editor_css_path']), 'array'); // https://www.tinymce.com/docs/configure/content-appearance/#content_css
};

$this->set('image_caption',         true,                           'bool' );       // https://www.tinymce.com/docs/plugins/image/#image_caption
$this->set('image_advtab',          'small',                        'string' );     // https://www.tinymce.com/docs/plugins/image/#image_advtab
$this->set('image_advtab',          true,                           'bool' );       // https://www.tinymce.com/docs/plugins/image/#image_advtab // replacement for 3.x-plugin advimage

// https://www.tinymce.com/docs/plugins/paste/#paste_word_valid_elements
$this->set('paste_word_valid_elements', 'a[href|name],p,b,strong,i,em,h1,h2,h3,h4,h5,h6,table,th,td[colspan|rowspan],tr,thead,tfoot,tbody,br,hr,sub,sup,u', 'string');

// @todo: final base-setup like tinymce3 "default"-theme?
$this->set('plugins', 'anchor visualblocks template autolink autosave save advlist fullscreen paste link media contextmenu table youtube image imagetools code textcolor', 'string');    // https://www.tinymce.com/docs/get-started/basic-setup/#pluginconfiguration
$this->set('toolbar1', 'undo redo | bold forecolor backcolor strikethrough fontsizeselect pastetext code template | fullscreen help', 'string');
$this->set('toolbar2', 'image media youtube link unlink anchor | alignleft aligncenter alignright | bullist numlist | blockquote outdent indent | table hr | visualblocks styleprops removeformat', 'string');

// Bridge does not return NULL, and does not use this->set() itself, so these parameters must be set at least once..
// Params get translated by bridge because it does not return NULL, so the returned values will be used
$this->set('style_formats', array(), 'json');   // https://www.tinymce.com/docs/configure/content-formatting/#style_formats
$this->set('block_formats', '',      'string'); // https://www.tinymce.com/docs/configure/content-formatting/#block_formats
$this->set('forced_root_block', '',  'string'); // https://www.tinymce.com/docs/configure/content-filtering/#forced_root_block