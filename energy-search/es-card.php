<?php
	use Pokemon\Pokemon;
	
	function es_card_page(){
		
		if(isset($_GET['ID'])){
			
			try {
			    
			    $es_cardpage_options = get_option( 'es_cardpage_options' );
			    
				$options = ['verify' => true];
				$response = Pokemon::Card($options)->find(sanitize_text_field($_GET['ID']));
				$card = $response->toArray();
				//print_r($response->toArray());
				
				echo '<table cellspacing="0" border="1">';
				
				echo '<tbody>';
				
				//Card name
				
				echo '<tr>';
				
				echo '<th style="font-size: 1.5em; line-height: 1.5em; color:: #000000;" colspan="3">' .  $card['name'];
				
				echo '</th></tr>';
				
				
				
				//card image
				
				echo '<tr>';
				
				echo '<td rowspan="90"><a href="' . $card['imageUrl'] . '">' . '<img width="250" height="350" src=' . $card['imageUrl'] . " alt=" . '"' . $card['name'] . '"' . ">" . "</a>";
				
				echo '</td></tr>';
				
				
				
				//Set
				
				echo '<tr>';
				
				echo '<td> <b>Set:</b>';
				
				echo '</td><td>' . $card['set'];
				
				echo '</td></tr>';
				
				
				
				//Number
				
				echo '<tr>';
				
				echo '<td> <b>Number:</b>';
				
				echo '</td><td>' . $card['number'];
				
				echo '</td></tr>';
				
				
				
				//Type
				
				echo '<tr>';
				
				echo '<td> <b>Type:</b>';
				
				//echo '</td><td>' . $card['types'][0];
				
				echo '</td><td>';
				
				if (count($card['types']) == 0) {
					
					} elseif (count($card['types']) == 1){
					
					echo TypeToImageHTML($card['types'][0]) . " " . $card['types'][0];
					
					} elseif (count($card['types']) == 2){
					
					echo TypeToImageHTML($card['types'][0]) . " " . $card['types'][0] . " / " . TypeToImageHTML($card['types'][1]) . " " . $card['types'][1];
					
				}
				
				echo '</td></tr>';
				
				
				
				//CardType
				
				echo '<tr>';
				
				echo '<td> <b>Card Type:</b>';
				
				echo '</td><td>' . $card['supertype'];
				
				echo '</td></tr>';
				
				
				
				//HP
				
				echo '<tr>';
				
				echo '<td> <b>HP:</b>';
				
				echo '</td><td>' . $card['hp'];
				
				echo '</td></tr>';
				
				
				
				//Weakness
				
				echo '<tr>';
				
				echo '<td> <b>Weakness:</b>';
				
				//echo '</td><td>' . $card['weaknesses'];
				echo '</td><td>';
				//print_r ($card['weaknesses']);
				for ($x = 0; $x < count($card['weaknesses']); $x++) {
					echo TypeToImageHTML($card['weaknesses'][$x]['type']);
					echo " " . $card['weaknesses'][$x]['value'];
					echo '<br>';
				} 
				
				echo '</td></tr>';
				
				
				
				//Resistance
				
				echo '<tr>';
				
				echo '<td> <b>Resistance:</b>';
				
				//echo '</td><td>' . $card['resistances'];
				echo '</td><td>';
				
				for ($x = 0; $x < count($card['resistances']); $x++) {
					echo TypeToImageHTML($card['resistances'][$x]['type']);
					echo " " . $card['resistances'][$x]['value'];
					echo '<br>';
				} 
				
				echo '</td></tr>';
				
				
				
				//RetreatCost
				
				echo '<tr>';
				
				echo '<td> <b>RetreatCost:</b>';
				
				echo '</td><td>';
				
				for ($x = 0; $x < count($card['retreatCost']); $x++) {
					echo TypeToImageHTML($card['retreatCost'][$x]);
				} 
				
				echo '</td></tr>';
				
				
				
				//Rarity
				
				echo '<tr>';
				
				echo '<td> <b>Rarity:</b>';
				
				echo '</td><td>' . $card['rarity'];
				
				echo '</td></tr>';
				
				
				
				//Text
				
				echo '<tr>';
				
				echo '<td> <b>Text:</b>';
				
				echo '</td><td>';
				
				echo '<br>';
				
				//print_r ($card['ability']);
				
				if ($card['ability']['text'] <> ""){
					echo $card['ability']['type'] . " - " . $card['ability']['name'] . "<br>";
					echo $card['ability']['text'];
					echo '<br>' . '<br>';
				}
				
				for ($x = 0; $x < count($card['attacks']); $x++) {
					
					for ($y = 0; $y < count($card['attacks'][$x]['cost']); $y++) {
						echo TypeToImageHTML($card['attacks'][$x]['cost'][$y]);
					} 
					
					echo " " . $card['attacks'][$x]['name'] . " | " . $card['attacks'][$x]['damage']  . "<br>";
					echo $card['attacks'][$x]['text'];
					echo '<br>' . '<br>';
				} 
				
				for ($x = 0; $x < count($card['text']); $x++) {			
					echo $card['text'][$x];
					echo '<br>' . '<br>';
				}
				
				echo '</td></tr>';
				
				echo '</tbody></table>';
				
				$cardPrev = "";
				$cardNext = "";
				
				$response = Pokemon::Card($options)->where([
				    'setCode' => $card['setCode'],
				    'number' => ($card['number'] - 1)
				])->all();
				foreach ($response as $model) {
				    $cardPrev = $model->toArray();
				}
				
				$response = Pokemon::Card($options)->where([
				    'setCode' => $card['setCode'],
				    'number' => ($card['number'] + 1)
				])->all();
				foreach ($response as $model) {
				    $cardNext = $model->toArray();
				}
				
				echo '<table>';
				echo '<tr>';
				
				if (!empty($cardPrev)){echo '<th>Previous card in set</th>';}
				
				if (!empty($cardNext)){echo '<th>Next card in set</th>';}
				
				echo '</tr>';
				echo '<tr>';
				
				if (!empty($cardPrev)){echo "<td>" . '<div style="text-align:center"><a href="' . get_permalink($es_cardpage_options['page_id']) . "?ID=" . $cardPrev['id'] . '">' . '<img width="250" height="350" src=' . $cardPrev['imageUrl'] . "" . ">" . "</a></div>" . "</td>";}
				
				if (!empty($cardNext)){echo "<td>" . '<div style="text-align:center"><a href="' . get_permalink($es_cardpage_options['page_id']) . "?ID=" . $cardNext['id'] . '">' . '<img width="250" height="350" src=' . $cardNext['imageUrl'] . "" . ">" . "</a></div>" . "</td>";}
				
				echo '</tr>';
				echo '</table>'; 
				
				//catch exception
				}catch(Exception $e) {
				echo 'Message: ' .$e->getMessage();
			}
			
			}else{
			
			echo "No card specified!";
		
		}
		
		}
		?>