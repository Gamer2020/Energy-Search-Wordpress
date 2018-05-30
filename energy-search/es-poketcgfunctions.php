<?php
	use Pokemon\Pokemon;
	
	function TypeToImageHTML($tname) {
		return '<img src="' . plugin_dir_url( __FILE__ ). 'img/' . $tname . '.png' . '" alt="' . $tname .'" height="20" width="20">';
	}
	
	function NameToTCGPName($InputName){
		
		
		
		switch ($InputName)
		
		{
			
			case 'Base':
			
			$SetName = "base set";
			
			break;
			
			case 'Jungle':
			
			$SetName = "jungle";
			
			break;
			
			case 'Fossil':
			
			$SetName = "fossil";
			
			break;
			
			case 'Base Set 2':
			
			$SetName = "base set 2";
			
			break;
			
			case 'Team Rocket':
			
			$SetName = "team rocket";
			
			break;
			
			case 'Gym Heroes':
			
			$SetName = "gym heroes";
			
			break;
			
			case 'Gym Challenge':
			
			$SetName = "gym challenge";
			
			break;
			
			case 'Neo Genesis':
			
			$SetName = "neo genesis";
			
			break;
			
			case 'Neo Discovery':
			
			$SetName = "neo discovery";
			
			break;
			
			case 'Neo Revelation':
			
			$SetName = "neo revelation";
			
			break;
			
			case 'Neo Destiny':
			
			$SetName = "neo destiny";
			
			break;
			
			case 'Legendary Collection':
			
			$SetName = "legendary collection";
			
			break;
			
			case 'Expedition Base Set':
			
			$SetName = "expedition";
			
			break;
			
			case 'Aquapolis':
			
			$SetName = "aquapolis";
			
			break;
			
			case 'Skyridge':
			
			$SetName = "skyridge";
			
			break;
			
			case 'Ruby & Sapphire':
			
			$SetName = "ruby and sapphire";
			
			break;
			
			case 'Sandstorm':
			
			$SetName = "sandstorm";
			
			break;
			
			case 'Dragon':
			
			$SetName = "dragon";
			
			break;
			
			case 'Team Magma vs Team Aqua':
			
			$SetName = "team magma vs team aqua";
			
			break;
			
			case 'Hidden Legends':
			
			$SetName = "hidden legends";
			
			break;
			
			case 'FireRed & LeafGreen':
			
			$SetName = "FireRed and LeafGreen";
			
			break;
			
			case 'Team Rocket Returns':
			
			$SetName = "team rocket returns";
			
			break;
			
			case 'Deoxys':
			
			$SetName = "deoxys";
			
			break;
			
			case 'Emerald':
			
			$SetName = "emerald";
			
			break;
			
			case 'Unseen Forces':
			
			$SetName = "unseen forces";
			
			break;
			
			case 'Delta Species':
			
			$SetName = "delta species";
			
			break;
			
			case 'Legend Maker':
			
			$SetName = "legend maker";
			
			break;
			
			case 'Holon Phantoms':
			
			$SetName = "holon phantoms";
			
			break;
			
			case 'Crystal Guardians':
			
			$SetName = "crystal guardians";
			
			break;
			
			case 'Dragon Frontiers':
			
			$SetName = "dragon frontiers";
			
			break;
			
			case 'Power Keepers':
			
			$SetName = "power keepers";
			
			break;
			
			case 'Diamond & Pearl':
			
			$SetName = "diamond and pearl";
			
			break;
			
			case 'Mysterious Treasures':
			
			$SetName = "mysterious treasures";
			
			break;
			
			case 'Secret Wonders':
			
			$SetName = "secret wonders";
			
			break;
			
			case 'Great Encounters':
			
			$SetName = "great encounters";
			
			break;
			
			case 'Majestic Dawn':
			
			$SetName = "majestic dawn";
			
			break;
			
			case 'Legends Awakened':
			
			$SetName = "legends awakened";
			
			break;
			
			case 'Stormfront':
			
			$SetName = "stormfront";
			
			break;
			
			case 'Platinum':
			
			$SetName = "platinum";
			
			break;
			
			case 'Rising Rivals':
			
			$SetName = "rising rivals";
			
			break;
			
			case 'Supreme Victors':
			
			$SetName = "supreme victors";
			
			break;
			
			case 'Arceus':
			
			$SetName = "arceus";
			
			break;
			
			case 'HeartGold & SoulSilver':
			
			$SetName = "heartgold soulsilver";
			
			break;
			
			case 'HS—Unleashed':
			
			$SetName = "unleashed";
			
			break;
			
			case 'HS—Undaunted':
			
			$SetName = "undaunted";
			
			break;
			
			case 'HS—Triumphant':
			
			$SetName = "triumphant";
			
			break;
			
			case 'Call of Legends':
			
			$SetName = "call of legends";
			
			break;
			
			case 'Black & White':
			
			$SetName = "black and white";
			
			break;
			
			case 'Emerging Powers':
			
			$SetName = "emerging powers";
			
			break;
			
			case 'Noble Victories':
			
			$SetName = "noble victories";
			
			break;
			
			case 'Next Destinies':
			
			$SetName = "next destinies";
			
			break;
			
			case 'Dark Explorers':
			
			$SetName = "dark explorers";
			
			break;
			
			case 'Dragons Exalted':
			
			$SetName = "dragons exalted";
			
			break;
			
			case 'Boundaries Crossed':
			
			$SetName = "boundaries crossed";
			
			break;
			
			case 'Plasma Storm':
			
			$SetName = "plasma storm";
			
			break;
			
			case 'Plasma Freeze':
			
			$SetName = "plasma freeze";
			
			break;
			
			case 'Plasma Blast':
			
			$SetName = "plasma blast";
			
			break;
			
			case 'Legendary Treasures':
			
			$SetName = "legendary treasures";
			
			break;
			
			case 'XY':
			
			$SetName = "xy base set";
			
			break;
			
			case 'Flashfire':
			
			$SetName = "xy - flashfire";
			
			break;
			
			case 'Furious Fists':
			
			$SetName = "xy - furious fists";
			
			break;
			
			case 'Phantom Forces':
			
			$SetName = "xy - phantom forces";
			
			break;
			
			case 'Primal Clash':
			
			$SetName = "xy - primal clash";
			
			break;
			
			case 'Roaring Skies':
			
			$SetName = "xy - roaring skies";
			
			break;
			
			case 'BW Black Star Promos':
			
			$SetName = "black and white promos";
			
			break;
			
			case 'XY Black Star Promos':
			
			$SetName = "xy promos";
			
			break;
			
			case 'Double Crisis':
			
			$SetName = "double crisis";
			
			break;
			
			case 'Ancient Origins':
			
			$SetName = "xy - ancient origins";
			
			break;
			
			case 'Wizards Black Star Promos':
			
			$SetName = "Wizards Black Star Promos";
			
			break;
			
			case 'Dragon Vault':
			
			$SetName = "dragon vault";
			
			break;
			
			case 'Kalos Starter Set':
			
			$SetName = "kalos starter set";
			
			break;
			
			case "Steam Siege":
			
			$SetName =  'XY - Steam Siege';
			
			break;
			
			case "Fates Collide":
			
			$SetName =  'XY - Fates Collide';
			
			break;
			
			case "Generations":
			
			$SetName =  'Generations';
			
			break;
			
			case "BREAKpoint":
			
			$SetName =  'XY - BREAKpoint';
			
			break;
			
			case "BREAKthrough":
			
			$SetName =  'XY - BREAKthrough';
			
			break;
			
			case "Evolutions":
			
			$SetName =  'XY - Evolutions';
			
			break;
			
			case "Sun & Moon":
			
			$SetName =  'SM Base Set';
			
			break;
			
			case "Guardians Rising":
			
			$SetName =  'SM - Guardians Rising';
			
			break;
			
			case "Burning Shadows":
			
			$SetName =  'SM - Burning Shadows';
			
			break;
			
			case "Crimson Invasion":
			
			$SetName =  'SM - Crimson Invasion';
			
			break;
			
			case "Ultra Prism":
			
			$SetName =  'SM - Ultra Prism';
			
			break;
			
			case "Forbidden Light":
			
			$SetName =  'SM - Forbidden Light';
			
			break;
			
			default:
			
			$SetName = $Clky;
			
			}
		
		return $SetName;
		
		}
	
?>