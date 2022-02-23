<?php

namespace Tests\Unit;

use App\Models\Candy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
//use PHPUnit\Framework\TestCase;

class CandyTest extends TestCase
{
    use DatabaseMigrations;

    public function test_one_chocolate_candy() {
        $candy = new Candy([
            'name' => 'Chocolate',
            'cocoa_content' => 12.5,
            'sugar_content' => 2,
        ]);
        $candy->save();

        $this->assertEquals(2, Candy::csokisakCukortartalma());
    }

    public function test_multiple_chocolate_candy() {
        Candy::factory()->createMany([
            [
                'name' => 'Chocolate',
                'cocoa_content' => 12.5,
                'sugar_content' => 2,
            ],
            [
                'name' => 'White Chocolate',
                'cocoa_content' => 10.5,
                'sugar_content' => 1,
            ],
            [
                'name' => 'White Chocolate',
                'cocoa_content' => 20,
                'sugar_content' => 6,
            ],
        ]);

        $this->assertEquals(3, Candy::csokisakCukortartalma());
    }

    public function test_multiple_chocolate_candy_no_chocolate() {
        Candy::factory()->createMany([
            [
                'name' => 'Chocolate',
                'cocoa_content' => 12.5,
                'sugar_content' => 2,
            ],
            [
                'name' => 'Hard Candy',
                'cocoa_content' => 0,
                'sugar_content' => 50,
            ]
        ]);

        $this->assertEquals(2, Candy::csokisakCukortartalma());
    }

    public function test_no_chocolate() {
        $this->assertNan(Candy::csokisakCukortartalma());
    }
}
