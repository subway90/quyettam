<div class="h2 text-center text-danger text-uppercase mt-3">
    Khu vực kiểm thử
</div>
<div class="border border-1 border-danger p-5 mx-2 mx-lg-0">

<?php 

if($error) echo 'Lỗi cURL';
else 
{
    echo'<pre>';
    print_r($array_code_bank);
    echo'</pre>';
}

?>


</div>