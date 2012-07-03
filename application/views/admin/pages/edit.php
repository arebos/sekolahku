<h3>Edit Page</h3><br/>
<?php echo validation_errors(); ?>
<?php echo form_open('admin/pages/edit'); ?>

<?php echo form_hidden('id', $page['id']); ?>
Title :<br/>
<?php echo form_input(array('name' => 'title', 'value' => set_value('title', isset($page['title']) ? $page['title'] : ''))); ?><br/>
Body :<br/>
<?php echo form_textarea(array('name' => 'body', 'value' => set_value('title', isset($page['body']) ? $page['body'] : ''))); ?><br/>
Status:<br/>
<?php echo form_dropdown('status', $status, isset($page['status']) ? $page['status'] : ''); ?><br/>
<?php echo form_submit('submit', 'Save'); ?>

<?php echo form_close(); ?>