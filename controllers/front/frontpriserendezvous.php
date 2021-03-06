<?php
/**
 * Created by PhpStorm.
 * User: ballack
 * Date: 22/02/2019
 * Time: 18:16
 */

require_once _PS_MODULE_DIR_ . 'priserendezvous/classes/PriserendezvousModel.php';

class priserendezvousfrontpriserendezvousModuleFrontController extends ModuleFrontController
{
    /**
     * @see FrontController::initContent()
     */
    public function initContent()
    { parent::initContent();
    //$this->ajax = true; // enable ajax
        $tres="merci";
        $parameters = array();
       // $tres.=PriserendezvousModel::getRendezVs(Tools::getValue(2),Tools::getValue("2019-03-01"));
        $this->context->smarty->assign(array(
            //'orders' => $this->getProducts(),
            'test' => $tres,
            'prise_controller_url' => $this->context->link->getModuleLink('priserendezvous', 'frontpriserendezvous', $parameters)
        ));

        if(Tools::getValue("action_reponse")){
        $response=Priserendezvouscreneaux::getCrenneaux(1);
        $json = Tools::jsonEncode($response);
         $this->ajaxDie($json);

        }else if(Tools::getValue("action")){
            /*$customer = $this->context->customer;*/
            $rendezvs= new PriserendezvousModel();
            $rendezvs->id_client=$this->context->customer->id;
            $rendezvs->jour=Tools::getValue("jour");
            //$rendezvs->jour=new Date();
            $rendezvs->id_priserendezvouscreneaux=Tools::getValue("id_crenneaux");
            Mail::Send((int)(Configuration::get('PS_LANG_DEFAULT')), // defaut language id
                'contact',
                'Sujet du mail', array('{email}' => 'rodriguembah13@gmail.com', // sender email address
                    '{customer_firstname}' => $this->context->customer->firstname,
                    '{customer_lastname}' => $this->context->customer->lastname,
                    '{company}' =>$this->context->customer->company), 'rodriguembah13@gmail.com',
                'Service administratif', 'giecameroon');
            $rendezvs->save();
            $json = Tools::jsonEncode($rendezvs);
            $this->ajaxDie($json);

            /* Mail::Send(
                 (int)(Configuration::get('PS_LANG_DEFAULT')), // defaut language id
                 'contact', // email template file to be use
                 ' Module Installation', // email subject
                 array(
                     '{email}' => Configuration::get('PS_SHOP_EMAIL'), // sender email address
                     '{message}' => 'Hello world' // email content
                 ),
                 Configuration::get('PS_SHOP_EMAIL'), // receiver email address
                 $this->context->customer->firstname, //receiver name
                 'rodriguembah13@gmail.com', //from email address
                 'giecameroon' //from name
             );*/
        }else if(Tools::getValue("rendevs")){
           //$rend=$this->getRendezVs2(Tools::getValue("id_crenneau"),Tools::getValue("jour"));
            $rend=PriserendezvousModel::getRendezVs(Tools::getValue("id_crenneau"),Tools::getValue("jour"));
            //$response=Customer::getCustomers();

            if ($rend==0){
                $response=[
                    'resp'=>false,
                ];
            }else if($rend==1){
                $response=[
                    'resp'=>true,
                ];
            }
            $json = Tools::jsonEncode($rend);
            $this->ajaxDie($json);
        }else if (Tools::getValue("registredname")){
          //  $this->setTemplate('module:priserendezvous/views/templates/front/priserdv.tpl');
        }
        if ($this->context->customer->isLogged()) {

            //echo $this->context->customer->id;
            $this->setTemplate('module:priserendezvous/views/templates/front/priserdv.tpl');
        }else{
            Tools::redirect('index.php?controller=authentication?back=my-account');
           // $this->setTemplate('module:priserendezvous/views/templates/front/priserdvinit.tpl');
        }


}
    public function getRendezVs2($id_crenneaux,$jours){

        $sql = 'SELECT COUNT (d.`id_priserendezvous`)
            FROM `' . _DB_PREFIX_ . 'priserendezvous`d
            where  d.id_priserendezvouscreneaux ='.$id_crenneaux.' and d.jour='.$jours;

        $content = Db::getInstance()->executeS($sql);

        return $content;
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