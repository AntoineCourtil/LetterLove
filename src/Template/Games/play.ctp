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
    <span id="listePlayers"/>
</p>

<p>A qui le tour ? <span id="turn"/></p>

<button id="pret" onclick="pret(<?php echo $_SESSION['idPlayer'];?>)" value="Piocher"><span id="txtPret">Prêt ?</span></button>
<button id="piocher" onclick="piocher(<?php echo $_SESSION['idPlayer'];?>)"/>Piocher</button>

<div>
    <table>
        <tr>
            <td>PIOCHE</td>
            <td><?php $defausse = TableRegistry::get('Piles')->get($game->defausse);
                    echo PilesController::getFirstCard($defausse->idPile);
                ?></td>
            <td>Carte défaussée au début</td>
        </tr>
        <tr>
            <td><?php $pioche = TableRegistry::get('Piles')->get($game->pioche);
                    echo PilesController::count($pioche->idPile); 
                ?> cartes restantes</td>
            <td><?php echo PilesController::count($defausse->idPile); ?> carte défaussées</td>
            <td><?= $game->carteDefaussee ?></td>
        </tr>
    </table>
</div>

<script>
    myTurn = false;
    
    function pret(idPlayer){
        $.post("<?= $this->Url->build(['controller'=>'players','action'=>'ready/'])?>/"+idPlayer, function(data){
            //var res = jQuery.parseJSON(data);
            //console.log(data);
            
            $("#txtPret").text('Vous êtes prêt');
        });
    }
    
    function piocher(idPlayer){
        if(myTurn){
            console.log("piocher");
        }
        else{
            console.log("pas votre tour");
        }
            
    }
    
    function refresh() {
        
        var idGame = <?php echo $_SESSION['idGame'];?>;
        var idPlayer = <?php echo $_SESSION['idPlayer'];?>;
        var turnPlayer = -1;
        
        console.log('refresh');
        
        $.post("<?= $this->Url->build(['controller'=>'games','action'=>'refresh/'])?>/"+idGame, function(data){
            var res = jQuery.parseJSON(data);
            
            //------------------------------------------------------------------------------------------
            
            turnPlayer = res['turnPlayer'];
            
            $("#turn").html("Joueur <b>"+res['turnPlayer']+"</b>");
            
            if(idPlayer==turnPlayer){
                myTurn=true;
            }
            else{
                myTurn=false;
            }
            
            //--------------------------------------------------------------------------------------------
            
            $("#listePlayers").html("<ul><li>"+res['player1']+"</li><li>"+res['player2']+"</li><li>"+res['player3']+"</li><li>"+res['player4']+"</li></ul>");
        });
    }

    setInterval(refresh, 1000); // Répète la fonction toutes les 1 sec
</script>