<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Antelope\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AntelopeForm extends AbstractType
{
    public const FIELD_ID_ANTELOPE = 'id_antelope';
    public const FIELD_NAME = 'name';
    public const FIELD_COLOR = 'color';

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {

    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->addIdAntelopeField($builder, $options)
            ->addNameField($builder, $options)
            ->addColorField($builder, $options)
            ;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return \Pyz\Zed\Antelope\Communication\Form\AttributeForm
     */
    protected function addIdAntelopeField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(self::FIELD_ID_ANTELOPE, HiddenType::class);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return \Pyz\Zed\Antelope\Communication\Form\AttributeForm
     */
    protected function addNameField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(self::FIELD_NAME, TextType::class, [
            'label' => 'Name of the antelope',
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return \Pyz\Zed\Antelope\Communication\Form\AttributeForm
     */
    protected function addColorField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(self::FIELD_COLOR, TextType::class, [
            'label' => 'Color of the antelope',
        ]);

        return $this;
    }
}

