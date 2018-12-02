<?php

namespace Langeland\AnvilCore\Command;

/*
 * This file is part of the Langeland.AnvilCore package.
 */

use Langeland\AnvilCore\Domain\Model\Unit;
use Langeland\AnvilCore\Domain\Repository\UnitRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;

/**
 * @Flow\Scope("singleton")
 */
class AnvilCommandController extends CommandController
{

    /**
     * @var UnitRepository
     * @Flow\Inject
     */
    protected $unitRepository;

    /**
     * @throws \Neos\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function importGroupsCommand()
    {
        $groups_json = json_decode(file_get_contents('https://spejder.dk/sites/default/files/groups.json'), 1);

        foreach ($groups_json as $group_json) {
            $newGroup = new Unit();
            $newGroup
                ->setCode($group_json['code'])
                ->setName($group_json['name'])
                ->setLatitude($group_json['lat'])
                ->setLongitude($group_json['long']);

            $this->unitRepository->add($newGroup);
        }
    }
}
