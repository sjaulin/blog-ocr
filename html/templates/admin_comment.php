<?= $this->session->show('alert'); ?>
<h2>Administration des Commentaires</h2>

<h3>Commentaires à valider</h3>
<table class="table">
    <tr>
        <td>Id</td>
        <td>Article</td>
        <td>Pseudo</td>
        <td>Message</td>
        <td>Date</td>
        <td>Actions</td>
    </tr>
    <?php
    foreach ($unpubliedcomments as $comment) {
        ?>
        <tr>
            <td><?= $comment->getId();?></td>
            <td>
                <a href="index.php?route=article&articleId=<?= $comment->getArticleId();?>">
                <?= $comment->getArticleId();?></a>
            </td>
            <td><?= $comment->getPseudo();?></td>
            <td><?= substr($comment->getContent(), 0, 150);?></td>
            <td>Créé le : <?= $comment->getCreatedDate();?></td>
            <td>
                <a href="index.php?route=publishComment&commentId=<?= $comment->getId(); ?>&token=<?= $token; ?>">Publier le commentaire</a>
                <a href="index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>&token=<?= $token; ?>">Supprimer le commentaire</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<h3>Commentaires signalés</h3>
<table class="table">
    <tr>
        <td>Id</td>
        <td>Pseudo</td>
        <td>Message</td>
        <td>Date</td>
        <td>Actions</td>
    </tr>
    <?php
    foreach ($flagcomments as $comment) {
        ?>
        <tr>
            <td><?= $comment->getId();?></td>
            <td><?= $comment->getPseudo();?></td>
            <td><?= substr($comment->getContent(), 0, 150);?></td>
            <td>Créé le : <?= $comment->getCreatedDate();?></td>
            <td>
                <a href="/index.php?route=unflagComment&commentId=<?= $comment->getId(); ?>&token=<?= $token; ?>">Désignaler le commentaire</a>
                <a href="/index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>&token=<?= $token; ?>">Supprimer le commentaire</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
