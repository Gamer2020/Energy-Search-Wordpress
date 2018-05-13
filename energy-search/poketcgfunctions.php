<?php
	use Pokemon\Pokemon;
	
	function TypeToImageHTML($tname) {
		return '<img src="' . plugin_dir_url( __FILE__ ). 'img/' . $tname . '.png' . '" alt="' . $tname .'" height="20" width="20">';
	}
	
?>