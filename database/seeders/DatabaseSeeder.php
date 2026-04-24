<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $categories = [
            [
                'id' => 1,
                'name' => 'Medicaments',
                'description' => 'Medicaments sur ordonnance et sans ordonnance',
                'is_active' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Complements alimentaires',
                'description' => 'Vitamines, mineraux et probiotiques',
                'is_active' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Dermo-cosmetique',
                'description' => 'Soins de la peau et produits de beaute',
                'is_active' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Hygiene et Bien-etre',
                'description' => 'Produits d hygiene quotidienne',
                'is_active' => 1,
            ],
            [
                'id' => 5,
                'name' => 'Maman et Bebe',
                'description' => 'Produits pour mamans et nourrissons',
                'is_active' => 1,
            ],
            [
                'id' => 6,
                'name' => 'Aromatherapie',
                'description' => 'Huiles essentielles et produits naturels',
                'is_active' => 1,
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['id' => $category['id']],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'is_active' => $category['is_active'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $products = [
            [
                'category_id' => 1,
                'name' => 'Doliprane 1000mg',
                'description' => 'Antalgique et antipuretique pour douleurs et fievre.',
                'price' => 25.00,
                'discount_price' => null,
                'stock' => 150,
                'image_url' => 'https://www.pharmacie-cayeux.com/resize/600x600/media/finish/img/normal/86/3400941631245-doliprane-tabs-1000mg-8-comprimes.jpg',
                'sku' => 'PHC-MED001',
                'is_active' => 1,
            ],
            [
                'category_id' => 1,
                'name' => 'Efferalgan 500mg',
                'description' => 'Paracetamol effervescent rapide.',
                'price' => 32.50,
                'discount_price' => 28.00,
                'stock' => 90,
                'image_url' => 'https://www.pharmaciepolygone.com/media/image/10/bf/51fff9d706d8109c4d793194e683.jpeg',
                'sku' => 'PHC-MED002',
                'is_active' => 1,
            ],
            [
                'category_id' => 2,
                'name' => 'Vitamine D3 Premium',
                'description' => 'Renforce immunite et os.',
                'price' => 120.00,
                'discount_price' => null,
                'stock' => 85,
                'image_url' => 'https://www.naturemade.com/cdn/shop/products/NM2673PK000652VITAMIND3front.png?v=1665421285',
                'sku' => 'PHC-CMP001',
                'is_active' => 1,
            ],
            [
                'category_id' => 3,
                'name' => 'Creme Hydratante',
                'description' => 'Soin pour peaux sensibles.',
                'price' => 185.00,
                'discount_price' => null,
                'stock' => 40,
                'image_url' => 'https://commons.wikimedia.org/wiki/Special:Redirect/file/Eucerin-cream.jpg',
                'sku' => 'PHC-DRM001',
                'is_active' => 1,
            ],
            [
                'category_id' => 4,
                'name' => 'Gel Hydroalcoolique',
                'description' => 'Desinfectant mains.',
                'price' => 45.00,
                'discount_price' => null,
                'stock' => 200,
                'image_url' => 'https://commons.wikimedia.org/wiki/Special:Redirect/file/Purell_hand_sanitizer_gel_in_bottle_%288487014501%29.jpg',
                'sku' => 'PHC-HYG001',
                'is_active' => 1,
            ],
            [
                'category_id' => 5,
                'name' => 'Lait Infantile',
                'description' => '0 a 6 mois.',
                'price' => 280.00,
                'discount_price' => null,
                'stock' => 50,
                'image_url' => 'https://commons.wikimedia.org/wiki/Special:Redirect/file/Enfamil_Gentlease_Infant_Formula.JPG',
                'sku' => 'PHC-MAM001',
                'is_active' => 1,
            ],
            [
                'category_id' => 6,
                'name' => 'Huile Lavande',
                'description' => 'Relaxante.',
                'price' => 95.00,
                'discount_price' => null,
                'stock' => 65,
                'image_url' => 'https://commons.wikimedia.org/wiki/Special:Redirect/file/LavenderEssentialOil.png',
                'sku' => 'PHC-ARM001',
                'is_active' => 1,
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->updateOrInsert(
                ['sku' => $product['sku']],
                [
                    'category_id' => $product['category_id'],
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'discount_price' => $product['discount_price'],
                    'stock' => $product['stock'],
                    'image_url' => $product['image_url'],
                    'is_active' => $product['is_active'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
