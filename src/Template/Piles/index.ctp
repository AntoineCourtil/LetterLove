<!-- File: src/Template/Piles/index.ctp -->

<h1>Toutes les piles</h1>

<?= $this->Html->link('Ajouter une pile', ['action' => 'add']) ?>

<table>
    <tr>
        <th>IdPile</th>
        <th>Type</th>
        <th>Card1</th>
        <th>Card2</th>
        <th>Card3</th>
        <th>Card4</th>
        <th>Card5</th>
        <th>Card6</th>
        <th>Card7</th>
        <th>Card8</th>
        <th>Card9</th>
        <th>Card10</th>
        <th>Card11</th>
        <th>Card12</th>
        <th>Card13</th>
        <th>Card14</th>
        <th>Card15</th>
        <th>Card16</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($piles as $pile): ?>
    <tr>
        <td><?= $this->Html->link($pile->idPile, ['action' => 'view', $pile->idPile]) ?></td>
        <td>
            <?= $pile->type ?>
        </td>
        <td>
            <?= $pile->card1 ?>
        </td>
        <td>
            <?= $pile->card2 ?>
        </td>
        <td>
            <?= $pile->card3 ?>
        </td>
        <td>
            <?= $pile->card4 ?>
        </td>
        <td>
            <?= $pile->card5 ?>
        </td>
        <td>
            <?= $pile->card6 ?>
        </td>
        <td>
            <?= $pile->card7 ?>
        </td>
        <td>
            <?= $pile->card8 ?>
        </td>
        <td>
            <?= $pile->card9 ?>
        </td>
        <td>
            <?= $pile->card10 ?>
        </td>
        <td>
            <?= $pile->card11 ?>
        </td>
        <td>
            <?= $pile->card12 ?>
        </td>
        <td>
            <?= $pile->card13 ?>
        </td>
        <td>
            <?= $pile->card14 ?>
        </td>
        <td>
            <?= $pile->card15 ?>
        </td>
        <td>
            <?= $pile->card16 ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'Supprimer',
                ['action' => 'delete', $pile->idPile],
                ['confirm' => 'Etes-vous sûr?'])
            ?>
            <?= $this->Html->link('Modifier', ['action' => 'edit', $pile->idPile]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>