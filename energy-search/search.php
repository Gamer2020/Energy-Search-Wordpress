<?php	
	use Pokemon\Pokemon;
	
	function es_search_page(){
		if(isset($_GET['search']) && ($_GET['search'] == "search") ){
			
			try {
				$options = ['verify' => true];
				$es_cardpage_options = get_option( 'es_cardpage_options' );
				
				$response = Pokemon::Card($options)->where([
				'name' => (isset($_GET['cardname']) ? sanitize_text_field($_GET['cardname']) : ''),
				'setCode' => (isset($_GET['setcode']) ? ((sanitize_text_field($_GET['setcode']) == 'All') ? '' : sanitize_text_field($_GET['setcode'])) : ''),
				'types' => (isset($_GET['type']) ? ((sanitize_text_field($_GET['type']) == 'All') ? '' : sanitize_text_field($_GET['type'])) : ''),
				//'attackText' => (isset($_GET['cardtext']) ? sanitize_text_field($_GET['cardtext']) : ''),
				//'attackName' => (isset($_GET['cardtext']) ? sanitize_text_field($_GET['cardtext']) : ''),
				//'abilityName' => (isset($_GET['cardtext']) ? sanitize_text_field($_GET['cardtext']) : ''),
				//'abilityText' => (isset($_GET['cardtext']) ? sanitize_text_field($_GET['cardtext']) : ''),
				'pageSize' => 100
				])->all();
				
				foreach ($response as $model) {
					$card = $model->toArray();
					echo "<a href='" . get_permalink($es_cardpage_options['page_id']) . "?ID=" . $card['id'] . "'>" . '<img width="250" height="350" src=' . $card['imageUrlHiRes'] . "" . " alt=" . '"' . $card['name'] . '"' . ">" . "</a>";
				}	
				
				//catch exception
				}catch(Exception $e) {
				echo 'Message: ' .$e->getMessage();
			}
			
			}else{
			
			echo "Search not initiated!";
			
			}
			}
?>