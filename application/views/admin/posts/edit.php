<h3>Edit Page</h3><br/>
<?php echo initialize_tinymce(); ?>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('admin/posts/edit'); ?>

<?php echo form_hidden('id', $post['id']); ?>
Title :<br/>
<?php echo form_input(array('name' => 'title', 'value' => set_value('title', isset($post['title']) ? $post['title'] : ''))); ?><br/>
Body :<br/>
<?php echo form_textarea(array('name' => 'body', 'value' => set_value('title', isset($post['body']) ? $post['body'] : ''))); ?><br/>
Category:<br/>
<?php echo form_dropdown('categories_id', $categories,$post['categories_id']); ?><br/>
Current Image : <br/>
<img src="<?php echo base_url().$post['image'];?>" width="150" height="150"/><br/>
Image : <br/>
<?php echo form_upload('image'); ?><br/>
Status:<br/>
<?php echo form_dropdown('status', $status, isset($post['status']) ? $post['status'] : ''); ?><br/>
<?php echo form_submit('submit', 'Save'); ?>

<?php echo form_close(); ?>