<?php
namespace App\Controller;

class HandsController extends AppController
{

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
}