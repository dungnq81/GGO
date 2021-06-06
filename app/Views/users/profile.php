<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="register-box">
	<div class="card">
		<div class="card-body register-card-body">
			<h5 class="login-box-msg">Cập nhật thông tin</h5>
			<?php echo form_open_multipart( uri_string() )?>
				<div class="input-group mb-4">
					<input value="<?= set_value('fullname', $user['fullname']) ?>" type="text" name="fullname" id="fullname" class="form-control" placeholder="Họ tên">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="input-group mb-4 col-12 col-sm-6">
                        <input readonly value="<?= $user['email'] ?>" required type="email" name="email" id="email" class="form-control" placeholder="Địa chỉ Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-4 col-12 col-sm-6">
                        <input value="<?= set_value('phone', $user['phone']) ?>" type="tel" name="phone" id="phone" class="form-control" placeholder="Số điện thoại">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="input-group mb-4">
					<input value="" type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-4">
					<input value="" type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Xác nhận lại mật khẩu">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<?php if (isset($validation)): ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
							<?= $validation->listErrors() ?>
                        </div>
                    </div>
				<?php endif; ?>
				<div class="row">
					<div class="col-12">
						<button type="submit" class="btn btn-primary btn-block">Cập nhật</button>
					</div>
				</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
