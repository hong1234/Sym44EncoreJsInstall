<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Location;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Doctrine\ORM\EntityManager;
//use Doctrine\ORM\EntityManagerInterface;

class LocationType extends AbstractType
{
    //private $entityManager;

    //public function __construct(EntityManagerInterface $entityManager)
    //{
    //    $this->entityManager = $entityManager;
    //}

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dql = "SELECT l.id, l.name FROM App\Entity\Location l WHERE l.parent < 3 ORDER BY l.name ASC";
        $results = $options['entityManager']->createQuery($dql)->getArrayResult();
        $choices = array();
        foreach($results as $result) {
            $choices[$result['name']] = $result['id'];
        }

        $builder
            ->add('name', TextType::class, array(
                 'label' => 'Location_'
            ))
            ->add('parentId', ChoiceType::class, array(
                'choices' => $choices,
                'required' => false,
                'label' => 'Parent___'
            ))
            //->add('level', IntegerType::class, array(
                //'required' => false
            //))
            ->add('level', ChoiceType::class, array(
                 'required' => false,
                 //'placeholder' => false,
                 'label' => 'Level____',
                 'choices' => array(
                     '0' => '0',
                     '1' => '1',
                     '2' => '2',
                     '3' => '3'
                 )
                   
            ))
            //->add('dueDate', DateType::class)
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
            'entityManager' => null,
        ]);
    }
}
