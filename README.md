# WP_Tabbed_Navigation
Automate creating a tabbed navigation and maintaining tabbed states

## Installing
Use composer:
```txt
composer require objectivco/wp_tabbed_navigation
```

Or include the file. (But really, just use composer)

## Initiating the Tab System
```php
$wp_tabbed_navigation = new WP_Tabbed_Navigation('Advanced Content Templates Settings');
```

## Setup Some Submenus
### These will be linked to our tabs
```php
add_submenu_page( "edit.php?post_type={$this->plugin->post_type}", "Advanced Content Templates Settings", "Settings", "manage_options", "act-settings", array($this, 'admin_settings_page') );
add_submenu_page( "edit.php?post_type={$this->plugin->post_type}", "Advanced Content Templates License", "License", "manage_options", "act-license", array($this, 'admin_license_page') );
add_submenu_page("edit.php?post_type={$this->plugin->post_type}", "Advanced Content Templates Add-Ons", "Add-Ons", "manage_options", "act-addons", array($this, 'admin_addons_page') );
add_submenu_page("edit.php?post_type={$this->plugin->post_type}", "Advanced Content Templates Support", "Support", "manage_options", "act-support", array($this, 'admin_support_page') );
```

## Setup Tabs Using The Same Menu Slugs
```php
$wp_tabbed_navigation->add_tab('Settings', menu_page_url('act-settings', false) );
$wp_tabbed_navigation->add_tab('Add-ons', menu_page_url('act-addons', false) );
$wp_tabbed_navigation->add_tab('License', menu_page_url('act-license', false) );
$wp_tabbed_navigation->add_tab('Support', menu_page_url('act-support', false ) );
```

## Displaying the Tabs
### Add this to the top of each admin page in a tab.

```php
$wp_tabbed_navigation->display_tabs();
```

## That's it! Have fun kids.
