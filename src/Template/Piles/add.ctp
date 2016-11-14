<!-- File: src/Template/Piles/add.ctp -->

<h1>Ajouter une pile</h1>
<?php
    echo $this->Form->create($pile);
    echo $this->Form->input('card1');
    echo $this->Form->input('card2');
    echo $this->Form->input('card3');
    echo $this->Form->input('card4');
    echo $this->Form->input('card5');
    echo $this->Form->input('card6');
    echo $this->Form->input('card7');
    echo $this->Form->input('card8');
    echo $this->Form->input('card9');
    echo $this->Form->input('card10');
    echo $this->Form->input('card11');
    echo $this->Form->input('card12');
    echo $this->Form->input('card13');
    echo $this->Form->input('card14');
    echo $this->Form->input('card15');
    echo $this->Form->input('card16');
    echo $this->Form->button(__("Sauvegarder la pile"));
    echo $this->Form->end();
?>