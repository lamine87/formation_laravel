<?php

use App\Taille;
use Illuminate\Database\Seeder;

class TaillesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       // $taille = ['36','38','40','42','44','46'];
        //$taille = ['36','38','40','42','44','46','47','48','49','50'];
        $taille = ['54','55','56','57','58','59','60','61','62','63'];
        foreach ($taille as $t){
            $taille = new Taille();
            $taille->nom = $t;
            $taille->type_id =4;
            $taille->save();

        }

    }
}
