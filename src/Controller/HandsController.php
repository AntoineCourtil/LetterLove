<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

class HandsController extends AppController
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
         $this->set('hands', $this->Hands->find('all'));
    }

    public function view($idHand = null)
    {
        $hand = $this->Hands->get($idHand);
        $this->set(compact('hand'));
    }
    
    public function add()
    {
        $hand = $this->Hands->newEntity();
        if ($this->request->is('post')) {
            $hand = $this->Hands->patchEntity($hand, $this->request->data);
            if ($this->Hands->save($hand)) {
                $this->Flash->success(__('Votre main a été sauvegardé.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter votre main.'));
        }
        $this->set('hand', $hand);
    }
    
    public function edit($idHand = null)
    {
        $hand = $this->Hands->get($idHand);
        if ($this->request->is(['post', 'put'])) {
            $this->Hands->patchEntity($hand, $this->request->data);
            if ($this->Hands->save($hand)) {
                $this->Flash->success(__('Votre main a été mise à jour.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible de mettre à jour votre main.'));
        }

        $this->set('hand', $hand);
    }
    
    public function delete($idHand)
    {
        $this->request->allowMethod(['post', 'delete']);

        $hand = $this->Hands->get($idHand);
        if ($this->Hands->delete($hand)) {
            $this->Flash->success(__("La main avec l'id : {0} a été supprimée.", h($idHand)));
            return $this->redirect(['action' => 'index']);
        }
    }
    
    
    //------------------------------------------------------------------------------------
    //                              HANDS FUNCTIONS
    //------------------------------------------------------------------------------------
    
    public static function haveCard($idHand, $idCard){
        $hand = TableRegistry::get('Hands')->get($idHand);
        
        if($hand->card1 == $idCard || $hand->card2 == $idCard || $hand->excard == $idCard){
            return true;
        }
        
        return false;
    }
    
    public static function nbcards($hand){
        $res = 0;
        
        if($hand->card1 != null){
            $res++;
        }
        if($hand->card2 != null){
            $res++;
        }
        
        return $res;
    }

    public static function addCard($idHand,$idCard){
        $hand = TableRegistry::get('Hands')->get($idHand);
        
        
        if($hand->card1==NULL){
            $hand->card1 = $idCard;
        }
        else{
            $hand->card2 = $idCard;
        }
        
        TableRegistry::get('Hands')->save($hand);
    }


    public static function newHand($idPlayer)
    {
        $hand = TableRegistry::get('Hands')->newEntity();
        
        $hand->idPlayer = $idPlayer;
        
        if (TableRegistry::get('Hands')->save($hand)) {
            return $hand->idHand;
        }
        else{
            //$this->Flash->error(__('Impossible d\'ajouter votre main.'));
        }
    }
}