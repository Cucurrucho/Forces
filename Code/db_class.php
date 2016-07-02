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

    function insert ($tableName, $info) {

        $query = "INSERT INTO $tableName (";
        foreach ($info as $column => $value){
            $query .= " $column,";
        }
        $query = substr($query, 0, -1);
        $query .= ")
        VALUES (";

        foreach ($info as $value) {
            $query .= " '$value',";
        }
        $query = substr($query, 0, -1);

        $query .= ")";

        if ($this->conn->query($query) === true) {?>
            <script>
                var member = "<?php echo $info[0] ?>";
                var table = "<?php echo $tableName ?>";
                swal({   title: member + " was added to " + table,   text: "",   timer: 2000,   showConfirmButton: false });
            </script>;
            <?php
        }
        else {?>
            <script>
                var member = "<?php echo $info[0] ?>";
                var table = "<?php echo $tableName ?>";
                swal({   title: member + " was not added to " + table,   text: "try again",   timer: 2000,   showConfirmButton: false });
            </script>;
            <?php
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }
}
?>