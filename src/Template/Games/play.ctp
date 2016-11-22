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

<p><span id="gameReady"></span> 
    <span id="listePlayers"></span>
</p>

<p>A qui le tour ? <span id="turn"/></p>

<button id="pret" onclick="pret(<?php echo $_SESSION['idPlayer'];?>)" value="Pret"><span id="txtPret">Prêt ?</span></button>

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
            <td><span id="carteRestantes"></span> cartes restantes</td>
            <td><span id="carteDefaussees"></span> carte défaussées</td>
            <td><?= $game->carteDefaussee ?></td>
        </tr>
    </table>
    
    <table>
        <tr>
            <th colspan="2">Votre Main : Cliquer pour défausser</th>
        </tr>
        <tr>
            <td><span id="card1"></span></td>
            <td><span id="card2"></span></td>
        </tr>
    </table>
</div>

<script>
    myTurn = false;
    pioche = false;
    
    function pret(idPlayer){
        $.post("<?= $this->Url->build(['controller'=>'players','action'=>'ready/'])?>/"+idPlayer, function(data){
            $("#txtPret").text('Vous êtes prêt');
        });
    }
    
    function piocher(idGame, idPlayer){
        
        if(myTurn){
            //console.log("piocher");
            
            $.post("<?= $this->Url->build(['controller'=>'games','action'=>'piocher/'])?>", { idGame: idGame, idPlayer: idPlayer})
            
                .done(function(data){
                    console.log(data);
                });
            
            pioche=true;
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
        
        $.post("<?= $this->Url->build(['controller'=>'games','action'=>'refresh'])?>", { idGame: idGame, idPlayer: idPlayer})
            
            .done(function(data){
                var res = jQuery.parseJSON(data);


                //------------------------------------------------------------------------------------------


                turnPlayer = res['turnPlayer'];

                $("#turn").html("Joueur <b>"+res['turnPlayer']+"</b>");

                if(idPlayer==turnPlayer){
                    myTurn=true;
                }
                else{
                    myTurn=false;
                    pioche=false;
                }


                //--------------------------------------------------------------------------------------------
                
                if(!pioche){
                    piocher(idGame, idPlayer);
                    pioche=true;
                }
                
                //--------------------------------------------------------------------------------------------

                
                $("#carteRestantes").html(res['carteRestantes']);
                $("#carteDefaussees").html(res['carteDefaussees']);
                
                
                //--------------------------------------------------------------------------------------------

                
                if(res['gameReady']){
                    $("#gameReady").html("Tous les Joueurs sont prêts:");
                }
                else{
                    $("#gameReady").html("Joueurs :");
                }
                
                $("#listePlayers").html("<ul><li>"+res['player1']+"</li><li>"+res['player2']+"</li><li>"+res['player3']+"</li><li>"+res['player4']+"</li></ul>");
                
                


                //--------------------------------------------------------------------------------------------


                var card1= res['card1'];
                var card2= res['card2'];


                $("#card1").text(card1);
                $("#card2").text(card2);
            }
        );
    }

    setInterval(refresh, 1000); // Répète la fonction toutes les 1 sec
</script>