<?php require_once 'process.php';?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <title>CRUD Php</title>
    </head>
    <body>
    
    <?php if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissible fade show" role="alert">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <?php 
    
        $mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * from data") or die(mysqli_error($mysqli));
    ?>

    

    <?php
        function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-5">
                <form action="process.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <legend>Enter your data</legend>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter your name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" name="location" value="<?php echo $location; ?>"  placeholder="Enter your location" class="form-control">
                    </div>
                    <div class="form-group">
                        <?php if($update == true): ?>
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                        <?php else: ?>
                            <button type="submit" name="save" class="btn btn-primary">Submit</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            <div class="col-lg-7">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                        while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['location'] ?></td>
                                <td>
                                    <a href="index.php?edit=<?php echo $row['id'] ?>" class="btn btn-info">Edit</a>
                                    <a href="process.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.btn-danger').click(function(){
            $('.alert').fadeOut();
        });
    </script>
    </body>
</html>