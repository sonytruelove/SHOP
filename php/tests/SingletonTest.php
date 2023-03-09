<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include_once 'C:/xampp/htdocs/shop/php/DB-singleton.php';
final class SingletonTest extends TestCase
{
   
    public function testUniqueness()

    {

        $firstCall = DB::getInstance();

        $secondCall = DB::getInstance();


        $this->assertInstanceOf(DB::class, $firstCall);

        $this->assertSame($firstCall, $secondCall);

    }
}
?>
