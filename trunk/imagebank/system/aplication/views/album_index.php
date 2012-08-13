<script type="text/javascript" src="../js/bootstrap-alert.js"></script>
<?php $flashmessage = $this->session->flashdata('message')?>

<?php echo !empty($flashmessage) ? '<p class="alert alert-success"><a class="close" data-dismiss="alert">x</a><strong>' . $flashmessage . '</strong></p>' : ''; ?>

<table width="597" border="1">
	<tr>
		<td width="317">Name</td>
		<td width="129">Photos</td>
		<td width="129"><a class="btn btn-primary" href="<?php echo site_url('album/create'); ?>">Create New Album </a></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>

</body>

