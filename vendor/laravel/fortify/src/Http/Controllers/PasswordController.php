<?php

namespace Laravel\Fortify\Http\Controllers;

use App\Actions\Fortify\ResetUserPassword;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravel\Fortify\Contracts\PasswordUpdateResponse;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Contracts\ResetUserPassword  $updater
     * @return \Laravel\Fortify\Contracts\PasswordUpdateResponse
     */
    public function update(Request $request, ResetUserPassword $updater)
    {
        $updater->reset($request->user(), $request->all());

        return app(PasswordUpdateResponse::class);
    }
}
