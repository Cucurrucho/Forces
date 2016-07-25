<?php include('navbar.php'); ?>
<script>$(document).prop('title', 'Add Player');</script>
<?php
include('code/php/Db.php');
if (isset($_POST['player'])) {
    try {
    $forces = new Db('localhost', 'Adam', 'queseyo', 'forces');
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