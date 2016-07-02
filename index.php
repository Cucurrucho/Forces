<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
    <title>Forces</title>
</head>
<body>
<?php
class Db {

    private $conn;

    function __construct($par1, $par2, $par3, $par4)
    {

        $this->conn = new mysqli($par1, $par2, $par3, $par4);

        if ($this->conn->connect_error) {?>
            <script>
                swal({   title: "Connection Failed",   text: "Refresh page to try again!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Refresh page!",   closeOnConfirm: false }, function(){location.reload(); });
            </script>
            <?php
        }
        else {
        }
    }

    function db_insert ($tableName, $columns, $values) {

        $query = "INSERT INTO $tableName (";
        foreach ($columns as $column){
            $query .= " $column,";
        }
        $query = substr($query, 0, -1);
        $query .= ")
        VALUES (";

        foreach ($values as $value) {
            $query .= " '$value',";
        }
        $query = substr($query, 0, -1);

        $query .= ")";

        if ($this->conn->query($query) === TRUE) {?>
                <script>
                    var member = "<?php echo $values[0] ?>";
                    var table = "<?php echo $tableName ?>";
                    swal({   title: member + " was added to " + table,   text: "",   timer: 2000,   showConfirmButton: false });
                </script>;
            <?php
        }
        else {?>
    <script>
        var member = "<?php echo $values[0] ?>";
        var table = "<?php echo $tableName ?>";
        swal({   title: member + " was not added to " + table,   text: "try again",   timer: 2000,   showConfirmButton: false });
    </script>;
            <?php
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }
}

$forces = new Db('localhost', 'Adam', 'queseyo', 'forces');


?>
    <form action="index.php" method="post">
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
<?php
if (isset($_POST['player'])) {
$forces->db_insert('players', array('Name', 'Attack', 'Defense', 'Stamina'), array($_POST['player'], $_POST['attack'], $_POST['defense'], $_POST['stamina']));
}
?>
</body>
</html>