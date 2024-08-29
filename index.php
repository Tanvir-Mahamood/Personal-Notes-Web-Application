<?php
    $insert = false;
    $update = false;
    $delete = false;

    include 'partials/_header.php';
    $user_sno = 0;
    if(isset($_SESSION['sno'])) $user_sno =  $_SESSION['sno'];

    include 'partials/_dbconnect.php'; // connection

    if(isset($_GET['delete'])) {
        $sno = $_GET['delete'];
        /*echo $sno;*/
        $delete = true;

        $sql = "DELETE FROM `notes` WHERE `notes`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
    }

    // collecting information to insert in the database
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset( $_POST['snoEdit'] )) { // update the record
            $sno = $_POST['snoEdit'];
            $title = $_POST["titleEdit"];
            $description = $_POST["descriptionEdit"];

            if($sno != NULL) { // if nothing is selected, then do not update
                $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`sno` = $sno";
                $result = mysqli_query($conn, $sql);
                
                if($result) $update = true;
                else echo "Failed to update <br>";
            }
        }
        else { // insert record
            $title = $_POST["title"];
            $description = $_POST["description"];

            $sql = "INSERT INTO `notes` (`user_sno`, `title`, `description`, `tstamp`) VALUES ('$user_sno', '$title', '$description', current_timestamp());";
            $result = mysqli_query($conn, $sql);

            if($result) $insert = true;
            else echo "Failed to Insert <br>";
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">

    <title>iNotes</title>

</head>

<body>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit this note</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/notes/index.php" method="post">
                <div class="modal-body">

                    <input type="hidden" id="snoEdit" name="snoEdit">
                    <div class="mb-3">
                        <label for="title" class="form-label">Note Title</label>
                        <input type="text" class="form-control" id="titleEdit" name="titleEdit"
                            aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="desc">Note Description</label>
                        <textarea class="form-control" id="descriptionEdit" name="descriptionEdit"
                            rows="3"></textarea>
                    </div>

                </div>
                <div class="modal-footer d-block mr-auto">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
    if($insert == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success! </strong> Your note has been inserted.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    else if($update == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success! </strong> Your note has been updated.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    else if($delete == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success! </strong> Your note has been deleted.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
?>

<div class="container my-4">
    <h2>Add a note</h2>
    <form action="/notes/index.php" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Note Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="desc">Note Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <?php
            if($user_sno != 0) {
                echo '<button type="submit" class="btn btn-primary">Add Note</button>';
            }
        ?>
    </form>
    <!-- Button trigger modal -->
    <?php
        if($user_sno != 0) {
            echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" style="margin-top: 20px;">Edit</button>
                <br>First select, then press on Edit';
        }
        else echo '<b><em>Please Log in to continue.</em></b>';
    ?>
</div>

<div class="container my-4">
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">SI</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Time</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if($user_sno != 0) {
                $sql = "SELECT * FROM `notes` WHERE user_sno = $user_sno";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while($row = mysqli_fetch_assoc($result)) {
                    $sno += 1;
                    echo "<tr>
                        <th scope='row'>". $sno . "</th>
                        <td>". $row['title'] . "</td>
                        <td>". $row['description'] . "</td>
                        <td>". $row['tstamp'] . "</td>
                        <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Select</button> 
                                <button  class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button> 
                        </td>
                        </tr>";
                }
            }
        ?>
        </tbody>
    </table>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                //console.log("edit ", e.target.parentNode.parentNode);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                //console.log(title, description);

                titleEdit.value = title;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                //console.log(e.target.id);

                //const myModal = new bootstrap.Modal(document.getElementById('editModal'), 'toggle');
                //$('#editModal').modal('show');
            })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ",);
                sno = e.target.id.substr(1,);
                console.log(sno);

                if (confirm("Are you sure to delete this note?")) {
                    console.log("yes");
                    window.location = `/notes/index.php?delete=${sno}`;
                    // create a form and use post request to submit a form
                }
                else console.log("no");
            })
        })
    </script>
    
    <!--Prevet Resubmission from page reload-->
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

</body>

</html>