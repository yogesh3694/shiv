<!-- Footer -->
<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
    
    <div class="t-center p-l-15 p-r-15">
       

        <div class="t-center s-text8 p-t-20">
            Copyright © 2020 All rights reserved.  <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank"></a>
        </div>
    </div>
</footer>



<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
</div>

<!-- Container Selection1 -->
<div id="dropDownSelect1"></div>



<!--===============================================================================================-->

<!--===============================================================================================-->
<script type="text/javascript" src="<?php echo base_url('assets/libs/animsition/js/animsition.min.js') ?>"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?php echo base_url('assets/libs/bootstrap/js/popper.min.js') ?>"></script>



<!--===============================================================================================-->


<!--===============================================================================================-->
<script type="text/javascript" src="<?php echo base_url('assets/libs/slick/slick.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/slick-custom.min.js')?>"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?php echo base_url('assets/libs/countdowntime/countdowntime.js') ?>"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?php echo base_url('assets/libs/lightbox2/js/lightbox.min.js') ?>"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?php echo base_url('assets/libs/sweetalert/sweetalert.min.js') ?>"></script>
<script type="text/javascript">
    $('.block2-btn-addcart').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to cart !", "success");
        });
    });

    $('.block2-btn-addwishlist').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();

        $(this).on('click', function(){
            var product_id = $(this).data("product-id");
            var Formdata = {
                product_id : product_id,
            };

            $.ajax({
                url : "<?php echo base_url('index.php/add-to-wishlist'); ?>",
                type : 'post',
                data : Formdata,
                success : function (result) {
                    if(result.status == 1){
                        swal(nameProduct, "Added to wishlist", "success");
                    }
                },
                error : function (error) {
                    console.log(error);
                    swal("", error.responseText, "error");
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
</script>
<script src="<?php echo base_url('assets/js/main.min.js') ?>"></script>
</body>
</html>