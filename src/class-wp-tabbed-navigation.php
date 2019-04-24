<?php
/**
 * WP Tabbed Navigation
 *
 * Automate creating a tabbed navigation and maintaining tabbed states
 *
 *
 * @since      0.2.0
 * @package    Advanced_Content_Templates
 * @subpackage Advanced_Content_Templates/includes
 * @author     Clifton Griffin <clif@objectiv.co>
 */
class WP_Tabbed_Navigation {
	/**
	 * Added tabs.
	 *
	 * @since 0.1.0
	 * @var array $_tabs Array of added tabs.
	 */
	private $_tabs = array();

	/**
	 * Tab title.
	 *
	 * @since 0.1.0
	 * @var boolean|string $_title False if page title, string if page title set.
	 */
	private $_title = false;

	/**
	 * Selected tab query arg.
	 *
	 * @since 0.2.0
	 * @var boolean|string $_selected_tab_query_arg False defaults to subpage, string if set
	 */
	private $_selected_tab_query_arg = false;

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param string $title Admin page title.
	 * @param string $selected_tab_query_arg (optional) Selected tab query arg.
	 */
	public function __construct( $title, $selected_tab_query_arg = 'subpage' ) {
		$this->_title                  = $title;
		$this->_selected_tab_query_arg = $selected_tab_query_arg;
	}

	/**
	 * Adds tab to navigation.
	 *
	 * @since 0.1.0
	 *
	 * @param string $title Tab title.
	 * @param string $url   Admin page URL.
	 * @param string|boolean $tab_slug (optional) The tab slug used for matching active tab.
	 */
	public function add_tab( $title, $url, $tab_slug = false ) {
		if ( false === $tab_slug ) {
			$tab_slug = sanitize_key( $title );
		}
		$this->_tabs[ $tab_slug ] = array(
			'title' => $title,
			'url'   => $url,
		);
	}

	/**
	 * Removes tab from navigation.
	 *
	 * @since 0.1.0
	 *
	 * @param string $title Tab title.
	 */
	public function remove_tab( $title ) {
		$key = sanitize_key( $title );

		if ( isset( $this->_tabs[ $key ] ) ) {
			unset( $this->_tabs[ $key ] );
		}
	}

	/**
	 * Returns markup for tab navigation.
	 *
	 * @since 0.1.0
	 *
	 * @return string Tab markup.
	 */
	public function get_tabs() {
		$html = '<h2>' . $this->_title . '</h2>';

		$html .= '<h2 class="nav-tab-wrapper">';

		foreach ( $this->_tabs as $slug => $tab ) {
			$class = '';

			$match_url = str_replace( get_site_url(), '', $tab['url'] );
			if ( ( ! empty( $_GET[ $this->_selected_tab_query_arg ] ) && $slug == $_GET[ $this->_selected_tab_query_arg ] ) || $_SERVER['REQUEST_URI'] == html_entity_decode( $match_url ) ) {
				$class = 'nav-tab-active';
			}

			$html .= '<a href="' . $tab['url'] . '" class="nav-tab ' . $class . '">';
			$html .= ' ' . __( $tab['title'] );
			$html .= '</a>';
		}

		$html .= '</h2>';

		return $html;
	}

	/**
	 * Outputs tab markup.
	 *
	 * @since 0.1.0
	 */
	public function display_tabs() {
		echo $this->get_tabs();
	}
}
