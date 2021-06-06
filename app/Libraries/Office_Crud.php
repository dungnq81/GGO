<?php

namespace App\Libraries;

use App\Libraries\Crud_core;
use CodeIgniter\HTTP\RequestInterface;

/**
 * Class Office_Crud
 * @package App\Libraries
 */
class Office_Crud extends Crud_core {

	/**
	 * Office_Crud constructor.
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

	/**
	 * Callback method
	 *
	 * @return int
	 */
	public function callback_vat() {
		return 10;
	}

	/**
	 * @param $item
	 *
	 * @return string
	 */
	public function callback_acreage( $item) {
		return $item->o_acreage . ' m<sup>2</sup>';
	}

	/**
	 * @param $item
	 *
	 * @return string
	 */
	public function callback_floor( $item ) {
		return 'Tầng ' . $item->o_floor;
	}

	/**
	 * Callback method
	 *
	 * @param $item
	 */
	public function callback_totals( $item ) {
		return number_format( ($item->o_price + $item->o_service_fee ) * $item->o_acreage, 1 );
	}

	/**
	 * Callback method
	 *
	 * @param $item
	 */
	public function callback_totals_include_vat( $item ) {
		return number_format( ($item->o_price + $item->o_service_fee) * $item->o_acreage * 1.100, 1 );
	}

	/**
	 * @return array
	 */
	public function callback_district_hcm() {
		$tmp = [];

		$q = $this->get_quantphcm();
		foreach ($q as $value) {
			$tmp[] = $value['name'];
		}

		return array_values($tmp);
	}

	/**
	 * @param $item
	 *
	 * @return string
	 */
	public function callback_checkbox ($item) {
		$o_id = $item->o_id;
		return '<label class="screen-reader-text" for="checkbox_item_' . $o_id . '">' . $item->o_title . '</label><input class="cb-item-1" form="search-inline" type="checkbox" name="checked[]" value="' . $o_id . '" id="checkbox_item_' . $o_id . '">';
	}

	/**
	 * @param $ten_quan
	 *
	 * @return false|int|string
	 */
	public function get_quantphcm() {
		$result       = '
	{"module":[
		{"id":"R2587287","name":"Quận\u00201","nameLocal":"","parentId":"R1973756","displayName":"Quận\u00201"},
		{"id":"R3799817","name":"Quận\u00202","nameLocal":"","parentId":"R1973756","displayName":"Quận\u00202"},
		{"id":"R3819816","name":"Quận\u00203","nameLocal":"","parentId":"R1973756","displayName":"Quận\u00203"},
		{"id":"R2778323","name":"Quận\u00204","nameLocal":"","parentId":"R1973756","displayName":"Quận\u00204"},
		{"id":"R3820432","name":"Quận\u00205","nameLocal":"","parentId":"R1973756","displayName":"Quận\u00205"},
		{"id":"R6228792","name":"Quận\u00206","nameLocal":"","parentId":"R1973756","displayName":"Quận\u00206"},
		{"id":"R2764875","name":"Quận\u00207","nameLocal":"","parentId":"R1973756","displayName":"Quận\u00207"},
		{"id":"R6888445","name":"Quận\u00208","nameLocal":"","parentId":"R1973756","displayName":"Quận\u00208"},
		{"id":"R7144246","name":"Quận\u00209","nameLocal":"","parentId":"R1973756","displayName":"Quận\u00209"},
		{"id":"R6228121","name":"Quận\u002010","nameLocal":"","parentId":"R1973756","displayName":"Quận\u002010"},
		{"id":"R6846181","name":"Quận\u002011","nameLocal":"","parentId":"R1973756","displayName":"Quận\u002011"},
		{"id":"R6923167","name":"Quận\u002012","nameLocal":"","parentId":"R1973756","displayName":"Quận\u002012"},
		{"id":"R6909710","name":"Quận\u0020Bình\u0020Tân","nameLocal":"","parentId":"R1973756","displayName":"Quận\u0020Bình\u0020Tân"},
		{"id":"R3797166","name":"Quận\u0020Bình\u0020Thạnh","nameLocal":"","parentId":"R1973756","displayName":"Quận\u0020Bình\u0020Thạnh"},
		{"id":"R6908316","name":"Quận\u0020Gò\u0020Vấp","nameLocal":"","parentId":"R1973756","displayName":"Quận\u0020Gò\u0020Vấp"},
		{"id":"R3851694","name":"Quận\u0020Phú\u0020Nhuận","nameLocal":"","parentId":"R1973756","displayName":"Quận\u0020Phú\u0020Nhuận"},
		{"id":"R6846177","name":"Quận\u0020Tân\u0020Bình","nameLocal":"","parentId":"R1973756","displayName":"Quận\u0020Tân\u0020Bình"},
		{"id":"R6846128","name":"Quận\u0020Tân\u0020Phú","nameLocal":"","parentId":"R1973756","displayName":"Quận\u0020Tân\u0020Phú"},
		{"id":"R6941055","name":"Quận\u0020Thủ\u0020Đức","nameLocal":"","parentId":"R1973756","displayName":"Quận\u0020Thủ\u0020Đức"},
		{"id":"R7157268","name":"Huyện\u0020Bình\u0020Chánh","nameLocal":"","parentId":"R1973756","displayName":"Huyện\u0020Bình\u0020Chánh"},
		{"id":"R7157255","name":"Huyện\u0020Cần\u0020Giờ","nameLocal":"","parentId":"R1973756","displayName":"Huyện\u0020Cần\u0020Giờ"},
		{"id":"R7157220","name":"Huyện\u0020Củ\u0020Chi","nameLocal":"","parentId":"R1973756","displayName":"Huyện\u0020Củ\u0020Chi"},
		{"id":"R7157219","name":"Huyện\u0020Hóc\u0020Môn","nameLocal":"","parentId":"R1973756","displayName":"Huyện\u0020Hóc\u0020Môn"},
		{"id":"R7157197","name":"Huyện\u0020Nhà\u0020Bè","nameLocal":"","parentId":"R1973756","displayName":"Huyện\u0020Nhà\u0020Bè"}
	],
	"success":true,"errorCode":null,"retry":false,"repeated":false,"notSuccess":false}';
		$resul_decode = ( json_decode( $result, true ) );

		return $resul_decode['module'];
	}
}
