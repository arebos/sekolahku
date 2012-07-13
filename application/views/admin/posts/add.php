<?php
echo initialize_tinymce();
?>
<h3>Add Post</h3><br/>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('admin/posts/add'); ?>
Title :<br/>
<?php echo form_input(array('name' => 'title', 'value' => set_value('title', isset($page['title']) ? $page['title'] : ''))); ?><br/>
Body :<br/>
<?php echo form_textarea(array('name' => 'body', 'value' => set_value('title', isset($page['body']) ? $page['body'] : ''))); ?><br/>
Category:<br/>
<?php echo form_dropdown('categories_id',$categories);?><br/>
Image : <br/>
<?php echo form_upload('image');?><br/>
Status:<br/>
<?php echo form_dropdown('status', $status, isset($page['status']) ? $page['status'] : ''); ?><br/>
<?php echo form_submit('submit', 'Save'); ?>

<?php echo form_close(); ?>