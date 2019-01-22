<?php
    $pdo = new PDO('sqlite:chinook.db');// note the formatting here for PHP data object
    $sql = "SELECT tracks.Name AS 'TrackName', albums.Title AS 'Album', artists.Name AS 'Artist', tracks.UnitPrice AS 'Price' 
        FROM tracks
        INNER JOIN genres ON tracks.GenreId = genres.GenreId
        INNER JOIN albums ON tracks.AlbumId = albums.AlbumId 
        INNER JOIN artists ON albums.ArtistId = artists.ArtistId ";
    //work for prepared statement if user inputs data in search bar
    if (isset($_GET['genre'])) {
        $sql = $sql . ' WHERE genres.Name = ? ORDER BY "TrackName" ASC';//'?' is the placeholder for the prepared statement
    } 
    else {
        $sql = $sql . ' ORDER BY "TrackName" ASC';
    }
    //Prepared statement
    $statement = $pdo->prepare($sql);//prepare for user input

    if (isset($_GET['genre'])) {
        $statement->bindParam(1, $_GET['genre']);//this will only execute if there is a search parameter.
        //could bind other parameters here if we wanted to
    }

    $statement->execute();

    $tracks = $statement->fetchAll(PDO::FETCH_OBJ);//with this argument, the arrays are convered into objects
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Chinook PDO: Tracks</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <style>
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
            <header class='text-center'><a href='index.php'><button class='btn btn-primary'>Home</button></a> Chinook Tracks: <?php echo (isset($_GET['genre']) ? $_GET['genre'] : 'All') ?></header>
            <table class='table'>
                <thead>
                    <tr>
                        <th scope='col'>Track Name</th>
                        <th scope="col">Album Title</th>
                        <th scope="col">Artist Name</th>
                        <th scope="col">Price</th>
                    </tr>
                    <?php  ?>
                </thead>
                <tbody>
                    <?php foreach ($tracks as $track): ?>
                    <tr>
                        <td><?php echo $track->TrackName;?></td>
                        <td><?php echo $track->Album; ?></td>
                        <td><?php echo $track->Artist; ?></td>
                        <td><?php echo $track->Price; ?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <script src="" async defer></script>
    </body>
</html>