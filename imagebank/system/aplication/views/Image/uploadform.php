<?php  echo form_open_multipart('user/picupload'); ?>
<?=form_hidden('project_id', "1"); ?>
<div class="well">
	<fieldset>

		<p>
			Title:
			<br />
			<input type="text" name="title" />
		</p>
		<p>
		Description
		<br />
		<textarea name="caption" rows="3" cols="20"></textarea>
		</p>		<p>
		File:
		<input type="file" name="file_name"/>
		</p>

		<h3> select your album</h3>
		<select name="id_album">
			<?php
			foreach ($album as $row) {
				echo "<option value ='$row->id_album'>$row->album_name</option>";
			}
			?>
		</select>

		<h3> Select categories</h3>

		<?php
		foreach ($category as $row) {

			echo " <input type='checkbox' name= 'kat[]' value='$row->id_category'/>$row->category_name<br/>";

		}
		?>

		<p>
		Tag :
		<br/>
		<input type="text" name="tag" style="width: 270px;" value="Separate tag with comma and space" onclick="if(this.value=='Separate tag with comma and space'){this.value=''}" onblur="if(this.value==''){this.value='Separate tag with comma and space'}"/>
		</p>

		<button id ="submit" class="btn btn-primary"value="upload" type="submit" name="upload">
			upload
		</button>
	</fieldset>
	</form>
	<?php $flashmessage = $this->session->flashdata('message')?>
	<?php echo !empty($flashmessage) ? '<p class="alert alert-error">' . $flashmessage . '</p>' : ''; ?>
</div>

