<?php
class Account {

    private $con;
    private $errorArray = array();

    public function __construct($con) {
        $this->con = $con;
    }

    public function login($em, $pw)
    {

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em AND password=:pw");

        $query->bindValue(":em", $em);
        $query->bindValue(":pw", $pw);

        $query->execute();

        if ($query->rowCount() == 1) {
            return true;
        }
        array_push($this->errorArray, Constants::$loginFailed);
        return false;
    }

    public function getError($error) {
        if(in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }

    public function addAlbum($album_name, $album_disc,$image_name)
    {

        $query = $this->con->prepare("INSERT INTO album_table (album_name,album_discription,image) 
                                            VALUES(:albumNm, :albumDisc, :imageNm)");

        $query->bindValue(":albumNm",$album_name);
        $query->bindValue(":albumDisc",$album_disc);
        $query->bindValue(":imageNm", $image_name);

        return $query->execute();

    }
    public function showAlbum()
    {

        $query = $this->con->prepare("SELECT * FROM album_table");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        return $row;

    }
    public function publish($id)
    {

        $query = $this->con->prepare("UPDATE album_table SET publish=1 WHERE id=:id");

        $query->bindValue(":id",$id);

        return $query->execute();

    }
    public function unpublish($id)
    {

        $query = $this->con->prepare("UPDATE album_table SET publish=0 WHERE id=:id");

        $query->bindValue(":id",$id);

        return $query->execute();

    }
    public function premium($id)
    {

        $query = $this->con->prepare("UPDATE album_table SET premium=1 WHERE id=:id");

        $query->bindValue(":id",$id);

        return $query->execute();

    }

    public function addGallery($a_id,$image_name)
    {

        $query = $this->con->prepare("INSERT INTO gallery_table (a_id,g_image) 
                                            VALUES(:album_id, :imageNm)");

        $query->bindValue(":album_id",$a_id);
        $query->bindValue(":imageNm", $image_name);

        return $query->execute();

    }

    public function gallery($id)
    {

        $query = $this->con->prepare("SELECT * FROM gallery_table WHERE a_id=:id");
        $query->bindValue(":id",$id);
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        return $row;

    }
    public function showNaiveAlbum()
    {

        $query = $this->con->prepare("SELECT * FROM album_table where publish=1 and premium=0");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        if($row){
            return $row;   
        }else{
            echo "something wrong went";
        }
        
    }

    public function premiumPage()
    {

        $query = $this->con->prepare("SELECT * FROM album_table WHERE publish=1");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }


}
?>