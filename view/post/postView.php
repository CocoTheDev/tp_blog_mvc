<?php 
$post = $post->fetch();
$title = htmlspecialchars($post['title']);
ob_start(); 

?>

<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>
<?php
if (isset($message)) {
    echo '<p>'. $message . '</p>';
}
?>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['billet_date_fr'] ?></em>
    </h3>
    
    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>

<h2>Commentaires</h2>

<?php
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> (id:<?= $comment['id'] ?>)</p>

    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>

    <!-- Update button -->
    <form action="index.php?action=editComment&amp;commentId=<?= $comment['id'] ?>" method="post">
    <input type="hidden" name ="commentId" value="<?= $comment['id'] ?>">
    <input type="hidden" name ="comment" value="<?= $comment['comment'] ?>">
    <input type="submit" value="Éditer">
    </form>

    <!-- Delete button -->
    <form action="index.php?action=deleteComment" method="post">
    <input type="hidden" name ="commentId" value="<?= $comment['id'] ?>">
    <input type="submit" value="Supprimer">
    </form>

    <br><br>
<?php
}
?>

<!-- Add Comment -->
<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
 <p>Votre Pseudo : <input type="text" name="author" /></p>
 <p>Commentaire : <input type="text" name="comment" /></p>
 <p><input type="submit" value="Ajouter"></p>
</form>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
