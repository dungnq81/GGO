<?php

namespace App\Controllers;

use App\Models\UserModel;

class Offices extends BaseController
{
	public function index()
	{
		$model = new UserModel();
		$data['user'] = $model->where( 'id', session()->get( 'id' ) )->first();
		$data['title'] = "GGO | Văn phòng";
		return view( 'offices/table', $data );
	}
}
