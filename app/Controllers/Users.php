<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Libraries\User_Crud;
use CodeIgniter\Model;

class Users extends BaseController {

	protected $crud;
	protected $table = "w_users";
	protected $route = "users";

	/**
	 * Users constructor.
	 */
	public function __construct() {
		$params = [
			'table'              => $this->table,
			'route'              => $this->route,
			'dev' => false,
			'fields' => $this->field_options(),
			'form_title_add' => 'Thêm tài khoản',
			'form_title_update' => 'Sửa thông tin',
			'form_submit' => 'Thêm mới',
			'table_title' => 'Tài khoản',
			'form_submit_update' => 'Cập nhật',
			'base' => '',
		];

		$this->crud = new User_Crud($params, service('request'));
	}

	/**
	 * @return string
	 */
	public function index() {

		$page = 1;
		if (isset($_GET['page'])) {
			$page = (int) $_GET['page'];
			$page = max(1, $page);
		}
		$per_page = 10;

		$model         = new UserModel();

		$data['user']  = $model->where( 'id', session()->get( 'id' ) )->first();
		$data['title'] = $this->crud->getTableTitle();

		$columns  = [
			[ 'label' => 'ID', 'field' => 'id' ],
			'fullname',
			'email',
			'phone',
			[ 'label' => 'Ngày tạo', 'callback' => 'callback_created_at' ],
			[ 'label' => 'Trạng thái', 'search' => 'status', 'search_field_type' => 'text', 'callback' => 'callback_status' ],
		];
		$where    = null;
		$order    = [
			[ $this->table . '.id', 'ASC' ]
		];

		$data['table'] = $this->crud->view( $page, $per_page, $columns, $where, $order );
		return view( 'users/table', $data );
	}

	/**
	 * @return array
	 */
	protected function field_options() {
		$fields = [];
		$fields['fullname'] = ['label' => 'Họ tên', 'class' => 'col-12' ];
		$fields['email'] = ['label' => 'Email', 'required' => true, 'unique' => [true, 'email'], 'class' => 'col-12' ];
		$fields['phone'] = ['label' => 'Điện thoại', 'type' => 'number', 'class' => 'col-12' ];
		$fields['status'] = ['label' => 'Trạng thái', 'required' => true, 'class' => 'col-12'];
		$fields['updated_at'] = ['label' => 'Ngày cập nhật', 'only_edit' => true, 'class' => 'col-12'];
		$fields['password'] = [
			'label' => 'Mật khẩu',
			'required' => false,
			'only_add' => false,
			'type' => 'password',
			'class' => 'col-12',
			'confirm' => true,
			'password_hash' => true
		];

		return $fields;
	}

	/**$model         = new UserModel();
	$data['user']  = $model->where( 'id', session()->get( 'id' ) )->first();
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

		$data['title']  = "Đăng nhập";
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
	public function add() {

		$model = new UserModel();

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

		$data['user'] = $model->where( 'id', session()->get( 'id' ) )->first();
		$data['title']  = "Đăng ký mới";
		$data['body_class'] = "register-page";

		echo view( 'users/register', $data );
	}

	/**
	 * @param $id
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse|string
	 */
	public function edit( $id ) {
		if ( ! $this->crud->current_values( $id ) ) {
			return redirect()->to( $this->crud->getBase() . '/' . $this->crud->getRoute() );
		}

		$data['item_id'] = $id;
		$data['form']    = $form = $this->crud->form();
		$data['title']   = $this->crud->getEditTitle();

		if ( is_array( $form ) && isset( $form['redirect'] ) ) {
			return redirect()->to( $form['redirect'] );
		}

		return view( 'users/form', $data );
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
		$data['title']  = "Thông tin thành viên";
		$data['body_class'] = "register-page";

		echo view( 'users/profile', $data );
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