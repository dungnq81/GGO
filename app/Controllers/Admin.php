<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController {

	public function index() {
		$model = new UserModel();
		$data['user'] = $model->where( 'id', session()->get( 'id' ) )->first();

		$data['title'] = 'Hello, Admin';
		return view( 'dashboard', $data );
	}

	//--------------------------------------------------------------------

}
