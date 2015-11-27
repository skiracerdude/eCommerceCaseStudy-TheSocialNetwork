<?php

/**
 * @property _User wallUser
 */
class _Wall extends Model
{
    /**
     * @var _User user
     */
    private $user;
    private $posts;
    private $friends;
    private $name;

    public function __construct()
    {
        parent::__construct();
    }

    public function init($new_user)
    {
        //GET USER INFORMATION TODO@FuckThis About user tab and short info block like FB
        $this->setUser($new_user);
        $this->setName($this->user->getName());
    }

    //Getters

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    //Setters


    public function getUFriends()
    {
        return $this->friends;
    }

    public function setFriends($user)
    {
        /*
        Get friends from database
        */
    }

    public function getPosts($offset = 0, $quantity = 4)
    {
        //RETRIEVE ALL POSTS IDS
        $st = $this->db->select('SELECT * FROM post WHERE post_to = :id AND isnull(parent_id) ORDER BY creation_date DESC LIMIT ' .
            $offset . ',' . $quantity, [':id' => $this->user->getID()]);
        if (count($st) > 0)
            $this->posts = $st;
        return $this->posts;
    }
}