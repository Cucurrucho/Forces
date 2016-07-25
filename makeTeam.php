<?php include('navbar.php'); ?>
<script>$(document).prop('title', 'Make a Team');</script>
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
    usort($matchups,"cmp");
    $topMathc = array_slice($matchups,0,1);
    unset($topMathc['rating']);
    $teamA = $topMathc[0];
    var_dump($teamA);
}
?>
</body>
</html>
