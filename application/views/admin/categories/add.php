<h3>Add Category</h3><br/>  
<?php echo validation_errors(); ?>
    <?php echo form_open_multipart('admin/categories/add'); ?>     
    Name : <br/>
    <?php echo form_input(array('name' => 'name', 'value' => set_value('name'))); ?><br/>
    Description: <br/>
    <?php echo form_textarea(array('name' => 'description', 'value' => set_value('description'))); ?>
    <br/>
     <input type="submit" value="Submit"/>
    <?php echo form_close(); ?>

<!--end #article-->
