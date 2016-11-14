<!-- File: src/Template/Players/edit.ctp -->

<h1>Modifier un joueur</h1>
<?php
    echo $this->Form->create($player);
    echo $this->Form->input('name');
    echo $this->Form->input('hand');
    echo $this->Form->button(__("Sauvegarder le joueur"));
    echo $this->Form->end();
?>