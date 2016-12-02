<?php namespace App\Controller;

use Cake\ORM\TableRegistry;

class CardsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Charge le FlashComponent
    }
    
    public function index()
    {
         $this->set('cards', $this->Cards->find('all'));
    }

    public function view($id = null)
    {
        $card = $this->Cards->get($id);
        $this->set(compact('card'));
    }
    
    public function add()
    {
        $card = $this->Cards->newEntity();
        if ($this->request->is('post')) {
            $card = $this->Cards->patchEntity($card, $this->request->data);
            if ($this->Cards->save($card)) {
                $this->Flash->success(__('Votre Carte a été sauvegardé.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter votre carte.'));
        }
        $this->set('card', $card);
    }
    
    public static function nameOfCard($idCard){
        
        if($idCard==null){
            return "";
        }
        
        $card = TableRegistry::get('Cards')->get($idCard);
        
        return $card->title;
        
    }
    
    public static function nameof(){
        $idCard = $_SESSION['idCard'];
        
        $card = TableRegistry::get('Cards')->get($idCard);
        
        $data = array();
        
        $data['status'] = 'success';
        $data['name'] = $card->title;
        
        echo json_encode($data);
        
    }

        public function edit($id = null)
    {
        $card = $this->Cards->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->Cards->patchEntity($card, $this->request->data);
            if ($this->Cards->save($card)) {
                $this->Flash->success(__('Votre carte a été mise à jour.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible de mettre à jour votre carte.'));
        }

        $this->set('card', $card);
    }
    
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $card = $this->Cards->get($id);
        if ($this->Cards->delete($card)) {
            $this->Flash->success(__("La carte avec l'id : {0} a été supprimée.", h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }
}