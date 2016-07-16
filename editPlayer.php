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
    <script src="Code/js/edit-player.js"></script>
    <title>Edit Player</title>
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
            <li><a href="makeTeam.php">Make a Team</a></li>
            <li class="active"><a href="editPlayer.php">Edit Player</a></li>
        </ul>
    </div>
</nav>
<?php
include('code/php/Db.php');
$forces = new Db('localhost', 'Adam', 'queseyo', 'forces');
if (isset($_POST['player'])){
    $edito = "Name='";
    $edito .=  $_POST['player'] . "',Attack=" . $_POST['attack'] . ",Defense=" . $_POST['defense'] . ",Stamina=" . $_POST['stamina'];
    $forces->table('players')->where('ID', '=', $_POST['ID'])->update($edito);
}

function getPlayer ($player_array){
    $playerData = $player_array['ID'] . ", '". $player_array['Name'] . "', " .  $player_array['Attack'] . ", " . $player_array['Defense'] . ", ". $player_array['Stamina'];
    echo $playerData;
}

?>
<div class="container-fluid">
    <div class="panel panel-default" width="100%">
        <table id="playersTable" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Edit Player</th>
                <th>ID</th>
                <th>Name</th>
                <th>Attack</th>
                <th>Defense</th>
                <th>Stamina</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Edit Player</th>
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
            while ( $row = $result->fetch_array()){ ?>

                <tr>
                    <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#editor" onclick="passPlayer(<?php getPlayer($row) ?>)">Edit Player</button></td>
                    <td><?php echo $row['ID']?></td>
                    <td><?php echo $row['Name']?></td>
                    <td><?php echo $row['Attack']?></td>
                    <td><?php echo $row['Defense']?></td>
                    <td><?php echo $row['Stamina']?></td>
                    <td><?php getPlayer($row) ?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
            <script src="Code/js/players-table.js"></script>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editor" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editor</h4>
                </div>
                <div class="modal-body">
                    <form action="editPlayer.php" method="post">
                        <div class="form-group">
                            <label for="player">Name:</label>
                            <input type="text" class="form-control" id="player" name="player" required>
                            <label for="attack">Attack:</label>
                            <select class="form-control" id="attack" name="attack">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <label for="defense">Defense:</label>
                            <select class="form-control" id="defense" name="defense">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <label for="stamina">Stamina:</label>
                            <select class="form-control" id="stamina" name="stamina">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <input type="hidden" id="ID" name="ID">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
