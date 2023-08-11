<?php

class synkTest extends \PHPUnit\Framework\TestCase
{
    public function testThatStringMatches()
    {
        $email = 'aarondeo30@gmail.com';
        $emailtrue = true;
        $mailformat = '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/';
        if (!preg_match($mailformat, $email)) {
            $emailtrue = false;
        }
        $this->assertTrue($emailtrue);
    }

}