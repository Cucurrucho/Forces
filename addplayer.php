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
    <title>Add Player</title>
</head>
<body>
<?php
include('code/php/Db.php');
$forces = new Db('localhost', 'Adam', 'queseyo', 'forces');
if (isset($_POST['player'])) {
    try {
    }
    catch (Exception $e){
        ?>
        <script>
            var errorMsg = "<?php echo $e->getMessage(); ?>";
            swal({   title: "Connection Failed",   text: errorMsg,   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Refresh page!",   closeOnConfirm: false }, function(){location.reload(); });
        </script>
    <?php
    }
    try {
        $forces->table('players')->insert (array('Name' => $_POST['player'], 'Attack' => $_POST['attack'], 'Defense' => $_POST['defense'], 'Stamina' => $_POST['stamina']));
        ?>
        <script>
            var member  = "<?php echo $_POST['player']; ?>";
            swal({   title: member, text:"was added to players", type: "success",  timer: 1500,   showConfirmButton: false });
        </script>
        <?php
    }
    catch (Exception $e){
        ?>
        <script>
            var errorMsg = "<?php echo $e->getMessage(); ?>";
            var member  = "<?php echo $_POST['player']; ?>";
            swal({   title: member + " could not be added",   text: errorMsg,   type: "error" });
            </script>
        <?php
    }
}
?>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Forces</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.html">Home</a></li>
                <li class="active"><a href="addplayer.php">Add Player</a></li>
                <li><a href="makeTeam.php">Make a Team</a></li>
                <li><a href="editPlayer.php">Edit Player</a></li>
            </ul>
        </div>
    </nav>
    <form action="addplayer.php" method="post">
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
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </form>
</body>
</html>