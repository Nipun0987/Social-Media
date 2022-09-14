<center>
    <div class="bg-light border border-secondary h-400px w-25 mt-45px h_first">

        <img src="assets/images/logo_1.png" class="mt-40px" alt="">

        <form>
            <div class="m-4">
                <!-- <label for="exampleInputEmail1" class="form-label">Email address</label> -->
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="m-4">
                <!-- <label for="exampleInputPassword1" class="form-label">Password</label> -->
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <!-- <div class="m-4 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <button type="submit" class="btn btn-primary w-290px">Log In</button>
        </form>

        <div class="h_line ">
            <div class="line"></div>
            <div class="">or</div>
            <div class="line"></div>
        </div>

        <a href="https://www.facebook.com/login.php" class="border-0">
            <button type="submit" class="h_face">
                <i class="fa-brands fa-facebook text_primary"></i>
                <span>Log in with Facebook</span>
            </button>
        </a>

    </div>
    <div class="bg-light border border-secondary h-50px w-25 mt-12px h_first">
        <div class="my-11px">
            Don't have an account?

            <a href="<?php ?>signup" <?php if ($page == 'Signup') : echo 'active';
                                        endif; ?>>
                <button type="submit" onclick="myfun()" class="border-0 bg-transparent text-primary">Sign Up</button>
            </a>
        </div>
    </div>

    <div class="container mt-20px">
        <h>Get The App.</h>
        <div class="mt-10px">
            <a href="https://apps.apple.com/in/app/instagram/id389801252">
                <img src="assets/images/app_store.png" class="w-12" alt="">
            </a>
            <a href="https://play.google.com/store/search?q=instagram&c=apps">
                <img src="assets/images/play_store.png" class="w-12" alt="">
            </a>
        </div>
    </div>
</center>