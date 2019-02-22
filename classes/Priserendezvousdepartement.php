<?php
/**
 * Created by PhpStorm.
 * User: ballack
 * Date: 22/02/2019
 * Time: 17:58
 */

class Priserendezvousdepartement extends ObjectModel
{
    public $id_priserendezvousdepartement;

    public $nom_departement;
    public $telephone;
    public static $definition = array(
        'table' => 'priserendezvousdepartement',
        'primary' => 'id_priserendezvousdepartement',
        // 'multilang' => true,
        'fields' => array(
            // Lang fields
            'nom_departement' => array('type' => self::TYPE_STRING,'lang' => true),
            'telephone' => array('type' => self::TYPE_STRING,'lang' => false),
        ),

    );
}