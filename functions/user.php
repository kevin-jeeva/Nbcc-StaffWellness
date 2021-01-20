<?php
include_once 'connect.php';

class staff {
    private $staffId;
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $admin;
    private $dateCreated;
    
    function __get($name) {
        return $this->$name;
    }
    
    function __set($name, $value) {
        $this->$name = $value;
    }
    
    function __construct($userID, $firstName, $lastName, $username, $password, $address, $province, $postal, $phone, $email, $url, $description, $location, $dateCreated, $profilePic) {
        $this->userID = $userID;
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateCreated = $dateCreated;
    }