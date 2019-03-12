<?php require APPROOT . '/views/inc/header.php';?>
<!-- <h1 class="display-3"><?php echo $data['title']; ?></h1> -->
<h1 class="display-3"><?php echo $data['header']; ?></h1>
<?php $arr = array();
$countA = 0;
$countB = 0;?>
<?php flash('info');?>
<table class="table">
  <thead>
    <tr>
    <?php foreach ($data['fields'] as $field): ?>
        <th scope="col">
        <?php if ($field != 'password' && $field != 'id' && $field != 'image_directory') {
    echo $field;
    // echo $countA;
    array_push($arr, $countA);
    $countA += 1;
} else {
    $countA += 1;
    continue;
}
?>
        </th>
    <?php endforeach?>
    <th scope="col">OPERATIONS</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['rows'] as $row): ?>
        <tr>
        <?php foreach ($row as $singleRow): ?>
            <!-- <th scope="row">1</th> -->
            <td>
                <?php if (in_array($countB, $arr)):
    echo $singleRow;
    $countB += 1;
    ?>
		                <?php else:$countB += 1;
    continue;?>
		                <?php endif;?>
            </td>
        <?php endforeach?>
        <?php $countB = 0;?>
        <td>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                        <form action="<?php echo URLROOT; ?>/updates/edit<?php echo rtrim($data["header"], 's');?>/<?php echo $row['id'];?>" method="get">
                            <input type="submit" class="btn btn-secondary" value="Edit">
                        </form>
                        <form action="<?php echo URLROOT; ?>/updates/delete<?php echo rtrim($data["header"], 's');?>/<?php echo $row['id'];?>" method="post">
                            <input type="submit" class="btn btn-secondary" value="Delete" class="btn btn-danger">
                        </form>
                          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button> -->
                        </div>
                    </div>
        </td>
        </tr>
    <?php endforeach?>
  </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php';?>
