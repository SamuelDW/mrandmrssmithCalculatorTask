<?php


namespace App\Form;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculatorForm
{
    public const FORM_NAME = 'calculatorBasic';

    /**
     * defining operator consts to use in array to allow easy identification
     * and easier to add operations in the future
     */
    public const ADD = 'add';
    public const SUBTRACT = 'subtract';
    public const DIVIDE = 'divide';
    public const MULTIPLY = 'multiply';

    public const OPERATIONS = [
        self::ADD,
        self::SUBTRACT,
        self::DIVIDE,
        self::MULTIPLY,
    ];

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('inputValueOne', IntegerType::class, [
            'label' => 'Value 1:',
            'placeholder' => '123',
            'attr' => [
                'class' => 'input-field',
            ],
        ]);

        $builder->add('inputValueTwo', IntegerType::class, [
            'label' => 'Value 2:',
            'placeholder' => '456',
            'attr' => [
                'class' => 'input-field',
            ],
        ]);

        $builder->add('operator', ChoiceType::class, [
            'label' => 'Operator',
            'choices' => self::OPERATIONS,
            'placeholder' => 'Select an operator',
            'attr' => [
                'class' => 'dropdown-single-choice'
            ]
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'required' =>true,
            'mapped' => false,
        ]);
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return self::FORM_NAME;
    }
}