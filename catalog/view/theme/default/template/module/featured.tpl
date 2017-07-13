<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
   
      <div class="box-product">
            <?php foreach ($products as $product) { ?>
            <div class="product_featured he-wrap tpl5">
                <?php if ($product['thumb']) { ?>
                <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
                <?php } ?>
                <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                <div class="he-view">
                    <?php if ($product['price']) { ?>
                    <a data-animate="jellyInUp" class="price a0" href="<?php echo $product['href']; ?>"><?php echo $product['price']; ?></a>
                    <span class="price-new"><?php echo $product['special']; ?></span>
                    <?php } ?>

                    <div class="cart">
                        <input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button buy a0" data-animate="rotateInLeft"/>
                    </div>


                </div>
            </div>


            <?php } ?>
        </div>
  </div>
</div>
