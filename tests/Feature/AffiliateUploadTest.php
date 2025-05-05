<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AffiliateUploadTest extends TestCase
{
    /** @test */
    public function it_uploads_and_displays_affiliates()
    {
        Storage::fake('local');

        $fileContent = <<<TXT
            {"latitude": "52.986375", "affiliate_id": 12, "name": "Yosef Giles", "longitude": "-6.043701"}
            {"latitude": "53.3340285", "affiliate_id": 1, "name": "Lance Keith", "longitude": "-6.2535495"}
            TXT;

        $file = UploadedFile::fake()->createWithContent('affiliates.txt', $fileContent);

        $response = $this->post('/', [
            'affiliate_file' => $file,
        ]);

        $response->assertStatus(200);
        $response->assertSee('Affiliate List');
        $response->assertSee('Yosef Giles');
        $response->assertSee('Lance Keith');
    }

    /** @test */
    public function it_shows_error_for_invalid_file_upload()
    {
        $file = UploadedFile::fake()->create('empty.pdf', 0);

        $response = $this->post('/', [
            'affiliate_file' => $file,
        ]);

        $response->assertSessionHasErrors();
    }

    /** @test */
    public function it_displays_message_if_no_affiliates_found()
    {
        $fileContent = <<<TXT
            {"latitude": "40.712776", "affiliate_id": 99, "name": "Far Away", "longitude": "-74.005974"}
            TXT;

        $file = UploadedFile::fake()->createWithContent('no-affiliates.txt', $fileContent);

        $response = $this->post('/', [
            'affiliate_file' => $file,
        ]);

        $response->assertStatus(200);
        $response->assertSee('No affiliates found');
    }
}
