<?php

namespace App\Http\Controllers\Apis\v1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HandlesJsonResponse;

class LocationController extends Controller
{
    use HandlesJsonResponse;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     private $notFoundMessage = 'response.messages.not_found';
     private $notFoundError = 'response.errors.not_found';
     private $notFoundErrorCode = 'response.codes.not_found_error';
     private $userAttribute = 'user';

     public function updateLocation(Request $request, $id){
       $user = User::find($id);

       if(!$user){
         return $this->jsonResponse(__($this->notFoundMessage, ['attr' => $this->userAttribute]), __($this->notFoundErrorCode), 404, [], __($this->notFoundError));
       }

       $user->location->fill([
         'lng' => $request->lng,
         'lat' => $request->lat
       ])->save();

       return $this->jsonResponse('Location updated successfully.');
     }
}
