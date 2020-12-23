<?php echo $this->session->flashdata('message'); ?>
<?php $this->load->view('template-shop/header'); ?>
<!-- banner -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators-->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1" class=""></li>
		<li data-target="#myCarousel" data-slide-to="2" class=""></li>
		<li data-target="#myCarousel" data-slide-to="3" class=""></li>
	</ol>
	<div class="carousel-inner" role="listbox">
		<div class="item active">
			<div class="container">
				<div class="carousel-caption">
					<h3>Vaping
						<span>is</span>
						Life
					</h3>
					<a class="button2" href="<?= site_url('produk'); ?>">Shop Now </a>
				</div>
			</div>
		</div>
		<div class="item item2">
			<div class="container">
				<div class="carousel-caption">
					<h3>Keep Your
						<span>Head</span>
						In The Cloud
					</h3>
					<a class="button2" href="<?= site_url('produk'); ?>">Shop Now </a>
				</div>
			</div>
		</div>
		<div class="item item3">
			<div class="container">
				<div class="carousel-caption">
					<h3>Do you even
						<span>Vape</span>
						Bro?
					</h3>
					<a class="button2" href="<?= site_url('produk'); ?>">Shop Now </a>
				</div>
			</div>
		</div>
		<div class="item item4">
			<div class="container">
				<div class="carousel-caption">
					<h3>Inhale,
						<span>Hold it, Exhale</span>
						And Smile
					</h3>
					<a class="button2" href="<?= site_url('produk'); ?>">Shop Now </a>
				</div>
			</div>
		</div>
	</div>
	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<!-- //banner -->

<!-- top Products -->
<div class="ads-grid">
	<div class="container">
		<!-- tittle heading -->
		<h3 class="tittle-w3l">Produk Baru
			<span class="heading-style">
				<i></i>
				<i></i>
				<i></i>
			</span>
		</h3>
		<!-- //tittle heading -->
		<!-- product right -->
		<div class="agileinfo-ads-display col-md-12">
			<div class="wrapper">
				<?php foreach ($kategori as $res_kat) : ?>
					<!-- first section (nuts) -->
					<div class="product-sec1">
						<h3 class="heading-tittle"><?= $res_kat['nama_kategori']; ?></h3>
						<?php foreach ($res_kat['produk'] as $res_produk) : ?>
							<div class="col-md-4 product-men">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<img src="<?= base_url('assets/img/produk/' . $res_produk['image_produk']) ?>" style="widht:200px;height:200px" alt="">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="<?= site_url('Produk/detail_produk/' . $res_produk['id_produk']); ?>" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										<span class="product-new-top">New</span>
									</div>
									<div class="item-info-product ">
										<h4>
											<a href="<?= site_url('Produk/detail_produk/' . $res_produk['id_produk']); ?>"><?= $res_produk['nama_produk']; ?></a>
										</h4>
										<div class="info-product-price">
											<span class="item_price"><?= maskrupiah($res_produk['harga']); ?></span>
											<p>
												<?= $res_produk['nama_lengkap'] ?>
											</p>
										</div>
										<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
											<form action="#" method="post">
												<fieldset>
													<input type="hidden" name="id_produk" value="<?= $res_produk['id_produk'] ?>" />
													<input type="hidden" name="id_penjual" value="<?= $res_produk['id_penjual'] ?>" />
													<input type="hidden" name="nama_penjual" value="<?= $res_produk['nama_lengkap'] ?>" />
													<input type="hidden" name="cmd" value="_cart" />
													<input type="hidden" name="add" value="1" />
													<input type="hidden" name="business" value=" " />
													<input type="hidden" name="item_name" value="<?= $res_produk['nama_produk'] ?>" />
													<input type="hidden" name="amount" value="<?= $res_produk['harga'] ?>" />
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
						<?php endforeach; ?>
						<div class="clearfix"></div>
					</div>
				<?php endforeach; ?>
				<!-- //first section (nuts) -->
			</div>
		</div>
		<!-- //product right -->
	</div>
</div>
<!-- //top products -->
<?php $this->load->view('template-shop/footer'); ?>