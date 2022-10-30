<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Sr.</th>
        <th>Username</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Account Number</th>
        <th>IFSC Code</th>
        <th>Agency Code</th>
    </tr>
    </thead>
    <tbody id = "ts">
    <?php $i = 1; foreach($details as $data){ ?>
        <tr>
            <td><?= $i;?></td>
            <td><?php  echo $data['username'];?></td>
            <td><?php  echo $data['name'];?></td>
            <td><?php  echo $data['email'];?></td>
            <td><?php  echo $data['contactNumber'];?></td>
            <td><?php  echo $data['accountNumber'];?></td>
            <td><?php  echo $data['ifsc'];?></td>
            <td><?php  echo $data['agencyCode'];?></td>
        </tr>
        <?php $i++; } ?>
    <?php
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=download.xls');
    ?>
    </tbody>
</table>

</body>
</html>
