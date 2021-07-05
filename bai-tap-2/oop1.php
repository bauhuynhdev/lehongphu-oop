<?php
    class nhanvien {
        public $ho;
        public $ten;
        public $ngay_sinh;

    function hoten(){}
    function ngay_sinh(){}
    }

    $hs1->ho = "Hồng Phú";
    $hs1->ten = "Lee";
    $hs1->ngay_sinh = "30/06/2000";

    echo "<p>Toi ten la: {$hs1->ho} </p>";
    echo "<p>toi sinh nam: {$hs1->ngay_sinh} </p>";
?>