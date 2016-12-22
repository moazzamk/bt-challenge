Feature: Adding customers with cards and performing transactions on them

    Scenario: Processing customers from a batch file
        When a file "fixtures/yo.txt" is provided to be processed
        Then the output should print summary similar to "fixtures/summary.txt"
