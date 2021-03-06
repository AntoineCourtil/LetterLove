<?php namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\PilesController;
use App\Controller\PlayersController;
use App\Controller\CardsController;
use App\Controller\HandsController;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class GamesController extends AppController
{
    
    //------------------------------------------------------------------------------------
    //                              INITIALISATION
    //------------------------------------------------------------------------------------
    
    
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Charge le FlashComponent
    }
    
    public function index()
    {
         $this->set('games', $this->Games->find('all'));
    }

    public function view($idGame = null)
    {
        $game = $this->Games->get($idGame);
        $this->set(compact('game'));
    }

    public function add()
    {
        $game = $this->Games->newEntity();
        if ($this->request->is('post')) {
            $game = $this->Games->patchEntity($game, $this->request->data);
            if ($this->Games->save($game)) {
                $this->Flash->success(__('Votre partie a été sauvegardée.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter votre partie.'));
        }
        $this->set('game', $game);
    }
    
    public function edit($idGame = null)
    {
        $game = $this->Games->get($idGame);
        if ($this->request->is(['post', 'put'])) {
            $this->Games->patchEntity($game, $this->request->data);
            if ($this->Games->save($game)) {
                $this->Flash->success(__('Votre partie a été mise à jour.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible de mettre à jour votre partie.'));
        }

        $this->set('game', $game);
    }
    
    public function delete($idGame)
    {
        $this->request->allowMethod(['post', 'delete']);

        $game = $this->Games->get($idGame);
        if ($this->Games->delete($game)) {
            $this->Flash->success(__("La partie avec l'idGame : {0} a été supprimée.", h($idGame)));
            return $this->redirect(['action' => 'index']);
        }
    }
    
    public static function newGame(){
        $game = TableRegistry::get('Games')->newEntity();
        $pioche = PilesController::newPioche();
        $defausse = PilesController::newDefausse();

        $playing = false;

        $game->pioche = $pioche->get('idPile');            
        $game->defausse = $defausse->get('idPile');
        $game->playing = $playing;

        $cartePiochee = PilesController::pioche($pioche);
        echo 'carte piochée : '.$cartePiochee;
        
        $game->carteDefaussee = $cartePiochee;
        
        //PilesController::defausse($defausse, $cartePiochee);

        if (TableRegistry::get('Games')->save($game)) {
            //$this->Flash->success(__('Votre partie a été créee.'));
            return $game->idGame;
            //return $this->redirect(['action' => 'play', $game->idGame]);
        }
        else{
            $this->Flash->error(__('Impossible d\'ajouter votre partie.'));
        }
    }
    
    
    //------------------------------------------------------------------------------------
    //                              CHECK
    //------------------------------------------------------------------------------------


    public static function checkPlaying($idGame){
        $game = TableRegistry::get('Games')->get($idGame);
        
        if(GamesController::checkPlayersReady($idGame) && $game->playing==false){
            $game->playing = true;
            $game->tourPlayer = $game->player1;
            
            GamesController::firstTour($game);
            
            TableRegistry::get('Games')->save($game);
            
            return true;
        }
    }
    
    
    public static function checkEndGame($game){
        
        $idPile = $game->pioche;
        
        if(PilesController::count($idPile) > 0){
            return false;
        }
        else{
            
            if(GamesController::checkHands($game)){
            
                $game->finished = true;
                TableRegistry::get('Games')->save($game);
                return true;
            }
        }
        
        return false;
    }
    
    public static function checkHands($game){
        
        if($game->player1 != null){
            if(!GamesController::checkHand($game->player1)){
                return false;
            }
        }
        
        if($game->player2 != null){
            if(!GamesController::checkHand($game->player2)){
                return false;
            }
        }
        
        if($game->player3 != null){
            if(!GamesController::checkHand($game->player3)){
                return false;
            }
        }
        
        if($game->player4 != null){
            if(!GamesController::checkHand($game->player4)){
                return false;
            }
        }
        
        return true;
    }
    
    public static function checkHand($idPlayer){
        
        $player = TableRegistry::get('Players')->get($idPlayer);
        $hand = TableRegistry::get('Hands')->get($player->hand);
        
        if(HandsController::nbcards($hand) > 1){
            return false;
        }
        else{
            return true;
        }
    }


    public static function checkPlayersReady($idGame){
        $game = TableRegistry::get('Games')->get($idGame);
        
        if(TableRegistry::get('Players')->get($game->player1)->ready == true){
            if($game->player2 == NULL){
                return false;
            }
            elseif(TableRegistry::get('Players')->get($game->player2)->ready == true){
                if($game->player3 == NULL || TableRegistry::get('Players')->get($game->player3)->ready == true){
                    if($game->player4 == NULL || TableRegistry::get('Players')->get($game->player4)->ready == true){
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
    public static function isAlreadyPlaying($idPlayer){
        
        $games = TableRegistry::get('Games')->find();
        
        $idGame = -1;
        
        foreach ($games as $game){
            
            if(!$game->finished){
                if($game->player1 == $idPlayer){
                    return $game->idGame;
                }
                if($game->player2 == $idPlayer){
                    return $game->idGame;
                }
                if($game->player3 == $idPlayer){
                    return $game->idGame;
                }
                if($game->player4 == $idPlayer){
                    return $game->idGame;
                }
            }
        }
        
        return $idGame;
    }
    
    
    //------------------------------------------------------------------------------------
    //                              PLAY FUNCTIONS
    //------------------------------------------------------------------------------------
    
    public static function refresh(){
        $idGame=$_SESSION['idGame'];
        $idPlayer=$_SESSION['idPlayer'];
        
        /*$idGame = 38;
        $idPlayer = 2;*/
        
        $game = TableRegistry::get('Games')->get($idGame);
        $player = TableRegistry::get('Players')->get($idPlayer);
        $hand = TableRegistry::get('Hands')->get($player->hand);
        $pioche = TableRegistry::get('Piles')->get($game->pioche);
        $defausse = TableRegistry::get('Piles')->get($game->defausse);
        
        $data = array();
        
        $data['status'] = 'success';
        $data['turnPlayer'] = $game->tourPlayer;
        $data['turnPlayerName'] = PlayersController::nameOfPlayer($game->tourPlayer);
        
        
        $data['player1'] = PlayersController::nameOfPlayer($game->player1);
        $data['player2'] = PlayersController::nameOfPlayer($game->player2);
        $data['player3'] = PlayersController::nameOfPlayer($game->player3);
        $data['player4'] = PlayersController::nameOfPlayer($game->player4);
        
        
        $data['carteRestantes'] = PilesController::count($pioche->idPile);
        $data['carteDefaussees'] = PilesController::count($defausse->idPile);
        
        if(GamesController::checkPlaying($idGame) && ($game->player3 == null && $game->player4 == null)){
            $data['gameReady']=true;
            if(GamesController::nbPlayers($game) && PilesController::count($game->defausse)==0){
                $idCard2 = PilesController::pioche($pioche);
                PilesController::defausse($defausse, $idCard2);
                
                $idCard2 = PilesController::pioche($pioche);
                PilesController::defausse($defausse, $idCard2);
                
                $idCard2 = PilesController::pioche($pioche);
                PilesController::defausse($defausse, $idCard2);
            }
        }
        else{
            $data['gameReady']=false;            
        }
        
        if(GamesController::checkEndGame($game)){
            $data['endGame'] = true;
        }
        else{
            $data['endGame'] = false;
        }
        
        $data['card1'] = $hand->card1;
        $data['card2'] = $hand->card2;
        
        echo json_encode($data);
    }

    public static function piocher($idGame, $idPlayer){
        
        if(!isset($idGame) && !isset($idPlayer)){
            $idGame=$_SESSION['idGame'];
            $idPlayer=$_SESSION['idPlayer'];
        }
        
        $game = TableRegistry::get('Games')->get($idGame);
        $player = TableRegistry::get('Players')->get($idPlayer);
        $pioche = TableRegistry::get('Piles')->get($game->pioche);
        $hand = TableRegistry::get('Hands')->get($player->hand);
        
        $player->protected = false;
        TableRegistry::get('Players')->save($player);
        
        
        if(HandsController::nbcards($hand)<2){
           
            $idCard = PilesController::pioche($pioche);
            HandsController::addCard($hand->idHand, $idCard);

            $data = array();

            $data['status'] = 'success';
            $data['card'] = $idCard;
            $data['hand'] = $hand->idHand;
        
        }
        
        else{
            $data['status'] = 'error';
        }
        
        echo json_encode($data);
        
        
    }

    public function play($idGame = null)
    {
        if(!isset($_SESSION['idPlayer'])){
            //echo $_SESSION['idPlayer'];
            return $this->redirect(array("controller" => "Players", 
                            "action" => "login"));
        }
        
        if($idGame==null){
            //$idGame = newGame();
            //return $this->redirect(['action' => 'play', $idGame]);
            return $this->redirect(array("controller" => "Players", 
                            "action" => "login"));
        }
        
        else{
            $game = $this->Games->get($idGame);
        }
        
        $this->set(compact('game'));
    }
    
    
    
    //------------------------------------------------------------------------------------
    //                              GAME FUNCTIONS
    //------------------------------------------------------------------------------------
    
    
    public static function firstTour($game){
        
        GamesController::piocher($game->idGame, $game->player1);
        GamesController::piocher($game->idGame, $game->player2);
        
        if($game->player3 != null){
            GamesController::piocher($game->idGame, $game->player3);
        }
        if($game->player4 != null){
            GamesController::piocher($game->idGame, $game->player4);
        }
    }

    public static function addPlayer($idGame, $idPlayer){
        $game = TableRegistry::get('Games')->get($idGame);
        
        if($game->player1 == NULL){
            $game->player1 = $idPlayer;
        }
        else if($game->player2 == NULL){
            $game->player2 = $idPlayer;
        }
        else if($game->player3 == NULL){
            $game->player3 = $idPlayer;
        }
        else if($game->player4 == NULL){
            $game->player4 = $idPlayer;
        }

        TableRegistry::get('Games')->save($game);
        
    }
    
    public static function openedGame(){
        $games = TableRegistry::get('Games')->find();
        //$games->find('all');
        //echo'<br/>a';
        
        foreach ($games as $game){
            //echo'<br/>b';
            if($game->playing==false){
                //echo'<br/>c';
                if($game->player1 == NULL || $game->player2 == NULL || $game->player3 == NULL || $game->player4 == NULL){
                    //echo'<b>'.$game->idGame.'</b>';
                    return $game->idGame;
                }
            } 
        }
        
        $idGame = GamesController::newGame();
        
        return $idGame;
    }
    
    public static function nextPlayer($idGame){
        
        $game = TableRegistry::get('Games')->get($idGame);
        
        $actualPlayer = $game->tourPlayer;
        
        if($actualPlayer == $game->player1){
            $game->tourPlayer = $game->player2;
        }
        if($actualPlayer == $game->player2){
            if($game->player3 != null){
                $game->tourPlayer = $game->player3;
            }
            else{
                $game->tourPlayer = $game->player1;
            }
        }
        if($actualPlayer == $game->player3){
            if($game->player4 != null){
                $game->tourPlayer = $game->player4;
            }
            else{
                $game->tourPlayer = $game->player1;
            }
        }
        if($actualPlayer == $game->player4){
            $game->tourPlayer = $game->player1;
        }
        
        TableRegistry::get('Games')->save($game);
        
    }
    
    public static function listdefaussep(){
        $idGame = $_SESSION['idGame'];
        $id = $_POST['id'];
        
        $idPlayer=-1;
        
        $game = TableRegistry::get('Games')->get($idGame);
        
        if($id==1){
            $idPlayer = $game->player1;
        }
        if($id==2 && $game->player2!=null){
            $idPlayer = $game->player2;
        }
        if($id==3 && $game->player3!=null){
            $idPlayer = $game->player3;
        }
        if($id==4 && $game->player4!=null){
            $idPlayer = $game->player4;
        }
        
        if($idPlayer == -1){
            $data = array();
            $data['status'] = 'error';

            echo json_encode($data);
            
        }
        else{
            $player = TableRegistry::get('Players')->get($idPlayer);
            $idDefausse = $player->defausse;

            PilesController::listpile2($idDefausse);
        }
        /*$data = array();
        $data['status'] = 'success';
        
        echo json_encode($data);*/
        
        
    }
    
    public static function nbPlayers($game){
        $res = 0;
        
        if($game->player1 != null){
            $res++;
        }
        if($game->player2 != null){
            $res++;
        }
        if($game->player3 != null){
            $res++;
        }
        if($game->player4 != null){
            $res++;
        }
        
        return $res;
    }
    
    
    
    
    //------------------------------------------------------------------------------------
    //                              CARDS EFFECTS
    //------------------------------------------------------------------------------------
    
    public static function king(){
        
        $data = array();
        
        if(PlayersController::haveCard($_SESSION['idPlayer'], 6)){
        
            $choice = $_POST['choice'];

            $game = TableRegistry::get('Games')->get($_SESSION['idGame']);

            $idChoose = -1;

            if($choice == 1){
                $player1 = TableRegistry::get('Players')->get($game->player1);
                if(!$player1->protected){
                    $idChoose=$game->player1;
                }
            }
            if($choice == 2){
                $player2 = TableRegistry::get('Players')->get($game->player2);
                if(!$player2->protected){
                    $idChoose=$game->player2;
                }
            }
            if($choice == 3 && $game->player3!=null){
                $player3 = TableRegistry::get('Players')->get($game->player3);
                if(!$player3->protected){
                    $idChoose=$game->player3;
                }
            }
            if($choice == 4 && $game->player4!=null){
                $player4 = TableRegistry::get('Players')->get($game->player4);
                if(!$player4->protected){
                    $idChoose=$game->player4;
                }
            }
            /*if($_SESSION['idPlayer']==$idChoose){
                $idChoose=-1;
            }*/

            if(($idChoose!=-1) && ($game->tourPlayer == $_SESSION['idPlayer'])){
                $data['status'] = 'success';

                $playerChoose = TableRegistry::get('Players')->get($idChoose);
                $player = TableRegistry::get('Players')->get($_SESSION['idPlayer']);

                $handPlayer = $player->hand;
                $handChoose = $playerChoose->hand;

                $player->hand = $handChoose;
                $playerChoose->hand = $handPlayer;

                TableRegistry::get('Players')->save($player);
                TableRegistry::get('Players')->save($playerChoose);

                GamesController::nextPlayer($_SESSION['idGame']);

            }
            else{
                $data['status'] = 'error';
            }
        }
        else{
            $data['status'] = 'error';
        }
        
        
        echo json_encode($data);
        
    }
    
    public static function priest(){
        
        $data = array();
        
        if(PlayersController::haveCard($_SESSION['idPlayer'], 2)){
            
            $choice = $_POST['choice'];

            $game = TableRegistry::get('Games')->get($_SESSION['idGame']);

            $idChoose = -1;

            if($choice == 1){
                $player1 = TableRegistry::get('Players')->get($game->player1);
                if(!$player1->protected){
                    $idChoose=$game->player1;
                }
            }
            if($choice == 2){
                $player2 = TableRegistry::get('Players')->get($game->player2);
                if(!$player2->protected){
                    $idChoose=$game->player2;
                }
            }
            if($choice == 3 && $game->player3!=null){
                $player3 = TableRegistry::get('Players')->get($game->player3);
                if(!$player3->protected){
                    $idChoose=$game->player3;
                }
            }
            if($choice == 4 && $game->player4!=null){
                $player4 = TableRegistry::get('Players')->get($game->player4);
                if(!$player4->protected){
                    $idChoose=$game->player4;
                }
            }
            /*if($_SESSION['idPlayer']==$idChoose){
                $idChoose=-1;
            }*/
            
            if(($idChoose!=-1) && ($game->tourPlayer == $_SESSION['idPlayer'])){
                $data['status'] = 'success';
            
                $player = TableRegistry::get('Players')->get($idChoose);
                $hand = TableRegistry::get('Hands')->get($player->hand);

                $data['card1'] = CardsController::nameOfCard($hand->card1);
                $data['card2'] = CardsController::nameOfCard($hand->card2);
                
                $data['player'] = PlayersController::nameOfPlayer($idChoose);

                GamesController::nextPlayer($_SESSION['idGame']);
            }
            else{
                $data['status'] = 'error';
            }
        }
        
        else{
            $data['status'] = 'error';
        }
        
        echo json_encode($data);
    }
    
    public static function handmaid(){
        
        $data = array();
        
        if(PlayersController::haveCard($_SESSION['idPlayer'], 4)){
            $data['status'] = 'success';
            
            $player = TableRegistry::get('Players')->get($_SESSION['idPlayer']);
            
            $player->protected = true;
            
            TableRegistry::get('Players')->save($player);

            GamesController::nextPlayer($_SESSION['idGame']);
        }
        
        else{
            $data['status'] = 'error';
        }
        
        echo json_encode($data);
    }
    
    public static function prince(){
        
        $data = array();
        
        if(PlayersController::haveCard($_SESSION['idPlayer'], 5)){
            
            $choice = $_POST['choice'];

            $game = TableRegistry::get('Games')->get($_SESSION['idGame']);

            $idChoose = -1;

            if($choice == 1){
                $player1 = TableRegistry::get('Players')->get($game->player1);
                if(!$player1->protected){
                    $idChoose=$game->player1;
                }
            }
            if($choice == 2){
                $player2 = TableRegistry::get('Players')->get($game->player2);
                if(!$player2->protected){
                    $idChoose=$game->player2;
                }
            }
            if($choice == 3 && $game->player3!=null){
                $player3 = TableRegistry::get('Players')->get($game->player3);
                if(!$player3->protected){
                    $idChoose=$game->player3;
                }
            }
            if($choice == 4 && $game->player4!=null){
                $player4 = TableRegistry::get('Players')->get($game->player4);
                if(!$player4->protected){
                    $idChoose=$game->player4;
                }
            }
            /*if($_SESSION['idPlayer']==$idChoose){
                $idChoose=-1;
            }*/
            
            if(($idChoose!=-1) && ($game->tourPlayer == $_SESSION['idPlayer'])){
                $data['status'] = 'success';
            
                $player = TableRegistry::get('Players')->get($idChoose);
                $hand = TableRegistry::get('Hands')->get($player->hand);
                $defausse = TableRegistry::get('Piles')->get($player->defausse);
                
                if($hand->card1 != null){
                    $card = $hand->card1;
                    PilesController::defausse($defausse, $hand->card1);
                    $hand->excard=null;
                    $hand->card1=null;
                }
                else{
                    $card = $hand->card2;
                    PilesController::defausse($defausse, $hand->card2);
                    $hand->excard=null;
                    $hand->card2=null;
                }
                
                GamesController::piocher($_SESSION['idGame'], $idChoose);
                
                TableRegistry::get('Hands')->save($hand);

                GamesController::nextPlayer($_SESSION['idGame']);
            }
            else{
                $data['status'] = 'error';
            }
        }
        
        else{
            $data['status'] = 'error';
        }
        
        echo json_encode($data);
    }
}