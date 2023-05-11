<?php

namespace App\Test\Controller;

use App\Entity\Business;
use App\Repository\BusinessRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BusinessControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private BusinessRepository $repository;
    private string $path = '/business/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Business::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Business index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'business[title]' => 'Testing',
            'business[phone]' => 'Testing',
            'business[address]' => 'Testing',
            'business[cep]' => 'Testing',
            'business[city]' => 'Testing',
            'business[state]' => 'Testing',
            'business[description]' => 'Testing',
            'business[category]' => 'Testing',
        ]);

        self::assertResponseRedirects('/business/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Business();
        $fixture->setTitle('My Title');
        $fixture->setPhone('My Title');
        $fixture->setAddress('My Title');
        $fixture->setCep('My Title');
        $fixture->setCity('My Title');
        $fixture->setState('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCategory('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Business');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Business();
        $fixture->setTitle('My Title');
        $fixture->setPhone('My Title');
        $fixture->setAddress('My Title');
        $fixture->setCep('My Title');
        $fixture->setCity('My Title');
        $fixture->setState('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCategory('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'business[title]' => 'Something New',
            'business[phone]' => 'Something New',
            'business[address]' => 'Something New',
            'business[cep]' => 'Something New',
            'business[city]' => 'Something New',
            'business[state]' => 'Something New',
            'business[description]' => 'Something New',
            'business[category]' => 'Something New',
        ]);

        self::assertResponseRedirects('/business/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getPhone());
        self::assertSame('Something New', $fixture[0]->getAddress());
        self::assertSame('Something New', $fixture[0]->getCep());
        self::assertSame('Something New', $fixture[0]->getCity());
        self::assertSame('Something New', $fixture[0]->getState());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getCategory());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Business();
        $fixture->setTitle('My Title');
        $fixture->setPhone('My Title');
        $fixture->setAddress('My Title');
        $fixture->setCep('My Title');
        $fixture->setCity('My Title');
        $fixture->setState('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCategory('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/business/');
    }
}
