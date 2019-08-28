<?php
if (!$resultset) {
    return;
}
?>

<table>
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Published</th>
        <th>Deleted</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><a href="page/<?= $row->id ?>"><?= $row->title ?></a></td>
        <td><?= $row->type ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->deleted ?></td>
    </tr>
<?php endforeach; ?>
</table>
