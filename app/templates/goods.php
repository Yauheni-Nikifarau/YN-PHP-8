<form action="/" method="POST" class="shop-catalog">
    <?php foreach ($goodsData as $id => $good) : ?>
        <div class="shop-good">
            <img src="<?= $good->image;?>" alt="<?=$good->title;?>" class="shop-good-img">
            <h3 class="shop-good-title"><?= substr($good->title, 0, 40) . '...';?></h3>
            <p class="shop-good-description"><?= substr($good->description, 0, 80) . '...';?></p>
            <p class="shop-good-price">$<?= $good->price;?></p>
            <button name="goodId" value="<?= $id; ?>" class="shop-good-buttonAddToCart">Add to cart</button>
        </div>
    <?php endforeach; ?>
</form>
