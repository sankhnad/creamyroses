<!-- JavaScript --> 
<script src="<?=$iURL_storeAssts?>js/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="<?=$iURL_storeAssts?>js/bootstrap-datepicker.min.js"></script>
<script src="<?=$iURL_storeAssts?>js/validate.min.js"></script>

<script src="<?=$iURL_storeAssts?>js/wow.min.js"></script>
<script src="<?=$iURL_storeAssts?>bootstrap-3.3.7/js/bootstrap.min.js"></script> 
<script src="<?=$iURL_adminAssts?>js/bootstrap-select.min.js"></script>
<script src="<?=$iURL_storeAssts?>js/revslider.js"></script> 
<script src="<?=$iURL_storeAssts?>js/common.js"></script> 
 
<script src="<?=$iURL_storeAssts?>js/owl.carousel.min.js"></script> 
<script src="<?=$iURL_storeAssts?>js/jquery.mobile-menu.min.js"></script>
<script src="<?=$iURL_storeAssts?>js/main.js"></script>

<script>
<?php
if(!CITY){
?>
	$( document ).ready(function() {
		$('#ChooseCity').modal('show');
	});
	
<?php } ?>
</script>

