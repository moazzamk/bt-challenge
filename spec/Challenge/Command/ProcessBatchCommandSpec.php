<?php

namespace spec\Challenge\Command;

use Challenge\Action\Customer\AddAction;
use Challenge\Action\Customer\ChargeAction;
use Challenge\Action\Customer\CreditAction;
use Challenge\Action\Customer\SummaryAction;
use Challenge\Action\Customer\UpdateAction;
use Challenge\Repository\CustomerRepository;
use Doctrine\ORM\EntityManager;
use League\Container\Container;
use PhpSpec\ObjectBehavior;


class ProcessBatchCommandSpec extends ObjectBehavior
{
    public function let(
        CustomerRepository $customerRepository,
        EntityManager $entityManager,
        SummaryAction $summaryAction,
        ChargeAction $chargeAction,
        CreditAction $creditAction,
        UpdateAction $updateAction,
        AddAction $addAction,
        Container $container
    ) {
        $entityManager->getRepository('\Challenge\Entity\Customer')->willReturn($customerRepository);

        $container->get('Customer\SummaryAction')->willReturn($summaryAction);
        $container->get('Customer\CreditAction')->willReturn($creditAction);
        $container->get('Customer\UpdateAction')->willReturn($updateAction);
        $container->get('Customer\ChargeAction')->willReturn($chargeAction);
        $container->get('Customer\AddAction')->willReturn($addAction);
        $container->get('EntityManager')->willReturn($entityManager);

        $this->beConstructedWith($container);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('\Challenge\Command\ProcessBatchCommand');
    }

    public function it_process_batch_actions()
    {
        $updateTs = time();
        $fileContents = file_get_contents(__DIR__ . '/../../../fixtures/yo.txt');

        $this->__invoke($fileContents, $updateTs);
    }
}
