<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\View;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * Class LinkForm
 * @package Application\Form
 */
class LinkForm extends Form implements InputFilterProviderInterface
{
    /**
     * @param null $name
     */
    public function __construct($name = null)
    {
        parent::__construct('Application');

        $this->add([
            'name' => 'id',
            'type' => 'Hidden',
        ]);

        $this->add([
            'name' => 'name',
            'type' => 'Text',
            'options' => [
                'label' => 'Name',
                'label_attributes' => [
                    'class' => 'pull-left fullWidth',
                ],
            ],
        ]);

        $this->add([
            'name' => 'url',
            'type' => 'Zend\Form\Element\Url',
            'options' => [
                'label' => 'Long URL',
                'label_attributes' => [
                    'class' => 'pull-left fullWidth',
                ],
            ],
            'attributes' => [
                'placeholder' => 'http://'
            ],
        ]);
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            'name' => [
                'required' => true,
                'filters' => [
                    ['name' => 'Zend\Filter\StringTrim'],
                ],
                'validators' => [
                    [
                        'name' => 'Zend\Validator\StringLength',
                        'options' => [
                            'max' => 255,
                        ],
                    ]
                ],
            ],
            'url' => [
                'required' => true,
                'filters' => [
                    ['name' => 'Zend\Filter\StringTrim'],
                ],
            ]
        ];
    }
}
