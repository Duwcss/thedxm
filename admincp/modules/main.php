<div>
    <?php
        if(isset($_GET['action']) && $_GET['query']){
            $tam = $_GET['action'];
            $query = $_GET['query'];
         }else{
            $tam = '';
            $query = '';
         }
        if($tam=='quanlymenu' && $query=='them'){
            include('./modules/quanlymenu/them.php' );
            include('./modules/quanlymenu/lietke.php');
        }elseif ($tam=='quanlymenu' && $query=='sua'){
            include('./modules/quanlymenu/sua.php' );

        }elseif ($tam=='quanlysp' && $query=='them'){
            include('./modules/quanlysp/them.php' );
        }elseif ($tam=='quanlysp' && $query=='lieke'){
            include('./modules/quanlysp/lietke.php');
        }elseif ($tam=='quanlysp' && $query=='sua'){
            include('./modules/quanlysp/sua.php' );
        }elseif ($tam=='quanlysp' && $query=='kichthuoc'){
            include('./modules/quanlysp/kichthuoc.php' );

        }elseif ($tam=='quanlydonhang' && $query=='lietke'){
            include('./modules/quanlydonhang/lietke.php');
        }elseif ($tam=='quanlydonhang' && $query=='xemdonhang'){
            include('./modules/quanlydonhang/xemdonhang.php' );
        }elseif ($tam=='quanlydonhang' && $query=='xuly'){
            include('./modules/quanlydonhang/xuly.php' );
        }elseif ($tam=='quanlydonhang' && $query=='timkiem'){
            include('./modules/quanlydonhang/timkiem.php' );
        }elseif ($tam=='quanlydonhang' && $query=='xulys'){
            include('./modules/quanlydonhang/xuly.php' );

        }elseif ($tam=='quanlytenchinhsach' && $query=='them'){
            include('./modules/qltenchinhsach/them.php');
            include('./modules/qltenchinhsach/lietke.php');
        }elseif ($tam=='quanlytenchinhsach' && $query=='sua'){
            include('./modules/qltenchinhsach/sua.php' );

        }elseif ($tam=='quanlychinhsach' && $query=='them'){
            include('./modules/qlchinhsach/them.php');
        }elseif ($tam=='quanlychinhsach' && $query=='lietke'){
            include('./modules/qlchinhsach/lietke.php');
        }elseif ($tam=='quanlychinhsach' && $query=='sua'){
            include('./modules/qlchinhsach/sua.php');
        }elseif ($tam=='quanlychinhanh' && $query=='them'){
            include('./modules/quanlychinhanh/them.php');
            include('./modules/quanlychinhanh/lietke.php');
        }elseif ($tam=='quanlychinhanh' && $query=='sua'){
            include('./modules/quanlychinhanh/sua.php' );

        }elseif ($tam=='quanlylienhe' && $query=='them'){
            include('./modules/quanlylienhe/them.php');
            include('./modules/quanlylienhe/lietke.php');
        }elseif ($tam=='quanlylienhe' && $query=='sua'){
            include('./modules/quanlylienhe/sua.php' );
        
        }elseif ($tam=='anhtrangbia' && $query=='them'){
            include('./modules/anhtrangbia/them.php');
            include('./modules/anhtrangbia/lietke.php');
        }elseif ($tam=='anhtrangbia' && $query=='sua'){
            include('./modules/anhtrangbia/sua.php' );
        
        }elseif ($tam=='quanlybaibao' && $query=='them'){
            include('./modules/quanlybaibao/them.php');
        }elseif ($tam=='quanlybaibao' && $query=='sua'){
            include('./modules/quanlybaibao/sua.php' );  
        }elseif ($tam=='quanlybaibao' && $query=='lietke'){
            include('./modules/quanlybaibao/lietke.php');

        }elseif($tam=='quanlythanhvien' && $query =='lietke'){
            include("modules/quanlythanhvien/lietke.php");
        }elseif($tam=='quanlythanhvien' && $query =='sua'){
            include("modules/quanlythanhvien/sua.php");
        }elseif($tam=='quanlythanhvien' && $query =='them'){
            include("modules/quanlythanhvien/them.php");

        }elseif ($tam=='quanlykho' && $query=='lietke'){
            include('./modules/quanlykho/lietke.php');
       

        }elseif($tam=='quanlyhoanhang' && $query =='loc'){
            include("modules/quanlyhoanhang/loc.php");
}elseif($tam=='quanlydonhang' && $query =='loc'){
            include("modules/quanlydonhang/loc.php");
        }elseif ($tam=='quanlyhoanhang' && $query=='timkiem'){
            include('./modules/quanlyhoanhang/timkiem.php');

        }elseif ($tam=='quanlyhoanhang' && $query=='lietke'){
            include('./modules/quanlyhoanhang/lietke.php');
        }else{
            include('./modules/dashboard.php');
        }
    ?>
</div>