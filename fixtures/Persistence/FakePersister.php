<?php

/*
 * This file is part of the Fidry\AliceDataFixtures package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fidry\AliceDataFixtures\Persistence;

use Nelmio\Alice\NotCallableTrait;

/**
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class FakePersister implements PersisterInterface
{
    use NotCallableTrait;

    /**
     * @inheritdoc
     */
    public function persist($object)
    {
        $this->__call(__METHOD__, func_get_args());
    }

    /**
     * @inheritdoc
     */
    public function flush()
    {
        $this->__call(__METHOD__, func_get_args());
    }
}
