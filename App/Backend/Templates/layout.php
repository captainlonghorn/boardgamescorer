<!DOCTYPE html>
<html>
<head>
    <title>
        <?php
        if (isset($title)) {
            echo $title;
        } else {
            // TODO : this DEFAULT TITLE must be a const
            echo 'Board Game Scorer ADM';
        }
        ?>
    </title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="/css/bootstrap.css" type="text/css"/>
</head>

<body>
<div id="wrap">
    <header>
        <h1><a href="/">BGS F1 Admin</a></h1>
        <p>Welcome</p>
    </header>

    <nav>
        <ul>
            <li><a href="/">Accueil</a></li>
            <li><a href="liste.php">Liste</a></li>
            <li><a href="ajout.php">Ajout</a></li>
            <?php if ($user->isAuthenticated()) { ?>
                <li><a href="/admin/">Admin</a></li>
                <li><a href="/admin/boardgame-insert.html">New boardgame</a></li>
            <?php } ?>
        </ul>
    </nav>

    <div id="content-wrap">
        <section id="main">
            <?php if ($user->hasFlash()) {
                echo '<p style="text-align: center;">', $user->getFlash(), '</p>';
            } ?>

            <?php echo $content; ?>
        </section>
    </div>

    <footer></footer>
</div>
</body>
</html>