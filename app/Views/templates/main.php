<!DOCTYPE html>
<html lang="vi" class="no-js">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= @$title ?></title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" />
	<link rel="stylesheet" href="/assets/css/awe.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.css">
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/assets/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="/assets/css/app.css">

    <script src="/assets/plugins/jquery/jquery.min.js"></script>

    <link rel="icon" type="image/png" href="/assets/img/icon.png" />
</head>
<body class="hold-transition sidebar-mini"><!--sidebar-collapse-->
<div class="wrapper">
	<!-- Navbar -->
	<?= $this->include('cmps/top-nav') ?>
	<!-- /.navbar -->

	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="/" class="brand-link">
			<img src="/assets/img/logo-sagoofice.png" alt="Sago Office Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light">Sago Office</span>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="/assets/img/avatar.png" class="img-circle elevation-2" alt="Avatarr">
				</div>
				<div class="info">
                    <?php
                    $name = 'Guest';
                    if (isset( $user )) {
                        if ($user['fullname'])
                            $name = $user['fullname'];
                        else if ($user['phone'])
                            $name = $user['phone'];
                        else $name = $user['email'];
                    }
                    ?>
					<a href="/users/profile" class="d-block"><?= @$name; ?></a>
				</div>
			</div>

			<!-- Sidebar Menu -->
			<?= $this->include('cmps/nav') ?>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">

		<?= view_cell('\App\Libraries\Admin::title', ['title' => @$title]) ?>

        <section class="content">
            <div class="container-fluid">

	            <?= $this->include('cmps/alerts') ?>
	            <?= $this->renderSection('content') ?>

            </div><!-- /.container-fluid -->
        </section>
	</div>
	<!-- /.content-wrapper -->
	<footer class="main-footer">
		<div class="float-right d-none d-sm-block"><b>Version</b> 1.0.0</div>
		<strong>Copyright &copy; <?=date('Y')?> <a href="#">Sago Office</a>.</strong> All rights reserved.
	</footer>
</div>
<!-- ./wrapper -->

<script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>$.widget.bridge('uibutton', $.ui.button)</script>
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/plugins/select2/js/select2.full.min.js"></script>
<script src="/assets/plugins/chart.js/Chart.min.js"></script>
<script src="/assets/plugins/sparklines/sparkline.js"></script>
<script src="/assets/plugins/moment/moment.min.js"></script>
<script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="/assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="/assets/js/adminlte.min.js"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>
