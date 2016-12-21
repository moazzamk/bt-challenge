<?php

namespace Challenge\Validator;

class CreditCardValidator
{
    public function validate($number)
    {
        $result = substr($number, 0, - 1);
        if ($this->luhn($result, 1) == $number) {
            return true;
        }

        return false;
    }

    protected function luhn($number, $iterations = 1)
    {
        while ($iterations-- >= 1)
        {
            $stack = 0;
            $number = str_split(strrev($number), 1);

            foreach ($number as $key => $value)
            {
                if ($key % 2 == 0)
                {
                    $value = array_sum(str_split($value * 2, 1));
                }

                $stack += $value;
            }

            $stack %= 10;

            if ($stack != 0)
            {
                $stack -= 10;
            }

            $number = implode('', array_reverse($number)) . abs($stack);
        }

        return $number;
    }
}

