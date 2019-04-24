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
	private $_tabs              = array();
	private $_title             = false;
	private $_selected_tab_query_arg = false;

	public function __construct( $title, $selected_tab_query_arg = 'subpage' ) {
		$this->_title                  = $title;
		$this->_selected_tab_query_arg = $selected_tab_query_arg;
	}

	public function add_tab( $title, $url, $tab_slug = false ) {
		if ( false === $tab_slug ) {
			$tab_slug = sanitize_key( $title );
		}
		$this->_tabs[ $tab_slug ] = array(
			'title' => $title,
			'url'   => $url,
		);
	}

	public function remove_tab( $title ) {
		$key = sanitize_key( $title );

		if ( isset( $this->_tabs[ $key ] ) ) {
			unset( $this->_tabs[ $key ] );
		}
	}

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

	public function display_tabs() {
		echo $this->get_tabs();
	}
}
