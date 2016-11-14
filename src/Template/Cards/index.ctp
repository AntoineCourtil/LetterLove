<!-- File: src/Template/Cards/index.ctp -->

<h1>Toutes les cartes</h1>

<?= $this->Html->link('Ajouter une carte', ['action' => 'add']) ?>

<table>
    <tr>
        <th>id</th>
        <th>Title</th>
        <th>Quantity</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($cards as $card): ?>
    <tr>
        <td><?= $card->id ?></td>
        <td>
            <?= $this->Html->link($card->title, ['action' => 'view', $card->id]) ?>
        </td>
        <td>
            <?= $card->quantity ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'Supprimer',
                ['action' => 'delete', $card->id],
                ['confirm' => 'Etes-vous sûr?'])
            ?>
            <?= $this->Html->link('Modifier', ['action' => 'edit', $card->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>