<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <div class="row" style="margin-top: 40px">
            <div class="col-md-4 col-md-offset-4">
                <h4>DashBoard</h4><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                         <th>Name</th>
                         <th>Email</th>
                         <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= ucfirst($userInfo['name']);?></td>
                            <td><?= $userInfo['email'];?></td>
                            <td><a href="<?= site_url('auth/logout');?>">LogOut</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>