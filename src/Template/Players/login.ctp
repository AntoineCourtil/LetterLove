<!-- File: src/Template/Players/login.ctp -->

<h1>Connexion</h1>
<?php
    echo $this->Form->create();
    echo $this->Form->input('name');
    echo $this->Form->button(__("Connexion"));
    echo $this->Form->end();
?>
