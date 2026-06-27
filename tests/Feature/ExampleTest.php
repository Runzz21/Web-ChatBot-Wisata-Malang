<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_destinasi_page_is_accessible(): void
    {
        $response = $this->get('/destinasi');
        $response->assertStatus(200);
    }

    public function test_tentang_page_is_accessible(): void
    {
        $response = $this->get('/tentang');
        $response->assertStatus(200);
    }

    public function test_kontak_page_is_accessible(): void
    {
        $response = $this->get('/kontak');
        $response->assertStatus(200);
    }

    public function test_chatbot_page_is_accessible(): void
    {
        $response = $this->get('/chatbot');
        $response->assertStatus(200);
    }
}
