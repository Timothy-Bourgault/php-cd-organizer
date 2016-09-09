<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/cd_organizer.php";

    session_start();

    if (empty($_SESSION['list_of_cds'])) {
        $_SESSION['list_of_cds'] = array();
    }

    $app = new Silex\Application();

    $app->get("/", function() {

        $output = "";

        $all_cds = CD::getAll();

        if (!empty($all_cds)) {
            $output .= "
                <h1>CD Organizer</h1>
                <p>Here are all your CD's:</p>
                ";

            foreach ($all_cds as $cd) {
                $output .= "<p>" . $cd->getArtist() . "</p>";
            }
        }

        $output .= "
            <form action='/cds' method='post'>
                <label for='artist'>Artist: </label>
                <input id='artist' name='artist' type='text'>

                <button type='submit'>Add Artist</button>
            </form>
        ";

        $output .= "
            <form action='/delete_cds' method='post'>
                <button type='submit'>Clear Organizer</button>
            </form>
        ";

        return $output;
    });

    $app->post("/cds", function() {
        $cd = new CD($_POST['artist']);
        $cd->save();
        return "
            <h1>You have added a CD to your organizer!</h1>
            <p>" . $cd->getArtist() . "</p>
            <p><a href='/'>View your list of CDs!</a></p>
        ";
    });

    $app->post("/delete_cds", function() {

        CD::deleteAll();

        return "
            <h1>Organizer Cleared!</h1>
            <p><a href='/'>Home</a></p>
        ";
    });

    return $app;

?>
