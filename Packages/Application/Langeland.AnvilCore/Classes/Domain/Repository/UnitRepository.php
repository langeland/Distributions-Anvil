<?php
namespace Langeland\AnvilCore\Domain\Repository;

/*
 * This file is part of the Langeland.AnvilCore package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\QueryInterface;
use Neos\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class UnitRepository extends Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = [
        'name' => QueryInterface::ORDER_ASCENDING
    ];

}
