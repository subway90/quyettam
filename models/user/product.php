<?php
function get_all_product() {
    return pdo_query(
        'SELECT * FROM products WHERE status = 1'
    );
}