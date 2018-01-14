<?php
  namespace AppBundle\DataFixtures\ORM;

  use AppBundle\Entity\Person;
  use Doctrine\Bundle\FixturesBundle\Fixture;
  use Doctrine\Common\Persistence\ObjectManager;

  class LoadPersonData extends Fixture
  {
    public function load(ObjectManager $manager)
    {
      $person = new Person();
      $person ->setFirstName('Gerard');
      $person -> setLastName('Pence');
      $person -> setDateOfBirth(new \DateTime('1999-03-03'));

      $manager -> persist($person);
      $manager -> flush();
    }
  }
 ?>
