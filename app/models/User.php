<?php

use Phalcon\Mvc\Model;

class User extends Model
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $picture;
    public $inserted;
}
