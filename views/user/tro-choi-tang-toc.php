<div class="h2 text-center text-danger text-uppercase mt-3">
    trò chơi tăng tốc
</div>
<?php
# SUCCESS
if($success_result) {
?>
<div class="mt-5 row">
    <div class="col-12 text-center">
        <div class="h1 text-success">
            <i class="fas fa-check-circle"></i>
        </div>
        <span class=" text-success h2">Kết quả của bạn đã được gửi đi !</span>
        <div class="col-12 mt-3">
        <a href="<?= URL ?>tro-choi-tang-toc/bang-ket-qua" class="text-hover btn border">
            &rarr; Xem bảng kết quả
        </a>
        </div>
    </div>
</div>
<?php
# FORM
}else {
?>
<div class="mt-5">
    <form method="post">
        <div class="row d-flex justify-content-center">
            <div class="col-12 text-center mb-3">
                <p class="h6">Nhập MSSV + Họ và tên của bạn</p>
            </div>
            <div class="col-12 mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-12 col-lg-3">
                        <div class="form-floating">
                            <input name="name" value="<?= $name ?>"
                                class="form-control text-center float-center text-danger" type="text" placeholder="a"
                                id="name">
                            <label class="small" for="name">Ví dụ: PS12345 - Nguyễn Văn A</i></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center mb-3">
                <p class="h6">Nhập đáp án của bạn</p>
                <span class="text-danger">
                    <strong>Lưu ý: Bạn chỉ có thể gửi 1 lần đáp án, vì vậy hãy cân nhắc đáp án trước khi gửi !</strong>
                </span>
            </div>
            <div class="col-12 mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="p-0 col-11 col-md-12 col-lg-4">
                        <div class="form-floating">
                            <input name="result" value="<?= $result ?>"
                                class="form-control text-center float-center text-danger" type="text" placeholder="a"
                                id="name">
                            <label class="small" for="name">Nhấn vào đây để nhập đáp án của bạn</i></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center mt-1">
                <button <?= $status_active == 1 ? '' : 'disabled' ?> name="submit" value="true" type="submit" class="btn btn-danger">
                    <?= $status_active == 1 ? 'Gửi đáp án' : 'Trò chơi chưa bắt đầu' ?>
                </button>
            </div>
        </div>
    </form>
</div>
<?php } ?>