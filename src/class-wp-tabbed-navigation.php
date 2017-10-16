<?php
/**
 * WP Tabbed Navigation
 *
 * Automate creating a tabbed navigation and maintaining tabbed states.
 *
 * @since      0.1.0
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
	 * Page title.
	 *
	 * @since 0.1.0
	 * @var boolean|string $_title False if page title, string if page title set.
	 */
	private $_title = false;

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param string $title Admin page title.
	 */
	public function __construct( $title ) {
		$this->_title = $title;
	}

	/**
	 * Adds tab to navigation.
	 *
	 * @since 0.1.0
	 *
	 * @param string $title Tab title.
	 * @param string $url   Admin page URL.
	 */
	public function add_tab( $title, $url ) {
		$this->_tabs[ sanitize_key( $title ) ] = array(
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

		foreach ( $this->_tabs as $tab ) {
			$class = '';

			$match_url = str_replace( get_site_url(), '', $tab['url'] );
			if ( $_SERVER['REQUEST_URI'] == html_entity_decode( $match_url ) ) {
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
