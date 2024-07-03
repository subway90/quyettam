<div class="h2 text-center text-danger text-uppercase mt-3">
    Đăng nhập
</div>
<div class="row mt-lg-5 d-flex flex-lg-row flex-column-reverse">
    <div class="col-12 col-md-12 col-lg-6 p-0 text-center pt-4">
        <img class="w-50" src="<?=URL_IMAGE_SYSTEM?>logo_qt_png.png" alt="logo quyết tâm">
    </div>
    <div class="col-12 col-md-12 col-lg-6 border rounded-5 py-4">
        <div class="row px-1">
            <form action="<?=URL?>dang-nhap" method="post">
                <div class="col-12 text-center d-flex justify-content-center px-lg-5 px-1">
                    <div class="form-floating mb-3 w-100">
                        <input type="text" name="user" value="<?=$user?>" class="form-control" id="floatingInput" placeholder="Nhập TK">
                        <label for="floatingInput">Tài khoản đăng nhập</label>
                    </div>
                </div>
                <div class="col-12 text-center d-flex justify-content-center px-lg-5 px-1">
                    <div class="form-floating mb-3 w-100">
                        <input type="password" name="pass" class="form-control" id="floatingInput" placeholder="MK">
                        <label for="floatingInput">Mật khẩu</label>
                    </div>
                </div>
                <div class="col-12 text-start d-flex justify-content-center px-lg-5 px-1">
                    <div class="form-check form-switch w-50">
                        <input name="remember" <?=$remember?> class="form-check-input border-danger bg-danger" role="switch" type="checkbox" id="rememberUser">
                        <label class="form-check-label text-danger" for="rememberUser">Ghi nhớ tài khoản</label>
                    </div>
                    <div class="w-50 text-end">
                        <a class="nav-link" href="<?=URL?>quen-mat-khau"><i class="fas fa-question-circle"></i> Quên mật khẩu</a>
                    </div>
                </div>
                <div class="col-12 text-center d-flex justify-content-center px-lg-5 px-1">
                    <button name="login" type="submit" class="btn btn-outline-danger">
                        Đăng nhập
                    </button>
                </div>
            </form>
            <div class="col-12">
                <div class="py-3 small fw-semi text-secondary text-center">hoặc tiếp tục với</div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="col-4 col-md-4 col-lg-3 mx-1">
                    <a href="#" class="nav-link btn border text-hover py-1 px-1">
                        <i class="fab fa-facebook"></i> facebook
                    </a>
                </div>
                <div class="col-4 col-md-4 col-lg-3 mx-1">
                    <a href="#" class="nav-link btn border text-hover py-1 px-1">
                        <i class="fab fa-google"></i> google
                    </a>
                </div>
                <div class="col-4 col-md-4 col-lg-3 mx-1">
                    <a href="#" class="nav-link btn border text-hover py-1 px-1">
                    <i class="fas fa-user-plus"></i> đăng ký
                    </a>
                </div>
            </div>
    </div>
    </div>
    </div>