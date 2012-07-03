<h3>List Pages</h3>
<?php echo anchor('admin/pages/add', 'Add'); ?><br/>
<?php if ($this->session->flashdata('success')): ?>
    <i><?php echo $this->session->flashdata('success'); ?><i/>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <i><?php echo $this->session->flashdata('error'); ?><i/>
        <?php endif; ?>
        <table border="1">
            <tr>
                <td>No</td>
                <td>Title</td>
                <td>Status</td>
                <td>User</td>
                <td>Action</td>
            </tr>
            <?php if (!empty($pages)): ?>
                <?php $no = 1; ?>
                <?php foreach ($pages as $page): ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $page['title']; ?></td>
                        <td><?php echo $status[$page['status']]; ?></td>
                        <td><?php echo $page['username']; ?></td>
                        <td>
                            <a href="<?php echo site_url('admin/pages/edit/' . $page['id']); ?>">Edit</a> |
                            <a href="<?php echo site_url('admin/pages/delete/' . $page['id']); ?>" onclick=" return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            <?php endif; ?>

        </table>