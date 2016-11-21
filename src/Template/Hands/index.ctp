<!-- File: src/Template/Hands/index.ctp -->

<h1>Toutes les mains</h1>

<?= $this->Html->link('Ajouter une main', ['action' => 'add']) ?>

<table>
    <tr>
        <th>idHand</th>
        <th>idPlayer</th>
        <th>Card1</th>
        <th>Card2</th>
        <th>Actions</th>
    </tr>

    <!-- Ici se trouve l'itération sur l'objet query de nos $articles, l'affichage des infos des articles -->

    <?php foreach ($hands as $hand): ?>
    <tr>
        <td><?= $hand->idHand ?></td>
        <td>
            <?= $hand->idPlayer ?>
        </td>
        <td>
            <?= $hand->card1 ?>
        </td>
        <td>
            <?= $hand->card2 ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'Supprimer',
                ['action' => 'delete', $hand->idHand],
                ['confirm' => 'Etes-vous sûr?'])
            ?>
            <?= $this->Html->link('Modifier', ['action' => 'edit', $hand->idHand]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>