<?php
  namespace AppBundle\DataFixtures\ORM;

  use AppBundle\Entity\Movie;
  use Doctrine\Bundle\FixturesBundle\Fixture;
  use Doctrine\Common\Persistence\ObjectManager;

  class LoadMovieData extends Fixture
  {
    public function load(ObjectManager $manager)
    {
      $movie1 = new Movie();
      $movie1 ->setTitle('Green Miles');
      $movie1 -> setDescription('This is just for fun');
      $movie1 -> setTime(199);
      $movie1 -> setYear(1999);

      $manager -> persist($movie1);
      $manager -> flush();
    }
  }
 ?>
