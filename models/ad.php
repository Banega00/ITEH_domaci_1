<?php
class Ad
{
    public function __construct($title, $brand, $model, $year, $price, $contact, $horsePower, $motor, $fuel, $additional, $ownerId)
    {
        $this->title = $title;
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->price = $price;
        $this->contact = $contact;
        $this->horsePower = $horsePower;
        $this->motor = $motor;
        $this->fuel = $fuel;
        $this->additional = $additional;
        $this->ownerId = $ownerId;
    }

    public static function getAds($conn)
    {
        $sql = "SELECT A.title, A.brand, A.model, A.year, A.price, A.contact, A.horsePower, A.motor, A.fuel, A.additional, A.ownerId 
        FROM ADVERTISEMENT A JOIN USER U ON U.id = A.ownerId";

        $result = $conn->query($sql);
        $array = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $array[] = $row;
            }
            return $array;
        }
    }

    public function insert($conn)
    {
        $sql = "INSERT INTO advertisement 
        VALUES (NULL, '$this->title', '$this->brand', '$this->model', '$this->year',
        '$this->price','$this->contact','$this->horsePower','$this->motor','$this->fuel',
        '$this->additional','$this->ownerId')";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return $conn->error;
        }
    }
}
