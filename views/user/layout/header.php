<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="<?= URL ?>publics/image/logo_qt_png.png" type="image/x-icon">
    <title><?= isset($title) ? $title : 'Quyết Tâm' ?></title>
    <link rel="stylesheet" href="<?= URL ?>publics/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL ?>publics/css/custom.css">
</head>

<body class="container p-0" id="themeText" data-bs-theme="">
    <div class="row my-1 d-flex align-items-center mt-3 mt-lg-1 ms-1 ms-lg-0">
        <div class="col-12 col-lg-6 d-flex align-items-center p-0">
            <div class="pe-3">
                <a class="navbar-brand fs-5" href="<?= URL ?>">
                    <img width="40" src="<?= URL ?>publics/image/logo_qt_png.png" alt="">
                    <span class="text-danger">Quyết Tâm</span>
                </a>
            </div>
            <div class="border-start px-3 small mt-1 text-muted">
                <?= date_now() ?>
            </div>
            <div class="border-start px-3 small mt-1 text-muted">
                <span>TP. Hồ Chí Minh</span>
                <span>36<sup>o</sup> C</span>
            </div>
        </div>
        <div class="col-12 col-lg-6 d-flex justify-content-lg-end justify-content-center my-3 my-lg-0">
            <button class="nav-link text-hover" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartCanvas" aria-controls="cartCanvas" href="<?= URL ?>gio-hang">
                <i class="me-1 fas fa-shopping-bag"></i> <small>Giỏ hàng</small>
            </button>
            <button class="nav-link text-hover ms-3" id="toggleButton">
                <i class="me-1 fas small fa-adjust"></i> <small>Màu nền</small>
            </button>
            <a href="<?= URL ?>dang-nhap" class="nav-link text-hover ms-3">
                <i class="me-1 fas fa-user"></i> <small>Đăng nhập</small>
            </a>
        </div>
    </div>
    <nav class="position-sticky fixed-top navbar navbar-expand-lg bg-body-tertiary border-bottom">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse px-3 px-lg-0" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">

                        <a href="<?= URL ?>trang-chu" class="nav-link"><span
                                class="<?= $page == 'home' ? 'text-active' : 'text-hover' ?>"><i
                                    class="fas fa-home me-2"></i><small>Trang chủ</small></span></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= URL ?>ve-chung-toi" class="nav-link"><small
                                class="<?= $page == 'about' ? 'text-active' : 'text-hover' ?>">Về chúng tôi</small></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= URL ?>mua-san-pham" class="nav-link"><small
                                class="<?= $page == 'product' ? 'text-active' : 'text-hover' ?>">Mua sản
                                phẩm</small></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= URL ?>quyen-gop" class="nav-link"><small
                                class="<?= $page == 'donate' ? 'text-active' : 'text-hover' ?>">Quyên góp</small></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= URL ?>tin-tuc" class="nav-link"><small
                                class="<?= $page == 'blog' ? 'text-active' : 'text-hover' ?>">Tin tức</small></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= URL ?>lien-he" class="nav-link"><small
                                class="<?= $page == 'contact' ? 'text-active' : 'text-hover' ?>">Liên hệ</small></a>
                    </li>
                </ul>
                <form method="post" class="d-flex" role="search">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Nhập thông tin tìm kiếm..."
                            aria-label="Search">
                        <button class="btn btn-sm" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <div class="offcanvas offcanvas-end <?= showCanvasCart() ?>" data-bs-scroll="true" tabindex="-1" id="cartCanvas"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Giỏ hàng</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body text-center">
            <?php
            if ($_SESSION['cart']) {
                $product_hidden = 0;
                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                    $productInCart = get_one_product_by_id($_SESSION['cart'][$i]['id']);
                    if (!$productInCart) {
                        ++$product_hidden;
                        continue;
                    }
                    ?>
                    <div class="row my-3 mx-1 border rounded-5 rounded-end-0 ">
                        <img src="<?= URL ?>/publics/image/product/<?= $productInCart['imgDefault'] ?>"
                            class="p-0 col-4 rounded-5 rounded-end-0 object-fit-cover" alt="...">
                        <div class="col-8 text-start">
                            <div class="mt-1"><?= $productInCart['name'] ?></div>
                            <div class="mt-1">Số lượng : <?= $_SESSION['cart'][$i]['quantity'] ?> <span class="text-danger small ms-2">( giới hạn: <?= $productInCart['quantity']?> )</span></div>
                            <div class="mt-1">Giá : <span class="text-danger"><?= number_format($productInCart['price']) ?> <sup>vnđ</sup></span></div>
                            <form action="" method="post">
                                <button name="removeCart" value="<?= $i ?>" class="btn btn-sm border text-hover p-0 px-2 my-2">
                                    <i class="fas fa-trash-alt me-2"></i>Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                <?php }
                if ($product_hidden == count($_SESSION['cart'])) echo '<p class="text-muted">Chưa có sản phẩm nào.</p>';
            } else echo '<p class="text-muted">Chưa có sản phẩm nào.</p>'; ?>
            <a href="<?= URL ?>gio-hang" class="btn btn-sm btn-outline-danger px-5 mt-2 <?= count($_SESSION['cart']) ? '' : 'disabled' ?>">&rarr; Xem giỏ hàng</a>
            <a href="<?= URL ?>thanh-toan" class="btn btn-sm btn-outline-danger px-5 mt-2 <?= count($_SESSION['cart']) ? '' : 'disabled' ?>">&rarr; Thanh toán</a>
        </div>
    </div>
    <!-- Content -->
    <div class="mt-3 mx-3 mx-lg-0">