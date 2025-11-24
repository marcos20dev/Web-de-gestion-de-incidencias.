<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Rol;

class AuthController extends Controller
{
    /**
     * Mostrar formulario de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesar el login
     */
    public function login(Request $request)
    {
        // Validación de datos
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Intentar autenticación
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Verificar si la cuenta está activa
            $user = Auth::user();

            if ($user->estado === 'activo') {
                // Redirección basada en rol
                return $this->redirectToDashboard($user);
            }
            elseif ($user->estado === 'pendiente') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Tu cuenta está pendiente de aprobación. Recibirás un correo cuando sea activada.',
                ])->onlyInput('email');
            }
            elseif ($user->estado === 'suspendido') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Tu cuenta ha sido suspendida. Contacta con el administrador.',
                ])->onlyInput('email');
            }
            else {
                // Estado desconocido
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Estado de cuenta no válido. Contacta con soporte.',
                ])->onlyInput('email');
            }
        }

        // Si falla la autenticación
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ])->onlyInput('email');
    }

    /**
     * Mostrar formulario de registro
     */

public function showRegisterForm()
{
    $roles = Rol::all(); // o filtra los roles visibles si deseas
    return view('auth.register', compact('roles'));
}



    /**
     * Procesar el registro
     */
 public function register(Request $request)
{
    // 🔹 Validar datos del formulario
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido_paterno' => 'required|string|max:255',
        'apellido_materno' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'rol' => 'required|string|exists:roles,nombre', // <- valida que el rol exista en la tabla roles
    ]);

    // 🔹 Obtener el rol desde la tabla roles
   $rol = Rol::where('nombre', $validated['rol'])->first();

    if (!$rol) {
        return back()->withErrors(['rol' => 'El rol seleccionado no existe.']);
    }

    // 🔹 Crear el usuario
    $user = User::create([
        'nombre' => $validated['nombre'],
        'apellido_paterno' => $validated['apellido_paterno'],
        'apellido_materno' => $validated['apellido_materno'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'rol_id' => $rol->id_roles, // ← Guardamos la relación correcta
        'estado' => 'pendiente',
    ]);

    // 🔹 Redirigir con mensaje de éxito
    return redirect()->route('login')
        ->with('success', 'Tu cuenta ha sido creada. Está pendiente de aprobación por un administrador.');
}

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirección personalizada según el rol
     */
    /**
     * Redirección personalizada según el rol
     */
    private function redirectToDashboard($user)
    {
        return redirect()->route('dashboard');
    }

    /**
     * Verificar estado de la cuenta
     */
    public function checkAccountStatus(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'No se encontró una cuenta con este email.'
            ]);
        }

        return response()->json([
            'status' => $user->estado,
            'message' => $this->getStatusMessage($user->estado)
        ]);
    }

    /**
     * Mensajes según el estado de la cuenta
     */
    private function getStatusMessage($status)
    {
        switch ($status) {
            case 'activo':
                return 'Tu cuenta está activa y puedes iniciar sesión.';
            case 'pendiente':
                return 'Tu cuenta está pendiente de aprobación. Recibirás un email cuando sea activada.';
            case 'suspendido':
                return 'Tu cuenta está suspendida. Contacta con el administrador.';
            default:
                return 'Estado de cuenta desconocido.';
        }
    }
}
