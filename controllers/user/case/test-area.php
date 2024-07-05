<?php 

$string = '2/4';

# [DATA]
$data = [
    'result' => explode('/',$string)[1]
];

# [RENDER VIEW]
view('Khu vực kiểm thử','test',$data);