<?php
	use Pokemon\Pokemon;
	
	function es_shortcode_card_image($attr, $content = null) {		
		if (!empty($content)) {
			$es_cardpage_options = get_option( 'es_cardpage_options' );
			$options = ['verify' => true];
			$response = Pokemon::Card($options)->find(sanitize_text_field($content));
			$card = $response->toArray();
			
			return "<a href='" . get_permalink($es_cardpage_options['page_id']) . "?ID=" . $card['id'] . "'>" . '<img width="250" height="350" src=' . $card['imageUrl'] . "" . " alt=" . '"' . $card['name'] . '"' . ">" . "</a>";
			
		}	
	}
	
	function es_shortcode_card_name($attr, $content = null) {
		if (!empty($content)) {
			$es_cardpage_options = get_option( 'es_cardpage_options' );
			$options = ['verify' => true];
			$response = Pokemon::Card($options)->find(sanitize_text_field($content));
			$card = $response->toArray();
			
			$ReturnCode = '<style type="text/css">';
			
			$ReturnCode = $ReturnCode . '.hover_img a { position:relative; }';
			
			$ReturnCode = $ReturnCode . '.hover_img a span { position:absolute; display:none; z-index:99; }';
			
			$ReturnCode = $ReturnCode . '.hover_img a:hover span { display:block; }';
			
			$ReturnCode = $ReturnCode . '</style>';
			
			$ReturnCode = $ReturnCode . "<div class='hover_img'><a href='" . get_permalink($es_cardpage_options['page_id']) . "?ID=" . $card['id'] . "'>" . $card['name'] . '<span><img width="250" height="350" src=' . $card['imageUrl'] . "" . " alt=" . '"' . $card['name'] . '"' . "></span>" . "</a></div>";
			
			return $ReturnCode;
			
		}
	}
	
?>