<?php

namespace Daemon\GalleryBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Exception\InvalidArgumentException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class UnitegalleryExtension
 * @package Daemon\GalleryBundle\Form\Extension
 */
class UnitegalleryExtension extends AbstractTypeExtension {

    /**
     * @var array
     */
    protected $options = array();

    /**
     * {@inheritdoc}
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['images'] = $options['images'];
        $view->vars['help_label'] = $options['help_label'];

        if (null !== $options['help_label_tooltip'] && !is_array($options['help_label_tooltip'])) {
            throw new InvalidArgumentException('The "help_label_tooltip" option must be an "array".');
        }

        if ($options['help_block_horizontal_wrapper_class']) {
            $options['help_block_horizontal_wrapper_class'] = $this->options['help_block_horizontal_wrapper_class'];
        }

        if ($options['help_label_tooltip']) {
            if (!isset($options['help_label_tooltip']['title'])) {
                $options['help_label_tooltip']['title'] = $this->options['help_label_tooltip']['title'];
            }
            if (!isset($options['help_label_tooltip']['text'])) {
                $options['help_label_tooltip']['text'] = $this->options['help_label_tooltip']['text'];
            }
            if (!isset($options['help_label_tooltip']['icon'])) {
                $options['help_label_tooltip']['icon'] = $this->options['help_label_tooltip']['icon'];
            }
            if (!isset($options['help_label_tooltip']['placement'])) {
                $options['help_label_tooltip']['placement'] = $this->options['help_label_tooltip']['placement'];
            }
        }

        if (null !== $options['help_label_popover'] && !is_array($options['help_label_popover'])) {
            throw new InvalidArgumentException('The "help_label_popover" option must be an "array".');
        }
    }


    /**
     * {@inheritdoc}
     *
     * @deprecated Remove it when bumping requirements to SF 2.7+
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'help_block' => null,
            'help_label' => null,
            'help_block_horizontal_wrapper_class' => $this->options['help_block_horizontal_wrapper_class'],
            'help_label_tooltip' => $this->options['help_label_tooltip'],
            'help_label_popover' => $this->options['help_label_popover'],
            'help_block_tooltip' => $this->options['help_block_tooltip'],
            'help_block_popover' => $this->options['help_block_popover'],
            'help_widget_popover' => $this->options['help_widget_popover'],
        ));
    }

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return "form";
    }

}