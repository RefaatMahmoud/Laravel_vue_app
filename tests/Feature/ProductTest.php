<?php

namespace Tests\Feature;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use ApiResponseTrait;

    public function testListAllProductsApi()
    {
        $response = $this->get('api/products');
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'data'       => [
                    [
                        'id',
                        'name',
                        'image'
                    ]
                ],
                'pagination' => [
                    'currentPage',
                    'perPage',
                    'lastPage',
                    'total'
                ]
            ]
        );
    }

    public function testCreateProductApi()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $data = [
            'name'  => 'test product',
            'image' => $file
        ];
        $response = $this->json('POST', '/api/products', $data);
        $response_body = json_decode($response->getContent());
        $this->expectedResponseInCreateOrUpdateProduct($response_body, $response);
    }

    public function testUpdateProductApi()
    {
        $response = $this->get('api/products');
        $response->assertStatus(Response::HTTP_OK);
        $product = $response->getData()->data[0];
        if (!empty($product)) {
            Storage::fake('public');
            $file = UploadedFile::fake()->image('avatar.jpg');
            $data = [
                'name'  => 'test product',
                'image' => $file
            ];
            $response = $this->json('PATCH', 'api/products/' . $product->id, $data);
            $response_body = json_decode($response->getContent());
            $this->expectedResponseInCreateOrUpdateProduct($response_body, $response);
        }
    }

    public function testDeleteProductApi()
    {
        $response = $this->get('api/products');
        $response->assertStatus(Response::HTTP_OK);
        $product = $response->getData()->data[0];
        if (!empty($product)) {
            $response = $this->json('Delete', 'api/products/' . $product->id);
            $response->assertStatus(Response::HTTP_OK);
        }
    }

    /**
     * @param $response_body
     * @param \Illuminate\Testing\TestResponse $response
     */
    private function expectedResponseInCreateOrUpdateProduct($response_body, \Illuminate\Testing\TestResponse $response): void
    {
        if (isset($response_body->errors)) {
            $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $response->assertStatus(Response::HTTP_OK)
                     ->assertJson(
                         [
                             'data' => [
                                 'id'    => $response_body->data->id,
                                 'name'  => $response_body->data->name,
                                 'image' => $response_body->data->image,
                             ]
                         ]
                     );
        }
    }
}
