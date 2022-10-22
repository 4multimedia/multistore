<?php

namespace Multimedia\Multistore\Commands;

use Illuminate\Support\Facades\Validator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Multimedia\Multistore\Core\Models\User;
use Multimedia\Multistore\Core\Models\UserRole;
use Str;

class ModulesCreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:user.create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user';

	public function validate($email) {
		$rules = ['email' => ['required', 'email']];
		$validator = Validator::make(['email' => $email], $rules);
		if ($validator->fails()) {
			$this->error('Incorrect email address');
			return false;
		}
		if (User::where('email', $email)->count() == 1) {
			$this->error('E-mail address already exists');
			return false;
		}
		return true;
	}

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->ask('Please enter your e-mail address');
		$emailValidate = $this->validate($email);

		while(!$emailValidate) {
			$email = $this->ask('Please enter your e-mail address');
			$emailValidate = $this->validate($email);
		}

		$randomPassword = $this->confirm('Generate a random password?', true);
		if ($randomPassword) {
			$password = Str::random(rand(8,16));
		} else {
			$password = $this->ask('Please enter password (min 8 characters)');
		}

		$passwordLength = strlen($password);
		while($passwordLength < 8) {
			$this->error('The password must be at least 8 characters long');
			$password = $this->ask('Please enter password (min 8 characters)');
			$passwordLength = strlen($password);
		}

		$role = $this->choice('Set the role',
			UserRole::select('id_user_role', 'name')->get()->pluck('name', 'id_user_role')->toArray()
		);

		$id_user_role = UserRole::where('name', $role)->first();

		$this->info('Success! The user has been created');
		$this->line("Email: $email");
		$this->line("Password: $password");
		$this->line("Role: $role");

		User::create([
			'email' => $email,
			'password' => Hash::make($password),
			'id_user_status' => 1
		]);
    }
}
