<?php

$self = 'assets/plugins/tinymce4/connector.tinymce4.saveProcessor.php';
$base_path = str_replace($self, '', str_replace('\\', '/', __FILE__));

define('MODX_API_MODE','true');
define('IN_MANAGER_MODE','true');
include_once("{$base_path}index.php");
include_once("{$base_path}assets/lib/class.modxRTEbridge.php");
$bridge = new modxRTEbridge('tinymce4', __FILE__);

$rid = isset($_POST['rid']) && is_numeric($_POST['rid']) ? (int)$_POST['rid'] : NULL;
$pluginName = isset($_POST['pluginName']) ? $_POST['pluginName'] : NULL;
$out = $rid ? $bridge->saveContentProcessor($rid, $pluginName) : 'No ID given';

echo (string)$out;  // returns ressource-id if successful, otherwise error-message