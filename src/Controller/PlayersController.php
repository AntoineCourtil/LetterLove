<?php namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\GamesController;
use App\Controller\HandsController;
use App\Controller\PilesController;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


class PlayersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Charge le FlashComponent
    }
    
    public function index()
    {
         $this->set('players', $this->Players->find('all'));
    }

    public function view($idPlayer = null)
    {
        $player = $this->Players->get($idPlayer);
        $this->set(compact('player'));
    }
    
    public function add()
    {
        $player = $this->Players->newEntity();
        if ($this->request->is('post')) {
            $player = $this->Players->patchEntity($player, $this->request->data);
            if ($this->Players->save($player)) {
                $this->Flash->success(__('Votre joueur a été sauvegardé.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter votre joueur.'));
        }
        $this->set('player', $player);
    }
    
    public static function ready($idPlayer){
        $player = TableRegistry::get('Players')->get($idPlayer);
        
        $player->ready = true;
        $data = array();
        
        if (TableRegistry::get('Players')->save($player)) {
                $data['status']='success';
                
                $idGame = $_SESSION['idGame'];
                
                GamesController::checkPlaying($idGame);
            }
        else{
                $data['status']='error';
        }
        
        echo json_encode($data);
    }
    
    public static function defaussecard(){

        $idPlayer=$_SESSION['idPlayer'];
        $posCard=$_POST['posCard'];

        $player = TableRegistry::get('Players')->get($idPlayer);
        $hand = TableRegistry::get('Hands')->get($player->hand);
        $defausse = TableRegistry::get('Piles')->get($player->defausse);
        
        if($posCard=="1" || $posCard==1){
            PilesController::defausse($defausse, $hand->card1);
            $hand->card1=null;
            
        }
        else{
            PilesController::defausse($defausse, $hand->card2);
            $hand->card2=null;
        }
        
        TableRegistry::get('Hands')->save($hand);
        TableRegistry::get('Piles')->save($defausse);
        
        $data = array();
        $data['response']="success";
        
        echo json_encode($data);
    }

        public function edit($idPlayer = null){
            $player = $this->Players->get($idPlayer);
            if ($this->request->is(['post', 'put'])) {
                $this->Players->patchEntity($player, $this->request->data);
                if ($this->Players->save($player)) {
                    $this->Flash->success(__('Votre joueur a été mis à jour.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Impossible de mettre à jour votre joueur.'));
            }

            $this->set('player', $player);
        }
    
    public function delete($idPlayer)
    {
        $this->request->allowMethod(['post', 'delete']);

        $player = $this->Players->get($idPlayer);
        if ($this->Players->delete($player)) {
            $this->Flash->success(__("Le joueur avec l'idPlayer : {0} a été supprimé.", h($idPlayer)));
            return $this->redirect(['action' => 'index']);
        }
    }
    
    public function login()
    {
        $player = $this->Players->newEntity();
        if ($this->request->is('post')) {
            
            $player = $this->Players->patchEntity($player, $this->request->data);
            if($player = $this->Players->findByName($player->name)->first()){
                //echo 'Player finded';
                if($player->connected == false){
                    $idGame = GamesController::openedGame();
                    
                    $idHand = HandsController::newHand($player->idPlayer);
                    $player->hand = $idHand;
                    
                    $defausse = PilesController::newDefausse();
                    $player->defausse = $defausse->idPile;
                    
                    if(!GamesController::isAlreadyHere($idGame, $player->idPlayer)){

//                            $player->connected = true;
                        if(TableRegistry::get('Players')->save($player)){
                            GamesController::addPlayer($idGame, $player->idPlayer);
                            //echo 'idPlayer : '.$player->idPlayer;
                            
                            
                            $_SESSION['idPlayer'] = $player->idPlayer;
                            $_SESSION['idHand'] = $idHand;
                            $_SESSION['idGame'] = $idGame;
                            
                            
                            
                            $this->redirect(array("controller" => "Games", 
                                "action" => "play",
                                $idGame));
                        }
                        else{
                            $this->Flash->error(__('Impossible de mettre à jour votre joueur.'));
                        }
                    }
                    else{
                        $this->Flash->error(__('Joueur déjà présent dans une partie.'));
                    }
                }
            }
        }
    }
}