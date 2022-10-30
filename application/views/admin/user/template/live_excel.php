
<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Sr.</th>
        <th>Username</th>
        <th>Name</th>
        <th>Channel</th>
        <th>Status</th>
        <th>Date/Time</th>
        <th>Live Time</th>

    </tr>
    </thead>
    <tbody>
    <?php $i = 1; foreach($details as $data){ ?>
        <tr>
            <td><?= $i;?></td>
            <td><?php  echo $data['name'];?></td>
            <td><?php  echo $data['username'];?></td>
            <td><?php  echo $data['channelName'];?></td>
            <td><?php if($data['status'] == 'live'){?><span class="label label-success">Live</span> <?php } else{?><span class="label label-warning">Archived</span> <?php } ?></td>
            <td><?php  echo $data['created'];?></td>
            <td>
                <?php
                if(!empty($data['archivedDate']) || $data['archivedDate'] != ''){
                    $date1 = new DateTime($data['created']);
                    $date2 = $date1->diff(new DateTime($data['archivedDate']));
                    $dayHour =  $date2->d * 60;
                    $totalHour = $date2->h * 60;
                    echo $finalMin = $date2->i + $totalHour + $dayHour;

                    // echo $date2->h.' hours'."\n";
                    // echo $date2->i.' minutes'."\n";
                    // echo $date2->s.' seconds'."\n";

                }
                else{
                    echo "00";
                }
                ?>
            </td>

        </tr>
        <?php $i++; } ?>
    <?php
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=live_users.xls');
    ?>
    </tbody>
</table>
