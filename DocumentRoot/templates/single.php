<?php $this->title = "Article"; // TODO : déplacer dans FrontController 
?>
<h1>Mon blog</h1>
<p>En construction</p>
<div>
    <h2><?= htmlspecialchars($article->getTitle()); ?></h2>
    <p><?= htmlspecialchars($article->getContent()); ?></p>
    <p>Créé le : <?= htmlspecialchars($article->getCreatedDate()); ?></p>
</div>
<?php if ($this->session->get('pseudo') && $this->session->get('role') === 'admin') { ?>
    <br>
    <div class="actions">
        <a href="../public/index.php?route=editArticle&articleId=<?= $article->getId(); ?>">Modifier</a>
        <a href="../public/index.php?route=deleteArticle&articleId=<?= $article->getId(); ?>">Supprimer</a>
    </div>
<?php } ?>
<br>
<a href="../public/index.php">Retour à l'accueil</a>

<div id="comments" class="text-left" style="margin-left: 50px">
    <?php if ($this->session->get('pseudo')) { ?>
        <h3>Ajouter un commentaire</h3>
        <?php include('form_comment.php'); ?>
    <?php } ?>
    <h3>Commentaires</h3>
    <?php
    foreach ($comments as $comment) { ?>
        <h4><?= htmlspecialchars($comment->getPseudo()); ?></h4>
        <p><?= htmlspecialchars($comment->getContent()); ?></p>
        <p>Dernière modification le <?= htmlspecialchars($comment->getCreatedDate()); ?></p>
        <?php if ($this->session->get('pseudo') && $comment->isFlag()) { ?>
            <p>Ce commentaire a déjà été signalé</p>
        <?php } elseif ($this->session->get('pseudo')) { ?>
            <p><a href="../public/index.php?route=flagComment&commentId=<?= $comment->getId(); ?>">Signaler le commentaire</a></p>
        <?php } ?>

        <?php if ($this->session->get('pseudo') && $this->session->get('role') === 'admin') { ?>
            <p><a href="../public/index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">Supprimer le commentaire</a></p>
        <?php } ?>
        <br>
    <?php } ?>
</div>
</div>