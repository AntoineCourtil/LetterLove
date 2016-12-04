<!-- File: src/Template/Players/create.ctp -->

<h1>Créer un joueur</h1>
<?php
    echo $this->Form->create($player);
    echo $this->Form->input('name');
    echo $this->Form->button(__("Sauvegarder le Joueur"));
    echo $this->Form->end();
?>
