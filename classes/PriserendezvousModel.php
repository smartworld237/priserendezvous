<?php
/**
 * Created by PhpStorm.
 * User: ballack
 * Date: 22/02/2019
 * Time: 17:59
 */

class PriserendezvousModel extends ObjectModel
{
    public $id_priserendezvous;
    public $id_client;
    public $id_priserendezvouscreneaux;
    public $jour;
    public static $definition = array(
        'table' => 'Priserendezvous',
        'primary' => 'id_priserendezvous',
        // 'multilang' => true,
        'fields' => array(
            // Lang fields
            'id_client' => array('type' => self::TYPE_INT),
            'id_priserendezvouscreneaux'=>array('type' => self::TYPE_INT),
           'jour'=>array('type' => self::TYPE_DATE),

        ),

    );
public function getRendezVs($id_crenneaux,$jours){
    $result=false;
    $sql = 'SELECT EXISTS(SELECT  d.`*`
            FROM `' . _DB_PREFIX_ . 'priserendezvous`d
            where  d.id_priserendezvouscreneaux ='.$id_crenneaux.' and d.jour='.$jours.')';

    $content = Db::getInstance()->executeS($sql);
if($content=== null){
    $result=false;
}else{
    $result=true;
}
    return $content;
}
}