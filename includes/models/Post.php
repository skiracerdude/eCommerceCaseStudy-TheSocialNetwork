<?php

/**
 * Class _Post
 *
 * This is the model used for anything post related and supports normal & group posts.
 * Also contains both comment (array of posts) and responses (array of like/unlikes)
 */
class _Post extends Model
{
    private $post_id;
    private $post_by;
    private $post_by_name;
    private $post_by_img;
    private $post_to_name;
    private $post_to;
    private $post_text;
    private $post_image;
    private $group_id;
    private $g_ = ''; //group prefix
    private $date;
    private $comments;
    private $responses;

    public function __construct($temp = null)
    {
        parent::__construct();
        //check if group cos fuck having 2 quasi-identical models
        if (isset($_GET['g']) || isset($_POST['is_group']) || (is_array($temp) && isset($temp['group_id']))) {
            $this->g_ = 'group_';
        }

        if (is_array($temp) && (array_key_exists($this->g_.'post_id', $temp) || array_key_exists('post_id', $temp))) { //less querying the server (used by user)
            $this->setAll($temp);
        } elseif (is_array($temp)) {  //if array and no damn id then its prob a new post
            $this->db->insert($this->g_.'post', [
                'post_by' => $temp['from'],
                'post_to' => $temp['to'],
                'text' => $temp['text'],
                'image_attachment' => $temp['image'],
                'parent_id' => $temp['parent']
            ] + (isset($_GET['g']) ? ['group_id' => $temp['group']] : [])); //Hacky solution to adding group key
        } elseif (isset($temp)) { //it's an id and you should fetch me the post

            $sql = 'SELECT * FROM '. $this->g_. 'post WHERE '. $this->g_. 'post_id = :id';
            $st = $this->db->select($sql, array(
                ':id' => $temp));
            if (count($st) > 0)
                $this->setAll($st[0]);
        }
        //header('Location: ../timeline');
    }

    /**
     * initializes parameters based on an array
     * @param $array contains all post information
     */
    private function setAll($array)
    {
        //grabbing id regardless of it being group post or otherwise.
        if (array_key_exists('post_id',$array))
            $this->post_id = $array['post_id'];
        else
            $this->post_id = $array[$this->g_.'post_id'];

        //WILL BE USED FOR USER WALL LINKS
        $this->post_by = $array['post_by'];
        $this->post_to = $array['post_to'];

        //GRABS ACTUAL NAMES FROM DB
        $this->post_by_name = $this->db->select('SELECT CONCAT(first_name,\' \', last_name) AS \'name\' FROM users WHERE user_id = :id', array(
            ':id' => $array['post_by']
        ))[0]['name'];


        //Grab relevent name ie either the receiving user's name or the group.
        if (isset($_GET['g']) || isset($array['group_id'])) {
            $this->group_id = $array['group_id'];
            $this->post_to_name = $this->db->select('SELECT name AS \'name\' FROM groups WHERE group_id = :id', array(
                ':id' => $array['group_id']
            ))[0]['name'];
        } else {
            $this->post_to_name = $this->db->select('SELECT CONCAT(first_name,\' \', last_name) AS \'name\' FROM users WHERE user_id = :id', array(
                ':id' => $array['post_to']
            ))[0]['name'];
        }
        //FINISH SETTING THE REST
        $this->post_text = $array['text'];
        $this->post_image = $array['image_attachment'];
        $this->date = $array['creation_date'];
        $this->setComments();
        $this->setResponses();
        $this->post_by_img = $this->db->select('SELECT profile_picture FROM users WHERE user_id = :id', array(
            ':id' => $array['post_by']
        ))[0]['profile_picture'];
    }

    /**
     * Grabs all comments pertaining to this post
     */
    public function setComments()
    {
        $st = $this->db->select('SELECT * FROM '.$this->g_.'post WHERE parent_id = :id', array(
            ':id' => $this->post_id));
        if (count($st) > 0) {

            foreach ($st as $post) {
                if (isset($this->group_id))
                    $_POST['is_group'] = 1;
                $this->comments[] = new self($post[$this->g_.'post_id']);
                unset($_POST['is_group']);
            }
        }
    }

    /**
     * Grabs all responses pertaining to this post
     * currently like/unlike
     */
    public function setResponses()
    {   require_once PATH . 'models/Response.php'; //because autoload magic method doesn't load up models.

        $st = $this->db->select('SELECT user_id,'.$this->g_.'post_id as \'post_id\',response FROM '.$this->g_.'post_likes WHERE '.$this->g_.'post_id = :id', array(
            ':id' => $this->post_id));
        if (count($st) > 0) {
            foreach ($st as $response) { //get the type text from response_type table
                $response['response'] = $this->db->select('SELECT description FROM response_type WHERE response_id = :id', array(
                    ':id' => $response['response']))[0]['description'];
                $this->responses[] = new _Response($response);
            }
        }
    }

    /**
     * Deletes the current post from db
     */
    public function deletePost()
    {
        (isset($_POST['is_group']) ? $g_ = 'group_' : $g_ = '');
        $this->db->delete($g_ . 'post', $g_ . 'post_id = ' . $_POST['postID']);
    }


    //GETTERS
    public function getPostID()
    {
        return $this->post_id;
    }

    public function getPostBy()
    {
        return $this->post_by;
    }

    public function getPostTo()
    {
        return $this->post_to;
    }

    public function getGroup()
    {
        return $this->group_id;
    }

    public function getPostByName()
    {
        return $this->post_by_name;
    }

    public function getPostToName()
    {
        return $this->post_to_name;
    }

    public function getPostByImg()
    {
        return $this->post_by_img;
    }

    public function getPostText()
    {
        return $this->post_text;
    }

    public function setPostText($newThing)
    {
        $this->post_text = $newThing;
    }

    public function getPostImage()
    {
        return $this->post_image;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * Get a count for a particular response
     *
     * @param $type string response type
     * @return int counter
     */
    public function getCount($type)
    {
        /**
         * @var _Response $response
         */
        $count = 0;
        if(is_array($this->responses))
            foreach ($this->responses as $response) {
                if (strcmp($response->getType(), $type) === 0) {
                    $count++;
                }
            }
        return $count;
    }

    /**
     * @return bool did I already respond to this post or nah
     * @param $type string response type
     */
    public function isILike($type)
    {
        /**
         * @var _Response $response
         */
        if(is_array($this->responses))
            foreach ($this->responses as $response) {
                if (strcmp($response->getUid(), Session::get('my_user')['id']) === 0 &&
                    strcmp($response->getType(), $type) === 0
                ) {
                    return true;
                }
            }
        return false;
    }

    public function setImage($newThing)
    {
        $this->post_image = $newThing;
    }
}
