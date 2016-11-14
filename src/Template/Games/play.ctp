<!-- File: src/Template/Games/play.ctp -->

<?php use App\Controller\PilesController; ?>

<h1>Jeu LetterLove</h1>

<p>Informations :
    <ul>
        <li>Partie no : <?= $id = $game->idGame ?></li>
        <li>Pioche no : <?= $id = $game->pioche ?></li>
        <li>Defausse no: <?= $id = $game->defausse ?></li>
    </ul>
</p>

<p>Joueurs : 
    <ul>
        <li><?= $game->player1 ?></li>
        <li><?= $game->player2 ?></li>
        <li><?= $game->player3 ?></li>
        <li><?= $game->player4 ?></li>
    </ul>
</p>


