<?php include('navbar.php'); ?>
<script>$(document).prop('title', 'Make a Team');</script>
<script src="Code/js/showNewMatchups.js"></script>
<?php
include('code/php/sortingFunctions.php');
include('code/php/Db.php');
include('code/php/Player.php');
$forces = new Db('localhost', 'Adam', 'queseyo', 'forces');
function getName ($player_array) {
    $addedPlayer = $player_array['ID'] . ", '". $player_array['Name'] . "'";
    echo $addedPlayer;
}
?>
<div class="container-fluid">
    <div class="panel panel-default" width="100%">
        <table id="playersTable" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Add To Game</th>
                <th>ID</th>
                <th>Name</th>
                <th>Attack</th>
                <th>Defense</th>
                <th>Stamina</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Add To Game</th>
                <th>ID</th>
                <th>Name</th>
                <th>Attack</th>
                <th>Defense</th>
                <th>Stamina</th>
            </tr>
            </tfoot>
            <tbody>
            <?php
            $result = $forces->table('players')->select('*')->get();
            while ( $row = $result->fetch_array()){?>

                <tr>
                    <td><button id="<?php echo $row['ID'] ?>" class="btn btn-info"  onclick="addToGame(<?php getName($row); ?>); $(this).prop('disabled', true)">Add Player</button></td>
                    <td><?php echo $row['ID']?></td>
                    <td><?php echo $row['Name']?></td>
                    <td><?php echo $row['Attack']?></td>
                    <td><?php echo $row['Defense']?></td>
                    <td><?php echo $row['Stamina']?></td>
                </tr>

            <?php } ?>
            </tbody>
            <script src="Code/js/playersTable.js"></script>
        </table>
    </div>
    <div class="panel panel-default">
        <form action="makeTeam.php" method="post" onsubmit="return teamValidation();">
            <label for="game">Playing</label>
            <select multiple class="form-control" id="game" name="game[]">
            </select>
            <button type="button" class="btn btn-danger" onclick="removePlayer()">Remove Players</button>
            <button type="submit" class="btn btn-default" onclick="selectAll();">Submit</button>
        </form>
    </div>
</div>
<?php
if (isset($_POST['game'])) {
    $playerList = array();
    $i = -1;
    foreach ($_POST['game'] as $value){
        $players = $forces->table('players')->where($value, '=', 'ID')->select('*')->get();
        while ($newPlayer = $players->fetch_array()) {
            $playerList[] =  new Player($newPlayer['Name'], $newPlayer['Attack'], $newPlayer['Defense'], $newPlayer['Stamina'], $newPlayer['ID']);;
            $i ++;
        }

    }
    $identifier = $playerList[$i];
    $teams = combinations($playerList, count($playerList)/2);
    $teamsA = array_filter($teams, function ($var) use ($identifier) {
        return (in_array($identifier,$var));
    });
    $teamsB = array_filter($teams, function ($var) use ($identifier) {
        return (!in_array($identifier,$var));
    });

    $matchups = [];

    foreach ($teamsA as $team) {
        $matchups[] = matchMaker($team,$teamsB);
    }
    $i = 0;
    usort($matchups,"cmp");
    foreach ($matchups as $matchup) {
        unset($matchup['rating']);
        $matchups[$i] = $matchup;
        $i++;
    }
    $matches = array_slice($matchups,0,10,true); ?>
    <div class="panel panel-default" style="margin: 2%;">
        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false" style="background: lightblue">
            <ol class="carousel-indicators" align="center" style="margin-top: 70%">
                <li data-target="#myCarousel" data-slide-to="0"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="4"></li>
                <li data-target="#myCarousel" data-slide-to="5"></li>
                <li data-target="#myCarousel" data-slide-to="6"></li>
                <li data-target="#myCarousel" data-slide-to="7"></li>
                <li data-target="#myCarousel" data-slide-to="8"></li>
                <li data-target="#myCarousel" data-slide-to="9"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php
                $i = 0;
                foreach ($matches as $match) {
                    $teamA = $match[0];
                    $teamB = $match [1];
                    ?> <div class="item <?php if ($match === $matches[0]) { echo "active";} ?>" align="center" id="item<?= $i?>">
                        <ul class="col-lg-5">
                            <?php foreach ($teamA as $player){
                                ?> <li>
                                <?php echo $player->name; ?>
                            </li>
                           <?php } ?>
                        </ul>
                        <p class="col-lg-1">VS</p>
                        <ul class="col-lg-5">
                            <?php foreach ($teamB as $player){
                                ?> <li>
                                    <?php echo $player->name; ?>
                                </li>
                            <?php } ?>
                        </ul>
                </div>
              <?php $i++; } ?>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <script> var matchups = <?= json_encode($matchups) ?>; </script>
            <button class="btn btn-info" onclick="matchups.splice(0,10);showNewMatchups(matchups)" align="center">Get more matchups</button>
        </div>
    <?php
 }
?>
</body>
</html>
