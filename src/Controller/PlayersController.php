<?php namespace App\Controller;

use App\Controller\GamesController;

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
    
    public function edit($idPlayer = null)
    {
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
                $idGame = GamesController::openedGame();
                if($idGame!=false){
                    GamesController::addPlayer($idGame, $player->idPlayer);
                    echo 'idPlayer : '.$player->idPlayer;
                    echo "<br/>idGame : ".$idGame;
                    $this->redirect(array("controller" => "Games", 
                        "action" => "play",
                        $idGame));
                }
            }
        }
    }
}