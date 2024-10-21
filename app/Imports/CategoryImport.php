<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CategoryImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Category([
            'uuid' => Str::uuid(),
            'name' => $row['name'],
            'slug' => Str::slug($row['name']),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'unique:categories,name',
        ];
    }
}
