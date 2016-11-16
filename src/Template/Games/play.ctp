<!-- File: src/Template/Games/play.ctp -->

<?php
use App\Controller\PilesController; 
use Cake\ORM\TableRegistry;
?>

<h1>Jeu LetterLove</h1>

<p>Informations :
    <ul>
        <li>Partie no : <?= $game->idGame ?></li>
        <li>Pioche no : <?= $game->pioche ?></li>
        <li>Defausse no: <?= $game->defausse ?></li>
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


<div>
    <table>
        <tr>
            <td>PIOCHE</td>
            <td><?php $defausse = TableRegistry::get('Piles')->get($game->defausse);
                    echo PilesController::getFirstCard($defausse->idPile);
                ?></td>
        </tr>
        <tr>
            <td><?php $pioche = TableRegistry::get('Piles')->get($game->pioche);
                    echo PilesController::count($pioche->idPile);
                ?> cartes restantes</td>
            <td><?php echo PilesController::count($defausse->idPile); ?> carte défaussées</td>
        </tr>
    </table>
</div>

