<?php

use Illuminate\Database\Seeder;

class ComentariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comentarios')->insert([
            'produto_id' => 1,
            'usuario'    => 'João Lucas',
            'comentario' => 'Melhor batata frita',
            'created_at' => date('Y/m/d h:i:s'),
            'updated_at' => date('Y/m/d h:i:s'),
        ]);

        DB::table('comentarios')->insert([
            'produto_id' => 1,
            'usuario'    => 'Mariana Silva',
            'comentario' => 'Muito bom',
            'created_at' => date('Y/m/d h:i:s'),
            'updated_at' => date('Y/m/d h:i:s'),
        ]);

        DB::table('comentarios')->insert([
            'produto_id' => 1,
            'usuario'    => 'Carlos',
            'comentario' => 'Espetacular',
            'created_at' => date('Y/m/d h:i:s'),
            'updated_at' => date('Y/m/d h:i:s'),
        ]);
    }
}
