<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

	protected $table = 'w_users';

	protected $allowedFields = [ 'firstname', 'lastname', 'email', 'phone', 'password', 'updated_at', 'data' ];
	protected $beforeInsert = [ 'beforeInsert' ];
	protected $beforeUpdate = [ 'beforeUpdate' ];

	/**
	 * @param array $data
	 *
	 * @return array
	 */
	protected function beforeInsert( array $data ) {
		$data = $this->passwordHash( $data );
		$data['data']['created_at'] = date( 'Y-m-d H:i:s' );

		return $data;
	}

	/**
	 * @param array $data
	 *
	 * @return array
	 */
	protected function beforeUpdate( array $data ) {
		$data                       = $this->passwordHash( $data );
		$data['data']['updated_at'] = date( 'Y-m-d H:i:s' );

		return $data;
	}

	/**
	 * @param array $data
	 *
	 * @return array
	 */
	protected function passwordHash( array $data ) {
		if ( isset( $data['data']['password'] ) ) {
			$data['data']['password'] = password_hash( $data['data']['password'], PASSWORD_DEFAULT );
		}

		return $data;
	}
}
