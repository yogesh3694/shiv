<style type="text/css">
  .error{
    color: red;
  }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/card/css/main.css') ?>">
    <!-- jQuery 3 -->
<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="<?php echo base_url('assets/card/js/payform.min.js') ?>"></script>
<script src="<?php echo base_url('assets/card/js/creditcard.js') ?>"></script>
<script src="<?php echo base_url('assets/card/js/jquery.creditCardValidator') ?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
   <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(<?php echo base_url()?>images/bg_11.jpg);">
    <h2 class="l-text2 t-center">
      Checkout
    </h2>
  </section>

	<!-- Cart -->`
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
            <?php $this->load->view('partials/flash'); ?>
			<!-- Cart item -->
            <?php echo form_open('cart/update'); ?>
           <!--  <form name="Checkout-payment" id="checkout_payment" method="post"  enctype="multipart/form-data"  action="<?php echo base_url('cart/update');?>"> -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2"></th>
							<th class="column-3">Price</th>
							<th class="column-4 p-l-70">Quantity</th>
							<th class="column-5">Total</th>
						</tr>
                        <?php
                        $i = 0;
                        foreach ($cart as $item) : ?>

						<tr class="table-row">
							<td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="<?php echo ($item['options']['product_image']!='') ? base_url('images/products/') .$item['options']['product_image']: "";  ?>" alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2"><?php echo $item['name']; ?></td>
							<td class="column-3"><?php echo $item['price']; ?></td>
							<td class="column-4">
                                   <?php echo $item['qty'] ?>

							</td>
							<td class="column-5"><?php echo $item['subtotal']; ?></td>
						</tr>
                        <?php
                            $i++;
                        endforeach; ?>
					</table>
				</div>
			</div>
            <?php echo form_close() ?>

			<!-- Total -->
			<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
				<h5 class="m-text20 p-b-24">
					Order
				</h5>
                <?php echo validation_errors(); ?>

				<!--  -->
				<div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						Subtotal:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						<?php echo "Rs. ".number_format($this->cart->total())." /-"; ?>
					</span>
				</div>
				<!--  -->
         <form name="Checkout-payment" id="checkout_payment" method="post"  enctype="multipart/form-data"  action="<?php echo base_url('place-order');?>">
                <?php //echo form_open(base_url('index.php/place-order')) ?>
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						<?php echo "Rs. ".number_format($this->cart->total())." /-"; ?>
					</span>
				</div>

                <div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Delivery Address:
					</span>

                    <span class="m-text21 w-size20 w-full-sm effect1 w-size9">
                         <?php echo form_input('delivery_address',set_value('delivery_address'),array("")) ?>
                        <span class="effect1-line"></span>
					</span>
                </div>

                <div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Pincode :
					</span>

                    <span class="m-text21 w-size20 w-full-sm effect1 w-size9">
                         <?php echo form_input('pincode',set_value('pincode'),array("class"=>"s-text7 w-full","")) ?>
                        <span class="effect1-line"></span>
					</span>
                </div>
                
				<div class="size15 trans-0-8">
					<!-- Button -->
          <div class="row">
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                    <label>Name on Card</label>
                    <input type="text" class="form-control" id="name_on_card" name="name_on_card" placeholder="Ex.John">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                    <label>Card Number<span>*</span></label>
                    <div class="position-relative">

                    <div class="input-wrapped full" id="validateCard">
                    <input type="text" size="25"  maxlength="20"  class="full form-control"  data-creditcard="true" id="card_number" name="card_number" placeholder="0000 0000 0000 0000"   >
                    <div class="card_number">
                      <span class="card">
                        <span class="card-generic"></span>
                      </span>
                      <i class="icon-ok"></i>
                    </div>
                    </div>
                   
                    </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                    <label>Expiry Date<span>*</span></label>
                    <input type="text" class="form-control" id="expire_date" name="expire_date" placeholder="MM / YY">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                    <label>CVV Code <span>*</span></label>
                    <div class="position-relative">
                      <input type="text" class="form-control cvv_code_help" id="cvv_code" name="cvv_code">
                      <a href="https://www.cvvnumber.com/cvv.html" class="cvvnumber" target="_blank"></a>
                    </div>
                    </div>
                  </div>
                </div>
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Place Order
					</button>
				</div>
</form>
                <?php //echo form_close() ?>
            </div>
			</div>

	</section>

 

<script type="text/javascript">
  //jQuery(function(){
 payform.cardNumberInput(document.getElementById('card_number'));
 payform.expiryInput(document.getElementById('expire_date'));
 payform.cvcInput(document.getElementById('cvv_code'));
   jQuery('#checkout_payment').validate({
     ignore: [],
              debug: false,
        rules: {
          pincode:"required",
            delivery_address:"required",
          card_number:{required:true,
            //creditcard:true,
          },
            expire_date:"required",
            cvv_code:"required",
            },
   
        messages: {
          pincode:"Please enter pincode",
            delivery_address:"Please enter delivery address",
          card_number:{required:"Please enter card number."},
            expire_date:"Please enter expire date.",
            cvv_code:"Please enter cvv code.",
            
          
        },

        submitHandler: function(form) {
          alert(1);
          return false;
         // form.submit();
        }

    });
//});
</script>
