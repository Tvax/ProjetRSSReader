<?php 
echo '<p><a href="index.php">HOME</a></p>
<a href="index.php?disconnect">Disconnect</a><br>
<form action="admin.php" method="POST">
<p> Max news to parse : <input type="number" name="max_news" min="1" max="50"></p>
<span>RSS Feed</span> <input type="text" name="url">
<input class="radio" type="radio" name="contact" value="add" checked /> <span>Add</span>
<input class="radio" type="radio" name="contact" value="rm" /> <span>Remove</span>
<p><input type="submit"></p>
</form>';
?>
