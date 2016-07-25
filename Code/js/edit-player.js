function passPlayer (playerID, playerName, playerAttack, playerDefense, playStamina) {
    console.log(playerName)
    $('#ID').val(playerID);
    $('#player').val(playerName);
    $('#attack').val(playerAttack);
    $('#defense').val(playerDefense);
    $('#stamina').val(playStamina);
}
