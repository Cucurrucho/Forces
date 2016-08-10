function showNewMatchups(matchups) {
    console.log(matchups);
    var topMatches = matchups.slice(0,9);
    var i = 0;
    $.each(topMatches, function (key, match){
            var teamA = match[0];
            var teamB = match[1];
            var matchesHtml = '<ul class="col-lg-5">';
            $.each(teamA, function (key, value) {
                matchesHtml += '<li>' + value.name + '</li>';
            })
            matchesHtml += '</ul>';
            matchesHtml += '<p class="col-lg-1">VS</p>'
            matchesHtml += '<ul class="col-lg-5">';
            $.each(teamB, function (key, value) {
                matchesHtml += '<li>' + value.name + '</li>';
            })
            matchesHtml += '</ul>';

        $("#item" + i).html(matchesHtml);
            i++;
        }
    )
}