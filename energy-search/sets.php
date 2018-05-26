<?php	
	use Pokemon\Pokemon;
	/** Sets Page.*/
	function es_sets_page() {
		
		$options = ['verify' => true];
		
		$es_searchpage_options = get_option( 'es_searchpage_options' );
		
		$standardresponse = Pokemon::Set($options)->where([
		
		'standardLegal' => 'true'
		
		])->all();
		
		$expandedresponse = Pokemon::Set($options)->where([
		
		'standardLegal' => 'false',
		'expandedLegal' => 'true'
		
		])->all();
		
		$unlimitedresponse = Pokemon::Set($options)->where([
		
		'standardLegal' => 'false',
		'expandedLegal' => 'false'
		
		])->all();
		
		echo '<table>';
		echo '<tr>';
		echo '<th>Standard</th>';
		echo '<th>Expanded</th>';
		echo '<th>Unlimited</th>';
		echo '</tr>';
		
		echo '<tr>';
		echo '<td valign="top">';
		echo '<span id="Standard">';
		
		foreach ($standardresponse as $model) {
			$set = $model->toArray();
			
			echo '<a href=' . get_permalink($es_searchpage_options['page_id']) . '?search=search&setcode=' . $set['code'] . '>' . '<img width="30" height="30" src=' . $set['symbolUrl'] . '>' . $set['name'] . '</a><br>';
			
		}
		
		echo '</span>';
		echo "</td>";
		
		echo '<td valign="top">';
		echo '<span id="Expanded">';
		
		foreach ($expandedresponse as $model) {
			$set = $model->toArray();
			
			echo '<a href=' . get_permalink($es_searchpage_options['page_id']) . '?search=search&setcode=' . $set['code'] . '>' . '<img width="30" height="30" src=' . $set['symbolUrl'] . '>' . $set['name'] . '</a><br>';
			
		}
		echo '</span>';
		echo "</td>";	
		
		echo '<td valign="top">';
		echo '<span id="Unlimited">';
		
		foreach ($unlimitedresponse as $model) {
			$set = $model->toArray();
			
			echo '<a href=' . get_permalink($es_searchpage_options['page_id']) . '?search=search&setcode=' . $set['code'] . '>' . '<img width="30" height="30" src=' . $set['symbolUrl'] . '>' . $set['name'] . '</a><br>';
			
		}
		
		echo '</span>';	
		echo "</td>";
		echo '</tr>';
		echo '</table>'; 
		
	}
?>