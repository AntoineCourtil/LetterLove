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
            <td><span id="carteRestantes"></span> cartes restantes</td>
            <td><span id="carteDefaussees"></span> carte défaussées</td>
        </tr>
        <tr>
            <td><img src="../../../webroot/img/Dos.jpg" alt=""/></td>
            <td><span id="listDefausse"></span></td>
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
            console.log("piocher");
            
            $.post("<?= $this->Url->build(['controller'=>'games','action'=>'piocher/'])?>", { idGame: idGame, idPlayer: idPlayer})
            
                .done(function(data){
                    //console.log(data);
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
                }
                
                //--------------------------------------------------------------------------------------------

                
                $("#carteRestantes").html(res['carteRestantes']);
                $("#carteDefaussees").html(res['carteDefaussees']);
                
                listDefausse();
                
                
                
                //--------------------------------------------------------------------------------------------

                
                if(res['gameReady']){
                    $("#gameReady").html("Tous les Joueurs sont prêts:");
                }
                else{
                    $("#gameReady").html("Joueurs :");
                }
                
                $("#listePlayers").html("<ul><li>"+res['player1']+"</li><li>"+res['player2']+"</li><li>"+res['player3']+"</li><li>"+res['player4']+"</li></ul>");
                
                


                //--------------------------------------------------------------------------------------------


                var card1 = res['card1'];
                var card2 = res['card2'];

                if(card1!=null){
                    $("#card1").html('<a onclick="defausse('+idPlayer+', 1)"><img src="../../../webroot/img/'+card1+'.jpg" alt=""/></a>');
                }
                else{
                    $("#card1").html('');
                }
                if(card2!=null){
                    $("#card2").html('<a onclick="defausse('+idPlayer+', 2)"><img src="../../../webroot/img/'+card2+'.jpg" alt=""/></a>');
                }
                else{
                    $("#card2").html('');
                }
            }
        );
    }
    
    function nameOfCard(idCard){
        $.post("<?= $this->Url->build(['controller'=>'cards','action'=>'nameof'])?>", { idCard: idCard})
            
            .done(function(data){
                var res = jQuery.parseJSON(data);
                
                var name = "";
                name = res['name'];
                
                return 'name';
                
                
            });
    }
    
    function listDefausse(){
        $.post("<?= $this->Url->build(['controller'=>'piles','action'=>'listpile'])?>", { idPile: <?= $game->defausse?>})
            
            .done(function(data){
                var res = jQuery.parseJSON(data);
                
                var liste ="<ul>";
                
                for(var i=1;i<17;i++){
                    if(res['card'+i]!="null"){
                        
                        liste = liste + "<li><b>"+i+"</b> : "+res['card'+i]+"</li>";
                    }
                }
                
                $("#listDefausse").html(liste);
                
                //console.log(data);
                
                
            });
    }
    
    function defausse(idPlayer, idCard){
        $.post("<?= $this->Url->build(['controller'=>'players','action'=>'defaussecard'])?>", { idPlayer: idPlayer, posCard: idCard})
            
            .done(function(data){
                
                
                //var res = jQuery.parseJSON(data);
                
                
                
                //console.log(data);
                
                
            });
    }

    setInterval(refresh, 1000); // Répète la fonction toutes les 1 sec
</script>