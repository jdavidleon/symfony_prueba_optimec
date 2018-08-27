<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
     /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return array(
            array('/'),
            array('/products/list'),
            array('/products/list/2'),
            array('/products/list/1/id/ok'),
            array('/products/newProduct'),
            array('/products/newProduct/6'),
            array('/products/list/1/code'),
            array('/products/list/1/nameProduct'),
            array('/products/list/1/category'),
            array('/products/list/1/price'),

            array('/categories/list'),
            array('/categories/list/code'),
            array('/categories/list/nameCategory'),
            array('/categories/list/active'),
            array('/categories/newCategory'),
            array('/categories/newCategory/10'),
            array('/categories/list/id/ok'),
            array('/categories/products/1/id/1'),
            array('/categories/products/1/code/1'),
            array('/categories/products/1/nameProduct/1'),
            array('/categories/products/1/category/1'),
            array('/categories/products/1/price/1'),
        );
    }

}
