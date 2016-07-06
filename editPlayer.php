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
            <li><a href="playerTable.php">Player Table</a></li>
            <li class="active"><a href="editPlayer.php">Edit Player</a></li>
        </ul>
    </div>
</nav>
<?php
include('code/php/db_class.php');
$forces = new Db('localhost', 'Adam', 'queseyo', 'forces');
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
            while ( $row = $result->fetch_array()){?>

                <tr>
                    <th><button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo $row['Name']?>">Edit Player</button></th>
                    <div class="modal fade" id="<?php echo $row['Name']?>" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Editor</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="editPlayer.php" method="post">
                                        <div class="form-group">
                                            <label for="Change">Change:</label>
                                            <select class="form-control" name="<?php echo $row['Name'];?>">
                                                <option>Attack</option
                                                <option>Defense</option>
                                                <option>Stamina</option>
                                            </select>
                                            <label for="Set">Set to</label>
                                            <select class="form-control" name="<?php echo ($row['Name'] . $row['ID']); ?>">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit</button>
                                        <?php

                                        if (isset($_POST[$row['Name']])) {
                                                $forces->table('players')->edit(array(array($_POST[$row['Name']], '=', $_POST[($row['Name'] . $row['ID'])])))->where('ID', '=', $row['ID']);
                                        }?>
                                        </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
</div>
</body>
</html>
