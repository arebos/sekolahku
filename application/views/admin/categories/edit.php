<h3>Edit Category</h3><br/>
<?php echo validation_errors();?><br/>
<?php echo form_open_multipart('admin/categories/edit'); ?>     
        <?php echo form_hidden('id', $category['id']) ?>
        Name : <br/>
        <?php echo form_input(array('name' => 'name', 'value' => set_value('name', isset($category['name']) ? $category['name'] : ''))); ?><br/>
        Description : <br/>                                     
        <?php echo form_textarea(array('name' => 'description', 'value' => set_value('description', isset($category['description']) ? $category['description'] : ''))); ?><br/>
                                      
        <input type="submit" value="Submit"/>
 <?php echo form_close(); ?>
                     