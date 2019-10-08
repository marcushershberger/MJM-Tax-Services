<?php
declare(strict_types=1);


use PHPUnit\Framework\TestCase;

//include 'inc/php_to_html_functions.php';
//include 'inc/client_page.php';

$result = ob_get_clean()
final class UnitTests extends TestCase
{
    
    public function test1(): void
    {
        session_start();
        $_SESSION['USER'] = 47;
        $this->assertEquals(
            $_SESSION['USER'], 47
        );
    }

    public function test2(): void
    {
        $this->assertEquals(
            "a", "a"
        );
    }

    public function test3(): void
    {
        $this->assertEquals(
            "a", "a"
        );
    }
}
