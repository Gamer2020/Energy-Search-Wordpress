<?php	
	use Pokemon\Pokemon;
	
	function es_search_page(){
		if(isset($_GET['search']) && ($_GET['search'] == "search") ){
			
			try {
				$options = ['verify' => true];
				$es_cardpage_options = get_option( 'es_cardpage_options' );
				
				$response = Pokemon::Card($options)->where([
				'name' => (isset($_GET['cardname']) ? $_GET['cardname'] : ''),
				'setCode' => (isset($_GET['setcode']) ? $_GET['setcode'] : ''),
				'pageSize' => 500
				])->all();
				
				foreach ($response as $model) {
					$card = $model->toArray();
					//echo $card['name'] . "<br>";
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