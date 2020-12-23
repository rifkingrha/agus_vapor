<?php echo $this->session->flashdata('message'); ?>
<?php $this->load->view('template-shop/header'); ?>

<div class="privacy">
    <div class="container">
        <!-- tittle heading -->
        <h3 class="tittle-w3l">Checkout
            <span class="heading-style">
                <i></i>
                <i></i>
                <i></i>
            </span>
        </h3>
        <!-- //tittle heading -->
        <div class="checkout-right">
            <h4>Produk yang ada dalam keranjang:
                <span class="productAmounts"></span>
            </h4>
            <div class="table-responsive">
                <table class="timetable_sub">
                    <thead>
                        <tr>
                            <th>Kode Produk</th>
                            <th>Nama Penjual</th>
                            <th>Nama Produk</th>
                            <th>Kuantitas</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr class="rem1">
                            <td class="invert">1</td>
                            <td class="invert-image">
                                <a href="single2.html">
                                    <img src="images/a7.jpg" alt=" " class="img-responsive">
                                </a>
                            </td>
                            <td class="invert">
                                <div class="quantity">
                                    <div class="quantity-select">
                                        <div class="entry value-minus">&nbsp;</div>
                                        <div class="entry value">
                                            <span>1</span>
                                        </div>
                                        <div class="entry value-plus active">&nbsp;</div>
                                    </div>
                                </div>
                            </td>
                            <td class="invert">Spotzero Spin Mop</td>
                            <td class="invert">$888.00</td>
                            <td class="invert">
                                <div class="rem">
                                    <div class="close1"> </div>
                                </div>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
            <br>
            <hr>
            <div class="row">
                <div class="btn-block pull-right">
                    <button type="button" class="btn btn-danger btn-clear" style="margin:5px">Kosongkan Keranjang</button>
                    <button type="button" class="btn btn-warning pull-right btn-conf" style="margin:5px">Konfirmasi</button>
                    <a href="<?= site_url(); ?>" class="btn btn-danger pull-right" style="margin:5px">Batal</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('template-shop/footer'); ?>
<script>
    function mask_rupiah(number) {
        return "Rp. " + number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
    }
    let cart_items = paypalm.minicartk.cart.items();

    let total = 0;
    let subtotal = paypalm.minicartk.cart.subtotal();
    for (let i = 0; i < cart_items.length; i++) {
        total = (cart_items[i]._amount * cart_items[i]._data.quantity)
        $('tbody').append("<tr><td>" + cart_items[i]._data.id_produk + "</td><td>" + cart_items[i]._data.nama_penjual + "</td><td>" + cart_items[i]._data.item_name + "</td><td>" + cart_items[i]._data.quantity + "</td><td>" + mask_rupiah(cart_items[i]._amount) + "</td><td>" + mask_rupiah(total) + "</td></tr>")
    }
    $('tbody').append("<tr><td colspan='5'><b>Subtotal</b></td><td>" + mask_rupiah(subtotal) + "</td></tr>")
    $('.productAmounts').append(cart_items.length + " Produk");
   
    $('.btn-conf').on('click', function(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Kelola_pesanan/confirm_pesanan'); ?>",
            data: {"produk":JSON.stringify(cart_items), "subtotal":subtotal, "id_pembeli":"<?= $this->session->userdata("id_customer"); ?>"},
            dataType: 'json',
            beforeSend: function() {
                // $('.loading').show();
            },
        }).done(function(result) {
            console.log(result);
        });
    });

    $('.btn-clear').on('click', function(){
        paypalm.minicartk.cart.destroy()
        location.reload();
    });

</script>