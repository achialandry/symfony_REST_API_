<?php
  namespace AppBundle\Serializer;

  use Doctrine\Common\Annotations\AnnotationReader;
  use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
  use JMS\Serializer\EventDispatcher\ObjectEvent;
  use JMS\Serializer\EventDispatcher\PreDeserializeEvent;

  /**
   *
   */
  class DoctrineEntityDeserializationSubscriber implements EventSubscriberInterface
  {
    public function __construct(AnnotationReader $annotationReader)
    {
        $this -> annotationReader = $annotationReader;
    }
    public static function getSubscribedEvents()
    {
      return [
        [
          'event' => 'serializer.pre_deserialize',
          'method' => 'onPreDeserialize',
          'format' => 'json'
        ],
        [
          'event' => 'serializer.post_deserialize',
          'method' => 'onPostDeserialize',
          'format' => 'json'
        ]
      ];
    }

    public function onPreDeserialize(PreDeserializeEvent $event)
    {
      // dump( $event ->getData());
      $deserializeType = $event -> getType()['name'];

      if(!class_exists($deserializeType))
      {
        return;
      }
      $data = $event -> getData();
      $class = new \ReflectionClass($deserializeType);
      // dump($class);die;
      foreach ($class -> getProperties() as  $property) {
        if(!isset($data[$property->name])){
          continue;
        }

        /**
         * @var DeSerializeEntity $annotation
         */
        $annotation = $this -> annotationReader->getPropertyAnnotation(
          $property,
          DeSerializeEntity::class
        );

        dump($annotation);
        // if (null == $annotation || !class_exists($annotation -> type)) {
        //   continue;
        // }
        // $data[$property -> name] = [
        //   $annotation -> idField => $data[$property -> name]
        // ];
        // dump($data);
      }
      die;
    }

    public function onPostDeserialize(ObjectEvent $event)
    {

    }

  }


 ?>
