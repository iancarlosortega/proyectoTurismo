<?php

namespace Database\Seeders;

use App\Models\LugaresTuristicos;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('turismo');
        Storage::makeDirectory('turismo');
        // \App\Models\User::factory(10)->create();
        $users = new User();
        $users->name = "Admin";
        $users->email = "admin@admin.com";
        $users->email_verified_at = now();
        $users->password = '$2y$10$tive4vPDzIq02SVERWxkYOAeXeaToAv57KQeF1kXXU7nogh60fYO2'; //Testing.1234
        $users->remember_token = Str::random(10);
        $users->save();

        
        // $hotel = new LugaresTuristicos();
        // $hotel ->user_id = 1;
        // $hotel ->nombre = "GRAND VICTORIA BOUTIQUE";
        // $hotel ->descripcion = "El Grand Victoria Boutique Hotel abrió sus puertas el 26 de julio del 2007. Es una hermosa propiedad de estilo republicano, que brinda a sus huéspedes un entorno natural inmerso en la bellísima ciudad de Loja. Por sus amplias instalaciones y su impecable servicio, lo invita a vivir días inolvidables, hospedándose en el hotel más emblemático de la ciudad, con la mejor gastronomía local e internacional.";
        // $hotel ->contenido = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate consequatur quisquam ipsum nostrum animi doloremque molestiae enim cumque, ut, consectetur, voluptates ad nam voluptatibus maiores nulla nisi suscipit provident! Cum?
        // Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate consequatur quisquam ipsum nostrum animi doloremque molestiae enim cumque, ut, consectetur, voluptates ad nam voluptatibus maiores nulla nisi suscipit provident! Cum?
        // Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate consequatur quisquam ipsum nostrum animi doloremque molestiae enim cumque, ut, consectetur, voluptates ad nam voluptatibus maiores nulla nisi suscipit provident! Cum?
        // Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate consequatur quisquam ipsum nostrum animi doloremque molestiae enim cumque, ut, consectetur, voluptates ad nam voluptatibus maiores nulla nisi suscipit provident! Cum?
        // Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate consequatur quisquam ipsum nostrum animi doloremque molestiae enim cumque, ut, consectetur, voluptates ad nam voluptatibus maiores nulla nisi suscipit provident! Cum?";
        // $hotel ->imagen = null;
        // $hotel ->tipo = "Hotel";
        // $hotel ->categoria = 5;
        // $hotel ->save();

        // $hotel2 = new LugaresTuristicos();
        // $hotel2 ->user_id = 1;
        // $hotel2 ->nombre = "SONESTA HOTEL LOJA";
        // $hotel2 ->descripcion = "Sonesta Hotel Loja ofrece 73 modernas habitaciones con excelentes vistas de la ciudad e iluminación natural, está ubicado en una zona residencial conocida por su seguridad y tranquilidad. A 5 minutos del centro de la ciudad ya 45 minutos del aeropuerto Ciudad de Catamayo.";
        // $hotel2 ->contenido = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate consequatur quisquam ipsum nostrum animi doloremque molestiae enim cumque, ut, consectetur, voluptates ad nam voluptatibus maiores nulla nisi suscipit provident! Cum?
        // Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate consequatur quisquam ipsum nostrum animi doloremque molestiae enim cumque, ut, consectetur, voluptates ad nam voluptatibus maiores nulla nisi suscipit provident! Cum?
        // Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate consequatur quisquam ipsum nostrum animi doloremque molestiae enim cumque, ut, consectetur, voluptates ad nam voluptatibus maiores nulla nisi suscipit provident! Cum?
        // Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate consequatur quisquam ipsum nostrum animi doloremque molestiae enim cumque, ut, consectetur, voluptates ad nam voluptatibus maiores nulla nisi suscipit provident! Cum?
        // Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate consequatur quisquam ipsum nostrum animi doloremque molestiae enim cumque, ut, consectetur, voluptates ad nam voluptatibus maiores nulla nisi suscipit provident! Cum?";
        // $hotel2 ->imagen = null;
        // $hotel2 ->tipo = "Hotel";
        // $hotel2 ->categoria = 5;
        // $hotel2 ->save();
        

        //LugaresTuristicos::factory(24)->create();


    }
}
