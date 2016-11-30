<!-- File: src/Template/Games/index.ctp -->

<h1>Toutes les games</h1>

<?= $this->Html->link('Ajouter une partie', ['action' => 'add']) ?>

<table>
    <tr>
        <th>idGame</th>
        <th>player1</th>
        <th>player2</th>
        <th>player3</th>
        <th>player4</th>
        <th>pioche</th>
        <th>defausse</th>
        <th>carte defaussée</th>
        <th>tour joueur</th>
        <th>playing ?</th>
        <th>finished ?</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($games as $game): ?>
    <tr>
        <td><?= $game->idGame ?></td>
        <td>
            <?= $game->player1 ?>
        </td>
        <td>
            <?= $game->player2 ?>
        </td>
        <td>
            <?= $game->player3 ?>
        </td>
        <td>
            <?= $game->player4 ?>
        </td>
        <td>
            <?= $game->pioche ?>
        </td>
        <td>
            <?= $game->defausse ?>
        </td>
        <td>
            <?= $game->carteDefaussee ?>
        </td>
        <td>
            <?= $game->tourPlayer ?>
        </td>
        <td>
            <?= $game->playing ?>
        </td>
        <td>
            <?= $game->finished ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'Supprimer',
                ['action' => 'delete', $game->idGame],
                ['confirm' => 'Etes-vous sûr?'])
            ?>
            <?= $this->Html->link('Modifier', ['action' => 'edit', $game->idGame]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>