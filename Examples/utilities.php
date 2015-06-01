<?php

/*********************************
 * 	 SORTING AND RESULTS DISPLAY
 *********************************/
// Helper sorter functions
function sortByDamage($a, $b) {
	if($a['damage'] > $b['damage']){
		return -1;
	}else if($a['damage'] == $b['damage']){
		return 0;
	}
	return 1;
}

function sortByDPS($a, $b) {
	if($a['dps'] > $b['dps']){
		return -1;
	}else if($a['dps'] == $b['dps']){
		return 0;
	}
	return 1;
}

function displayResults($top_damage, $top_dps){
	// Sort the arrays
	usort($top_damage, 'sortByDamage');
	usort($top_dps, 'sortByDPS');
	
	// Print Results
	echo "\n\nTOP 20 DAMAGE\n-----------------------------\n";
	foreach($top_damage as $key => $entry){
		echo "Damage: ".$entry['damage']. "\tDPS: ".$entry['dps']. "\tGlyphs: ".$entry['Marks']. "\tMarks: ".$entry['Marks']. "\tQuintessences: ".$entry['Quintessences']. "\tSeals: ".$entry['Seals']."\n";
	}
	
	echo "\nTOP 20 DPS\n-----------------------------\n";
	foreach($top_dps as $key => $entry){
		echo "DPS: ".$entry['dps']. "\tDamage: ".$entry['damage']. "\tGlyphs: ".$entry['Marks']. "\tMarks: ".$entry['Marks']. "\tQuintessences: ".$entry['Quintessences']. "\tSeals: ".$entry['Seals']."\n";
	}
}

 
/*********************************
 * 		 COMPLETE RUNE LIST
 *********************************/
$runes_arr = Array(
	'Glyphs' => Array(		
		'ManaScaling',
		'CooldownReductionScaling',
		'EnergyScaling',
		'Health',
		'AttackSpeed',
		'MagicResistScaling',
		'AttackDamage',
		'MagicResist',
		'ManaRegeneration',
		'MagicPenetration',
		'AbilityPowerScaling',
		'AttackDamageScaling',
		'HealthScaling',
		'AbilityPower',
		'Mana',
		'Energy',
		'CriticalChance',
		'CriticalDamage',
		'HealthRegeneration',
		'Armor',
		'ManaRegenerationScaling',
		'CooldownReduction'
	),
	'Quintessences' => Array(	
		'EnergyRegeneration',
		'ManaScaling',
		'CooldownReductionScaling',
		'Health',
		'AttackSpeed',
		'MagicResistScaling',
		'AttackDamage',
		'MagicResist',
		'Experience',
		'HealthPercent',
		'Lifesteal',
		'ManaRegeneration',
		'ArmorPenetration',
		'ArmorScaling',
		'Revival',
		'MagicPenetration',
		'AbilityPowerScaling',
		'AttackDamageScaling',
		'HealthScaling',
		'AbilityPower',
		'Mana',
		'Energy',
		'MovementSpeed',
		'HealthRegenerationScaling',
		'CriticalChance',
		'CriticalDamage',
		'HealthRegeneration',
		'Armor',
		'ManaRegenerationScaling',
		'SpellVamp',
		'Gold',
		'HybridPenetration',
		'CooldownReduction'
	),
	'Seals' => Array(	
		'EnergyRegeneration',
		'ManaScaling',
		'Health',
		'AttackSpeed',
		'MagicResistScaling',
		'AttackDamage',
		'MagicResist',
		'HealthPercent',
		'ManaRegeneration',
		'ArmorScaling',
		'AbilityPowerScaling',
		'AttackDamageScaling',
		'HealthScaling',
		'AbilityPower',
		'Mana',
		'HealthRegenerationScaling',
		'CriticalChance',
		'CriticalDamage',
		'HealthRegeneration',
		'Armor',
		'ManaRegenerationScaling',
		'Gold',
		'EnergyRegenerationScaling',
		'CooldownReduction'
	),
	'Marks' => Array(
		'ManaScaling',
		'Health',
		'AttackSpeed',
		'MagicResistScaling',
		'AttackDamage',
		'MagicResist',
		'ManaRegeneration',
		'ArmorPenetration',
		'MagicPenetration',
		'AbilityPowerScaling',
		'AttackDamageScaling',
		'HealthScaling',
		'AbilityPower',
		'Mana',
		'CriticalChance',
		'CriticalDamage',
		'Armor',
		'HybridPenetration',
		'CooldownReduction',
	)
);
