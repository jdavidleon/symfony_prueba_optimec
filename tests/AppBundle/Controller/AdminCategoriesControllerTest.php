<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validation;


class AdminCategoriesControllerTest extends WebTestCase
{	

    public function testNewCategory()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/categories/newCategory');

		$this->assertEquals(200, $client->getResponse()->getStatusCode());
		$form = $crawler->selectButton('Crear Categoria')->form();

		// set some values
		$form['category[code]'] = 'cat1';
		$form['category[nameCategory]'] = 'category1';
		$form['category[descriptionCategory]'] = 'cat1';
		$form['category[active]'] = 1;

		// submit the form
		$crawler = $client->submit($form);
		$this->assertGreaterThan(
        	0,
        	$crawler->filter('div:contains(Categoria Agregada)')->count()
        );	

        // Validate Entities
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $errors = $validator->validate($form);

		$this->assertEquals(0, count($errors));
    }

    public function testEditForm()
    {
    	$client = static::createClient();
        $crawler = $client->request('GET', '/categories/newCategory/2');

		$this->assertEquals(200, $client->getResponse()->getStatusCode());

		$form = $crawler->selectButton('Crear Categoria')->form(array(), 'PUT');

		// submit the form
		$crawler = $client->submit($form);
		$this->assertGreaterThan(
        	0,
        	$crawler->filter('div:contains(Categoria Agregada)')->count()
        );	

        // Validate Entities
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $errors = $validator->validate($form);

		$this->assertEquals(0, count($errors));
    }
}
