<?php
$success_msg = $this->session->flashdata('success_msg');
$error_msg = $this->session->flashdata('error_msg');

if ($success_msg) {
?>
    <div class="alert alert-success">
        <?php echo $success_msg; ?>
    </div>
<?php
}
if ($error_msg) {
?>
    <div class="alert alert-danger">
        <?php echo $error_msg; ?>
    </div>
<?php
}
?>


<center>
    <div class="bg-light border border-secondary h-auto w-25 mt-45px h_first">

        <img src="assets/images/logo_1.png" class="mt-40px" alt="">


        <?php echo form_open('auth_controller/login_post'); ?>

        <div class="m-4">
            <input type="text" name="user_name" class="form-control" placeholder="Enter Username" value="<?php echo set_value('user_name'); ?>">

        </div>
        <div class="m-4">
            <input type="password" name="password" class="form-control" placeholder="Enter Password" id="txtPassword" value="<?php echo set_value('password') ?>">

        </div>
        <button type="submit" class="btn btn-primary w-290px">Log In</button>


        <?php echo form_close(); ?>


        <div class="h_line ">
            <div class="line"></div>
            <div class="">or</div>
            <div class="line"></div>
        </div>

        <a href="https://www.facebook.com/login.php">
            <button type="submit" class="h_face">
                <i class="fa-brands fa-facebook text_primary"></i>
                <span>Log in with Facebook</span>
            </button>
        </a>

    </div>
    <div class="bg-light border border-secondary h-auto w-25 my-12px h_first">
        <div class="my-15px">
            Don't have an account?

            <a href="<?php ?>signup">
                <button type="submit" onclick="myfun()" class="border-0 bg-transparent text-primary">Sign Up</button>
            </a>
        </div>
    </div>
</center>
