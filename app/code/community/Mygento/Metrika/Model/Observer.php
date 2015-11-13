<?php

/**
 *
 * @category   Mygento
 * @package    Mygento_Metrika
 * @copyright  Copyright © 2015 NKS LLC. (http://www.mygento.ru)
 */
class Mygento_Metrika_Model_Observer
{

    public function addToCartComplete($observer)
    {
        $product = $observer->getProduct();
        $params = $observer->getRequest()->getParams();

        $data = array(
            "ecommerce" => array(
                "add" => array(
                    "products" => array(
                        "id" => $product->getSku(),
                        "name" => $product->getName(),
                        "price" => $product->getPrice(),
                        //"brand" => "Яндекс / Яndex",
                        //"category" => "Аксессуары/Сумки",
                        "quantity" => ($params['qty'] == 0 ? 1 : $params['qty']),
                    )
                )
            )
        );
        Mage::getSingleton('core/session')->setMetrika($data);
    }

    public function removeFromCartComplete($observer)
    {
        $product = $observer->getQuoteItem()->getProduct();
        $data = array(
            "ecommerce" => array(
                "remove" => array(
                    "products" => array(
                        "id" => $product->getSku(),
                        "name" => $product->getName(),
                    )
                )
            )
        );
        Mage::getSingleton('core/session')->setMetrika($data);
    }
}
