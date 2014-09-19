<?php namespace spec;

trait SpecHelper {

    public function getMatchers()
    {
        return [
            'haveValue' => function($subject, $value)
            {
                return in_array($value, $subject);
            },
        ];
    }

}
