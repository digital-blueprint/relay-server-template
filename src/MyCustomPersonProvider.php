<?php

declare(strict_types=1);

namespace App;

use DBP\API\CoreBundle\Entity\Person;
use DBP\API\CoreBundle\Service\PersonProviderInterface;

class MyCustomPersonProvider implements PersonProviderInterface
{
    public function getPersons(array $filters): array
    {
        // TODO: Implement getPersons() method.
        return [];
    }

    public function getPersonsByNameAndBirthday(string $givenName, string $familyName, \DateTime $birthDay): array
    {
        // TODO: Implement getPersonsByNameAndBirthday() method.
        return [];
    }

    public function getPerson(string $id): Person
    {
        // TODO: Implement getPerson() method.
        return new Person();
    }

    public function getCurrentPerson(): Person
    {
        // TODO: Implement getCurrentPerson() method.
        return new Person();
    }

    public function getPersonForExternalService(string $service, string $serviceID): Person
    {
        // TODO: Implement getPersonForExternalService() method.
        return new Person();
    }
}
