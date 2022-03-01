<?php
if (isset($_SESSION['_flash']['fail']) || isset($_SESSION['_flash']['success'])){
?>
<div class="row">
<div class="alert <?php echo (!empty($_SESSION['_flash']['fail']))?'alert-danger':'alert-success' ?> alert-dismissible fade show" role="alert">
	<?php  echo $_SESSION['_flash']['message']?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
</div>
</div>
<?php

}
?>