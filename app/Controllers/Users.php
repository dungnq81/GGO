<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Model;

class Users extends BaseController {

	/**
	 * @return string
	 */
	public function index() {

		$model = new UserModel();
		$data['user'] = $model->where( 'id', session()->get( 'id' ) )->first();
		$data['title'] = "GGO | Danh sách tài khoản";
		return view( 'users/table', $data );
	}

	/**
	 * @return \CodeIgniter\HTTP\RedirectResponse|void
	 */
	public function login() {

		$data = [];
		helper( [ 'form' ] );
		if ( $this->request->getMethod() == 'post' ) {

			//let's do the validation here
			$rules = [
				'email'    => 'required|min_length[6]|valid_email',
				'password' => 'required|min_length[3]|validateUser[email,password]',
			];

			$errors = [
				'password' => [
					'validateUser' => 'Email, Phone or Password don\'t match'
				]
			];

			if ( ! $this->validate( $rules, $errors ) ) {
				$data['validation'] = $this->validator;
			} else {
				$model = new UserModel();
				$user = $model->where( 'email', $this->request->getVar( 'email' ) )->first();

				$this->setUserSession( $user );
				return redirect()->to( '/' );
			}
		}

		$data['title']  = "GGO | Đăng nhập";
		$data['body_class'] = "login-page";
		echo view( 'templates/header', $data );
		echo view( 'users/login' );
		echo view( 'templates/footer' );
	}

	/**
	 * @param $user
	 *
	 * @return bool
	 */
	private function setUserSession( $user ) {
		$data = [
			'id'         => $user['id'],
			'fullname'  => $user['fullname'],
			'email'      => $user['email'],
			'phone'      => $user['phone'],
			'isLoggedIn' => true,
		];

		session()->set( $data );
		return true;
	}

	/**
	 * @return \CodeIgniter\HTTP\RedirectResponse|void
	 * @throws \ReflectionException
	 */
	public function register() {
		$data = [];
		helper( [ 'form' ] );
		if ( $this->request->getMethod() == 'post' ) {

			//let's do the validation here
			$rules = [
				'fullname'        => 'min_length[3]',
				'email'            => 'required|min_length[6]|valid_email|is_unique[w_users.email]',
				'phone'           => 'min_length[10]|max_length[10]|is_natural',
				'password'         => 'required|min_length[3]',
				'password_confirm' => 'matches[password]',
			];

			if ( ! $this->validate( $rules ) ) {
				$data['validation'] = $this->validator;
			} else {
				$model = new UserModel();

				$newData = [
					'fullname' => $this->request->getVar( 'fullname' ),
					'email'     => $this->request->getVar( 'email' ),
					'phone'     => $this->request->getVar( 'phone' ),
					'password'  => $this->request->getVar( 'password' ),
				];
				$model->save( $newData );
				$session = session();
				$session->setFlashdata( 'success', 'Đăng ký thành công' );

				return redirect()->to( '/users/login' );

			}
		}

		$data['title']  = "GGO | Đăng ký thành viên";
		$data['body_class'] = "register-page";
		echo view( 'templates/header', $data );
		echo view( 'users/register' );
		echo view( 'templates/footer' );
	}

	/**
	 * @return \CodeIgniter\HTTP\RedirectResponse|void
	 * @throws \ReflectionException
	 */
	public function profile() {

		$data = [];
		helper( [ 'form' ] );
		$model = new UserModel();

		if ( $this->request->getMethod() == 'post' ) {
			//let's do the validation here
			$rules = [
				'fullname' => 'required|min_length[3]',
				'phone'    => 'min_length[10]|max_length[10]|is_natural',
			];

			if ( $this->request->getPost( 'password' ) != '' ) {
				$rules['password']         = 'required|min_length[3]';
				$rules['password_confirm'] = 'matches[password]';
			}

			if ( ! $this->validate( $rules ) ) {
				$data['validation'] = $this->validator;
			} else {

				$newData = [
					'id'        => session()->get( 'id' ),
					'fullname' => $this->request->getPost( 'fullname' ),
					'phone' => $this->request->getPost( 'phone' ),
				];
				if ( $this->request->getPost( 'password' ) != '' ) {
					$newData['password'] = $this->request->getPost( 'password' );
				}
				$model->save( $newData );

				session()->setFlashdata( 'success', 'Successfuly Updated' );
				return redirect()->to( '/users/profile' );
			}
		}

		$data['user'] = $model->where( 'id', session()->get( 'id' ) )->first();
		$data['title']  = "GGO | Thông tin thành viên";
		$data['body_class'] = "register-page";
		echo view( 'templates/header', $data );
		echo view( 'users/profile' );
		echo view( 'templates/footer' );
	}

	/**
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function logout() {
		session()->destroy();
		return redirect()->to( '/' );
	}

	//--------------------------------------------------------------------

}