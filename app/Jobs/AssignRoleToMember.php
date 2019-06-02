<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Spatie\Permission\Models\Role;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AssignRoleToMember implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $role;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param string $role
     */
    public function __construct(User $user, string $role)
    {
        $this->user = $user;

        $this->role = $role;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->assignRole(Role::findByName($this->role));
    }
}
