<?php
namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        Validator::make($input, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'name'                     => $input['name'],
            'email'                    => $input['email'],
            'password'                 => Hash::make($input['password']),
            'nama'                     => $input['nama'] ?? $input['name'],
            'jenis_kelamin'            => $input['jenis_kelamin'] ?? null,
            'faktor_alkohol'           => isset($input['faktor_alkohol']),
            'faktor_berganti_pasangan' => isset($input['faktor_berganti_pasangan']),
            'faktor_jarum_suntik'      => isset($input['faktor_jarum_suntik']),
            'faktor_seks_tanpa_kondom' => isset($input['faktor_seks_tanpa_kondom']),
        ]);
    }
}
