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
$wp_tabbed_navigation = new WP_Tabbed_Navigation( 'My Plugin Settings', $selected_tab_query_arg = 'subpage' );
```

## Setup Some Submenus
### These will be linked to our tab'
```php
add_options_page( __( 'My Plugin Settings', 'my-plugin' ), __( 'My Plugin Settings', 'my-plugin' ), 'manage_options', 'my-plugin-settings', array($this, 'admin_page') );
```

## Setup Tabs Using The Same Menu Slugs
```php
$wp_tabbed_navigation->add_tab( 'Settings', add_query_arg( array('subpage' => 'settings'), menu_page_url('my-plugin-settings', false) ) );
$wp_tabbed_navigation->add_tab( 'Add-ons', add_query_arg( array('subpage' => 'addons'), menu_page_url('my-plugin-settings', false) ) );
$wp_tabbed_navigation->add_tab( 'License', add_query_arg( array('subpage' => 'license'), menu_page_url('my-plugin-settings', false) ) );
$wp_tabbed_navigation->add_tab( 'Support', add_query_arg( array('subpage' => 'support'), menu_page_url('my-plugin-settings', false) ) );
```

## Displaying the Tabs
### Add this to the top of each admin page in a tab.

```php
$wp_tabbed_navigation->display_tabs();
```

## That's it! Have fun kids.
