<?php require APPROOT . '/views/inc/header.php';?>
<!-- <h1 class="display-3"><?php echo $data['title']; ?></h1> -->
<h1 class="display-3"><?php echo $data['header']; ?></h1>
<?php $arr = array();
$countA = 0;
$countB = 0;?>
<table class="table">
  <thead>
    <tr>
    <?php foreach ($data['fields'] as $field): ?>
        <th scope="col">
        <?php if ($field != 'password' && $field != 'Id' && $field != 'image_directory') {
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
        </tr>
    <?php endforeach?>
  </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php';?>

