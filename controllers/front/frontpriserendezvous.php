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
        $tres="merci";
        $parameters = array();
        $this->context->smarty->assign(array(
            //'orders' => $this->getProducts(),
            'test' => $tres,
            'prise_controller_url' => $this->context->link->getModuleLink('priserendezvous', 'frontpriserendezvous', $parameters)
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
if(Tools::getValue("action_name")){
   // $tres="azerty";
      $response=Customer::getCustomers();
    $json = Tools::jsonEncode($response);
    $this->ajaxDie($json);
}
    }

    public function processService()
    {
        $customer = $this->context->customer;

        $devis = new ServiceDevisModel();
        $devisservice = new DemandeServiceModel();
        $devisservice->id_client = $customer->id;
        $devis->libelle1 = Tools::getValue('localite');
        //$devis->libelle1_1=Tools::getValue('coupureCheckbox1');


        $devis->save();
        $sql='SELECT id_devisservicemodel as id FROM `' . _DB_PREFIX_ . 'devisservicemodel` ORDER BY id_devisservicemodel DESC LIMIT 1 ';
        $content = Db::getInstance()->executeS($sql);
        foreach ($content as $co){
            $devisservice->id_devisservicemodel =$co['id'];
            $devisservice->save();
        }

    }


}