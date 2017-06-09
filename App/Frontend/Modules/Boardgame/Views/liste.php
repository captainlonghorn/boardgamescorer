Liste
<?php
    // iterator mode
// parcours de la liste
while ($listeBoardgames->valid()) {

    $boardgame_current = $listeBoardgames->current();
    //var_dump($boardgame_current);

    /*
    if ($initiale != substr($boardgame_current['gamename'], 0, 1)) {
        $initiale = substr($boardgame_current['gamename'], 0, 1);
        echo '<h3><a id="' . $initiale . '">' . $initiale . '</a> - <a href="#top">&uarr;</a></a></h3>';
    }
    */
    echo '<li class="cleanli">';
    echo '<span class="invert_bw"> ' . str_pad($boardgame_current->getId(), 3, "0",
            STR_PAD_LEFT) . '</span>';

    echo ' ' . '<strong>' . $boardgame_current->getName() . '</strong>';
    /*
    echo ' / ' . $boardgame_current['firstname'] . ' ' . $boardgame_current['lastname'];
    echo ' / ';
    echo $boardgame_current['editorname'];
    if ($boardgame_current['is_extension']) {
        echo ' (e)';
    }
    echo ' - ';
    echo '<a href="' . LINK_BASE_URL . 'content/fiche-jeu.php?boardgame=' . $boardgame_current['id'] . '">Fiche</a>';
    echo ' - ';
    echo '<a href="' . LINK_BASE_URL . 'content/form-jeu.php?boardgame=' . $boardgame_current['id'] . '">Form</a>';
    */
    // todo: explorer ce bout : echo ' - <span class="infotxt">' . $boardgame_current['C'] . ' parties jouées</span>';
    echo '</li>';


    $listeBoardgames->next();

}

?>

<?php
/*
foreach ($listeBoardgames as $boardgame)
{

    ?>
    <p><?php echo $boardgame->getName(); ?></a></p>
    <p><?php echo $boardgame->getId(); ?></p>
    <?php
}
*/