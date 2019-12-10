<?php 
ob_start(); 

?>

<p><strong>Edition de votre commmentaire (id:<?= $_POST['commentId'] ?>)</strong></p><br>

<p><u>Commentaire actuel:</u></p>
<p><?= $_POST['comment'] ?></p><br>

<form action="index.php?action=updateComment&commentId=<?= $_POST['commentId'] ?>" method="post">
<input type="text" name ="commentNew">
<input type="submit" value="Envoyer">
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/post/template.php'); ?>