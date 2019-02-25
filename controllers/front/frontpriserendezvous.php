<?php
/**
 * Created by PhpStorm.
 * User: ballack
 * Date: 22/02/2019
 * Time: 18:16
 */

class priserendezvousfrontpriserendezvousModuleFrontController extends ModuleFrontController
{
    /**
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        $parameters = array();
        $this->context->smarty->assign(array(
            //'orders' => $this->getProducts(),
            //'test' => 'reza',
            //'devis_controller_url' => $this->context->link->getModuleLink('devisservice', 'servicebackup', $parameters)
        ));
        parent::initContent();
        if (Tools::isSubmit('submitbackup')) {
            $this->context->smarty->assign(array(
                //'orders' => $this->getProducts(),
                'test' => 'reza',
            ));
            $this->processService();
        }
        $this->setTemplate('module:priserendezvous/views/templates/front/priserdv.tpl');

    }

    public function processService()
    {
        $customer = $this->context->customer;

        $devis = new ServiceDevisModel();
        $devisservice = new DemandeServiceModel();
        $devisservice->id_client = $customer->id;
        $devis->libelle1 = Tools::getValue('localite');
        //$devis->libelle1_1=Tools::getValue('coupureCheckbox1');
        $devis->libelle2 = Tools::getValue('coupureCheckbox1');
        //$devis->libelle2_1=Tools::getValue('localite2');
        $devis->libelle3 = Tools::getValue('qte_electrique');
        $devis->libelle4 = Tools::getValue('localite2');
        $devis->libelle5 = Tools::getValue('appareils');
        $devis->libelle5_1 = Tools::getValue('ampoule');
        $devis->libelle5_1_1 = Tools::getValue('home');
        $devis->libelle5_1_2 = Tools::getValue('rephome');
        $devis->libelle5_1_3 = Tools::getValue('rephome1');
        $devis->libelle5_2 = Tools::getValue('frigo-congelateur');
        $devis->libelle5_2_1 = Tools::getValue('frigo-congelateur-qte');
        $devis->libelle5_3 = Tools::getValue('television');
        $devis->libelle5_3_1 = Tools::getValue('television-puissance');
        $devis->libelle5_3_2 = Tools::getValue('television-quantite');
        $devis->libelle5_3_3 = Tools::getValue('television-taille');
        $devis->libelle5_3_4 = Tools::getValue('television-type');
        $devis->libelle5_4= Tools::getValue('ventilateur');
        $devis->libelle5_4_1 = Tools::getValue('ventilateur-quantite');
        $devis->libelle5_4_2 = Tools::getValue('ventilateur-quantite-prevoir');
        $devis->typeservice = "service-backup";
        $devis->save();
        $sql='SELECT id_devisservicemodel as id FROM `' . _DB_PREFIX_ . 'devisservicemodel` ORDER BY id_devisservicemodel DESC LIMIT 1 ';
        $content = Db::getInstance()->executeS($sql);
        foreach ($content as $co){
            $devisservice->id_devisservicemodel =$co['id'];
            $devisservice->save();
        }

    }


}