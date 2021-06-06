<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Libraries\Office_Crud;

/**
 * Class Offices
 *
 * @package App\Controllers
 */
class Offices extends BaseController {
	protected $crud;
	protected $table = "w_offices";
	protected $route = "offices";

	/**
	 * Offices constructor.
	 */
	public function __construct() {
		$params = [
			'table'              => $this->table,
			'route'              => $this->route,
			'dev'                => false,
			'fields'             => $this->field_options(),
			'form_title_add'     => 'Thêm mới',
			'form_title_update'  => 'Cập nhật',
			'form_submit'        => 'Thêm mới',
			'table_title'        => 'Thông tin tòa nhà',
			'form_submit_update' => 'Cập nhật',
			'base'               => '',
		];

		$this->crud = new Office_Crud( $params, service( 'request' ) );
	}

	/**
	 * Index
	 *
	 * @return string
	 */
	public function index() {
		$model         = new UserModel();
		$data['user']  = $model->where( 'id', session()->get( 'id' ) )->first();
		$data['title'] = $this->crud->getTableTitle();

		$page = 1;
		if ( isset( $_GET['page'] ) ) {
			$page = (int) $_GET['page'];
			$page = max( 1, $page );
		}

		$per_page = 20;
		$columns  = [
			[ 'label' => '<label for="cb-all-1" class="screen-reader-text">Chọn toàn bộ</label><input form="search-inline" id="cb-all-1" type="checkbox">', 'callback' => 'callback_checkbox'],
			[ 'label' => 'ID', 'field' => 'o_id' ],
			'o_title',
			'o_district',
			[ 'label' => 'Diện tích<span>(m2)</span>', 'search' => 'o_acreage', 'search_field_type' => 'number', 'callback' => 'callback_acreage' ],
			[ 'label' => 'Tầng', 'search' => 'o_floor', 'search_field_type' => 'number' , 'callback' => 'callback_floor'],
			'o_price',
			[ 'label' => 'Phí dịch vụ <small>(usd/m<sup>2</sup>/tháng)</small>', 'field' => 'o_service_fee' ],
			[ 'label' => 'Tổng tiền<span>(usd/tháng)</span>', 'callback' => 'callback_totals', ],
			[ 'label' => 'VAT<span>(%)</span>', 'callback' => 'callback_vat' ],
			[ 'label' => 'Tổng tiền có VAT<span>(usd/tháng)</span>', 'callback' => 'callback_totals_include_vat', ],
		];
		$where    = null; //['district =' => 'Phú Nhuận'];
		$order    = [
			[ 'o_id', 'ASC' ]
		];

		$data['table'] = $this->crud->view( $page, $per_page, $columns, $where, $order );
		$data['items'] = $this->crud->view( $page, $per_page, $columns, $where, $order );
		return view( 'offices/table', $data );
	}

	/**
	 * @return \CodeIgniter\HTTP\RedirectResponse|string
	 */
	public function add() {
		$data['form']  = $form = $this->crud->form();
		$data['title'] = $this->crud->getAddTitle();

		if ( is_array( $form ) && isset( $form['redirect'] ) ) {
			return redirect()->to( $form['redirect'] );
		}

		return view( 'offices/form', $data );
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

		return view( 'offices/form', $data );
	}

	/**
	 * @return array
	 */
	protected function field_options() {

		$fields = [];
		$fields['o_id'] = ['label' => 'TT'];
		$fields['o_uid'] = [
			'label' => 'Tài khoản',
			'required' => true,
			'type' => 'dropdown',
			'relation' => [
				'table'=> 'w_users',
				'primary_key' => 'id',
				'display' => 'fullname',
				'order_by' => 'fullname',
				'order' => 'ASC'
			],
			'class' => 'col-12 col-sm-6 col-md-4'
		];
		$fields['o_title'] = ['label' => 'Tên tòa nhà', 'required' => true];
		$fields['o_city'] = ['label' => 'Tỉnh / thành phố', 'type' => 'hiden', 'class' => 'hidden'];
		$fields['o_district'] = [
			'label' => 'Quận / huyện',
			'type' => 'select',
			'required' => true,
			'class' => 'col-12 col-sm-6 col-md-4',
			'values' => 'callback_district_hcm',
		];
		$fields['o_acreage'] = ['label' => 'Diện tích <small>(m<sup>2</sup>)</small>', 'type' => 'number', 'required' => true, 'class' => 'col-12 col-sm-6 col-md-4' ];
		$fields['o_floor'] = ['label' => 'Tầng', 'type' => 'number', 'required' => true, 'class' => 'col-12 col-sm-6 col-md-4', 'attr' => [ 'min' => 1 ] ];
		$fields['o_price'] = ['label' => 'Giá chào thuê <small>(usd/m<sup>2</sup>/tháng)</small>', 'required' => true, 'class' => 'col-12 col-sm-6' ];
		$fields['o_service_fee'] = ['label' => 'Phí dịch vụ <small>(usd/m<sup>2</sup>/tháng)</small>', 'class' => 'col-12 col-sm-6', 'default' => '0'];
		$fields['o_status'] = ['label' => 'Tình trạng', 'class' => 'col-12 col-sm-6' ];

		$fields['o_created_at'] = ['label' => 'Thời gian tạo', 'type' => 'hiden', 'class' => 'hidden'];
		$fields['o_updated_at'] = ['label' => 'Thời gian cập nhật', 'type' => 'hiden', 'class' => 'hidden'];

		$fields['o_vat'] = ['label' => 'VAT', 'class' => 'col-12 col-sm-6', 'default' => 'Toàn bộ giá, phí chưa bao gồm VAT 10%'];
		$fields['o_car_parking_fee'] = ['label' => 'Phí đỗ xe ô tô', 'class' => 'col-12 col-sm-6'];
		$fields['o_motorbike_parking_fee'] = ['label' => 'Phí đỗ xe máy', 'class' => 'col-12 col-sm-6'];
		$fields['o_air_conditioner_fee'] = ['label' => 'Điện điều hòa', 'class' => 'col-12 col-sm-6', 'default' => 'Bao gồm trong phí dịch vụ'];
		$fields['o_electricity_fee'] = ['label' => 'Điện trong văn phòng', 'class' => 'col-12 col-sm-6', 'default' => 'Tính thực tế tiêu thụ theo đồng hồ'];
		$fields['o_work_time'] = ['label' => 'Giờ làm việc', 'class' => 'col-12 col-sm-6', 'default' => 'Thứ 2-6 từ 7:00-18:00, Thứ 7 từ 07:00-13:00'];
		$fields['o_overtime_fee'] = ['label' => 'Chi phí ngoài giờ', 'class' => 'col-12 col-sm-6'];
		$fields['o_address'] = ['label' => 'Địa chỉ tòa nhà', 'class' => 'col-12 col-sm-6'];
		$fields['o_scale_building'] = ['label' => 'Quy mô tòa nhà', 'class' => 'col-12 col-sm-6'];
		$fields['o_typical_floor'] = ['label' => 'Tầng điển hình', 'class' => 'col-12 col-sm-6'];
		$fields['o_air_conditioner'] = ['label' => 'Điều hòa', 'class' => 'col-12 col-sm-6'];
		$fields['o_elevator'] = ['label' => 'Thang máy', 'class' => 'col-12 col-sm-6'];
		$fields['o_generator'] = ['label' => 'Máy phát', 'class' => 'col-12 col-sm-6' ];

		$fields['offices_files'] = [
			'label' => 'Ảnh tòa nhà',
			'type' => 'files',
			'files_relation' => [
				'files_table' => 'w_offices_files',
				'primary_key' => 'of_id',
				'parent_field' => 'w_offices_id',
				'file_name_field' => 'of_file_name',
				'file_type_field' => 'of_file_type',
			],
			'path' => './uploads/images',
			'is_image' => true,
			'max_size' => '2048',
			'ext_in' => 'png,jpg,jpeg,gif',
			'wrapper_start' => '<div class="row">',
			'wrapper_end' => '</div>',
			'wrapper_item_start' => '<div class="col-4 col-sm-2 mt-3 mb-3">',
			'wrapper_item_end' => '</div>',
			'show_file_names' => false,
			'placeholder' => '/assets/img/file-icon.png',
			'delete_callback' => 'deleteFile',
			'delete_file' => true,
			'delete_button_class' => 'btn btn-danger btn-xs'
		];

		return $fields;
	}

	/**
	 * @param $id
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function delete($id) {

		$path = './uploads/images';

		// delete in w_offices_files table
		$where = [ 'w_offices_id' => $id ];
		$o_files = $this->crud->getRows( 'w_offices_files', $where );
		foreach ( $o_files as $file) {
			unlink($path . '/' . $id . '/' . $file->of_file_name);
		}

		unset($o_files);
		$this->crud->deleteItem( 'w_offices_files', $where );

		// delete in w_offices
		$where = ['o_id' => $id];
		$item = $this->crud->deleteItem( 'w_offices', $where );

		if (!$item)
			$this->crud->flash('warning', 'Content could not be deleted');
		else {
			$this->crud->flash('success', 'Content successfully deleted');
		}

		return redirect()->to( $this->crud->getBase() . '/' . $this->crud->getRoute() );
	}

	/**
	 * @param $parent_id
	 * @param $file_id
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function deletefile($parent_id, $file_id)
	{
		$crud = $this->crud;
		$current_values = $crud->current_values($parent_id);
		if (!$current_values)
			return redirect()->to($crud->getBase() . '/' . $crud->getRoute());

		$field = $crud->getFields('offices_files');

		$table = $field['files_relation']['files_table'];
		$relationOptions = $field['files_relation'];
		$where = [$relationOptions['primary_key'] => $file_id];
		$item = $crud->deleteItem($table, $where);

		if (!$item)
			$crud->flash('warning', 'File could not be deleted');
		else {

			if ($field['delete_file'] ?? false && $field['delete_file'] === TRUE)
				unlink($field['path'] . '/' . $parent_id . '/' . $item->{$relationOptions['file_name_field']});

			$crud->flash('success', 'File was deleted');
		}

		$url = $crud->getBase() . '/' . $crud->getRoute() . '/edit/' . $parent_id;
		return redirect()->to($url);
	}
}
