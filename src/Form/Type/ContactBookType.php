<?php
    namespace App\Form\Type;

    use App\Entity\ContactBookEntity;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class ContactBookType extends AbstractType {
        //erstellt eine Formular-Vorlage (wird zu Anzeigen erstellt)
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add('username', TextType::class, ['empty_data' => '']); //['empty_data' => ''] Filler bei leerem Username (für Validation)
            $builder->add('email', EmailType::class, ['required' => false]); //['empty_data' => ''] optionales Feld
            $builder->add('subtitle', TextType::class, ['empty_data' => '']);
            $builder->add('body', TextType::class, ['empty_data' => '']);
            $builder->add('submit', SubmitType::class);
        }


        //wird beim Absenden erstellt
        //wandelt eingegebene Daten (POST) zur Klasse
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => ContactBookEntity::class
            ]);
        }

    }
