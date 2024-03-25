<?php

namespace App\Repositories;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function create(Request $request)
    {
        $empleado = new Empleado();
        $empleado->fill($request->only(['nombre', 'apellido', 'edad', 'cargo']));
        $empleado->save();
        return $this->registerUser($request, $empleado);
    }

    /**
     * @param Request $request
     * @param Empleado $empleado
     * @return User|null
     */
    private function registerUser(Request $request, Empleado $empleado): ?User
    {
        $user = new User();
        $user->fill($request->only(['email', 'estado']));
        $user->hash = Hash::make($request->password);
        $user->empleado_id = $empleado->id;
        if ($user->save()) return $user;
        $empleado->delete();
        return null;
    }

    public function getUserByEmail(string $email)
    {
        return User::query()->where('email', $email)->first();
    }

    public function login(Request $request)
    {
        $user = User::query()->where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->hash)) return $user;
        return null;
    }

}
