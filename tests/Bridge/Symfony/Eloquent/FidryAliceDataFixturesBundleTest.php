<?php

/*
 * This file is part of the Fidry\AliceDataFixtures package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fidry\AliceDataFixtures\Bridge\Symfony\Eloquent;

use Fidry\AliceDataFixtures\Bridge\Eloquent\Persister\ModelPersister;
use Fidry\AliceDataFixtures\Bridge\Eloquent\Purger\ModelPurger;
use Fidry\AliceDataFixtures\Bridge\Symfony\FidryAliceDataFixturesBundleTest as NakedFidryAliceDataFixturesBundleTest;
use Fidry\AliceDataFixtures\Bridge\Symfony\SymfonyApp\EloquentKernel;
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
        $this->kernel = new EloquentKernel('eloquent', true);
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
            ModelPurger::class,
            $this->kernel->getContainer()->get('fidry_alice_data_fixtures.persistence.purger.eloquent.model_purger')
        );

        $this->assertInstanceOf(
            ModelPersister::class,
            $this->kernel->getContainer()->get('fidry_alice_data_fixtures.persistence.persister.eloquent.model_persister')
        );

        $this->assertInstanceOf(
            PersisterLoader::class,
            $this->kernel->getContainer()->get('fidry_alice_data_fixtures.loader.eloquent')
        );
    }
}
