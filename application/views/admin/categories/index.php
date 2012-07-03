<h3>Categories</h3>
<?php echo anchor('admin/categories/add', 'Add'); ?><br/>

<?php if ($this->session->flashdata('success')): ?>
   
       <?php echo $this->session->flashdata('success'); ?>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    
        <?php echo $this->session->flashdata('error'); ?>
<?php endif; ?>
    
    <table cellpadding="0" cellspacing="0" border="1">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php if ($categories): ?>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?php echo $category['name']; ?></td>
                    <td><?php echo $category['description']; ?></td>
                    <td>
                        <a href="<?php echo site_url('admin/categories/edit/' . $category['id']) ?>">Edit</a> |
                        <a href="<?php echo site_url('admin/categories/delete/' . $category['id']) ?>" onclick="return confirm('Anda yakin akan menghapus ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

