<form id="demo-form" method="post" action="/index.php?route=addComment&articleId=<?= $article->getId(); ?>">
    <label for="content">Message</label><br>
    <textarea id="content" name="content"></textarea><br>
    <input type="submit" value="Ajouter" id="submit" name="submit">
</form>

