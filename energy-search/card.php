<?php
	use Pokemon\Pokemon;
	
	function es_card_page(){
		
		if(isset($_GET['ID'])){
			
			try {
				$options = ['verify' => true];
				$response = Pokemon::Card($options)->find($_GET['ID']);
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
				
				echo '<td rowspan="90"><a href="' . $card['imageUrlHiRes'] . '">' . '<img width="250" height="350" src=' . $card['imageUrlHiRes'] . " alt=" . '"' . $card['name'] . '"' . ">" . "</a>";
				
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
					
					echo $card['types'][0];
					
					} elseif (count($card['types']) == 2){
					
					echo $card['types'][0] . "/" . $card['types'][1];
					
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
					echo $card['weaknesses'][$x]['type'];
					echo $card['weaknesses'][$x]['value'];
					echo '<br>';
				} 
				
				echo '</td></tr>';
				
				
				
				//Resistance
				
				echo '<tr>';
				
				echo '<td> <b>Resistance:</b>';
				
				//echo '</td><td>' . $card['resistances'];
				echo '</td><td>';
				
				for ($x = 0; $x < count($card['resistances']); $x++) {
					echo $card['resistances'][$x]['type'];
					echo $card['resistances'][$x]['value'];
					echo '<br>';
				} 
				
				echo '</td></tr>';
				
				
				
				//RetreatCost
				
				echo '<tr>';
				
				echo '<td> <b>RetreatCost:</b>';
				
				echo '</td><td>';
				
				for ($x = 0; $x < count($card['retreatCost']); $x++) {
					echo $card['retreatCost'][$x];
					echo '<br>';
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
				//print_r ($card['ability']);
				
				if ($card['ability']['text'] <> ""){
					echo $card['ability']['type'] . " - " . $card['ability']['name'] . "<br>";
					echo $card['ability']['text'];
					echo '<br>' . '<br>';
				}
				
				for ($x = 0; $x < count($card['attacks']); $x++) {
					echo $card['attacks'][$x]['name'] . " | " . $card['attacks'][$x]['damage']  . "<br>";
					echo $card['attacks'][$x]['text'];
					echo '<br>' . '<br>';
				} 
				//print_r ($card['text']);
				echo $card['text'][0];
				echo '<br>' . '<br>';
				
				echo '</td></tr>';
				
				echo '</tbody></table>';
				
			}
			
			//catch exception
			catch(Exception $e) {
				echo 'Message: ' .$e->getMessage();
			}
			
			}else{
			
			echo "No card specified!";
			
		}
		
	}
?>