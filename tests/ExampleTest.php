<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * 基本测试
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
            ->see('zhihu');
    }

}
