<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProductRepository;
use Carbon\Carbon;

class AuthController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function showLoginForm()
    {
        if(Auth::check() === true) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.index');
    }

    public function home()
    {
        $currentDate = date('d/m/Y', strtotime(Carbon::now()->toDateString()));
        $productCreatedAt = $this->productRepository->getProductDay('created_at');
        $productDeletedAt = $this->productRepository->getProductDay('deleted_at');
        $productCreateInSystem = $this->productRepository->getProductCreateInDevice('system');
        $productCreateInApi = $this->productRepository->getProductCreateInDevice('Api');
        $productLowStock = $this->productRepository->getLowStock();

        return view('admin.administration.reports.index', compact('currentDate', 'productCreatedAt', 'productDeletedAt', 'productCreateInSystem', 'productCreateInApi', 'productLowStock'));
    }

    public function login(Request $request)
    {
        if(in_array('', $request->only('email', 'password'))) {
            $json['message'] = $this->message->error('Ooops, informe todos os dados para efetuar o login')->render();
            return response()->json($json);
        }

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $json['message'] = $this->message->error('Ooops, informe um e-mail válido')->render();
            return response()->json($json);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials)) {
            $json['message'] = $this->message->error('Ooops, usuário e senha não conferem')->render();
            return response()->json($json);
        }

        if (!$this->isAdmin()) {
            Auth::logout();
            $json['message'] = $this->message->error('Ooops, usuário não tem permissão para acessar o painel de controle')->render();
            return response()->json($json);
        }

        $this->authenticated($request->getClientIp());
        $json['redirect'] = route('admin.home');
        return response()->json($json);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    private function isAdmin()
    {
        $user = User::where('id', Auth::user()->id)->first();

        if ($user->admin == 1) {
            return true;
        }

        return false;
    }

    private function authenticated(string $ip)
    {
        $user = User::where('id', Auth::user()->id);
        $user->update([
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $ip,
        ]);
    }
}
