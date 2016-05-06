tinymce4-for-modx-evo 4.3.11
============================

TinyMCE4 rich text editor for MODX Evolution.

### Custom themes

All themes are located in directory `assets/plugins/tinymce4/theme`. The base-theme `theme.tinymce4.base.inc.php` will always be loaded to set all nessecary base options. All other themes are meant to customize the base-theme. Select your theme within Modx-configuration.

To create your own custom theme, duplicate one of the other themes/files and customize it per your needs. Within a theme editor-options are set like

    $this->set('parameter', 'value', 'type');

#### Example "custom toolbar"

Refering to the TinyMCE4-docs https://www.tinymce.com/docs/configure/editor-appearance/#toolbarn , the parameters are "toolbar1" and "toolbar2". Their type is "string". So inside your theme this example can be achieved with  
 
    $this->set('toolbar1', 'undo redo | styleselect | bold italic | link image', 'string');
    $this->set('toolbar2', 'alignleft aligncenter alignright',                   'string');

To remove a setting completely, set it to NULL:

    $this->set('toolbar1', NULL, 'string');

### Inline-Mode

Like QuickManager, this plugin also offers inline-editing of template-variables directly within your frontend:
   
 - disable QuickManager Inline-editing
 - enable "Inline-Mode" within TinyMCE4 plugin-configuration
 - set your desired inline-theme
 - to make a TV like `[*content*]` editable, simply prepend add # like `[*#content*]`

### Changelog

 - v4.3.11 - 06.05.2016
     - updated TinyMCE-library to v4.3.11
     - added same scheme as QM `[*#content*]` (Inline-Mode)
     - added secHash (Inline-Mode)
     - added setting "inlineTheme" (Inline-Mode)
     - added README.md