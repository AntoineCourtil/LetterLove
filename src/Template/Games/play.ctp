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

<span id="endGame"></span>

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

<div>
    <table>
        <tr>
            <th>Defausse Player 1</th>
            <th>Defausse Player 2</th>
            <th>Defausse Player 3</th>
            <th>Defausse Player 4</th>
        </tr>
        <tr>
            <td><span id="listDefausseP1"></span></td>
            <td><span id="listDefausseP2"></span></td>
            <td><span id="listDefausseP3"></span></td>
            <td><span id="listDefausseP4"></span></td>
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
    
    function piocher(){
        
        if(myTurn){
            //console.log("piocher");
            
            //$.post("<?php // $this->Url->build(['controller'=>'games','action'=>'piocher/'])?>", { idGame: idGame, idPlayer: idPlayer})
            $.post("<?= $this->Url->build(['controller'=>'games','action'=>'piocher/'])?>")
            
                .done(function(data){
                    //console.log(data);
                });
            
            pioche=true;
        }
        else{
            //console.log("pas votre tour");
        }
            
    }
    
    function refresh() {
        
        var idPlayer = <?php echo $_SESSION['idPlayer'];?>;
        var turnPlayer = -1;
        
        console.log('refresh');
        
        //$.post("<?php // $this->Url->build(['controller'=>'games','action'=>'refresh'])?>", { idGame: idGame, idPlayer: idPlayer})
        $.post("<?= $this->Url->build(['controller'=>'games','action'=>'refresh'])?>")
            
            .done(function(data){
                
                //console.log(data);
                
                var res = jQuery.parseJSON(data);


                //------------------------------------------------------------------------------------------


                turnPlayer = res['turnPlayer'];

                $("#turn").html("Joueur <b>"+res['turnPlayerName']+"</b>");

                if(idPlayer==turnPlayer){
                    myTurn=true;
                }
                else{
                    myTurn=false;
                    pioche=false;
                }


                //--------------------------------------------------------------------------------------------
                
                if(!pioche){
                    piocher();
                }
                
                //--------------------------------------------------------------------------------------------

                
                $("#carteRestantes").html(res['carteRestantes']);
                $("#carteDefaussees").html(res['carteDefaussees']);
                
                listDefausse();
                listDefausseP(1);
                listDefausseP(2);
                listDefausseP(3);
                listDefausseP(4);
                
                
                
                //--------------------------------------------------------------------------------------------

                
                if(res['gameReady']){
                    $("#gameReady").html("Tous les Joueurs sont prêts:");
                }
                else{
                    $("#gameReady").html("Joueurs :");
                }
                
                $("#listePlayers").html("<ul><li>"+res['player1']+"</li><li>"+res['player2']+"</li><li>"+res['player3']+"</li><li>"+res['player4']+"</li></ul>");
                

                //--------------------------------------------------------------------------------------------

                
                if(res['endGame']){
                    $("#endGame").html("<h2>Fin du Jeu ! Merci d'avoir joué !</h2>");
                }

                //--------------------------------------------------------------------------------------------


                var card1 = res['card1'];
                var card2 = res['card2'];

                if(card1!=null){
                    $("#card1").html('<a onclick="defausse(1)"><img src="../../../webroot/img/'+card1+'.jpg" alt=""/></a>');
                }
                else{
                    $("#card1").html('');
                }
                if(card2!=null){
                    $("#card2").html('<a onclick="defausse(2)"><img src="../../../webroot/img/'+card2+'.jpg" alt=""/></a>');
                }
                else{
                    $("#card2").html('');
                }
            }
        );
    }
    
    function nameOfCard(){
        $.post("<?= $this->Url->build(['controller'=>'cards','action'=>'nameof'])?>")
            
            .done(function(data){
                var res = jQuery.parseJSON(data);
                
                var name = "";
                name = res['name'];
                
                return 'name';
                
                
        });
    }
    
    function listDefausse(){
        //$.post("<?php // $this->Url->build(['controller'=>'piles','action'=>'listpile'])?>", { idPile: <?php // $game->defausse?>})
        $.post("<?= $this->Url->build(['controller'=>'piles','action'=>'listpile'])?>")
            
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
    
    function listDefausseP(player){
        $.post("<?= $this->Url->build(['controller'=>'games','action'=>'listdefaussep'])?>", {id: player})
            .done(function(data){
                var res = jQuery.parseJSON(data);
                
                //console.log(player);
                
                var liste ="<ul>";
                
                for(var i=1;i<17;i++){
                    if(res['card'+i]!="null" && res['status']!="error"){
                        
                        liste = liste + "<li><b>"+i+"</b> : "+res['card'+i]+"</li>";
                    }
                }
                
                $("#listDefausseP"+player).html(liste);
                
                //console.log(data);
                
                
         });
    }
    
    function king(){
        
        player = prompt("Veuillez choisir un joueur (1,2,3 ou 4) : ");
        
        
        $.post("<?= $this->Url->build(['controller'=>'games','action'=>'king'])?>", {choice : player})
            
            .done(function(data){
                console.log(data);
                var res = jQuery.parseJSON(data);
                
                if(res['status'] == "error"){
                    king();
                }
            });
    }
    
    function priest(){
        
        player = prompt("Veuillez choisir un joueur (1,2,3 ou 4) : ");
        
        
        $.post("<?= $this->Url->build(['controller'=>'games','action'=>'priest'])?>", {choice : player})
            
            .done(function(data){
                console.log(data);
                var res = jQuery.parseJSON(data);
                
                if(res['status'] == "error"){
                    priest();
                }
                else{
                    alert("Joueur : "+res['player']+"\n\nCarte 1 : "+res['card1']+"\nCarte 2 : "+res['card2']);
                }
            });
    }
    
    
    
    function defausse(posCard){
        
        $.post("<?= $this->Url->build(['controller'=>'players','action'=>'defaussecard'])?>", {posCard: posCard})
            
            
            .done(function(data){
                var res = jQuery.parseJSON(data);
                
                if(res['actions'] == "king"){
                    king();
                }
                if(res['actions'] == "priest"){
                    priest();
                }
        });
        
    }

    setInterval(refresh, 1000); // Répète la fonction toutes les 1 sec
</script>