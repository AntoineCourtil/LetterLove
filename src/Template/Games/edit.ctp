<!-- File: src/Template/Games/edit.ctp -->

<h1>Modifier une partie</h1>
<?php
    echo $this->Form->create($game);
    echo $this->Form->input('player1');
    echo $this->Form->input('player2');
    echo $this->Form->input('player3');
    echo $this->Form->input('player4');
    echo $this->Form->input('pioche');
    echo $this->Form->input('defausse');
    echo $this->Form->input('carteDefaussee');
    echo $this->Form->input('tourPlayer');
    echo $this->Form->input('playing');
    echo $this->Form->button(__("Sauvegarder la partie"));
    echo $this->Form->end();
?>