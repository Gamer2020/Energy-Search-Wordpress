<?php
	use Pokemon\Pokemon;
	
	function es_search_box(){
		
		$options = ['verify' => true];
		$es_searchpage_options = get_option( 'es_searchpage_options' );
		
	?>
	<!-- The form -->
	<form action="<?php echo get_permalink($es_searchpage_options['page_id']) ;?>">
		<input type="text" placeholder="Card Name..." name="cardname" value="<?php echo (isset($_GET['cardname']) ? sanitize_text_field($_GET['cardname']) : '')?>">
		<!--<input type="text" placeholder="Card text..." name="cardtext" value="<?php echo (isset($_GET['cardtext']) ? sanitize_text_field($_GET['cardtext']) : '')?>">-->
		
		<?php echo 'Set: <select name="setcode">'; ?>
		<?php echo '<option'; ?> <?php if(isset($_GET['setcode'])){if(sanitize_text_field($_GET['setcode']) == "All"){ echo "selected"; }}Else{echo "selected";}?> <?php echo 'value="All">All</option>'; ?>
		<?php		
			$es_searchpage_options = get_option( 'es_searchpage_options' );
			
			$sets = Pokemon::Set()->all();
			
			foreach ($sets as $model) {
				$set = $model->toArray();
				
				echo '<option ' . 
				((isset($_GET['setcode'])) ? 
				((sanitize_text_field($_GET['setcode']) ==  $set['code']) ? 'selected' : '')
				:'')
				. ' value="' . $set['code'] . '">' . $set['name'] . '</option>';
				
			}
			
		?>	
		<?php echo '</select>'; ?>
		
		<button type="submit" name="search" value="search"><i class="fa fa-search"></i></button>
	</form><br>
	<?php		
	}
	
?>