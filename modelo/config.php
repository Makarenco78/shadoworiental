<?php

$site = array(

	"title" => "Pagina de registro",
	"h1" => "Registro",
	"meta_description" => "Shadow WoW Oriental Server WoW",
	"meta_keywords" => "PapaKiller, Blizzlike, Repack, Registro",
	"meta_robots" => "INDEX",
	"realmlist" => "set realmlist 127.0.0.1"

);

$sql_user = 'root'; //mysql username
$sql_pass = 'ascent'; //mysql_pass
$sql_host = 'localhost'; //mysql server address
$sql_account_db = 'sl_auth'; //mysql account data base name
$sql_character_db = 'sl_characters'; //mysql characters database name
$sql_world_db = 'sl_world'; //mysql world database

function _getCharRaceSTR($CharRace) {
	switch($CharRace) {
		case 1: return "Human"; 
		case 2: return "Orc"; 
		case 3: return "Dwarf"; 
		case 4: return "Night Elf"; 
		case 5: return "Undead"; 
		case 6: return "Tauren"; 
		case 7: return "Gnome"; 
		case 8: return "Troll"; 
		case 9: return "Goblin"; 
		case 10: return "Blood Elf"; 
		case 11: return "Draenei"; 
		case 12: return "Fel Orc"; 
		case 13: return "Naga"; 
		case 14: return "Broken"; 
		case 15: return "Skeleton"; 
		case 16: return "Vrykul"; 
		case 17: return "Tuskarr"; 
		case 18: return "Forest Troll"; 
		case 19: return "Taunka"; 
		case 20: return "Northrend Skeleton"; 
		case 21: return "Ice Troll"; 
		case 22: return "Worgen"; 
		case 23: return "Gilnean"; 
		case 24: return "Pandaren"; 
		case 25: return "Pandaren"; 
		case 26: return "Pandaren"; 
		case 27: return "Nightborne"; 
		case 28: return "Highmountain Tauren"; 
		case 29: return "Void Elf";
		case 30: return "Lightforged Draenei"; 
		case 31: return "Zandalari Troll"; 
		case 32: return "Kul Tiran"; 
		case 33: return "Human"; 
		case 34: return "Dark Iron Dwarf"; 
		case 35: return "Vulpera"; 
		case 36: return "Mag'har Orc"; 
		case 37: return "Mechagnome"; 
		default:
			return "???"; // Default - Human
	}
}
	
function _getChSexSTR($G) {
	switch($G) {
		case 1: return "Female"; // Female
		case 0: return "Male"; // Male
		default:
			return "???"; // Default - Male
	}
}
	
function _getChClSTR($class) {
	switch($class) {
		case 1: return  "Warrior"; // Warrior
		case 2: return  "Paladin"; // Paladin
		case 3: return  "Hunter"; // Hunter
		case 4: return  "Rogue"; // Rogue
		case 5: return  "Priest"; // Priest
		case 6: return  "Death Knight"; // Death Knight
		case 7: return  "Shaman"; // Shaman
		case 8: return  "Mage"; // Mage
		case 9: return  "Warlock"; // Warlock
		case 10: return "Monk"; // Warlock
		case 11: return "Druid"; // Druid
		case 12: return "Demon Hunter"; // Druid
		default:
			return "???"; // Default - Warrior
	}
}

function _getCharMoneySTR($M) {
	$L = intval($M / 10000);
	/* Gold */   $AU = $L;
	$L = $M - $AU * 10000;
	$L = intval($L / 100);
	/* Silver */ $AG = $L;
	/* Copper */ $CU = $M - $AU * 10000 - $AG * 100;
	return $AU ."<img alt = '' src = '/images/money/gold_coin.png'> ".
		 $AG ."<img alt = '' src = '/images/money/silver_coin.png'> ".
		 $CU ."<img alt = '' src = '/images/money/copper_coin.png'> ";
}

function _getFactionSTR($F){
	switch($F){
		case 1:
		case 3:
		case 4:
		case 7:
		case 11:
		case 12:
		case 13:
		case 14:
		case 15:
		case 16:
		case 17:
		case 18:
		case 19:
		case 20:
		case 21:
		case 22:
		case 23:
		case 25:
		case 29:
		case 30:
		case 32:
		case 33:
		case 34:
		case 37:
			return "Aliance";
	
		case 2:
		case 5:
		case 6:
		case 8:
		case 9:
		case 10:
		case 26:
		case 27:
		case 28:
		case 31:
		case 35:
		case 36:
			return "Horde";
			
		case 24:
			return "Neutral";
	}
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


?>