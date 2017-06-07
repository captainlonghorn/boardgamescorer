Liste<?php
foreach ($listeBoardgames as $boardgame)
{
    ?>
    <p><?php echo $boardgame->getName(); ?></a></p>
    <p><?php echo $boardgame->getId(); ?></p>
    <?php
}