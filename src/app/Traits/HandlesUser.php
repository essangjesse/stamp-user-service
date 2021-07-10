<?php

namespace App\Traits;

use App\Models\User;

trait HandlesUser
{
    public function fetchUser($request){
      $params = $request->params ? explode(',', $request->params) : null;

      $limit = $request->limit;

      $corpsMembersOnly = $request->corps_members_only;

      $adminsOnly = $request->admins_only;

      if($params){
        if($limit){
          if($corpsMembersOnly){
            $users = User::where('is_admin', false)->whereIn('id', $params)->orderBy('created_at', 'DESC')->paginate($limit);
          }else if ($adminsOnly){
            $users = User::where('is_admin', true)->whereIn('id', $params)->orderBy('created_at', 'DESC')->paginate($limit);
          }else{
            $users = User::whereIn('id', $params)->orderBy('created_at', 'DESC')->paginate($limit);
          }
        }else{
          if($corpsMembersOnly){
            $users = User::where('is_admin', false)->whereIn('id', $params)->orderBy('created_at', 'DESC')->get();
          }else if ($adminsOnly){
            $users = User::where('is_admin', true)->whereIn('id', $params)->orderBy('created_at', 'DESC')->get();
          }else{
            $users = User::whereIn('id', $params)->orderBy('created_at', 'DESC')->get();
          }
        }
      }else{
        if($limit){
          if($corpsMembersOnly){
            $users = User::where('is_admin', false)->orderBy('created_at', 'DESC')->paginate($limit);
          }else if ($adminsOnly){
            $users = User::where('is_admin', true)->orderBy('created_at', 'DESC')->paginate($limit);
          }else{
            $users = User::orderBy('created_at', 'DESC')->paginate($limit);
          }
        }else{
          if($corpsMembersOnly){
            $users = User::where('is_admin', false)->orderBy('created_at', 'DESC')->get();
          }else if ($adminsOnly){
            $users = User::where('is_admin', true)->orderBy('created_at', 'DESC')->get();
          }else{
            $users = User::orderBy('created_at', 'DESC')->get();
          }
        }
      }

      return $users;
    }
}
