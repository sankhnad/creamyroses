<?php
$iURL_uploads 	= $this->config->item('default_path')['uploads'];
$iURL_profile 	= $this->config->item('default_path')['profile'];
$iURL_product 	= $this->config->item('default_path')['product'];
$iURL_email 	= $this->config->item('default_path')['email'];
$iURL_assets 	= $this->config->item('default_path')['assets'];
$iURL_storeAssts= $this->config->item('default_path')['storeAssts'];
$iURL_adminAssts= $this->config->item('default_path')['adminAssts'];
$iURL_vendor 	= $this->config->item('default_path')['vendor'];
$iURL_type 		= $this->config->item('default_path')['type'];
$iURL_banner	= $this->config->item('default_path')['banner'];
$iURL_testimonials	= $this->config->item('default_path')['testimonials'];
?>
<script>
	base_url = '<?=base_url();?>';
	store_url = '<?=store_url();?>';
	admin_url = '<?=admin_url();?>';
</script>