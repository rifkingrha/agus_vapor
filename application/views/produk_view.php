<?php echo $this->session->flashdata('message'); ?>
<?php $this->load->view('template-shop/header');?>
<!-- product right -->
<div class="agileinfo-ads-display col-md-12 w3l-rightpro">
    <div class="wrapper">
        <!-- first section -->
        <?php
        $i = 0;
        $col = 4;
        ?>
        <?php foreach ($produk as $res): ?>
        <?php if ($i%$col==0) :?>
        <div class="product-sec1">
        <?php endif; ?>
           <?php $i++; ?>
            <div class="col-xs-3 product-men">
                <div class="men-pro-item simpleCart_shelfItem">
                    <div class="men-thumb-item">
                        <img src="<?= base_url('assets/img/produk/'.$res['image_produk']); ?>"  style="widht:200px;height:200px" alt="">
                        <div class="men-cart-pro">
                            <div class="inner-men-cart-pro">
                                <a href="<?= site_url('Produk/detail_produk/'.$res['id_produk']); ?>" class="link-product-add-cart">Quick View</a>
                            </div>
                        </div>
                    </div>
                    <div class="item-info-product ">
                        <h4>
                            <a href="<?= site_url('Produk/detail_produk/'.$res['id_produk']); ?>"><?= $res['nama_produk'] ?></a>
                        </h4>
                        <div class="info-product-price">
                            <span class="item_price"><?= maskrupiah($res['harga']) ?></span>
                            <p>
                                <?= $res['nama_lengkap'] ?>
                            </p>
                        </div>
                        <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                            <form action="#" method="post">
                                <fieldset>
                                    <input type="hidden" name="id_produk" value="<?= $res['id_produk'] ?>" />
                                    <input type="hidden" name="id_penjual" value="<?= $res['id_penjual'] ?>" />
									<input type="hidden" name="nama_penjual" value="<?= $res['nama_lengkap'] ?>" />
                                    <input type="hidden" name="cmd" value="_cart" />
                                    <input type="hidden" name="add" value="1" />
                                    <input type="hidden" name="business" value=" " />
                                    <input type="hidden" name="item_name" value="<?= $res['nama_produk'] ?>" />
                                    <input type="hidden" name="amount" value="<?= $res['harga'] ?>" />
                                    <input type="hidden" name="discount_amount" value="" />
                                    <input type="hidden" name="currency_code" value="IDR" />
                                    <input type="hidden" name="return" value=" " />
                                    <input type="hidden" name="cancel_return" value=" " />
                                    <input type="submit" name="submit" value="Add to cart" class="button" />
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($i%$col==0) :?>
                <div class="clearfix"></div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
            <div class="clearfix"></div>
        </div>
        <!-- //first section -->
        <?= $this->pagination->create_links(); ?>
    </div>
</div>
<!-- //product right -->
<?php $this->load->view('template-shop/footer');?>
