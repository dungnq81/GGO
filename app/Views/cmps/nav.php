<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php
        $request = service('request');

        $segment1 = null;
        $segment2 = null;
        if ($request->uri->getTotalSegments() >= 1 && $request->uri->getSegment(1)) {
	        $segment1 = $request->uri->getSegment(1);
        }

        if ($request->uri->getTotalSegments() >= 2 && $request->uri->getSegment(2)) {
	        $segment2 = $request->uri->getSegment(2);
        }

        ?>
        <li class="nav-item">
            <a href="/" class="nav-link <?= !$segment1 ? 'active' : null; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Bảng điều khiển</p>
            </a>
        </li>
        <li class="nav-header">VĂN PHÒNG</li>
        <li class="nav-item">
            <a href="/offices" class="nav-link <?= ($segment1 == 'offices' && (!$segment2 || $segment2 == 'edit')) ? 'active' : null; ?>">
                <i class="nav-icon fas fa-building"></i>
                <p>Danh sách tòa nhà</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/offices/add" class="nav-link <?= ($segment1 == 'offices' && $segment2 == 'add') ? 'active' : null; ?>">
                <i class="nav-icon far fa-building"></i>
                <p>Thêm mới</p>
            </a>
        </li>
        <li class="nav-header">TÀI KHOẢN</li>
        <li class="nav-item menu-is-opening menu-open">
            <a href="#" class="nav-link <?= ($segment1 == 'users') ? 'active' : null; ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Tài khoản
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">3</span>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/users" class="nav-link <?= ($segment1 == 'users'  && !$segment2) ? 'active' : null; ?>">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Danh sách tài khoản</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/users/add" class="nav-link <?= ($segment1 == 'users' && $segment2 == 'add') ? 'active' : null; ?>">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p>Đăng ký mới</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/users/logout" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p>Thoát</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>