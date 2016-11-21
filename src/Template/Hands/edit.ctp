<!-- File: src/Template/Hands/edit.ctp -->

<h1>Modifier une main</h1>
<?php
    echo $this->Form->create($hand);
    echo $this->Form->input('idPlayer');
    echo $this->Form->input('card1');
    echo $this->Form->input('card2');
    echo $this->Form->button(__("Sauvegarder la main"));
    echo $this->Form->end();
?>