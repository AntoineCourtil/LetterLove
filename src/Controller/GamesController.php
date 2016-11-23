<?php namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\PilesController;
use App\Controller\HandsController;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class GamesController extends AppController
{

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
        $data['player1'] = $game->player1;
        $data['player2'] = $game->player2;
        $data['player3'] = $game->player3;
        $data['player4'] = $game->player4;
        
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
    
    public static function checkEndGame($game){
        
        $idPile = $game->pioche;
        
        if(PilesController::count($idPile) > 0){
            return false;
        }
        else{
            $game->finished = true;
            return true;
        }
        
        TableRegistry::get('Games')->save($game);
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

    public function play($idGame = null)
    {
        if($idGame==null){
            $idGame = newGame();
            return $this->redirect(['action' => 'play', $idGame]);
        }
        
        else{
            $game = $this->Games->get($idGame);
        }
        
        $this->set(compact('game'));
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
    
    public static function isAlreadyHere($idGame, $idPlayer){
        $game = TableRegistry::get('Games')->get($idGame);
        
        if($game->player1 == $idPlayer){
            return true;
        }
        if($game->player2 == $idPlayer){
            return true;
        }
        if($game->player3 == $idPlayer){
            return true;
        }
        if($game->player4 == $idPlayer){
            return true;
        }
        return false;
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
        if($id==2){
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
}