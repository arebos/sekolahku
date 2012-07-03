<h2>Login User</h2>
<hr/>
<?php if ($this->session->flashdata('success')): ?>
    <?php echo $this->session->flashdata('success'); ?>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <?php echo $this->session->flashdata('error'); ?>
<?php endif; ?>
<?php echo validation_errors(); ?>
<?php echo form_open('users/login') ?>
<br/>
Username : <?php echo form_input('username') ?><br/>
Password : <?php echo form_password('password'); ?><br/>
<?php echo form_submit('submit', 'Login') ?>
<?php echo form_close(); ?>