<?php
    $pdo = new PDO('sqlite:chinook.db');// note the formatting here for PHP data object
    $sql = "SELECT * FROM genres;";
    
    //Prepared statement
    $statement = $pdo->prepare($sql);//prepare for user input

    $statement->execute();

    $genres = $statement->fetchAll(PDO::FETCH_OBJ);//with this argument, the arrays are convered into objects

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Chinook PDO: Home</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <style>
            td {
                text-align: center;
            }
            th {
                text-align: right;
            }
            #genre {
                text-align: center;
            }
            header {
                font-size: 20pt;
                font-weight: bolder;
                margin-bottom: 20px;
            }

        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class='outercontainer'>
            <header class='text-center'>Chinook Genre Explorer!</header>
            <table class='table'>
                <thead>
                    <tr>
                        <th scope='col' id='id'>ID</th>
                        <th scope="col" id='genre'>Genre</th>
                    </tr>
                    <?php  ?>
                </thead>
                <tbody>
                    <?php foreach ($genres as $genre): ?>
                    <tr>
                        <th scope='row'><?php echo $genre->GenreId; ?></th>
                        <td><a href='tracks.php?genre=<?php echo urlencode($genre->Name);?>'><?php echo $genre->Name; ?></a></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <script src="" async defer></script>
    </body>
</html>