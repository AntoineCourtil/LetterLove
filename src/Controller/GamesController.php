<?php namespace App\Controller;

use App\Controller\PilesController;

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

    public function play($idGame = null)
    {
        if($idGame==null){
            $game = $this->Games->newEntity();
            $pioche = PilesController::newPioche();
            $defausse = PilesController::newDefausse();
            
            $playing = false;
            
            $game->pioche = $pioche->get('idPile');            
            $game->defausse = $defausse->get('idPile');
            $game->playing = $playing;
            
            $cartePiochee = PilesController::pioche($pioche);
            echo 'carte piochée : '.$cartePiochee;
            PilesController::defausse($defausse, $cartePiochee);
            
            if ($this->Games->save($game)) {
                $this->Flash->success(__('Votre partie a été créee.'));
                return $this->redirect(['action' => 'play', $game->idGame]);
            }
            else{
                $this->Flash->error(__('Impossible d\'ajouter votre partie.'));
            }
        }
        
        else{
            $game = $this->Games->get($idGame);
        }
        
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
}