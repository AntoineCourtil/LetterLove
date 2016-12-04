<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Hand Entity
 *
 * @property int $idHand
 * @property int $card1
 * @property int $card2
 * @property int $idPlayer
 * @property int $excard
 */
class Hand extends Entity
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
        'idHand' => false
    ];
}
