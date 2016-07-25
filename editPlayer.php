<?php include('navbar.php'); ?>
<script>$(document).prop('title', 'Edit Player');</script>
<?php 
include('code/php/Db.php');
$forces = new Db('localhost', 'Adam', 'queseyo', 'forces');
if (isset($_POST['player'])){
    $edito = "Name='";
    $edito .=  $_POST['player'] . "',Attack=" . $_POST['attack'] . ",Defense=" . $_POST['defense'] . ",Stamina=" . $_POST['stamina'];
    try {
        $forces->table('players')->where('ID', '=', $_POST['ID'])->update($edito);
    }
    catch (Exception $e){
        ?>
        <script>
            var errorMsg = "<?php echo $e->getMessage(); ?>";
            swal({   title: "Editing player failed",   text: errorMsg,   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "contact us!",   closeOnConfirm: false });
        </script>
        <?php
    }
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
                </tr>
            <?php
            }
            ?>
            </tbody>
            <script src="Code/js/playersTable.js"></script>
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
