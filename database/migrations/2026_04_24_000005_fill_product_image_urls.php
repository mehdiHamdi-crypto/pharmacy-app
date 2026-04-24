<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $images = [
            'Doliprane 1000mg' => 'https://commons.wikimedia.org/wiki/Special:Redirect/file/M%26B_paracetamol.jpg',
            'Efferalgan 500mg' => 'https://commons.wikimedia.org/wiki/Special:Redirect/file/Yef_paracetamol.jpg',
            'Vitamine D3 Premium' => 'https://commons.wikimedia.org/wiki/Special:Redirect/file/Vitamin_D_pills.jpg',
            'Crème Hydratante' => 'https://commons.wikimedia.org/wiki/Special:Redirect/file/Eucerin-cream.jpg',
            'Creme Hydratante' => 'https://commons.wikimedia.org/wiki/Special:Redirect/file/Eucerin-cream.jpg',
            'Gel Hydroalcoolique' => 'https://commons.wikimedia.org/wiki/Special:Redirect/file/Purell_hand_sanitizer_gel_in_bottle_%288487014501%29.jpg',
            'Lait Infantile' => 'https://commons.wikimedia.org/wiki/Special:Redirect/file/Enfamil_Gentlease_Infant_Formula.JPG',
            'Huile Lavande' => 'https://commons.wikimedia.org/wiki/Special:Redirect/file/LavenderEssentialOil.png',
        ];

        foreach ($images as $name => $url) {
            DB::table('products')
                ->where('name', $name)
                ->update(['image_url' => $url]);
        }
    }

    public function down(): void
    {
        $names = [
            'Doliprane 1000mg',
            'Efferalgan 500mg',
            'Vitamine D3 Premium',
            'Crème Hydratante',
            'Creme Hydratante',
            'Gel Hydroalcoolique',
            'Lait Infantile',
            'Huile Lavande',
        ];

        DB::table('products')
            ->whereIn('name', $names)
            ->update(['image_url' => null]);
    }
};
