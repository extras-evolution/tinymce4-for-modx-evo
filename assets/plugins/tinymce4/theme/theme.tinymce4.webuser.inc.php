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

// @todo: Set default-config for webusers
if( !empty( $this->pluginParams['pluginWebPlugins'])) {
    $this->set('plugins', $this->pluginParams['pluginWebPlugins'], 'string' );
};

$this->set('toolbar1', $this->pluginParams['pluginWebButtons1'], 'string', false );
$this->set('toolbar2', $this->pluginParams['pluginWebButtons2'], 'string', false );
$this->set('toolbar3', $this->pluginParams['pluginWebButtons3'], 'string', false );
$this->set('toolbar4', $this->pluginParams['pluginWebButtons4'], 'string', false );