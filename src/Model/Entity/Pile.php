<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pile Entity
 *
 * @property int $idPile
 * @property int $card1
 * @property int $card2
 * @property int $card3
 * @property int $card4
 * @property int $card5
 * @property int $card6
 * @property int $card7
 * @property int $card8
 * @property int $card9
 * @property int $card10
 * @property int $card11
 * @property int $card12
 * @property int $card13
 * @property int $card14
 * @property int $card15
 * @property int $card16
 */
class Pile extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'idPile' => false
    ];
}
