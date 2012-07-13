<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Admin Panel Sekolahku</title>
        <meta name="keywords" content="" />
        <meta name="Premium Series" content="" />

    </head>
    <body>
        <table>
            <tr>
                <td>
                    <h2>Admin Panel</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo anchor('admin/pages', 'Pages') ?> | 
                    <?php echo anchor('admin/categories', 'Categories') ?> | 
                    <?php echo anchor('admin/posts', 'Posts') ?> | 
                    <?php echo anchor('users/logout', 'Logout') ?> 
                    <hr/>
                </td>
            </tr>
            <tr>
                <td>
                    <?php if (!empty($content)): ?>
                        <?php $this->load->view($content); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <hr/>
                    Admin Panel Sekolahku
                </td>
            </tr>
        </table>
    </body>
</html>