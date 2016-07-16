<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script src="Code/js/add-to-game.js"></script>
    <script src="Code/js/selectAll.js"></script>
    <script src="Code/js/team-validation.js"></script>
    <title>Player Table</title>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Forces</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.html">Home</a></li>
                <li><a href="addplayer.php">Add Player</a></li>
                <li class="active"><a href="makeTeam.php">Make a Team</a></li>
                <li><a href="editPlayer.php">Edit Player</a></li>
            </ul>
        </div>
    </nav>
<?php
include('code/php/Db.php');
$forces = new Db('localhost', 'Adam', 'queseyo', 'forces');
function getName ($player_array) {
    $addedPlayer = $player_array['ID'] . ", '". $player_array['Name'] . "'";
    echo $addedPlayer;
}
if (isset($_POST['game'])) {
    foreach ($_POST['game'] as $value){
        echo $value;
    }
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
            <script src="Code/js/players-table.js"></script>
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
</body>
</html>
