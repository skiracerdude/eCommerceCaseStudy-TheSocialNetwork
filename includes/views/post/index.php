<div class="panel panel-default " xmlns="http://www.w3.org/1999/html">
    <div class="panel-heading">
        <?php   /** @var _Post post */ //Evan's thing for deleting posts... Pretty scary looking eh?
        if ((strcmp($_GET['url'], 'public/timeline') !== 0)&& ((isset($sessionUser) && $sessionUser !== 3) || (strcmp(Session::get('my_user')['id'], $this->post->getPostBy()) === 0) || (isset($_GET['u']) && (strcmp(Session::get('my_user')['id'], $_GET['u']) === 0)))) {
            echo '<form  action="' . URL . 'post/deletePost" method="post" style="display:inline; float:right">
                                                    <button class="close" type="submit" name="postID" value="' . $this->post->getPostID() . '"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            if (isset($_GET['g'])) {
                echo '<input type="hidden" value=1 name="is_group"/>';
            }

            echo '<input type="hidden" name="origin" value="' . (isset($_GET['u']) ? 'wall?u=' . $_GET['u'] : //Convoluted origin identification
                    (isset($_GET['g']) ? ltrim($_GET['url'], 'public') . '?g=' . $_GET['g'] : ltrim($_GET['url'], 'public/'))) . '"/>';
            echo '</form>';
        } ?>
        <a href="#" data-toggle="modal" data-target="#lightbox">
            <img class="media-object thumbnail" src="<?= URL . $this->post->getPostByImg() ?>" alt="..."
                 style="float: left;display: inline-block; height: 4em; margin: 0 8px 0 0;">
        </a> <!--Get them to / from names -->
        <b><a href="<?= URL . 'wall?u=' . $this->post->getPostBy(); ?>"><?= $this->post->getPostByName(); ?> </a></b>
        <?php if (!isset($_GET['u']) && !isset($_GET['g']) && $this->post->getPostBy() !== $this->post->getPostTo()) { ?>
            <i class="fa fa-chevron-right"></i>
            <b><a href="<?= URL . ($this->post->getPostTo() !== null ? ('wall?u=' . $this->post->getPostTo()) : ('groups/group?g=' . $this->post->getGroup())); ?>"><?= $this->post->getPostToName(); ?> </a></b>
        <?php } ?>
        <br/>
        <strong><i><?= $this->post->getDate() ?></i></strong>

    </div>
    <div class="media"><!-- The actual msg/picture -->
        <div class="media-body media-right">
            <p><?= $this->post->getPostText() ?></p>
            <?php $img = $this->post->getPostImage();
            if (isset($img))
                echo '<a href="#" data-toggle="modal" data-target="#lightbox">' .
                    '<img class="media-object thumbnail" src= ' . URL . $img . ' alt="..." style="display: inline; height: 15em;"></a>'; ?>
        </div>
    </div>

    <div class="panel-footer">
        <div class="container-fluid">
            <div class="row">
                <?php //LOADS ALL COMMENTS (is carbon copy from above. sry, its the only way to have 1lvl comments)
                if ($this->post->getComments() !== null) { /** @var _Post $comment */
                foreach ($this->post->getComments() as $comment) { ?>
                <div class="panel panel-collapse">
                    <div class="media" style="padding: 0.4em; margin: 0;">
                        <div class="media-left">
                            <a href="#" data-toggle="modal" data-target="#lightbox">
                                <img class="media-object thumbnail" src="<?= URL . $comment->getPostByImg() ?>"
                                     alt="..." style="display: inline-block; height: 3.5em; margin: 0">
                            </a>
                        </div>
                        <div class="media-body">
                            <?php if ((strcmp($_GET['url'], 'public/timeline') !== 0)&& ((isset($sessionUser) && $sessionUser !== 3) || (strcmp(Session::get('my_user')['id'], $comment->getPostBy()) === 0) || (isset($_GET['u']) && (strcmp(Session::get('my_user')['id'], $_GET['u']) === 0)))) {
                                echo '<form  action="' . URL . 'post/deletePost" method="post" style="display:inline; float:right">
                                                    <button class="close" type="submit" name="postID" value="' . $comment->getPostID() . '"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                                if (isset($_GET['g'])) {
                                    echo '<input type="hidden" value=1 name="is_group"/>';
                                }
                                echo '<input type="hidden" name="origin" value="' . (isset($_GET['u']) ? 'wall?u=' . $_GET['u'] : //Convoluted origin identification
                                        (isset($_GET['g']) ? ltrim($_GET['url'], 'public') . '?g=' . $_GET['g'] : ltrim($_GET['url'], 'public/'))) . '"/>';
                                echo '</form>';
                            } ?>
                            <p>
                                <b><a href="<?= URL . 'wall?u=' . $comment->getPostBy(); ?>"><?= $comment->getPostByName(); ?></a></b>
                                <?= $comment->getPostText() ?>
                            </p>
                            <?php $img = $comment->getPostImage();
                            if (isset($img))
                                echo '<a href="#" data-toggle="modal" data-target="#lightbox">' .
                                    '<img class="media-object thumbnail" src= ' . URL . $img . ' alt="..." style="display: inline; height: 12em;"></a>';
                            ?>
                        </div>
                        <div class="media-bottom">
                            <strong><i><?= $comment->getDate() ?></i></strong>

                            <div class="input-group-btn" aria-hidden="true" style="float: right; display: inline-table;">
                                <button type="submit" class="btn btn-default" aria-haspopup="true" aria-expanded="false"
                                        onclick="getR('like',<?=$comment->getPostID()?><?=$comment->getGroup()!==null ? ",1": ''?>)">
                                    <i id="like<?= $comment->getPostID() ?>"
                                       class="fa fa-thumbs-up <?=$comment->isILike('like')?'rep':''?>"> <?= $comment->getCount('like') ?></i>
                                </button>
                                <button type="submit" class="btn btn-default" aria-haspopup="true" aria-expanded="false"
                                        onclick="getR('dislike',<?=$comment->getPostID()?><?=$comment->getGroup()!==null ? ",1": ''?>)">
                                    <i id="dislike<?= $comment->getPostID() ?>"
                                       class="fa fa-thumbs-down <?=$comment->isILike('dislike')?'rep':''?>"> <?= $comment->getCount('dislike') ?></i>
                                </button>
                                <input type="hidden" name="origin"
                                       value="<?= (isset($_GET['u']) ? 'wall?u=' . $_GET['u'] : //Convoluted origin identification
                                           (isset($_GET['g']) ? ltrim($_GET['url'], 'public') . '?g=' . $_GET['g'] : ltrim($_GET['url'], 'public/'))); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                } ?>
                <div class="form-group"> <!-- REPLY TO A POST -->
                    <form action="<?= URL ?>post/doPost?u=<?= $this->post->getPostBy() . '&' . ($this->post->getGroup() !== null ? 'g=' . $this->post->getGroup() . '&' : '')
                        ?>reply=<?= $this->post->getPostID() ?>"
                        method="post" style=" display:inline;" enctype="multipart/form-data">
                        <textarea class="form-control" name="post" rows="2" required
                              placeholder="<?= ($this->post->getComments() !== null ? 'Reply to this post?' : 'Be the first to comment on this post!'); ?>"
                              style=" background-color: white"></textarea>


                        <div class="input-group-btn" aria-hidden="true"
                             style="float: right; display: inline-table;">
                            <button type="submit" class="btn btn-default" aria-haspopup="true"
                                    aria-expanded="false">
                                Reply
                            </button>
                            <div class="fileUpload btn btn-default" style="margin:0;">
                                <span><i class="fa fa-camera" aria-hidden="true"></i></span>
                                <input type="file" name="picture" class="upload" accept="image/*"/>
                                <input type="hidden" name="origin"
                                       value="<?= (isset($_GET['u']) ? 'wall?u=' . $_GET['u'] : //Convoluted origin identification
                                           (isset($_GET['g']) ? ltrim($_GET['url'], 'public') . '?g=' . $_GET['g'] : ltrim($_GET['url'], 'public/'))); ?>"/>
                            </div>
                        </div>
                    </form>
                    <div class="input-group-btn" align="left" aria-hidden="true">
                        <button type="submit" class="btn btn-default" aria-haspopup="true" aria-expanded="false"
                                onclick="getR('like',<?=$this->post->getPostID()?><?=$this->post->getGroup()!==null ? ",1": ''?>)">
                            <i id="like<?=$this->post->getPostID()?>"
                               class="fa fa-thumbs-up <?=$this->post->isILike('like')?'rep':''?>"> <?=$this->post->getCount('like')?></i>
                        </button>
                        <button type="submit" class="btn btn-default" aria-haspopup="true" aria-expanded="false"
                                onclick="getR('dislike',<?=$this->post->getPostID()?><?=$this->post->getGroup()!==null ? ",1": ''?>)">
                            <i id="dislike<?=$this->post->getPostID()?>"
                               class="fa fa-thumbs-down <?=$this->post->isILike('dislike')?'rep':''?>"> <?=$this->post->getCount('dislike')?></i>
                        </button>
                        <input type="hidden" name="origin"
                               value="<?= (isset($_GET['u']) ? 'wall?u=' . $_GET['u'] : //Convoluted origin identification
                                   (isset($_GET['g']) ? ltrim($_GET['url'], 'public') . '?g=' . $_GET['g'] : ltrim($_GET['url'], 'public/'))); ?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>