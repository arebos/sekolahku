<h3>List Posts</h3>
<?php echo anchor('admin/posts/add', 'Add'); ?><br/>
<?php if ($this->session->flashdata('success')): ?>
    <i><?php echo $this->session->flashdata('success'); ?><i/>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <i><?php echo $this->session->flashdata('error'); ?><i/>
        <?php endif; ?>
        <table border="1">
            <tr>
                <td>No</td>
                <td>Image</td>
                <td>Title</td>
                <td>Category</td>
                <td>Status</td>
                <td>User</td>
                <td>Action</td>
            </tr>
            <?php if (!empty($posts)): ?>
                <?php $no = 1; ?>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><img src="<?php echo base_url().$post['image']; ?>" width="100" height="100"/></td>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo $post['name']; ?></td>
                        <td><?php echo $status[$post['status']]; ?></td>
                        <td><?php echo $post['username']; ?></td>
                        <td>
                            <a href="<?php echo site_url('admin/posts/edit/' . $post['id']); ?>">Edit</a> |
                            <a href="<?php echo site_url('admin/posts/delete/' . $post['id']); ?>" onclick=" return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            <?php endif; ?>

        </table>