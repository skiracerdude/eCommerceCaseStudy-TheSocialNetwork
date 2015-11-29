<?php

class _Groups extends Model
{

    private $group_id;
    private $name;
    private $privacy;
    private $description;
    private $posts;
    private $members;

    public function __construct($tempID = 0)
    {
        parent::__construct();
    }

    /**
     * Sets all the group's information so that it may be accessed by the view
     * @param $group id of group needed to intialized
     */
    public function init($group)
    {
        /**
         * get's all the information for the group (not the members)
         */
        $temp = $this->db->select('SELECT * FROM groups WHERE group_id = :to', array(
            ':to' => $group
        ))[0];

        if (!empty($temp)) {
            $this->setName($temp['name']);
            $this->setDescription($temp['description']);
            $this->setPrivacy($temp['privacy']);
            /**
             * gets the members of the group
             */
            $membersTemp = $this->db->select('SELECT CONCAT( users.first_name,  \' \', users.last_name ) AS  \'name\', users.user_id, user_status
                                            FROM groups
                                            INNER JOIN group_members ON groups.group_id = group_members.group_id
                                            INNER JOIN users ON users.user_id = group_members.user_id
                                            WHERE groups.group_id =:to', array(
                ':to' => $group
            ));

            $this->members = $membersTemp;
           /**
            * RETRIEVE ALL POSTS
            */
             $st = $this->db->select('SELECT * FROM group_post WHERE group_id = :to AND isnull(parent_id) ORDER BY creation_date DESC', array(
                ':to' => $group
            ));

            if (count($st) > 0) {
                $this->posts = $st;
            } else { //no posts on wall ;(
                echo 'Sucks to suck, ' . $this->getName();
            }
        }

    }

    /**
     * uses information from the $_GET and updates the group in the database
     */
    public function updateGroup()
    {
        $this->db->update('groups', ['privacy' => $_POST['privacy'], 'description' => $_POST['description']], 'group_id = ' . $_POST['g']);
    }

    /**
     * uses information from the $_GET and updates the member's power in the database
     */
    public function makeAdmin()
    {
        $this->db->update('group_members', ['user_status' => 'admin'], 'user_id = ' . $_POST['admin_id'] . ' AND group_id = ' . $_GET['g']);
    }

    public function removeAdmin()
    {
        $this->db->update('group_members', ['user_status' => 'normal'], 'user_id = ' . $_POST['admin_id'] . ' AND group_id = ' . $_GET['g']);
    }

    /**
     * kicks member form the group
     */
    public function kick()
    {
        $this->db->delete('group_members', 'user_id = ' . $_POST['member_id'] . ' AND group_id = ' . $_GET['g']);
    }

    public function join()
    {

        $this->db->insert('group_members', ['user_id' => $_POST['user_id'], 'group_id' => $_GET['g'], 'user_status' => 'normal']);
    }

    public function leave()
    {

        $this->db->delete('group_members', 'user_id = ' . Session::get('my_user')['id'] . ' AND group_id = ' . $_GET['g']);
    }

    public function delete()
    {

        $this->db->delete('groups', ' group_id = ' . $_GET['g']);
    }

    /**
     * @return bool
     * checks to see if the gorup name is already taken
     */
    public function validateName()
    {
        if (isset($_POST['name']) && isset($_POST['privacy']) && isset($_POST['description'])) {
            $name = $_POST['name'];
            $res = $this->db->select('SELECT group_id FROM groups WHERE name = :name',
                array(':name' => $name));
            if (count($res) === 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $name : new name for the group
     * @param $description: new description
     * @param $privacy : sets privacy
     * @param $user : sets current user as the owner of the group
     *
     */
    public function createGroup($name, $description, $privacy, $user)
    {
        $this->db->insert('groups', ['name' => $name, 'privacy' => $privacy, 'description' => $description]);
        $tdb = $this->db->select('SELECT group_id
                                    FROM groups
                                   WHERE name = :to ', array(
            ':to' => $name
        ))[0];

        $this->db->insert('group_members', ['user_id' => $user, 'group_id' => $tdb['group_id'], 'user_status' => 'owner']);
    }

    /**
     * @param $uid
     * @return mixed
     * gets group information as well as all of it's members
     */
    public function getGroups($uid)
    {
        return $this->db->select('SELECT name, groups.group_id
                                    FROM groups
                              INNER JOIN group_members
                                      ON groups.group_id=group_members.group_id
                                   WHERE user_id = :to', array(
            ':to' => $uid
        ));
    }

    //Getters
    public function getGroup_id()
    {
        return $$this->group_id;
    }

    public function getMembers()
    {
        return $this->members;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrivacy()
    {
        return $this->privacy;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    //Setters

    public function setName($newThing)
    {
        $this->name = $newThing;
    }

    public function setPrivacy($newThing)
    {
        $this->privacy = $newThing;
    }

    public function setDescription($newThing)
    {
        $this->description = $newThing;
    }
}
