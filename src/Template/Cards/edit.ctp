<!-- File: src/Template/Cards/edit.ctp -->

<h1>Modifier une carte</h1>
<?php
    echo $this->Form->create($card);
    echo $this->Form->input('title');
    echo $this->Form->input('quantity');
    echo $this->Form->button(__("Sauvegarder la carte"));
    echo $this->Form->end();
?>