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
        <th>playing ?</th>
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
            <?= $game->playing ?>
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