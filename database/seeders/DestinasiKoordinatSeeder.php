<?php

namespace Database\Seeders;

use App\Models\Destinasi;
use Illuminate\Database\Seeder;

class DestinasiKoordinatSeeder extends Seeder
{
    private array $data = [
        ['id_destinasi' => 7,  'latitude' => -7.9813051, 'longitude' => 112.6376925],
        ['id_destinasi' => 8,  'latitude' => -7.9826145, 'longitude' => 112.6308113],
        ['id_destinasi' => 9,  'latitude' => -7.977143,  'longitude' => 112.6340478],
        ['id_destinasi' => 10, 'latitude' => -7.9235099, 'longitude' => 112.6580123],
        ['id_destinasi' => 11, 'latitude' => -7.8846458, 'longitude' => 112.4768237],
        ['id_destinasi' => 12, 'latitude' => -7.9705673, 'longitude' => 112.8023017],
        ['id_destinasi' => 13, 'latitude' => -7.9116767, 'longitude' => 112.5184342],
        ['id_destinasi' => 14, 'latitude' => -8.4034458, 'longitude' => 112.5391259],
        ['id_destinasi' => 15, 'latitude' => -8.3835873, 'longitude' => 112.4242054],
        ['id_destinasi' => 16, 'latitude' => -8.4391428, 'longitude' => 112.6777942],
        ['id_destinasi' => 17, 'latitude' => -8.4429424, 'longitude' => 112.6654655],
        ['id_destinasi' => 18, 'latitude' => -8.4471919, 'longitude' => 112.6537097],
        ['id_destinasi' => 19, 'latitude' => -7.8220855, 'longitude' => 112.526612],
        ['id_destinasi' => 20, 'latitude' => -7.8542907, 'longitude' => 112.4857585],
        ['id_destinasi' => 21, 'latitude' => -7.8204902, 'longitude' => 112.6431502],
        ['id_destinasi' => 22, 'latitude' => -8.1656096, 'longitude' => 112.5920333],
        ['id_destinasi' => 23, 'latitude' => -8.049703,  'longitude' => 112.7164399],
        ['id_destinasi' => 24, 'latitude' => -8.1228293, 'longitude' => 112.6206066],
        ['id_destinasi' => 25, 'latitude' => -7.9524529, 'longitude' => 112.6749379],
        ['id_destinasi' => 26, 'latitude' => -7.8682192, 'longitude' => 112.4850916],
        ['id_destinasi' => 27, 'latitude' => -7.8965741, 'longitude' => 112.5345361],
        ['id_destinasi' => 28, 'latitude' => -7.9234101, 'longitude' => 112.657862],
        ['id_destinasi' => 29, 'latitude' => -7.9578376, 'longitude' => 112.5985719],
        ['id_destinasi' => 30, 'latitude' => -7.9153841, 'longitude' => 112.5889089],
    ];

    public function run(): void
    {
        foreach ($this->data as $item) {
            Destinasi::where('id_destinasi', $item['id_destinasi'])
                ->update([
                    'latitude' => $item['latitude'],
                    'longitude' => $item['longitude'],
                ]);
        }
    }
}
