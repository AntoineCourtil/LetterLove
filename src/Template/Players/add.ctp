<!-- File: src/Template/Players/add.ctp -->

<h1>Ajouter un joueur</h1>
<?php
    echo $this->Form->create($player);
    echo $this->Form->input('name');
    echo $this->Form->input('hand');
    echo $this->Form->input('defausse');
    echo $this->Form->input('ready');
    echo $this->Form->input('playing');
    echo $this->Form->input('protected');
    echo $this->Form->button(__("Sauvegarder le Joueur"));
    echo $this->Form->end();
?>