<?php

// Array manipulation

function array_pushDown(&$array, $subKey, $pushKey)
{
    $original = &$array;

    if(!isset($original[$subKey]))
        $original[$subKey] = array();

    if(isset($original[$pushKey])){
        $original[$subKey] = array_add($original[$subKey], $pushKey, $original[$pushKey]);
        array_forget($original, $pushKey);
    }

    return $original;
}

function array_rename(&$array, $oldName, $newName){
    $original = &$array;

    if(isset($original[$oldName])) {
        $original[$newName] = $original[$oldName];
        array_forget($original, $oldName);
    }

    return $original;
}

// View related functions

function rarityToKeyruneClass($setCode, $rarity)
{
    if($rarity == 'Mythic Rare')
        $rarity = 'mythic';
    $rarity = strtolower($rarity);
    $setCode = strtolower($setCode);
    return "ss-$setCode ss-$rarity";
}

function costToManaClassArray($class)
{
    $classes = array();
    preg_match_all('/{(.*?)}/', $class, $classes);
    $classes = array_map("singleCostToManaClass", $classes[1]);
    return $classes;
}

function singleCostToManaClass($singleCost)
{
    $singleCost = strtolower($singleCost);
    if(strlen($singleCost) == 3){
        $costs = explode('/', $singleCost);
        $costA = $costs[0]; $costB = $costs[1];
        $class = "ms-split ms-$costA$costB";
    }else{
        $class = "ms-$singleCost";
    }
    return $class;
}

function isActive($url)
{
    if(Request::is($url))
        return 'active';

    return '';
}