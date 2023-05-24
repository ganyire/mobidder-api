<?php

namespace App\Exceptions;

use App\Traits\Responder;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use Responder;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        if (!App::environment('testing')) :

            $this->renderable(function (Throwable $exception) {
                if ($exception instanceof ValidationException) :
                    $errors = $exception->errors();

                    $formattedErrors = [];
                    foreach ($errors as $field => $messages) :
                        foreach ($messages as $message) :
                            $formattedErrors[$field][] = $message;
                        endforeach;
                    endforeach;
                    $error = collect($formattedErrors)->map(function ($error) {
                        return $error[0];
                    });
                    return $this->error(message: 'Invalid data encountered', data: $error, httpCode: 422);
                endif;
            });

        endif;
    }
}
