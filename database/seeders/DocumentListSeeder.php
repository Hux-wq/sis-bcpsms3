<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentList;

class DocumentListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            'Birth Certificate',
            'High School Diploma',
            'Transcripts',
            'Passport Photo',
            'Application Form',
            'Good Moral',
        ];

        foreach ($documents as $document) {
            DocumentList::create([
                'name' => $document,
            ]);
        }
    }
}
