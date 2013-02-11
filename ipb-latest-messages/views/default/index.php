<?php $posts = $this->getMessages();?>
<div id="rightcol_forum">
    
    <?php if ($this->showTitle()):?>
        <div id="rightcol_forum_header"><a href="<?php echo $this->getForumUrl()?>" target="_blank"><?php echo $this->getTitle()?></a></div>
    <?php endif;?>
    
    <div id="rightcol_forum_body">
        <?php if (count($posts)):?>
            <ul class="forumLinks">
                <?php foreach ($posts as $post):?>
                    <li><a href="<?php echo $post->getFullUrl();?>"><?php echo $post->getTitle();?></a></li>
                <?php endforeach;?>
            </ul>
        <?php else:?>
            <?php echo $this->getNotFound()?>
        <?php endif;?>
        
    </div>
</div>