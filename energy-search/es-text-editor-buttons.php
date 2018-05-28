<?php
	use Pokemon\Pokemon;
	add_action("admin_print_footer_scripts", "es_text_card_image_button_script");
	add_action("admin_print_footer_scripts", "es_text_card_name_button_script");
	
	function es_text_card_image_button_script() 
	{
		if(wp_script_is("quicktags"))
		{
		?>
		<script type="text/javascript">
			
			//this function is used to retrieve the selected text from the text editor
			function getSel()
			{
				var txtarea = document.getElementById("content");
				var start = txtarea.selectionStart;
				var finish = txtarea.selectionEnd;
				return txtarea.value.substring(start, finish);
			}
			
			QTags.addButton( 
			"card_image_shortcode", 
			"Card Image", 
			callback
			);
			
			function callback()
			{
				var selected_text = getSel();
				QTags.insertContent("[es_shortcode_card_image]" +  selected_text + "[/es_shortcode_card_image]");
			}
		</script>
        <?php
		}
	}
	
	function es_text_card_name_button_script() 
	{
		if(wp_script_is("quicktags"))
		{
		?>
		<script type="text/javascript">
			
			//this function is used to retrieve the selected text from the text editor
			function getSel()
			{
				var txtarea = document.getElementById("content");
				var start = txtarea.selectionStart;
				var finish = txtarea.selectionEnd;
				return txtarea.value.substring(start, finish);
			}
			
			QTags.addButton( 
			"card_name_shortcode", 
			"Card Name", 
			callback
			);
			
			function callback()
			{
				var selected_text = getSel();
				QTags.insertContent("[es_shortcode_card_name]" +  selected_text + "[/es_shortcode_card_name]");
			}
		</script>
        <?php
		}
	}
?>