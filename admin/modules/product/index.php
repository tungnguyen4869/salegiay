<?php
$open = 'product';
require_once 'C:\xampp\htdocs\projectthuctap\admin\autoload\autoload.php';
$sql = "SELECT * FROM product";
$total = count($db->fetchsql($sql));
if (isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 1;
}
$product = $db->fetchJones("product", $sql, $total, $p, 4, true);
$sotrang = $product['page'];
unset($product['page']);
$path = $_SERVER['SCRIPT_NAME'];
?>
<?php require 'C:\xampp\htdocs\projectthuctap\admin\layouts\header.php'; ?>                   
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Danh Sách Danh Mục                               
        </h1>
        <a href="add.php" class="btn btn-info">Thêm mới</a>

        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
            </li>
                                        
        </ol>  
        <div class="clearfix"></div>
        <?php
        require_once 'C:\xampp\htdocs\projectthuctap\partials\notification.php';
        ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">          
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Thunbar</th>
                        <th>Info</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $stt = 1;
                    foreach ($product as $item):
                        ?>
                        <tr>
                            <td><?= $stt ?></td>
                            <td><?= $item['name'] ?></td>
                            <?php
                            $result = $db->fetchID("category", $item['category_id']);
                            ?>
                            <td><?= $result['name'] ?></td>
                            <td><?= $item['slug'] ?></td>
                            <td>
                                <img src="<?= uploads() ?>product/<?= $item['thunbar'] ?>" width="80px" height="80px">
                            </td>
                            <td>
                                <ul>
                                    <li>Giá:<?= $item['price'] ?></li>
                                    <li>Số lượng:<?= $item['number'] ?></li>

                                </ul>
                            </td>
                            <td>
                                <a class="btn btn-xs btn-info" href="edit.php?id=<?= $item['id'] ?>">
                                    <i class="fa fa-edit"></i>Sửa</a>
                                <a class="btn btn-xs btn-danger" href="delete.php?id=<?= $item['id'] ?>">
                                    <i class="fa fa-times"></i>Xóa</a>

                            </td>
                        </tr>                          
                        <?php
                        $stt++;
                    endforeach
                    ?>
                </tbody>
            </table>
            <div class="pull-right">
                <nav aria-label="Page navigation">

                    <ul class="pagination">
                        <?php
                        for ($i = 1; $i <= $sotrang; $i++) {
                            ?>
                            <li class="<?= isset($_GET['p']) && $_GET['p'] == $i ? 'active' : '' ?>"><a href="<?= $path ?>?p=<?= $i ?>"><?= $i ?></a></li>
                            <?php
                        }
                        ?>

                    </ul>
                </nav>
            </div>

        </div>
    </div>

</div>
<?php require 'C:\xampp\htdocs\projectthuctap\admin\layouts\footer.php'; ?>      

