<?php
// Get Template from resource for TinyMCE4
// Based on get_template.php for TinyMCE3 by Yamamoto
//
// Changelog:
// @author Deesen / updated: 29.02.2016

// Config options
// $templates_to_ignore = array();        // Template IDs to ignore from the link list
// $include_page_ids = false;
// $charset = 'UTF-8';
// $sortby = 'menuindex'; // Could be menuindex or menutitle
// $limit = 0;

/* That's it to config! */
define('MODX_API_MODE', true);
define('IN_MANAGER_MODE', "true");
$self = 'assets/plugins/tinymce4/connector.tinymce4.templates.php';
$base_path = str_replace($self, '', str_replace('\\', '/', __FILE__));
include_once("{$base_path}index.php");
$modx->db->connect();
$templatesArr = array();

/* only display if manager user is logged in */
if ($modx->getLoginUserType() === 'manager') {

    $modx->getSettings();
    $ids    = $modx->config['tinymce4_template_docs'];
    $chunks = $modx->config['tinymce4_template_chunks'];
    $templatesArr = array();

    if (!empty($ids)) {
        $docs = $modx->getDocuments($ids, 1, 0, $fields = 'id,pagetitle,menutitle,description,content');
        foreach ($docs as $i => $a) {
            $newTemplate = array(
                'title'=>($docs[$i]['menutitle'] !== '') ? $docs[$i]['menutitle'] : $docs[$i]['pagetitle'],
                'description'=>$docs[$i]['description'],
                'content'=>$docs[$i]['content']
            );
            $templatesArr[] = $newTemplate;
        }
    }

    if (!empty($chunks)) {
        $tbl_site_htmlsnippets = $modx->getFullTableName('site_htmlsnippets');
        if (strpos($chunks, ',') !== false) {
            $chunks  = array_filter(array_map('trim', explode(',', $chunks)));
            $chunks  = $modx->db->escape($chunks);
            $chunks  = implode("','", $chunks);
            $where   = "`name` IN ('{$chunks}')";
            $orderby = "FIELD(name, '{$chunks}')";
        } else {
            $where   = "`name`='{$chunks}'";
            $orderby = '';
        }

        $rs = $modx->db->select('id,name,description,snippet', $tbl_site_htmlsnippets, $where, $orderby);

        while ($row = $modx->db->getRow($rs)) {
            $newTemplate = array(
                'title'=>$row['name'],
                'description'=>$row['description'],
                'content'=>$row['snippet']
            );
            $templatesArr[] = $newTemplate;
        }
    }
}

// Make output a real JavaScript file!
header('Content-type: application/x-javascript');
header('pragma: no-cache');
header('expires: 0');
echo json_encode($templatesArr);