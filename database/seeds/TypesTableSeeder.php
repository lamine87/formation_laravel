<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $type = new Type();
        $type-> nom = "Vetement";
        $type-> save();

        $type = new Type();
        $type-> nom = "Chaussure";
        $type-> save();

        $type = new Type();
        $type-> nom = "Pantalon";
        $type-> save();

        $type = new Type();
        $type-> nom = "Chapeau";
        $type-> save();

    }
}
