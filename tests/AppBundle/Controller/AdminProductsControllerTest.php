<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validation;


class AdminProductsControllerTest extends WebTestCase
{
    public function testNewProduct()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/products/newProduct');

		$this->assertEquals(200, $client->getResponse()->getStatusCode());
    	$form = $crawler->filter('button:contains("Crear Producto")')->form();	

		// set some values
		$form['product[code]'] = 'prd1';
		$form['product[nameProduct]'] = 'product1';
		$form['product[descriptionProduct]'] = 'this is 1 product';
        $form['product[brand]'] = 'Adidas';
        $form['product[category]'] = 1;
		$form['product[price]'] = 1.25;

		// submit the form
		$crawler = $client->submit($form);
		$this->assertGreaterThan(
        	0,
        	$crawler->filter('div:contains(Producto Agregado)')->count()
        );	

        // Validate Entities
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $errors = $validator->validate($form);

		$this->assertEquals(0, count($errors));
    }

    public function testEditForm()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/products/newProduct/4');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Crear Producto')->form(array(), 'PUT');

        // submit the form
        $crawler = $client->submit($form);
        $this->assertGreaterThan(
            0,
            $crawler->filter('div:contains(Producto Agregado)')->count()
        );  

        // Validate Entities
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $errors = $validator->validate($form);

        $this->assertEquals(0, count($errors));
    }
}
