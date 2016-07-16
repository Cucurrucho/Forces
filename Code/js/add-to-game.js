function addToGame(playerID, name) {
    $('#game').append("<option value='" + playerID + "' class='" + playerID + "' >" + name + "</option>");
}

function enable(ID) {
    $('#' + ID ).prop('disabled', false);
}
function removePlayer() {
    $('#game option:selected').each(function () {
        var ID = $(this).val();
        $(this).remove();
        enable(ID);
    })
}