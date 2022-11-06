<?php include 'templates/header.html.php'; ?>

<h1>Lista artykułów</h1>
<table>
    <tr>
        <td>Tytuł</td>
        <td>Data dodania</td>
        <td>Autor</td>
        <td>Kategoria</td>
        <td>&nbsp;</td>
    </tr>
    <?php
     foreach($this->get('articles') as $articles) { ?>

    <tr>
        <td><a href="?task=articles&amp;action=one&amp;id=<?= $articles['id']; ?>"><?= $articles['title']; ?></a></td>
        <td><?= $articles['date_add']; ?></td>
        <td><?= $articles['autor']; ?></td>
        <td><?= $articles['name']; ?></td>
        <td><a href="?task=articles&amp;action=delete&amp;id=<?= $articles['id']; ?>">usuń</a></td>
        <td><a href="?task=aplikacja&amp;action=dashboard&amp;info=siematuinfo">przekieruj zi infem</a></td>
    </tr>
    <?php } ?>
</table>

<?php include 'templates/footer.html.php'; ?>