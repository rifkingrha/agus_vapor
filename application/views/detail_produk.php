<?php $this->load->view('template-shop/header'); ?>

<!-- Single Page -->
<div class="banner-bootom-w3-agileits">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Detail Produk
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<div class="col-md-5 single-right-left ">
				<div class="grid images_3_of_2">
					<div class="flexslider">
						<ul class="slides">
							<li data-thumb="<?= base_url('assets/img/produk/' . $produk['image_produk']); ?>" ">
								<div class="thumb-image">
									<img src="<?= base_url('assets/img/produk/' . $produk['image_produk']); ?>" " data-imagezoom="true" class="img-responsive" alt=""> </div>
							</li>
							<li data-thumb="<?= base_url('assets/img/produk/' . $produk['image_produk']); ?>" ">
								<div class="thumb-image">
									<img src="<?= base_url('assets/img/produk/' . $produk['image_produk']); ?>" " data-imagezoom="true" class="img-responsive" alt=""> </div>
							</li>
							<li data-thumb="<?= base_url('assets/img/produk/' . $produk['image_produk']); ?>" ">
								<div class="thumb-image">
									<img src="<?= base_url('assets/img/produk/' . $produk['image_produk']); ?>" " data-imagezoom="true" class="img-responsive" alt=""> </div>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="col-md-7 single-right-left simpleCart_shelfItem">
				<h3><?= $produk['nama_produk']; ?></h3>
				<p>
					<span class="item_price"><?= maskrupiah($produk['harga']); ?></span>
				</p>
				<div class="single-infoagile">
					<p>
						<?= $produk['nama_lengkap']; ?>
					</p>
				</div>
				<div class="product-single-w3l">
					<p>
					<i class="fa fa-info-circle" aria-hidden="true"></i>Deskripsi :
					</p>
					<p>
						<?= $produk['keterangan']; ?>
					</p>
				</div>
				<div class="product-single-w3l">
					<p>
					<i class="fa fa-info-circle" aria-hidden="true"></i>Bekas/Baru :
					</p>
					<p>
						<?php if ($produk['bekas_baru']==0) {
							echo "Baru";
						} else {
							echo "Bekas";
						}?>
					</p>
				</div>
				<div class="occasion-cart">
					<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
						<form action="#" method="post">
							<fieldset>
								<input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>" />
								<input type="hidden" name="id_penjual" value="<?= $produk['id_penjual'] ?>" />
								<input type="hidden" name="nama_penjual" value="<?= $produk['nama_lengkap'] ?>" />
								<input type="hidden" name="cmd" value="_cart" />
								<input type="hidden" name="add" value="1" />
								<input type="hidden" name="business" value=" " />
								<input type="hidden" name="item_name" value="<?= $produk['nama_produk'] ?>" />
								<input type="hidden" name="amount" value="<?= $produk['harga'] ?>" />
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
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //Single Page -->
<?php $this->load->view('template-shop/footer'); ?>