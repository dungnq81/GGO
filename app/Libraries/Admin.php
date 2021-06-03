<?php

namespace App\Libraries;

class Admin {

	/**
	 * @param $params
	 *
	 * @return string|void
	 */
	public function title( $params ) {
		if ( $params['title'] ) {
			return view( 'cmps/title', $params );
		}
	}
}
