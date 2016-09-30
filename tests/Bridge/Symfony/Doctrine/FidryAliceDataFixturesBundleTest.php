<?php

/*
 * This file is part of the Fidry\AliceDataFixtures package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fidry\AliceDataFixtures\Bridge\Symfony\Doctrine;

use Fidry\AliceDataFixtures\Bridge\Doctrine\Persister\ObjectManagerPersister;
use Fidry\AliceDataFixtures\Bridge\Doctrine\Purger\OrmPurger;
use Fidry\AliceDataFixtures\Bridge\Symfony\FidryAliceDataFixturesBundleTest as NakedFidryAliceDataFixturesBundleTest;
use Fidry\AliceDataFixtures\Bridge\Symfony\SymfonyApp\DoctrineKernel;
use Fidry\AliceDataFixtures\Loader\PersisterLoader;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @coversNothing
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class FidryAliceDataFixturesBundleTest extends NakedFidryAliceDataFixturesBundleTest
{
    /**
     * @var KernelInterface
     */
    protected $kernel;

    public function setUp()
    {
        $this->kernel = new DoctrineKernel('doctrine', true);
        $this->kernel->boot();
    }

    public function tearDown()
    {
        $this->kernel->shutdown();
    }

    public function testServiceRegistration()
    {
        parent::testServiceRegistration();

        $this->assertInstanceOf(
            OrmPurger::class,
            $this->kernel->getContainer()->get('fidry_alice_data_fixtures.persistence.purger.orm_purger')
        );

        $this->assertInstanceOf(
            ObjectManagerPersister::class,
            $this->kernel->getContainer()->get('fidry_alice_data_fixtures.persistence.persister.object_manager_persister')
        );

        $this->assertInstanceOf(
            PersisterLoader::class,
            $this->kernel->getContainer()->get('fidry_alice_data_fixtures.loader.orm_persister')
        );
    }
}
