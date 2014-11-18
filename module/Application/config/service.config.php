<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

return [
    'factories' => [
        'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        'LinkRepository' => function (Zend\ServiceManager\ServiceManager $sm) {
            $em = $sm->get('EntityManager');
            return new Application\Repository\LinkRepository($em);
        },
        'LinkForm' => function (Zend\ServiceManager\ServiceManager $sm) {
            $form = new Application\Form\LinkForm($sm);
            return $form;
        },
        'EntityManager' => function (Zend\ServiceManager\ServiceManager $sm) {
            $config = $sm->get('Config');

            $em = EntityManager::create(
                $config['doctrine']['params'],
                Setup::createYAMLMetadataConfiguration(
                    [realpath(__DIR__ . '/../src/Application/Mapping')],
                    true
                )
            );

            return $em;
        },
        'ShortenedLinkService' => function (Zend\ServiceManager\ServiceManager $sm) {
            return new Application\Service\ShortenedLinkService(
                $sm->get('LinkRepository')
            );
        }
    ],
];
