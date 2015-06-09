<?php include('html-header.php'); ?>

	<div class="wrap  qd-wrap">
	 	<h2>Setting</h2>

	 	<p><a href="<?php echo admin_url() . 'admin.php?page=qdiscuss-settings';?>">Back</a></p>
	 	<form id="qdiscuss-settings-form" name="qdiscuss-settings-form" action="" enctype="multipart/form-data" method="POST">
	 		
			<p><strong><?php _e('Key'); ?>:</strong></p>
			<p><?php echo $key; ?></p>		
		 	
		 	<p><strong><?php _e('Value'); ?>:</strong></p>
			<p>
			<?php 
				if ($key == 'forum_language') :
					echo '<select name="forum_language">';
					foreach ($language_files as $language) :
						if ($language == $set_value) echo '<option selected value="' . $language . '">' . $language .'</option>';
						else echo '<option value="' . $language . '">' . $language .'</option>';
					endforeach;
					echo '</select>';
				else :
					echo "<textarea name=" .$key . " rows='2' cols='30'>" . $set_value . "</textarea>";
				endif;
			?>
			</p>
			<p>
			<?php 
				if($key == 'forum_endpoint') : 
					echo '<span style="color:red;">Should start and end with (a-zA-Z) letters, only contain (a-zA-Z), -,  and length less than 10.</span>';
				endif;
			?>
			</p>
			
		 	
		 	<p class="clear"></p>
		 	<p ><div id="save-config-setting" class="button button-primary">Save</div></p>
		 	
		</form>

	</div>

