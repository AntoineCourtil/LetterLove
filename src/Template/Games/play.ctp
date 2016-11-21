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
        <li>Carte Defaussée no: <?= $game->carteDefaussee ?></li>
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

<button id="pret" onclick="pret(<?php echo $_SESSION['idPlayer'];?>)" value="Piocher"><span id="txtPret">Prêt ?</span></button>
<button id="piocher" onclick="piocher()"/>Piocher</button>

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

<script>
    function pret(idPlayer){
        $.ajax({
            url: "<?= $this->Url->build(['controller'=>'players','action'=>'ready/'])?>/"+idPlayer,
            type: 'post',
            dataType:'JSON', 
            success: function (response) {
                $("#txtPret").text('Vous êtes prêt');
            }, 
            error: function (response) {
                $("#txtPret").text('Déjà prêt');
            }
        });
    }
    
    function piocher(){
        console.log("piocher");
    }
</script>