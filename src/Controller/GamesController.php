<?php namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\PilesController;
session_start();


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
    
    public static function checkPlaying($idGame){
        if(GamesController::checkPlayersReady($idGame)){
            $game = TableRegistry::get('Games')->get($idGame);
            $game->playing = true;
            TableRegistry::get('Games')->save($game);
        }
    }
    
    public static function checkPlayersReady($idGame){
        $game = TableRegistry::get('Games')->get($idGame);
        
        if(TableRegistry::get('Players')->get($game->player1)->ready == true){
            if(TableRegistry::get('Players')->get($game->player2)->ready == true){
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