<?php

// namespace App\Exceptions;

// use Illuminate\Auth\AuthenticationException;
// use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// use Throwable;

// class Handler extends ExceptionHandler
// {
//     protected $levels = [];

//     protected $dontReport = [];

//     protected $dontFlash = [
//         'current_password',
//         'password',
//         'password_confirmation',
//     ];

//     public function register(): void
//     {
//         $this->reportable(function (Throwable $e) {
//             //
//         });
//     }

//     protected function unauthenticated($request, AuthenticationException $exception)
//     {
//         if ($request->expectsJson()) {
//             return response()->json(['message' => $exception->getMessage()], 401);
//         }

//         foreach ($exception->guards() as $guard) {
//             switch ($guard) {
//                 case 'mechanic':
//                     $login = route('mechanic.login');
//                     break;
//                 case 'admin':
//                     $login = route('admin.login');
//                     break;
//                 default:
//                     $login = route('login');
//                     break;
//             }
//         }

//         return redirect()->guest($login);
//     }
// }
