<?php
$error_msg = $this->session->flashdata('error_msg');
if ($error_msg) {
    echo $error_msg;
}
?>




<center>
    <div class="bg-light border border-secondary h-auto w-25 mt-45px h_first">

        <img src="assets/images/logo_1.png" class="mt-40px" alt="">

        <div class="h_face_1">Sign up to see photos and videos from your friends.</div>
        <a href="https://www.facebook.com/login.php">
            <button type="submit" class="btn btn-primary w-290px mt-20px ">
                <i class="fa-brands fa-facebook text_primary"></i>
                <span>Log in with Facebook</span>
            </button>
        </a>


        <div class="h_line ">
            <div class="line"></div>
            <div class="">or</div>
            <div class="line"></div>
        </div>


        <?php
        echo form_open('superadmin_controller/signup_post');
        ?>

        <div class="m-4">
            <input type="phone" class="form-control" name="phone_number" placeholder="Enter Phone No." required>
        </div>

        <div class="m-4">
            <input type="name" class="form-control" name="first_name" placeholder="First Name" required>
        </div>

        <div class="m-4">
            <input type="username" class="form-control" name="email" placeholder="Enter Email" required>
        </div>

        <div class="m-4">
            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
        </div>

        <p class="p_sign"> People who use our service may have uploaded your contact information to Instagram.
            <a href="https://www.facebook.com/help/instagram/261704639352628" class="text-secondary">Learn More</a>
            <br><br>
            By signing up, you agree to our Terms , Privacy Policy and Cookies Policy
        </p>
        <button type="submit" class="btn btn-primary mb-20px w-290px">Sign Up</button>

        <?php echo form_close(); ?>


    </div>
    <div class="bg-light border border-secondary h-auto w-25 my-12px h_first">
        <div class="my-15px">
            Have an account?
            <a href="<?php echo (base_url()) ?>" <?php if ($page == 'Log In') : echo 'active';
                                                    endif; ?>>
                <button type="submit" onclick="myfun()" class="border-0 bg-transparent text-primary">Log In</button>
            </a>
        </div>
    </div>
</center>