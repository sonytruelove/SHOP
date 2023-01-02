<?php
declare(strict_types=1);
include_once '..\DB-singleton.php'; 
xdebug_start_trace();
class SingletonTest

{

    public function testUniqueness()

    {

        $firstCall = DB::getInstance();

        $secondCall = DB::getInstance();


        $this->assertInstanceOf(DB::class, $firstCall);

        $this->assertSame($firstCall, $secondCall);

    }

}
xdebug_stop_trace();
?>