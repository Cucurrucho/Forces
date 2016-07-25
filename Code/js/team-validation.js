function teamValidation() {
     teamLength = $('#game option:selected');
    if (teamLength.length < 8) {
        sweetAlert("Error", "Number of players need to be more than 8", "error");
        return false;
    }
    if (teamLength.length % 2 != 0) {
        sweetAlert("Error", "You need to select even number of players", "error");
        return false;
    }
}