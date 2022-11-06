<?php include 'templates/header.html.php'; ?>

<h1>Lista kategorii</h1>
<table>
    <tr>
        <td>Nazwa</td>
        <td>&nbsp;</td>
    </tr>
    <?php foreach($this->get('catsData') as $cats) { ?>
    <tr>
        <td><?php= $cats['name']; ?></td>
        <td><a href="?task=categories&amp;action=delete&amp;id=<?php= $cats['id']; ?>">usuń</a></td>
    </tr>
    <?php } ?>
</table>

<?php include 'templates/footer.html.php'; ?>