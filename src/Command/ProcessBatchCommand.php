<?php

namespace Challenge\Command;

use Doctrine\ORM\EntityManager;
use League\Container\Container;

class ProcessBatchCommand
{
    /** @var  \Challenge\Repository\CustomerRepository */
    private $customerRepository;

    /** @var Container  */
    private $container;


    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->customerRepository = $container->get('EntityManager')->getRepository('\Challenge\Entity\Customer');
        $this->container = $container;
    }

    /**
     * @param string $fileContents
     *
     * @return string
     */
    public function __invoke($fileContents, $updateTs)
    {
        $lines = explode(PHP_EOL, $fileContents);
        foreach ($lines as $line) {
            $data = explode(' ', $line);
            $data[] = $updateTs;

            $command = array_shift($data);
            if (empty($command)) {
                continue;
            }
            $action = "Customer\\{$command}Action";

            call_user_func_array($this->container->get($action), $data);
        }

        $action = $this->container->get('Customer\SummaryAction');

        return $action($updateTs);
    }
}
