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

// $this->set('toolbar_items_size', 'small',                        'string');      // @todo: No docs - deprecated parameter?

$this->set('skin',                  'lightgray',                    'string' );     // Set default skin (setting param first time sets its value also as default val)
$this->set('skin',                  $modxParams['skin'] );                          // Overwrite with Modx-setting (if empty, default is used))

$this->set('width',                 $this->pluginParams['width'],   'string' );     // https://www.tinymce.com/docs/configure/editor-appearance/#width
$this->set('height',                $this->pluginParams['height'],  'string' );     // https://www.tinymce.com/docs/configure/editor-appearance/#height
$this->set('document_base_url',     MODX_SITE_URL,                  'string' );     // https://www.tinymce.com/docs/configure/url-handling/#document_base_url
$this->set('image_caption',         true,                           'bool' );       // https://www.tinymce.com/docs/plugins/image/#image_caption
$this->set('image_advtab',          'small',                        'string' );     // https://www.tinymce.com/docs/plugins/image/#image_advtab
$this->set('entity_encoding', $this->pluginParams['pluginEntityEncoding'],'string');// https://www.tinymce.com/docs/configure/content-filtering/#encodingtypes
$this->set('entities',        $this->pluginParams['pluginEntities'],      'string');// https://www.tinymce.com/docs/configure/content-filtering/#entities
$this->set('language_url',          $this->pluginParams['base_url'].'tinymce/langs/'. $this->lang('lang_code') .'.js', 'string');   // https://www.tinymce.com/docs/configure/localization/#language_url
$this->set('statusbar',             true,                           'bool' );       // https://www.tinymce.com/docs/get-started/customize-ui/#hidingthestatusbar
$this->set('schema',                $modxParams['schema'],          'string' );     // https://www.tinymce.com/docs/configure/content-filtering/#schema
$this->set('element_format',        $modxParams['element_format'],  'string' );     // https://www.tinymce.com/docs/configure/content-filtering/#element_format

// Avoid set empty content_css - accepts comma-separated list of multiple css-files
if( !empty( $modx->config['editor_css_path'] )) {
    $this->set('content_css', explode(',',$modx->config['editor_css_path']), 'array'); // https://www.tinymce.com/docs/configure/content-appearance/#content_css
};

// @todo: final base-setup?
$this->set('plugins', 'advlist autolink lists link image charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen spellchecker insertdatetime media nonbreaking save table contextmenu directionality emoticons template paste textcolor codesample colorpicker textpattern imagetools paste modxlink youtube', 'string');    // https://www.tinymce.com/docs/get-started/basic-setup/#pluginconfiguration
$this->set('paste_word_valid_elements', 'a[href|name],p,b,strong,i,em,h1,h2,h3,h4,h5,h6,table,th,td[colspan|rowspan],tr,thead,tfoot,tbody,br,hr,sub,sup,u', 'string');  // https://www.tinymce.com/docs/plugins/paste/#paste_word_valid_elements
$this->set('toolbar1', 'undo redo | cut copy paste | searchreplace | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent blockquote | styleselect', 'string');
$this->set('toolbar2', 'link unlink anchor image media codesample table | hr removeformat | subscript superscript charmap | nonbreaking | visualchars visualblocks print preview fullscreen code', 'string');

// Bridge does not return NULL, and does not use this->set() itself, so these parameters must be set at least once..
// Params get translated by bridge because it does not return NULL, so the returned values will be used
$this->set('style_formats', array(), 'json');   // https://www.tinymce.com/docs/configure/content-formatting/#style_formats
$this->set('block_formats', '',      'string'); // https://www.tinymce.com/docs/configure/content-formatting/#block_formats
$this->set('forced_root_block', '',  'string'); // https://www.tinymce.com/docs/configure/content-filtering/#forced_root_block