<?php

return [
    'Validator\CreditCardValidator' => function () {
        return new \Challenge\Validator\CreditCardValidator();
    },

    'Customer\AddAction' => function ($container) {
        return new \Challenge\Action\Customer\AddAction(
            $container->get('Validator\CreditCardValidator'),
            $container->get('EntityManager')
        );
    },
    'Customer\ChargeAction' => function ($container) {
        return new \Challenge\Action\Customer\ChargeAction($container->get('EntityManager'));
    },
    'Customer\CreditAction' => function ($container) {
        return new \Challenge\Action\Customer\CreditAction($container->get('EntityManager'));
    },
    'Customer\SummaryAction' => function ($container) {
        return new \Challenge\Action\Customer\SummaryAction($container->get('EntityManager')->getRepository('\Challenge\Entity\Customer'));
    },
    'Customer\UpdateAction' => function ($container) {
        return new \Challenge\Action\Customer\UpdateAction(
            $container->get('Validator\CreditCardValidator'),
            $container->get('EntityManager')
        );
    },

    'Command\ProcessBatchCommand' => function ($container) {
        return new \Challenge\Command\ProcessBatchCommand($container);
    },

];
