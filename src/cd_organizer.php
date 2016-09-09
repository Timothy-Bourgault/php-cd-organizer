<?php
class CD
{
//Properties

    public $artist;

//Constructor

function __construct($artist)
{
    $this->artist = $artist;
}


//Getter and Setter Methods

function setArtist($new_artist)
{
    $this->artist = (string) $new_artist;
}

function getArtist()
{
    return $this->artist;
}

//General Methods

    function save()
    {
        array_push($_SESSION['list_of_cds'], $this);
    }

//Static Methods

    static function getAll()
    {
        return $_SESSION['list_of_cds'];
    }

    static function deleteAll()
    {
        return $_SESSION['list_of_cds'] = array();
    }
}
?>
