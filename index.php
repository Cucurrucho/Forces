<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
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
            <div class="alert alert-warning" role="alert">
                <strong>Failed Connection</strong>
            </div>
            <?php
        }
        else {?>
            <div class="alert alert-success" role="alert">
                <strong>Connected!</strong>
            </div>
            <?php
        }
    }

    function db_insert_player () {
        $name = $_POST['player'];
        $attack = $_POST['attack'];
        $defense = $_POST['defense'];
        $stamina = $_POST['stamina'];

        $sql = "INSERT INTO players (Name, Attack, Defense, Stamina)
    VALUES ('$name', '$attack', '$defense', '$stamina')";

        if ($this->conn->query($sql) === TRUE) {?>
            <div class="alert alert-success" role="alert">
                <strong>Player Added</strong>
            </div>
            <?php
        }
        else {?>
            <div class="alert alert-warning" role="alert">
                <strong>Failed adding player!</strong>
            </div>
            <?php
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
$forces->db_insert_player();
}
?>
</body>
</html>