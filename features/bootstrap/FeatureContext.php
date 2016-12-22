<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $output;



    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        shell_exec('bin/cleardb');
    }

    /**
     * @When /^a file "([^"]*)" is provided to be processed$/
     */
    public function aFileIsProvidedToBeProcessed1($arg1)
    {
        $this->output = shell_exec("bin/mcc $arg1");
    }

    /**
     * @Then /^the output should print summary similar to "([^"]*)"$/
     */
    public function theOutputShouldPrintSummarySimilarTo($arg1)
    {
        $expectedOutput = trim(file_get_contents($arg1));
        if (trim($this->output) !== $expectedOutput) {
            throw new \Exception("Expected output to be {$expectedOutput} but got {$this->output}");
        }
    }
}
