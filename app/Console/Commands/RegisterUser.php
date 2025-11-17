<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class RegisterUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:register
                            {--name= : The name of the user}
                            {--email= : The email address of the user}
                            {--password= : The password for the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register a new user account via CLI';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->option('name') ?: text(
            label: 'What is the user\'s name?',
            required: true
        );

        $email = $this->option('email') ?: text(
            label: 'What is the user\'s email?',
            required: true,
            validate: fn (string $value) => match (true) {
                ! filter_var($value, FILTER_VALIDATE_EMAIL) => 'Please enter a valid email address.',
                User::where('email', $value)->exists() => 'This email is already registered.',
                default => null
            }
        );

        $userPassword = $this->option('password') ?: password(
            label: 'What is the user\'s password?',
            required: true,
            validate: fn (string $value) => $this->validatePassword($value)
        );

        // Final validation
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $userPassword,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['required', 'string', Password::defaults()],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $userPassword,
        ]);

        $this->components->info("User [{$user->email}] registered successfully!");

        return self::SUCCESS;
    }

    /**
     * Validate password requirements.
     */
    private function validatePassword(string $value): ?string
    {
        $validator = Validator::make(['password' => $value], [
            'password' => ['required', 'string', Password::defaults()],
        ]);

        if ($validator->fails()) {
            return $validator->errors()->first('password');
        }

        return null;
    }
}
