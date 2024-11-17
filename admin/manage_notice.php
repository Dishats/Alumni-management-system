<?php include 'db_connect.php'; ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM notices WHERE id=" . $_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-notice">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row form-group">
			<div class="col-md-12">
				<label for="title" class="control-label">Title</label>
				<input type="text" name="title" class="form-control" value="<?php echo isset($title) ? $title : '' ?>" required>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label for="description" class="control-label">Description</label>
				<textarea name="description" class="form-control text-jqte" required><?php echo isset($description) ? $description : '' ?></textarea>
			</div>
		</div>
	</form>
</div>

<script>
	$('.text-jqte').jqte();
	$('#manage-notice').submit(function(e){
		e.preventDefault();
		start_load();
		$.ajax({
			url: 'ajax.php?action=save_notice',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp){
				if(resp == 1){
					alert_toast("Notice successfully saved.", 'success');
					setTimeout(function(){
						location.reload();
					}, 1000);
				}
			}
		});
	});
</script>
