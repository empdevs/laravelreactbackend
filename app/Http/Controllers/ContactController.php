<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\ContactRole;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contact $contact)//GET Method
    {
        $contacts = $contact->all();
        $arr_users = [];
        $arr_role_user =[];
        foreach($contacts as $c){
            foreach($c->role as $cr){
                $role_user=[
                    "id" => $cr->id,
                    "role" => $cr->role,
                    "color" => $cr->color
                ];
                // var_dump($role_user);
                array_push($arr_role_user,$role_user);

            }
            $user = [
                "id"=>$c->id,
                "name"=>$c->name,
                "phone"=>$c->phone,
                "roles"=> $arr_role_user
            ];
            array_push($arr_users, $user);
            $arr_role_user = [];
            // var_dump($user);
        }
        return response()->json($arr_users);
            // return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Contact $contact)//POST Method
    {
        $requests = $request->all();
        
        $roles = $requests['roles'];
        
        // var_dump($requests,$roles);
        
        $arr_role = [];

        $contact->create($requests);

        for($i = 0; $i < count($roles); $i++){
            DB::table('contact_role')->insert([
                "contact_id" => $request["id"],
                "role_id"=>$roles[$i]
            ]);
        }

        // return response()->json($requests);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//GET Method
    {
        $arr_role_user = [];
        $arr_user = [];
        $contact = Contact::where("id",$id)->get();
        foreach($contact as $c){
            foreach($c->role as $cr){
                $role_user=[
                    "id" => $cr->id,
                    "role" => $cr->role,
                    "color" => $cr->color
                ];
                // var_dump($role_user);
                array_push($arr_role_user,$role_user);
            }
            
            $user = [
                "id"=>$c->id,
                "name"=>$c->name,
                "phone"=>$c->phone,
                "roles"=> $arr_role_user
            ];
            // var_dump($user);
        }
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//PUT Method
    {
        $requests = $request->all();

        $roles = $requests["roles"];
        
        $contact = Contact::find($id);
        
        $contact->update($requests);

        DB::table('contact_role')->where('contact_id',$id)->delete();

        for($i = 0; $i < count($roles); $i++){
            DB::table('contact_role')->insert([
                "contact_id"=>$id,
                "role_id"=>$roles[$i]
            ]);
        }
        return response()->json($requests);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("contact_role")->where("contact_id",$id)->delete();

        $contact = Contact::find($id);

        $contact->delete();

        return response()->json($contact);
    }
}
