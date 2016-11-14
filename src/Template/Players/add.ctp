<!-- File: src/Template/Players/add.ctp -->

<h1>Ajouter un joueur</h1>
<?php
    echo $this->Form->create($player);
    echo $this->Form->input('name');
    echo $this->Form->input('hand');
    echo $this->Form->button(__("Sauvegarder le Joueur"));
    echo $this->Form->end();
?>