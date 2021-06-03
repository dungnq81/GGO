<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>GGO</b></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Thông tin đăng nhập</p>
	        <?php if (session()->get('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->get('success') ?>
            </div>
	        <?php endif; ?>
	        <?php echo form_open_multipart( uri_string() )?>
                <div class="input-group mb-3">
                    <input required type="email" name="email" id="email" class="form-control" placeholder="Địa chỉ Email" value="<?= set_value('email') ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input required type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu">
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
                    <div class="col-7">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">Ghi nhớ</label>
                        </div>
                    </div>
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                    </div>
                </div>
	        <?php echo form_close();?>
        </div>
    </div>
</div>