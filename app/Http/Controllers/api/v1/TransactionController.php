<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TransactionController as NoApiTransactionController;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $response = json_decode(NoApiTransactionController::show($request->id));
        $response = $response->data;
        $exist = Transaction::where('id_transaction', '=', $request->id)->where('id_transaction','=',$response->id)->first();
        if (!!$exist) {
            $respuesta = [
                'message' => 'La transacción ya existe',
                'id_transaction' => $response->id,
                'status' => $response->status,
                'status_message' => $response->status_message
            ];
        } else {
            $insert = Transaction::create(
                [
                    'user_id' => 2,
                    'id_transaction' => $response->id,
                    'reference' => $response->reference,
                    'status' => $response->status,
                    'status_message' => $response->status_message ? $response->status_message : null,
                    'price' => $response->amount_in_cents,
                    'currency' => $response->currency
                ]
            );
            $respuesta = [
                'message' => 'La transacción se ha registrado con éxito',
                'id_transaction' => $response->id,
                'status' => $response->status,
                'status_message' => $response->status_message

            ];
        }
        return response($respuesta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
