<?php

namespace Database\Seeders;

use App\Models\Cicle;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    private function seedAdmin()
    {
        $user = USER::create([
            'name' => 'administrador',
            'email' => 'admin@admin.cat',
            'password' => bcrypt('admin1234')
        ]);
    }

    private function seedStudents()
    {
        $user = User::create([
            'name' => 'Iker Buded',
            'email' => 'iker@ibc.cat',
            'password' => bcrypt('iker1234')
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'address' => 'Avinguda de Marià Fortuny',
            'birth_date' => '2006-06-10',
            'phone_number' => '699888777',
        ]);

        $user2 = User::create([
            'name' => 'Douaa Kaddar',
            'email' => 'douaa@ibc.cat',
            'password' => bcrypt('douaa1234')
        ]);

        $student2 = Student::create([
            'user_id' => $user2->id,
            'name' => $user2->name,
            'email' => $user2->email,
            'address' => 'Reus',
            'birth_date' => '2004-02-19',
            'phone_number' => '666555444',
            'cicle_id' => 1
        ]);

        $studentsData = [
            ['name' => 'Arnau Mariné', 'address' => 'Carrer de Sant Joan', 'birth_date' => '2006-03-12', 'phone' => '611223344'],
            ['name' => 'Biel Cordonet', 'address' => 'Avinguda Prat de la Riba', 'birth_date' => '2005-08-24', 'phone' => '612334455'],
            ['name' => 'Pol Porro', 'address' => 'Passeig Mata', 'birth_date' => '2006-05-10', 'phone' => '613445566'],
            ['name' => 'David Lucia', 'address' => 'Carrer de l\'Hospital', 'birth_date' => '2005-11-03', 'phone' => '614556677'],
            ['name' => 'Eduard Cañamás', 'address' => 'Carrer de les Galanes', 'birth_date' => '2006-01-18', 'phone' => '615667788'],
            ['name' => 'Gonzalo Poyatos', 'address' => 'Avinguda President Macià', 'birth_date' => '2005-10-30', 'phone' => '616778899'],
            ['name' => 'Alan Garcia', 'address' => 'Carrer de Josep Sardà', 'birth_date' => '2006-07-25', 'phone' => '617889900'],
            ['name' => 'Jesus Silva', 'address' => 'Carrer Ample', 'birth_date' => '2006-02-14', 'phone' => '618990011'],
            ['name' => 'Carlos Lara', 'address' => 'Raval de Santa Anna', 'birth_date' => '2005-09-05', 'phone' => '619001122'],
            ['name' => 'Pol Singh', 'address' => 'Carrer del Roser', 'birth_date' => '2006-04-09', 'phone' => '620112233'],
            ['name' => 'Youssef Ghaddari', 'address' => 'Passeig de Sunyer', 'birth_date' => '2005-06-16', 'phone' => '621223344'],
        ];

        foreach ($studentsData as $data) {
            // Separar nom i cognom
            $parts = explode(' ', $data['name']);
            $firstName = strtolower($parts[0]);
            $lastName = isset($parts[1]) ? strtolower($parts[1]) : '';
            $cleanLastName = preg_replace('/[^a-z]/', '', $lastName); // treu accents i caràcters especials

            $email = $firstName . $cleanLastName . '@ibc.cat';
            $password = bcrypt($firstName . '1234');

            $cicleId = rand(0, 2);
            if ($cicleId === 0) {
                $cicleId = null;
            }


            $user = User::create([
                'name' => $data['name'],
                'email' => $email,
                'password' => $password,
            ]);

            Student::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'email' => $email,
                'address' => $data['address'],
                'birth_date' => $data['birth_date'],
                'phone_number' => $data['phone'],
                'cicle_id' => $cicleId
            ]);
        }
    }

    private function seedCicles()
    {
        $dam = Cicle::create([
            'code' => 'DAM',
            'name' => 'Desenvolupament d\' Aplicacions Multiplataforma',
            'description' => 'Aprèn a crear apps per a mòbils i ordinadors amb Java, Kotlin o Swift. Domina eines com Android Studio i desenvolupa aplicacions per a diferents sistemes operatius.',
            'num_courses' => 2,
            'image' => 'ciclesImages/portada-dam.png'
        ]);

        $asix = Cicle::create([
            'code' => 'ASIX',
            'name' => 'Administració de Sistemes Informàtics en Xarxa',
            'description' => 'Aprèn a instal·lar, configurar i mantenir xarxes i servidors. Gestiona sistemes operatius, serveis de xarxa i seguretat amb eines com Docker o VMware',
            'num_courses' => 2,
            'image' => 'ciclesImages/portada-asix.png'
        ]);
    }

    public function run(): void
    {
        // User::factory(10)->create();

        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */

        self::seedAdmin();
        self::seedCicles();
        self::seedStudents();
    }
}
