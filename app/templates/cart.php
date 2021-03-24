<form action="/cart/" method="POST">
    <?php foreach ($arrCart as $id => $position) : ?>
    <div class="cart-position">
        <img src="<?= $position['image']; ?>" alt="<?= $position['title']; ?>" class="cart-position-image">
        <h3 class="cart-position-title"><?= $position['title']; ?></h3>
        <input type="number" min="0" name="<?= $id; ?>" value="<?= $position['quantity']; ?>" class="cart-position-input">
        <p class="cart-position-sum">$<?= $position['sum']; ?></p>
        <button name="<?= $id; ?>" value="0" class="cart-position-delete">Delete</button>
    </div>
    <?php endforeach; ?>
    <button class="cart-update">update cart</button>
    <div class="applyOrder">
        <input type="text" name="name" placeholder="Name" class="applyOrder-name">
        <input type="text" name="phone" placeholder="Phone" class="applyOrder-phone">
        <textarea name="address" cols="30" rows="10" placeholder="Address" class="applyOrder-address"></textarea>
        <button name="cart-order" value="yes" class="applyOrder-button">Buy!</button>
    </div>
</form>
