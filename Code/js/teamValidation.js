function teamValidation() {
     teamLength = $('#game option:selected');
    if (teamLength.length < 8) {
        $('#game option').prop('selected', false);
        sweetAlert("Error", "Number of players need to be more than 8", "error");
        return false;
    }
    if (teamLength.length % 2 != 0) {
        $('#game option').prop('selected', false);
        sweetAlert("Error", "You need to select even number of players", "error");
        return false;
    }
}