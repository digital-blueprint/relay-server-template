<?php


namespace App;

use DBP\API\CoreBundle\Entity\Person;
use DBP\API\CoreBundle\Service\PersonProviderInterface;

class MyCustomPersonProvider implements PersonProviderInterface
{

    public function getPersons(array $filters): array
    {
        // TODO: Implement getPersons() method.
    }

    public function getPersonsByNameAndBirthday(string $givenName, string $familyName, \DateTime $birthDay): array
    {
        // TODO: Implement getPersonsByNameAndBirthday() method.
    }

    public function getPerson(string $id, bool $full): Person
    {
        // TODO: Implement getPerson() method.
    }

    public function getCurrentPerson(): Person
    {
        // TODO: Implement getCurrentPerson() method.
    }

    public function getPersonForExternalService(string $service, string $serviceID): Person
    {
        // TODO: Implement getPersonForExternalService() method.
    }
}