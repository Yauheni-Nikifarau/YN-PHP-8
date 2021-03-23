<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $pageTitle ?? 'Shop'; ?></title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
    <div class="site">
        <header class="header">
            <img src="/img/car_logo_PNG1649.png" alt="logo" class="logo">
            <nav class="navigation">
                <ul class="menu">
                    <li class="menu-item"><a href="/" class="link <?= $pageTitle == 'Goods' ? 'active' : '';?>">Goods</a></li>
                    <li class="menu-item"><a href="/cart/" class="link <?= $pageTitle == 'Cart' ? 'active' : '';?>">Cart</a></li>
                </ul>
            </nav>
            <div class="header-cart">
                <img src="/img/shopping_cart_PNG38.png" alt="cart" class="header-cart-img">
                <p class="header-cart-quantity"><?= $orderQuantity ?? 0; ?></p>
                <p class="header-cart-price">$<?= $orderAmount ?? 0; ?></p>
            </div>
        </header>

