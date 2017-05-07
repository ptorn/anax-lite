<?php
namespace Peto16\User;

/**
 * User test class with test cases
 *
 */
class UserTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Testcase to retrieve the full name.
     */
    public function testGetFullName()
    {
        $user = new \Peto16\User\User();
        $user->firstname = "Peder";
        $user->lastname = "Tornberg";

        $this->assertEquals("Peder Tornberg", $user->getFullName());
    }


    /**
     * Testcase to retrieve the full aray from the user.
     */
    public function testGetDataArray()
    {
        $user = new \Peto16\User\User();
        $user->username = "admin";
        $user->firstname = "Peder";
        $user->lastname = "Tornberg";
        $user->email = "info@example.com";
        $user->level = 1;
        $user->administrator = 1;
        $user->administrator = 1;

        $expectedResult = [
            0 => 'admin',
            1 => 'Peder',
            2 => 'Tornberg',
            3 => 'info@example.com',
            4 => 1,
            5 => 1,
            6 => true
        ];
        $this->assertEquals($expectedResult, $user->getDataArray());
    }


    /**
     * Test to set the data to the user from an object.
     */
    public function testSetUserData()
    {
        $user = new \Peto16\User\User();
        $expectedResult = (object)[
            "id" => 1,
            "username" => 'admin',
            "firstname" => 'Peder',
            "lastname" => 'Tornberg',
            "email" => 'info@example.com',
            "level" => 1,
            "administrator" => 1,
            "enabled" => true,
            "password" => "$2y$10$61GOvJwSoAFQ29NAD.tvXuex9FnJRmsyx6R9j3UnkfwNbX4SIHJIS"
        ];

        $user->setUserData($expectedResult);

        $this->assertEquals("Peder", $user->firstname);
    }


    /**
     * @runInSeparateProcess
     * Test case to try to login a user.
     */
    public function testLoginUser()
    {
        $user = new \Peto16\User\User();
        $expectedResult = (object)[
            "id" => 1,
            "username" => 'admin',
            "firstname" => 'Peder',
            "lastname" => 'Tornberg',
            "email" => 'info@example.com',
            "level" => 1,
            "administrator" => 1,
            "enabled" => true,
            "password" => "$2y$10$61GOvJwSoAFQ29NAD.tvXuex9FnJRmsyx6R9j3UnkfwNbX4SIHJIS"
        ];

        $user->setUserData($expectedResult);

        $this->assertEquals(true, $user->loginUser("test"));
        $this->assertEquals(false, $user->loginUser("testaaa"));
    }
}
