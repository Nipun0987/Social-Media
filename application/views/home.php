<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/regular.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/brands.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/rkj.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/solid.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>

    <!-- navbar start -->
    <div class="navigation">
        <div class="logo">
            <img src="<?php echo base_url() ?>assets/images/logo_1.png" class="" alt="">

        </div>
        <div class="navigation-search-container">
            <i class="fa fa-search "></i>
            <input class="search-field" type="text" placeholder="Search">
            <div class="search-container">
                <div class="search-container-box">
                    <div class="search-results">

                    </div>
                </div>
            </div>
        </div>
        <div class="navigation-icons">
            <a href="https://instagram.com/mimoudix" target="_blank" class="navigation-link">
                <i class="w-50px mx-10px far fa-compass"></i>
            </a>
            <a class="navigation-link notifica">
                <i class="w-50px mx-10px far fa-heart">
                    <div class="notification-bubble-wrapper">
                        <div class="notification-bubble">
                            <span class="notifications-count">99</span>
                        </div>
                    </div>
                </i>
            </a>
            <a href="https://instagram.com/mimoudix" class="navigation-link">
                <i class="w-50px mx-10px far fa-user-circle"></i>
            </a>
            <a href="<?php base_url() ?>auth_controller/index" id="signout" class="navigation-link">
                <i class="w-50px mx-10px fas fa-sign-out-alt"></i>
            </a>
        </div>
    </div>
    <!-- navbar end -->

    <table id="example0" class="table display">
        <thead>
            <tr>
                <td>Sr.No</td>
                <td>First Name</td>
                <td>User Name</td>
                <td>Phone Number</td>
                <!-- <td>State</td> -->
                <!-- <td>Pincode</td> -->
                <!-- <td>View Full Details</td> -->
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($users as $user) {
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $user->first_name; ?></td>
                    <td><?php echo $user->user_name; ?></td>
                    <td><?php echo $user->phone_number; ?></td>
                </tr>

            <?php } ?>
        </tbody>
    </table>





    <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.bundle.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/all.js"></script>
    <script src="<?php echo base_url() ?>assets/js/brands.js"></script>
    <script src="<?php echo base_url() ?>assets/js/fontawesome.js"></script>
    <script src="<?php echo base_url() ?>assets/js/regular.js"></script>
    <script src="<?php echo base_url() ?>assets/js/solid.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="assets/slick/slick.min.js"></script>

    <!-- <script>
    $('.confirm,.password,.username,.phone,.name').on('keyup', function() {
        if (!checker()) {
            $('.submit').prop('disabled', true);
        } else {
            $('.submit').prop('disabled', false);
        }
    });

    function checker() {
        if (!($('.username').length >= 2 && $('.username').length <= 100) ||
            !($('.phone').length = 10 ||
                !($('.name').length >= 2 && $('.name').length <= 256) ||
                !($('.password').length >=
                    8 && $('.password').length <= 20) || !($('.confirm').length >=
                    8 && $('.confirm').length <= 20) || !($('.password').val() ===
                    $('.confirm').val()))) {
            return false;
        } else {
            return true;
        }
    }
</script> -->

</body>

</html>