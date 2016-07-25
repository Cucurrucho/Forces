<?php

function cmp($a, $b)
{
    return strcmp($a['rating'], $b['rating']);
}

function compareAttack ($teamA, $teamB){
    $sumAttackA = 0;
    foreach ($teamA as $player) {
        $playerAttack = $player->attack;
        $sumAttackA += $playerAttack;
    }
    $sumAttackB = 0;
    foreach ($teamB as $player) {
        $playerAttack = $player->attack;
        $sumAttackB += $playerAttack;
    }
    $sumAttack = abs($sumAttackA - $sumAttackB) * abs($sumAttackA - $sumAttackB);

    return $sumAttack;
}

function compareDefense ($teamA, $teamB){
    $sumDefenseA = 0;
    foreach ($teamA as $player) {
        $playerDefense = $player->defense;
        $sumDefenseA += $playerDefense;
    }
    $sumDefenseB = 0;
    foreach ($teamB as $player) {
        $playerDefense = $player->defense;
        $sumDefenseB += $playerDefense;
    }
    $sumDefense = abs($sumDefenseA - $sumDefenseB) * abs($sumDefenseA - $sumDefenseB);

    return  $sumDefense;
}

function compareStamina ($teamA, $teamB){
    $sumStaminaA = 0;
    foreach ($teamA as $player) {
        $playerStamina = $player->stamina;
        $sumStaminaA  += $playerStamina;
    }
    $sumStaminaB = 0;
    foreach ($teamB as $player) {
        $playerStamina  = $player->stamina;
        $sumStaminaB += $playerStamina;
    }
    $sumStamina = abs($sumStaminaB - $sumStaminaA) * abs($sumStaminaB - $sumStaminaA);

    return  $sumStamina;
}

function rateGame ($teamA, $teamB) {
    $rating = compareAttack($teamA,$teamB) + compareDefense($teamA,$teamB) + compareStamina($teamA,$teamB);
    return $rating;
}
function combinations($list, $n) {
    set_time_limit ( 1000 );
    if ($n == 1) {
        return array_chunk($list, 1, true);
    }
    if ($n == count($list)) {
        return [$list];
    }
    $solution = [];
    $player = array_shift($list);
    $playerTeams = combinations($list, $n - 1);
    foreach ($playerTeams as $team) {
        array_push($team, $player);
        $solution [] = $team;
    }
    $nonPlayerTeams = combinations($list, $n);
    foreach ($nonPlayerTeams as $team){
        $solution [] = $team;
    }
    return $solution;
}

function matchMaker($teamA, $teamsB) {
    foreach ($teamsB as $team) {
        $i = 0;
        foreach ($teamA as $player) {
            if (in_array($player,$team,true)){
                $i ++;
                break;
            }
        }
        if ($i == 0) {
            $rating = rateGame($teamA,$team);
            $matchup = [$teamA,$team, 'rating' => $rating];
        }
    }
    return $matchup;
}