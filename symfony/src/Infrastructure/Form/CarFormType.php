<?php

namespace App\Infrastructure\Form;

use App\Domain\Model\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Car|null $article */
        $car = $options['data'] ?? null;
        $country = $car ? $car->getCountry() : null;

        $builder
            ->add('mark', TextType::class, [
                'help' => 'Choose something catchy!'
            ])
            ->add('model')
            ->add('description', TextareaType::class)
            ->add('year', IntegerType::class)
            ->add('enabled', CheckboxType::class, ['required' => false])
            ->add('country', ChoiceType::class, [
                'placeholder' => 'Choose a country',
                'choices' => [
                    'EEUU' => 'eeuu',
                    'France' => 'france',
                    'Spain' => 'spain'
                ],
                'required' => true,
            ])
        ;

        $builder
            ->add('imageFile', FileType::class, [
                'mapped' => false,
                'required' => false
            ])
        ;

        if ($country) {
            $builder->add('city', ChoiceType::class, [
                'placeholder' => 'Where exactly?',
                'choices' => $this->getCountryNameChoices($country),
                'required' => true,
            ]);
        }

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                /** @var Car|null $data */
                $data = $event->getData();
                if (!$data) {
                    return;
                }

                $this->setupCityNameField(
                    $event->getForm(),
                    $data->getCountry()
                );
            }
        );

        $builder->get('country')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) {
                $form = $event->getForm();
                $this->setupCityNameField(
                    $form->getParent(),
                    $form->getData()
                );
            }
        );
    }

    private function setupCityNameField(FormInterface $form, ?string $country)
    {
        if (null === $country) {
            $form->remove('city');
            return;
        }

        $choices = $this->getCountryNameChoices($country);

        if (null === $choices) {
            $form->remove('city');
            return;
        }

        $form->add('city', ChoiceType::class, [
            'placeholder' => 'Where exactly?',
            'choices' => $choices,
            'required' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
            'enabled' => false,
        ]);
    }

    private function getCountryNameChoices(string $country)
    {
        $eeuu = [
            'Dallas',
            'Houston',
            'Miami'
        ];
        $france = [
            'Paris',
            'Lyon',
            'Nantes'
        ];
        $spain = [
            'Barcelona',
            'Madrid',
            'Valencia'
        ];
        $countryNameChoices = [
            'eeuu' => array_combine($eeuu, $eeuu),
            'france' => array_combine($france, $france),
            'spain' => array_combine($spain, $spain),
        ];

        return $countryNameChoices[$country] ?? null;
    }
}