<!-- File: src/Template/Hands/add.ctp -->

<h1>Ajouter une main</h1>
<?php
    echo $this->Form->create($hand);
    echo $this->Form->input('card1');
    echo $this->Form->input('card2');
    echo $this->Form->button(__("Sauvegarder la main"));
    echo $this->Form->end();
?>