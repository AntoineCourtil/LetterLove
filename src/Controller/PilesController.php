<?php namespace App\Controller;

use \Cake\ORM\TableRegistry;
use App\Controller\CardsController;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class PilesController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash'); // Charge le FlashComponent
    }
    
    public function index()
    {
         $this->set('piles', $this->Piles->find('all'));
    }

    public function view($idPile = null)
    {
        $pile = $this->Piles->get($idPile);
        $this->set(compact('pile'));
    }
    
    
    
    public static function listpile(){
        $idGame = $_SESSION['idGame'];
        
        $game = TableRegistry::get('Games')->get($idGame);
        
        $idPile = $game->defausse;
        
        $pile = TableRegistry::get('Piles')->get($idPile);
        
        $data = array();
        
        $data['card1']="null";
        $data['card2']="null";
        $data['card3']="null";
        $data['card4']="null";
        $data['card5']="null";
        $data['card6']="null";
        $data['card7']="null";
        $data['card8']="null";
        $data['card9']="null";
        $data['card10']="null";
        $data['card11']="null";
        $data['card12']="null";
        $data['card13']="null";
        $data['card14']="null";
        $data['card15']="null";
        $data['card16']="null";
        
        if($pile->card1 != null){
            $data['card1'] =  CardsController::nameOfCard($pile->card1);
        }
        if($pile->card2 != null){
            $data['card2'] = CardsController::nameOfCard($pile->card2);
        }
        if($pile->card3 != null){
            $data['card3'] = CardsController::nameOfCard($pile->card3);
        }
        if($pile->card4 != null){
            $data['card4'] = CardsController::nameOfCard($pile->card4);
        }
        if($pile->card5 != null){
            $data['card5'] = CardsController::nameOfCard($pile->card5);
        }
        if($pile->card6 != null){
            $data['card6'] = CardsController::nameOfCard($pile->card6);
        }
        if($pile->card7 != null){
            $data['card7'] = CardsController::nameOfCard($pile->card7);
        }
        if($pile->card8 != null){
            $data['card8'] = CardsController::nameOfCard($pile->card8);
        }
        if($pile->card9 != null){
            $data['card1'] = CardsController::nameOfCard($pile->card9);
        }
        if($pile->card10 != null){
            $data['card10'] = CardsController::nameOfCard($pile->card10);
        }
        if($pile->card11 != null){
            $data['card11'] = CardsController::nameOfCard($pile->card11);
        }
        if($pile->card12 != null){
            $data['card12'] = CardsController::nameOfCard($pile->card12);
        }
        if($pile->card13 != null){
            $data['card13'] = CardsController::nameOfCard($pile->card13);
        }
        if($pile->card14 != null){
            $data['card14'] = CardsController::nameOfCard($pile->card14);
        }
        if($pile->card15 != null){
            $data['card15'] = CardsController::nameOfCard($pile->card15);
        }
        if($pile->card16 != null){
            $data['card16'] = CardsController::nameOfCard($pile->card16);
        }
        
        
        $data['status'] = 'success';
        
        echo json_encode($data);
        
    }
    
    public static function listpile2($idPile){
        
        $pile = TableRegistry::get('Piles')->get($idPile);
        
        $data = array();
        
        $data['card1']="null";
        $data['card2']="null";
        $data['card3']="null";
        $data['card4']="null";
        $data['card5']="null";
        $data['card6']="null";
        $data['card7']="null";
        $data['card8']="null";
        $data['card9']="null";
        $data['card10']="null";
        $data['card11']="null";
        $data['card12']="null";
        $data['card13']="null";
        $data['card14']="null";
        $data['card15']="null";
        $data['card16']="null";
        
        if($pile->card1 != null){
            $data['card1'] =  CardsController::nameOfCard($pile->card1);
        }
        if($pile->card2 != null){
            $data['card2'] = CardsController::nameOfCard($pile->card2);
        }
        if($pile->card3 != null){
            $data['card3'] = CardsController::nameOfCard($pile->card3);
        }
        if($pile->card4 != null){
            $data['card4'] = CardsController::nameOfCard($pile->card4);
        }
        if($pile->card5 != null){
            $data['card5'] = CardsController::nameOfCard($pile->card5);
        }
        if($pile->card6 != null){
            $data['card6'] = CardsController::nameOfCard($pile->card6);
        }
        if($pile->card7 != null){
            $data['card7'] = CardsController::nameOfCard($pile->card7);
        }
        if($pile->card8 != null){
            $data['card8'] = CardsController::nameOfCard($pile->card8);
        }
        if($pile->card9 != null){
            $data['card1'] = CardsController::nameOfCard($pile->card9);
        }
        if($pile->card10 != null){
            $data['card10'] = CardsController::nameOfCard($pile->card10);
        }
        if($pile->card11 != null){
            $data['card11'] = CardsController::nameOfCard($pile->card11);
        }
        if($pile->card12 != null){
            $data['card12'] = CardsController::nameOfCard($pile->card12);
        }
        if($pile->card13 != null){
            $data['card13'] = CardsController::nameOfCard($pile->card13);
        }
        if($pile->card14 != null){
            $data['card14'] = CardsController::nameOfCard($pile->card14);
        }
        if($pile->card15 != null){
            $data['card15'] = CardsController::nameOfCard($pile->card15);
        }
        if($pile->card16 != null){
            $data['card16'] = CardsController::nameOfCard($pile->card16);
        }
        
        
        $data['status'] = 'success';
        
        echo json_encode($data);
        
    }
    
    public static function newDefausse(){
        
        $defausse = TableRegistry::get('Piles')->newEntity();
        $defausse->set('type', 'defausse');
         
        if (TableRegistry::get('Piles')->save($defausse)) {
            //$this->Flash->success(__('Votre pioche a été créee.'));
            return $defausse;
        }
    }

    public static function newPioche()
    {
        $pioche = TableRegistry::get('Piles')->newEntity();
        $pioche->set('type', 'pioche');
        
        $tab = [1,1,1,1,1,2,2,3,3,4,4,5,5,6,7,8];
        
        shuffle($tab);shuffle($tab);shuffle($tab);
        
        $pioche->set('card1', $tab[0]);
        $pioche->set('card2', $tab[1]);
        $pioche->set('card3', $tab[2]);
        $pioche->set('card4', $tab[3]);
        $pioche->set('card5', $tab[4]);
        $pioche->set('card6', $tab[5]);
        $pioche->set('card7', $tab[6]);
        $pioche->set('card8', $tab[7]);
        $pioche->set('card9', $tab[8]);
        $pioche->set('card10', $tab[9]);
        $pioche->set('card11', $tab[10]);
        $pioche->set('card12', $tab[11]);
        $pioche->set('card13', $tab[12]);
        $pioche->set('card14', $tab[13]);
        $pioche->set('card15', $tab[14]);
        $pioche->set('card16', $tab[15]);
         
        if (TableRegistry::get('Piles')->save($pioche)) {
            //$this->Flash->success(__('Votre pioche a été créee.'));
            return $pioche;
        }
        
    }
    
    public static function defausse($defausse, $idCard){
        if($defausse->get('card16')==NULL){
            $defausse->set('card16',$idCard);
        }
        else if($defausse->get('card15')==NULL){
            $defausse->set('card15',$idCard);
        }
        else if($defausse->get('card14')==NULL){
            $defausse->set('card14',$idCard);
        }
        else if($defausse->get('card13')==NULL){
            $defausse->set('card13',$idCard);
        }
        else if($defausse->get('card12')==NULL){
            $defausse->set('card12',$idCard);
        }
        else if($defausse->get('card11')==NULL){
            $defausse->set('card11',$idCard);
        }
        else if($defausse->get('card10')==NULL){
            $defausse->set('card10',$idCard);
        }
        else if($defausse->get('card9')==NULL){
            $defausse->set('card9',$idCard);
        }
        else if($defausse->get('card8')==NULL){
            $defausse->set('card8',$idCard);
        }
        else if($defausse->get('card7')==NULL){
            $defausse->set('card7',$idCard);
        }
        else if($defausse->get('card6')==NULL){
            $defausse->set('card6',$idCard);
        }
        else if($defausse->get('card5')==NULL){
            $defausse->set('card5',$idCard);
        }
        else if($defausse->get('card4')==NULL){
            $defausse->set('card4',$idCard);
        }
        else if($defausse->get('card3')==NULL){
            $defausse->set('card3',$idCard);
        }
        else if($defausse->get('card2')==NULL){
            $defausse->set('card2',$idCard);
        }
        else if($defausse->get('card1')==NULL){
            $defausse->set('card1',$idCard);
        }
        
        TableRegistry::get('Piles')->save($defausse);
    }
    
    public static function pioche($pioche){
        if ($pioche->get('card1')!=NULL){
            $idCard = $pioche->get('card1');
            $pioche->set('card1',NULL);
        }
        else if($pioche->get('card2')!=NULL){
            $idCard = $pioche->get('card2');
            $pioche->set('card2',NULL);
        }
        else if($pioche->get('card3')!=NULL){
            $idCard = $pioche->get('card3');
            $pioche->set('card3',NULL);
        }
        else if($pioche->get('card4')!=NULL){
            $idCard = $pioche->get('card4');
            $pioche->set('card4',NULL);
        }
        else if($pioche->get('card5')!=NULL){
            $idCard = $pioche->get('card5');
            $pioche->set('card5',NULL);
        }
        else if($pioche->get('card6')!=NULL){
            $idCard = $pioche->get('card6');
            $pioche->set('card6',NULL);
        }
        else if($pioche->get('card7')!=NULL){
            $idCard = $pioche->get('card7');
            $pioche->set('card7',NULL);
        }
        else if($pioche->get('card8')!=NULL){
            $idCard = $pioche->get('card8');
            $pioche->set('card8',NULL);
        }
        else if($pioche->get('card9')!=NULL){
            $idCard = $pioche->get('card9');
            $pioche->set('card9',NULL);
        }
        else if($pioche->get('card10')!=NULL){
            $idCard = $pioche->get('card10');
            $pioche->set('card10',NULL);
        }
        else if($pioche->get('card11')!=NULL){
            $idCard = $pioche->get('card11');
            $pioche->set('card11',NULL);
        }
        else if($pioche->get('card12')!=NULL){
            $idCard = $pioche->get('card12');
            $pioche->set('card12',NULL);
        }
        else if($pioche->get('card13')!=NULL){
            $idCard = $pioche->get('card13');
            $pioche->set('card13',NULL);
        }
        else if($pioche->get('card14')!=NULL){
            $idCard = $pioche->get('card14');
            $pioche->set('card14',NULL);
        }
        else if($pioche->get('card15')!=NULL){
            $idCard = $pioche->get('card15');
            $pioche->set('card15',NULL);
        }
        else if($pioche->get('card16')!=NULL){
            $idCard = $pioche->get('card16');
            $pioche->set('card16',NULL);
        }
        
        TableRegistry::get('Piles')->save($pioche);
        
        return $idCard;
    }
    
    public static function getFirstCard($idPile){
        $pile = TableRegistry::get('Piles')->get($idPile);
        
        if($pile->get('card1')!=NULL){
            return $pile->get('card1');
        }
        if($pile->get('card2')!=NULL){
            return $pile->get('card2');
        }
        if($pile->get('card3')!=NULL){
            return $pile->get('card3');
        }
        if($pile->get('card4')!=NULL){
            return $pile->get('card4');
        }
        if($pile->get('card5')!=NULL){
            return $pile->get('card5');
        }
        if($pile->get('card6')!=NULL){
            return $pile->get('card6');
        }
        if($pile->get('card7')!=NULL){
            return $pile->get('card7');
        }
        if($pile->get('card8')!=NULL){
            return $pile->get('card8');
        }
        if($pile->get('card9')!=NULL){
            return $pile->get('card9');
        }
        if($pile->get('card10')!=NULL){
            return $pile->get('card10');
        }
        if($pile->get('card11')!=NULL){
            return $pile->get('card11');
        }
        if($pile->get('card12')!=NULL){
            return $pile->get('card12');
        }
        if($pile->get('card13')!=NULL){
            return $pile->get('card13');
        }
        if($pile->get('card14')!=NULL){
            return $pile->get('card14');
        }
        if($pile->get('card15')!=NULL){
            return $pile->get('card15');
        }
        if($pile->get('card16')!=NULL){
            return $pile->get('card16');
        }
        
        return 0;
    }
    
    /*public static function getLastCard($idPile){
        $pile = TableRegistry::get('Piles')->get($idPile);
        
        if($pile->get('card16')!=NULL){
            return $pile->get('card16');
        }
        if($pile->get('card15')!=NULL){
            return $pile->get('card15');
        }
        if($pile->get('card14')!=NULL){
            return $pile->get('card14');
        }
        if($pile->get('card13')!=NULL){
            return $pile->get('card13');
        }
        if($pile->get('card12')!=NULL){
            return $pile->get('card12');
        }
        if($pile->get('card11')!=NULL){
            return $pile->get('card11');
        }
        if($pile->get('card10')!=NULL){
            return $pile->get('card10');
        }
        if($pile->get('card9')!=NULL){
            return $pile->get('card9');
        }
        if($pile->get('card8')!=NULL){
            return $pile->get('card8');
        }
        if($pile->get('card7')!=NULL){
            return $pile->get('card7');
        }
        if($pile->get('card6')!=NULL){
            return $pile->get('card6');
        }
        if($pile->get('card5')!=NULL){
            return $pile->get('card5');
        }
        if($pile->get('card4')!=NULL){
            return $pile->get('card4');
        }
        if($pile->get('card3')!=NULL){
            return $pile->get('card3');
        }
        if($pile->get('card2')!=NULL){
            return $pile->get('card2');
        }
        if($pile->get('card1')!=NULL){
            return $pile->get('card1');
        }
        
        return 0;
    }*/
    
    public static function count($idPile){
        $count=0;
        
        $pile = TableRegistry::get('Piles')->get($idPile);
        
        if($pile->get('card1')!=NULL){
            $count++;
        }
        if($pile->get('card2')!=NULL){
            $count++;
        }
        if($pile->get('card3')!=NULL){
            $count++;
        }
        if($pile->get('card4')!=NULL){
            $count++;
        }
        if($pile->get('card5')!=NULL){
            $count++;
        }
        if($pile->get('card6')!=NULL){
            $count++;
        }
        if($pile->get('card7')!=NULL){
            $count++;
        }
        if($pile->get('card8')!=NULL){
            $count++;
        }
        if($pile->get('card9')!=NULL){
            $count++;
        }
        if($pile->get('card10')!=NULL){
            $count++;
        }
        if($pile->get('card11')!=NULL){
            $count++;
        }
        if($pile->get('card12')!=NULL){
            $count++;
        }
        if($pile->get('card13')!=NULL){
            $count++;
        }
        if($pile->get('card14')!=NULL){
            $count++;
        }
        if($pile->get('card15')!=NULL){
            $count++;
        }
        if($pile->get('card16')!=NULL){
            $count++;
        }
        
        return $count;
    }
    
    public function add()
    {
        $pile = $this->Piles->newEntity();
        if ($this->request->is('post')) {
            $pile = $this->Piles->patchEntity($pile, $this->request->data);
            if ($this->Piles->save($pile)) {
                $this->Flash->success(__('Votre Carte a été sauvegardé.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter votre carte.'));
        }
        $this->set('pile', $pile);
    }
    
    public function edit($idPile = null)
    {
        $pile = $this->Piles->get($idPile);
        if ($this->request->is(['post', 'put'])) {
            $this->Piles->patchEntity($pile, $this->request->data);
            if ($this->Piles->save($pile)) {
                $this->Flash->success(__('Votre carte a été mise à jour.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible de mettre à jour votre carte.'));
        }

        $this->set('pile', $pile);
    }
    
    public function delete($idPile)
    {
        $this->request->allowMethod(['post', 'delete']);

        $pile = $this->Piles->get($idPile);
        if ($this->Piles->delete($pile)) {
            $this->Flash->success(__("La carte avec l'id : {0} a été supprimée.", h($idPile)));
            return $this->redirect(['action' => 'index']);
        }
    }
}