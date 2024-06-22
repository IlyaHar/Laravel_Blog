<?php

namespace App\Http\Controllers\Personal\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Personal\Settings\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, User $user)
    {
        $data = $request->validated();

        if ($user->avatar !== 'images/avatars/default-avatar.png') {
            Storage::disk('public')->delete($user->avatar);
        }

        $data['avatar'] = Storage::disk('public')->put('/images/avatars', $data['avatar']);

        $user->update($data);

        return redirect()->route('personal.settings.index');
    }
}
