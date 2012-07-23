<?php if (!empty($post)): ?>

    <div class="post">
        <h1 class="title"><?php echo $post['title'] ?></h1>
        <p class="byline"><small><?php echo $post['created']; ?></small></p>
        <div class="entry">
            <?php if (!empty($post['image'])): ?>
                <img src="<?php echo base_url() . $post['image'] ?>" width="510" height="250"/>
            <?php endif; ?>
            <?php echo $post['body'] ?><br/>

        </div>
    </div>

<?php endif; ?>