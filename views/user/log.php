<div class="h2 text-center text-danger text-uppercase mt-3">
    LOG DATA
    <div class="small fs-6 mt-4">Ví dụ đây là một server của attacker</div>
</div>
<div class="border border-1 border-danger p-5 mx-2 mx-lg-0">
    <form class="mb-5" action="" method="post">
        <?php
        if($admin)  {?>
        <button name="refresh_data" type="submit" class="border border-1 btn btn-sm btn-outline-danger">
            <i class="fas fa-refresh small"></i>
            Refresh Data
        </button>
        <?php }
        if ($distinct) { ?>
            <button name="default_data" type="submit" class="border border-1 btn btn-sm btn-outline-danger">
                <i class="fas fa-database small"></i>
                Default Data
            </button>
        <?php } else { ?>
            <button name="distinct_data" type="submit" class="border border-1 btn btn-sm btn-outline-danger">
                <i class="fas fa-hashtag small"></i>
                Distinct Data
            </button>
        <?php } ?>
        <button onclick="window.open('<?=URL?>test-area')" class="border border-1 btn btn-sm btn-outline-danger">
            <i class="fas fa-sign-in small"></i>
            Test area
        </button>
    </form>
    <table class="table">
        <th>Thời gian</th>
        <th>Địa chỉ</th>
        <th>Dữ liệu</th>
        <?php
        if ($distinct) {
            foreach ($distinct as $row) {
                ?>
                <tr>
                    <td> <?= '######' ?> </td>
                    <td> <?= $row['address'] ?> </td>
                    <td> <?= $row['content'] ?> </td>
                </tr>
            <?php }
        } else { ?>
            <?php
            if ($list_data_log) {
                foreach ($list_data_log as $data) {
                    ?>
                    <tr>
                        <td> <?= $data['create_at'] ?> </td>
                        <td> <?= $data['address'] ?> </td>
                        <td> <?= $data['content'] ?> </td>
                    </tr>
                <?php }
            } else { ?>
                <tr class="text-center">
                    <td colspan="3">Không có dữ liệu</td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
</div>