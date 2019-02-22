<?php
/**
 * Created by PhpStorm.
 * User: ballack
 * Date: 22/02/2019
 * Time: 17:59
 */

class Priserendezvous extends ObjectModel
{
    public $id_priserendezvous;
    public $id_client;
    public $id_priserendezvouscreneaux;
    public $jour;
    public static $definition = array(
        'table' => 'priserendezvous',
        'primary' => 'id_priserendezvous',
        // 'multilang' => true,
        'fields' => array(
            // Lang fields
            'id_client' => array('type' => self::TYPE_INT),
            'id_priserendezvouscreneaux'=>array('type' => self::TYPE_INT),
           'jour'=>array('type' => self::TYPE_DATE),

        ),

    );

}