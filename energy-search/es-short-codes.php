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
			
			$ReturnCode = $ReturnCode . '.hiddenimg' . $card['id'] .' {
			display: none;
			position:absolute;
			z-index:99; 
			}
			
			.hiddentxt' . $card['id'] .' {
			font-weight: bold;
			}
			
			.hiddentxt' . $card['id'] .' a {
			text-decoration: none;
			}
			
			.hiddenclick' . $card['id'] .' {
			font-weight: bold;
			text-decoration: none;
			cursor: pointer;
			}
			
			.hiddenclick' . $card['id'] .' a {
			text-decoration: none;
			}
			
			.hiddenclick' . $card['id'] .' a:visited {
			text-decoration: none;
			}
			
			.hiddentxt' . $card['id'] .':hover ~ .hiddenimg' . $card['id'] .' {
			display: inline;
			position:absolute;
			}';
			
			$ReturnCode = $ReturnCode . '</style>';
			
			$ReturnCode = $ReturnCode . '<span class="hiddentxt' . $card['id'] .'"><a href="' . get_permalink($es_cardpage_options['page_id']) . "?ID=" . $card['id'] . '">' . $card['name']  . '</a></span><span class="hiddenimg' . $card['id'] .'"><img src="' . $card['imageUrl'] . '" width="250" height="350" /></span>';
			
			return $ReturnCode;
			
		}
	}
	
?>