<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name'  => 'required|min:2|unique:products',
                    'image' => 'required|mimes:jpg,jpeg,png',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                $rules = [];
                if (request()->has('name')) {
                    $rules = array_merge($rules, ['name' => 'required|min:2|unique:products,name,'. request()->segment(3) . ',id']);
                }
                if (request()->has('image')) {
                    $rules = array_merge($rules, ['image' => 'required|mimes:jpg,jpeg,png']);
                }
                return $rules;
            }
            default:
                break;
        }
    }
}
