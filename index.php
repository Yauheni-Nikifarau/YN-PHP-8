<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
if (!file_exists(ROOT . '/app/data/goods.txt') || (time() - filemtime(ROOT.'/app/data/goods.txt') > 3600)) :
    require_once ROOT . '/app/data/api.php';
endif;

$goodsData = unserialize(file_get_contents(ROOT . '/app/data/goods.txt'));


if ($_GET['page'] == 'goods') {
    $pageTitle = 'Goods';
    $templateFile = ROOT . '/app/templates/goods.php';

    if (isset($_COOKIE['order'])) {
        $arrOrder = unserialize($_COOKIE['order']);
    } else {
        $arrOrder = [];
    }

    if (isset($_POST['goodId'])) {
        if (isset($arrOrder[$_POST['goodId']])) {
            $arrOrder[$_POST['goodId']]++;
        } else {
            $arrOrder[$_POST['goodId']] = 1;
        }
    }

    $orderQuantity = array_sum($arrOrder);
    $orderAmount = 0;
    foreach ($goodsData as $id => $good) {
        if (isset($arrOrder[$id])) {
            $orderAmount += $arrOrder[$id] * $good->price;
        }
    }

    setcookie('order', serialize($arrOrder), time()+3600, '/');

} elseif ($_GET['page'] == 'cart') {

    $pageTitle = 'Cart';
    $templateFile = ROOT . '/app/templates/cart.php';

    if (isset($_COOKIE['order'])) {
        $arrOrder = unserialize($_COOKIE['order']);
    } else {
        $arrOrder = [];
    }

    if (isset($_POST['cart-order']) && $_POST['cart-order'] == 'yes') {
        require_once ROOT . '/app/controller/applyorder.php';
    }

    if (count($_POST) > 0) {
        foreach ($arrOrder as $id => $quantity) {
            $arrOrder[$id] = $_POST[$id];
        }
    }



    $arrOrder = array_filter($arrOrder, function ($value) {
        return $value > 0;
    });

    setcookie('order', serialize($arrOrder), time()+3600, '/');

    $arrCart = [];
    $orderQuantity = array_sum($arrOrder);
    $orderAmount = 0;
    foreach ($goodsData as $id => $good) {
        if (isset($arrOrder[$id])) {
            $orderAmount += $arrOrder[$id] * $good->price;
            $arrCart[$id] = [
                'title' => $good->title,
                'image' => $good->image,
                'sum' => $arrOrder[$id] * $good->price,
                'quantity' => $arrOrder[$id]
            ];
        }
    }
} elseif ($_GET['page'] == 'product') {

    $pageTitle = 'Product';
    $templateFile = ROOT . '/app/templates/product.php';

    if (!isset($_GET['id']) || !isset($goodsData[$_GET['id']])) {
        header('location: /?page=404');
    }

    $productData = $goodsData[$_GET['id']];

} else {
    $pageTitle = '404';
    $templateFile = ROOT . '/app/templates/404.php';
}


require_once ROOT . '/app/templates/header.php';
require_once $templateFile;
require_once ROOT . '/app/templates/footer.php';


