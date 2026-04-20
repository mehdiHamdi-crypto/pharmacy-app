<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===============================
        // 1. Catégories
        // ===============================
        DB::table('categories')->insertOrIgnore([
            [
                'id' => 1,
                'name' => 'Médicaments',
                'description' => 'Médicaments sur ordonnance et sans ordonnance',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Compléments alimentaires',
                'description' => 'Vitamines, minéraux et probiotiques',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Dermo-cosmétique',
                'description' => 'Soins de la peau et produits de beauté',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Hygiène & Bien-être',
                'description' => 'Produits d\'hygiène quotidienne',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'name' => 'Maman & Bébé',
                'description' => 'Produits pour mamans et nourrissons',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'name' => 'Aromathérapie',
                'description' => 'Huiles essentielles et produits naturels',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // ===============================
        // 2. Produits
        // ===============================
        DB::table('products')->insert([
            // Médicaments
            [
                'category_id' => 1,
                'name' => 'Doliprane 1000mg',
                'description' => 'Antalgique et antipyrétique pour douleurs et fièvre.',
                'price' => 25.00,
                'discount_price' => null,
                'stock' => 150,
                'image_url' => null,
                'sku' => 'PHC-MED001',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 1,
                'name' => 'Efferalgan 500mg',
                'description' => 'Paracétamol effervescent rapide.',
                'price' => 32.50,
                'discount_price' => 28.00,
                'stock' => 90,
                'image_url' => null,
                'sku' => 'PHC-MED002',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Compléments
            [
                'category_id' => 2,
                'name' => 'Vitamine D3 Premium',
                'description' => 'Renforce immunité et os.',
                'price' => 120.00,
                'discount_price' => null,
                'stock' => 85,
                'image_url' => null,
                'sku' => 'PHC-CMP001',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Dermo
            [
                'category_id' => 3,
                'name' => 'Crème Hydratante',
                'description' => 'Soin pour peaux sensibles.',
                'price' => 185.00,
                'discount_price' => null,
                'stock' => 40,
                'image_url' => null,
                'sku' => 'PHC-DRM001',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Hygiène
            [
                'category_id' => 4,
                'name' => 'Gel Hydroalcoolique',
                'description' => 'Désinfectant mains.',
                'price' => 45.00,
                'discount_price' => null,
                'stock' => 200,
                'image_url' => null,
                'sku' => 'PHC-HYG001',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Bébé
            [
                'category_id' => 5,
                'name' => 'Lait Infantile',
                'description' => '0 à 6 mois.',
                'price' => 280.00,
                'discount_price' => null,
                'stock' => 50,
                'image_url' => null,
                'sku' => 'PHC-MAM001',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Aromathérapie
            [
                'category_id' => 6,
                'name' => 'Huile Lavande',
                'description' => 'Relaxante.',
                'price' => 95.00,
                'discount_price' => null,
                'stock' => 65,
                'image_url' => null,
                'sku' => 'PHC-ARM001',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}