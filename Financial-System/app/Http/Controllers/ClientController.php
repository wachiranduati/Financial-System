<?php

namespace App\Http\Controllers;

use App\Http\Resources\Client as ClientResource;
use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
     public function store(Request $request)
    {
    	$client = Client::create([
    		'firstname'=> $request->firstname,
            'othernames'=> $request->othernames,
            'address' => $request->address,
            'customerid'=> $request->customerid,
            'nationalid'=> $request->nationalid,
            'mobilenumber'=>$request->mobilenumber,
            'customerphoto'=> $request->customerphoto
    	]);
    	return response()->json( new ClientResource($client), 201);
    }

    public function update(Request $request, int $id)
    {
    	$client = Client::findorfail($id);

    	if($request->has('firstname'))
    	{
    		$client->update([
    			'firstname'=> $request->firstname
    		]);

    	}
    	if($request->has('othernames'))
    	{
    		$client->update([
    			'othernames'=> $request->othernames
    		]);

    	}
    	if($request->has('address'))
    	{
    		$client->update([
    			'address'=> $request->address
    		]);

    	}
    	if($request->has('customerid'))
    	{
    		$client->update([
    			'customerid'=> $request->customerid
    		]);

    	}
    	if($request->has('nationalid'))
    	{
    		$client->update([
    			'nationalid'=> $request->nationalid
    		]);

    	}
    	if($request->has('mobilenumber'))
    	{
    		$client->update([
    			'mobilenumber'=> $request->mobilenumber
    		]);

    	}
    	if($request->has('customerphoto'))
    	{
    		$client->update([
    			'customerphoto'=> $request->customerphoto
    		]);

    	}

    	return response()->json(new ClientResource($client));

    }

    public function show(Request $request)
    {
    	if($request->has('nationalid'))
    	{
         	$client = Client::where('nationalid', '=', $request->nationalid)->firstorfail();
    	}elseif($request->has('customerid'))
    	{
         	$client = Client::where('customerid', '=', $request->customerid)->firstorfail();
    	}elseif($request->has('names'))
    	{
         	$client = Client::where('firstname', 'like', '%'.$request->names.'%')->orwhere('othernames', 'like', '%'.$request->names.'%')->firstorfail();
    	}else{
    		return response()->json([], 404);
    	}

    	// return response()->json(new ClientResource($client));
    	return $client;
    }

}
