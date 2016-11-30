<!-- File: src/Template/Players/index.ctp -->

<h1>Tous les joueurs</h1>

<?= $this->Html->link('Ajouter un joueur', ['action' => 'add']) ?>

<table>
    <tr>
        <th>idPlayer</th>
        <th>name</th>
        <th>hand</th>
        <th>defausse</th>
        <th>ready ?</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($players as $player): ?>
    <tr>
        <td><?= $player->idPlayer ?></td>
        <td>
            <?= $this->Html->link($player->name, ['action' => 'view', $player->idPlayer]) ?>
        </td>
        <td>
            <?= $player->hand ?>
        </td>
        <td>
            <?= $player->defausse ?>
        </td>
        <td>
            <?= $player->ready ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'Supprimer',
                ['action' => 'delete', $player->idPlayer],
                ['confirm' => 'Etes-vous sûr?'])
            ?>
            <?= $this->Html->link('Modifier', ['action' => 'edit', $player->idPlayer]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>