<?php

setlocale(LC_ALL, 'fr_FR.utf8');
include("config.php");

if (isset($_GET['date'])) {
    $date = date_create($_GET['date']);
} else {
    $date = date_create("today");
}

$date_idx = (int) $date->diff(date_create($BASE_DATE))->format("%a");

$date_txt=strftime("%A %e %B %Y", $date->getTimestamp());
$date_day = (int) strftime("%d", $date->getTimestamp());
$date_month = (int) strftime("%m", $date->getTimestamp());

$is_anniv = $date_day == $ANNIV_JOUR && $date_month == $ANNIV_MOIS;


error_log("Date idx : $date_idx");

$backgrounds=array_values(array_diff(scandir("img"), array('..', '.')));
$background = $backgrounds[$date_idx % count($backgrounds)];

$merci = $mercis[$date_idx % count($mercis)];
$recompense = $recompenses[$date_idx % count($recompenses)];

?>
<!doctype html>
<html class="no-js" lang="fr">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
        <title><?php echo $TITRE ?></title>
        <meta name="description" content="<?php echo $SOUS_TITRE ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" href="icon.png">
        <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>
    
<body style="background: url('img/<?php echo $background ?>') no-repeat center center fixed; background-size:cover">
    
    <div id="header">
        <h1><?php echo $TITRE ?></h1>
        <p id="sous-titre"><?php echo $SOUS_TITRE ?></p>
    </div>

    <div id="content"> 
        
        <div id="colonne">

        <p class="titre">
            Bonjour petit papa. <br/> 
            Aujourd'hui, <span class="date"><?= $date_txt ?></span><br/>
            <?php if ($is_anniv) : ?>
                <span class="date">Bon anniversaire !!</span><br/>
            <?php endif; ?>
            Je voudrais te remercier pour ... 
        </p>
        <p class="carte" id="merci">
            <?= $merci ?>
        </p>

        <p class="titre">
            Je te propose ce petit plaisir, <br/>
            que tu as bien mérité ... 
        </p>
        <p class="carte" id="plaisir">
            <?= $recompense ?>
        </p>
        
        </div>

    </div>
    <div id="footer">
        <span class="author"><?php echo $AUTEUR ?></span>
        //
        <span class="creation-date"><?php echo $DATE_CREATION ?></span>
    </div>
    </body>
</html>
