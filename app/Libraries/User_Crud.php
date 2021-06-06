<?php

namespace App\Libraries;

use App\Libraries\Crud_core;
use CodeIgniter\HTTP\RequestInterface;

/**
 * Class User_Crud
 * @package App\Libraries
 */
class User_Crud extends Crud_core {

	/**
	 * User_Crud constructor.
	 *
	 * @param $params
	 * @param RequestInterface $request
	 */
	public function __construct( $params, RequestInterface $request ) {
		parent::__construct( $params, $request );
	}

	/**
	 * @return string|string[]
	 */
	public function form() {
		return $this->parent_form();
	}

	public function callback_created_at($item) {
		$created_at = $item->created_at;
		return '<span class="u-created-at">' . date( 'd/m/Y H:i', strtotime($item->created_at)) . '</span>';
	}

	/**
	 * @param $item
	 *
	 * @return string
	 */
	public function callback_status( $item ) {
		if ($item->status == 'Active') {
			return '<span class="u-active">' . $item->status . '</span>';
		} elseif ($item->status == 'Inactive') {
			return '<span class="u-inactive">' . $item->status . '</span>';
		}
	}
}
