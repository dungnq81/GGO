<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<?= $table ?>

<?php
$request = service('request');

$table_search = $request->getPost( 'table_search' );
$checked = $request->getPost( 'checked' );
if( $checked) :

?>
<div class="row" id="w_offices_content_print">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Tổng hợp văn phòng</h3>
                <span>*Giá thuê có thể đàm phán</span>
			</div>
			<div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap" id="w_offices_print">
					<tbody>
					<tr>
						<th class="th th-id">TT</th>
						<th class="th th-o_title">Tên tòa nhà</th>
						<th class="th th-o_district">Quận / huyện</th>
						<th class="th th-tang">Diện tích / Tầng</th>
						<th class="th th-o_price">Giá chào thuê <small>(usd/m<sup>2</sup>/tháng)</small></th>
						<th class="th th-phi-dich-vu">Phí dịch vụ <small>(usd/m<sup>2</sup>/tháng)</small></th>
						<th class="th th-tong-tien">Tổng tiền<span>(usd/tháng)</span></th>
						<th class="th th-vat">VAT<span>(%)</span></th>
						<th class="th th-tong-tien-co-vat">Tổng tiền có VAT<span>(usd/tháng)</span></th>
						<th class="th-action"><span class="hide">Actions</span></th>
					</tr>
					</tbody>
					<tbody>
					<tr class="row_item">
						<td class="td td-id">2</td>
						<td class="td td-o_title">Lucky House</td>
						<td class="td td-o_district">Quận Phú Nhuận</td>
						<td class="td td-tang">133 m<sup>2</sup> - Tầng 1</td>
						<td class="td td-o_price">13.5</td>
						<td class="td td-phi-dich-vu">0</td>
						<td class="td td-tong-tien">1,795.5</td>
						<td class="td td-vat">10</td>
						<td class="td td-tong-tien-co-vat">1,975.1</td>
					</tr>
					<tr class="row_item">
						<td class="td td-id">2</td>
						<td class="td td-o_title">Lucky House</td>
						<td class="td td-o_district">Quận Phú Nhuận</td>
						<td class="td td-tang">133 m<sup>2</sup> - Tầng 1</td>
						<td class="td td-o_price">13.5</td>
						<td class="td td-phi-dich-vu">0</td>
						<td class="td td-tong-tien">1,795.5</td>
						<td class="td td-vat">10</td>
						<td class="td td-tong-tien-co-vat">1,975.1</td>
					</tr>
					</tbody>
				</table>
			</div>
            <div class="card-infos">
                <div class="infos-offices">
                    <h3><span>1.</span> Báo tuổi trẻ</h3>
                    <div class="of-item col-12">
                        <div class="heading-title">
                            <h6>Văn phòng cho thuê</h6>
                            <span>*Giá thuê có thể đàm phán</span>
                        </div>
                        <ul class="of-table">
                            <li>
                                <label>Diện tích</label>
                                <p>120 m<sup>2</sup></p>
                            </li>
                            <li>
                                <label>Tầng</label>
                                <p>5</p>
                            </li>
                            <li>
                                <label>Tình trạng</label>
                                <p>Đang trống</p>
                            </li>
                            <li>
                                <label>Giá thuê</label>
                                <p>16 usd/m<sup>2</sup></p>
                            </li>
                            <li>
                                <label>Phí dịch vụ</label>
                                <p>5 usd/m<sup>2</sup></p>
                            </li>
                            <li>
                                <label>Tổng tiền</label>
                                <p>2520<span class="block">usd/m<sup>2</sup></span></p>
                            </li>
                        </ul>
                    </div>
                    <div class="of-item col-6">
                        <div class="heading-title">
                            <h6>Chi phí khác</h6>
                        </div>
                        <ul class="of-table of-horizontal">
                            <li>
                                <label>VAT</label>
                                <p>Toàn bộ giá, phí chưa bao gồm VAT 10%</p>
                            </li>
                            <li>
                                <label>Đỗ ô tô</label>
                                <p>800.000 vnd/xe/tháng</p>
                            </li>
                            <li>
                                <label>Đỗ xe máy</label>
                                <p>150.000 vnd/xe/tháng</p>
                            </li>
                            <li>
                                <label>Điện điều hòa</label>
                                <p>Bao gồm trong phí dịch vụ</p>
                            </li>
                            <li>
                                <label>Điện trong VP</label>
                                <p>Tính thực tế tiêu thụ theođồng hồ</p>
                            </li>
                            <li>
                                <label>Giờ làm việc</label>
                                <p>Thứ 2-6 từ 7:00-18:00,Thứ 7 từ 07:00-13:00</p>
                            </li>
                            <li>
                                <label>Phí ngoài giờ</label>
                                <p>200.000vnd/h</p>
                            </li>
                        </ul>
                    </div>
                    <div class="of-item col-6">
                        <div class="heading-title">
                            <h6>Thông tin tòa nhà</h6>
                        </div>
                        <ul class="of-table of-horizontal">
                            <li>
                                <label>Địa chỉ</label>
                                <p>60A Hoàng Văn Thụ,Phường 9, Phú Nhuận</p>
                            </li>
                            <li>
                                <label>Quy mô</label>
                                <p>05 tầng và 01 tầng hầm</p>
                            </li>
                            <li>
                                <label>Tầng điển hình</label>
                                <p>150.000 vnd/xe/tháng</p>
                            </li>
                            <li>
                                <label>Điều hòa</label>
                                <p>Bao gồm trong phí dịch vụ</p>
                            </li>
                            <li>
                                <label>Thang máy</label>
                                <p>Tính thực tế tiêu thụ theođồng hồ</p>
                            </li>
                            <li>
                                <label>Máy phát</label>
                                <p>Thứ 2-6 từ 7:00-18:00,Thứ 7 từ 07:00-13:00</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<?php endif; ?>
<?= $this->endSection() ?>
