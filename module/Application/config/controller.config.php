<?php

return [
    'factories' => [
        'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        'Application\Controller\Index' => function (Zend\Mvc\Controller\ControllerManager $cm) {
            return new Application\Controller\IndexController(
                $cm->getServiceLocator()->get('LinkRepository'),
                $cm->getServiceLocator()->get('ShortenedLinkService')
            );
        },
    ],
];
