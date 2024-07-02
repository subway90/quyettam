<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="<?=URL?>publics/image/logo_qt_png.png" type="image/x-icon">
    <title><?= isset($title) ? $title : 'Quyết Tâm' ?></title>
    <link rel="stylesheet" href="<?=URL?>publics/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=URL?>publics/css/custom.css">
</head>

<body class="container p-0" id="themeText" data-bs-theme="">
    <div class="row my-1 d-flex align-items-center mt-3 mt-lg-1 ms-1 ms-lg-0">
        <div class="col-12 col-lg-6 d-flex align-items-center p-0">
            <div class="pe-3">
                <a class="navbar-brand fs-5" href="<?=URL?>">
                    <img width="40" src="<?=URL?>publics/image/logo_qt_png.png" alt="">
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
            <a href="<?=URL?>dang-nhap" class="nav-link">
                <small class="text-hover">Đăng nhập</small>
            </a><a href="<?=URL?>dang-nhap" class="nav-link ms-2">
                <small class="text-hover">Đăng kí</small>
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
                        
                        <a href="<?=URL?>trang-chu" class="nav-link"><span class="<?= $page == 'home' ? 'text-active' : 'text-hover' ?>"><i class="fas fa-home me-2"></i><small>Trang chủ</small></span></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=URL?>ve-chung-toi" class="nav-link"><small class="<?= $page == 'about' ? 'text-active' : 'text-hover' ?>">Về chúng tôi</small></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=URL?>mua-san-pham" class="nav-link"><small class="<?= $page == 'buy' ? 'text-active' : 'text-hover' ?>">Mua sản phẩm</small></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=URL?>quyen-gop" class="nav-link"><small class="<?= $page == 'donate' ? 'text-active' : 'text-hover' ?>">Quyên góp</small></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=URL?>tin-tuc" class="nav-link"><small class="<?= $page == 'blog' ? 'text-active' : 'text-hover' ?>">Tin tức</small></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=URL?>lien-he" class="nav-link"><small class="<?= $page == 'contact' ? 'text-active' : 'text-hover' ?>">Liên hệ</small></a>
                    </li>
                    <li class="nav-item">
                        <button class="btn"> <i class="fas small fa-adjust" id="toggleButton"></i></button>
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

    <!-- Content -->
    <div class="mt-3 mx-1 mx-lg-0"></div>