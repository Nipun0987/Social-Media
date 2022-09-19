<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <table class="table table-bordered table-striped">


                    <tr>
                        <th colspan="2">
                            <h4 class="text-center">Users Details</h3>
                        </th>

                    </tr>

                    <tr>
                        <td>Name</td>
                        <td><?php echo $val['first_name'];  ?></td>
                    </tr>
                    <tr>
                        <td>User Email</td>
                        <td><?php echo $val['email'];  ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td><?php echo  $val['phone_number'];  ?></td>
                    </tr>

                    <tr>
                        <td style="padding-top: 20px;"> </td>
                    </tr>

                </table>


            </div>
        </div>
        <!-- <a href="<?php echo base_url('user/user_logout'); ?>"> <button type="button" class="btn-primary">Logout</button></a> -->
    </div>
</body>

</html>