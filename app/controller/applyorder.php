<?php
$nameRegExp = '/^[а-яА-ЯёЁ]+$/ui';
$phoneRegExp = '/^(?:\+375)(?:33|44|29|25)\d{7}$/ui';
$addressRegExp = '/^[-., а-яА-ЯёЁ0-9]{5,250}$/ui';

if (preg_match($nameRegExp, $_POST['name']) &&
    preg_match($phoneRegExp, $_POST['phone']) &&
    preg_match($addressRegExp, $_POST['address'])) {
    $templateFile = ROOT . '/app/templates/successOrder.php';

    $subject = 'Сообщение с сайта';
    $to  = "yauheninikifarau@gmail.com";
    $headers  = "Content-type: text/html; charset=utf-8 \r\n";
    $headers .= "From: Сообщение с сайта <nikeugene@mail.ru>\r\n";
    $headers .= "Reply-To: nikeugene@mail.ru\r\n";
    $message = "Заказчик: {$_POST['name']}. Телефон: {$_POST['phone']}. Адрес: {$_POST['address']}. <br />Заказ:<br />";

    foreach ($arrOrder as $id => $quantity) {
        $message .= "$quantity единиц товара {$goodsData[$id]->title}.<br />";
    }

    mail($to, $subject, $message, $headers);

    $arrOrder = [];
    setcookie('order', 0, time()-10);
} else {
    $templateFile = ROOT . '/app/templates/orderError.php';
}

