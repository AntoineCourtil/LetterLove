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

<button id="pret" onclick="pret()"/>Prêt ?</button>
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
    function pret(){
        console.log("pret");
        /*$.ajax({
            url: "<?= $this->Url->build(['controller'=>'produits','action'=>'liste'])?>",
            data: {
                prix: $("#prix").val()
            },
            dataType: 'json',
            type: 'post',
            success: function (json) {
                $("#livres").empty(); // nous vidons le SELECT
                $("#livres").append('<option value="0"><?=__('Selectionnez un livre')?></option>'); // Nous rajoutons une option "vide" qu SELECT qui indique à l'utilisateur de choisir un livre
                $.each(json, function (clef, valeur) { // pour chaque élément du tableau JSON, on récupère la clef et la valeur
                    // on ajoute l'option dans la liste
                    $("#livres").append('<option value="' + clef + '">' + valeur + '</option>');
                });
            }
        });*/
    }
    
    function piocher(){
        console.log("piocher");
    }
</script>