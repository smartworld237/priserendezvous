<?php
/**
 * Created by PhpStorm.
 * User: ballack
 * Date: 22/02/2019
 * Time: 17:59
 */

class Priserendezvouscreneaux extends ObjectModel
{
    public $id_priserendezvouscreneaux;
    public $id_priserendezvousdepartement;

    public $hdebut;
    public $hfin;
    public $mdebut;public $mfin;
    public static $definition = array(
        'table' => 'priserendezvouscreneaux',
        'primary' => 'id_priserendezvouscreneaux',
        // 'multilang' => true,
        'fields' => array(
            // Lang fields
            'id_priserendezvousdepartement' => array('type' => self::TYPE_INT),
            'hdebut'=>array('type' => self::TYPE_INT),
            'hfin'=>array('type' => self::TYPE_INT),
            'mdebut'=>array('type' => self::TYPE_INT),
            'mfin'=>array('type' => self::TYPE_INT),

        ),

    );
    public function getCrenneaux($iddepartement){
        $sql = 'SELECT  d.*
            FROM `' . _DB_PREFIX_ . 'priserendezvouscreneaux`d
            where  d.id_priserendezvousdepartement ='.$iddepartement;

        $content = Db::getInstance()->executeS($sql);

        return $content;
    }
}