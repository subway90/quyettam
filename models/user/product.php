<?php
function get_all_product() {
    return pdo_query(
        'SELECT * FROM products WHERE status = 1'
    );
}
function get_one_product_by_slug($slug) {
    return pdo_query_one(
        'SELECT * FROM products WHERE status = 1 AND slug ="'.$slug.'"'
    );
}