<?php
foreach ($listeBoardgames as $boardgame)
{
    ?>
    <h2><?php echo $boardgame->getName(); ?></a></h2>
    <p><?php echo $boardgame->getId(); ?></p>
    <?php
}