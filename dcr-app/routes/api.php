<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// CURL example
// curl --request POST \
//   --url http://localhost:8180/realms/demo/clients-registrations/default \
//   --header 'Content-Type: application/json' \
//   --header 'User-Agent: insomnia/8.2.0' \
//   --header 'Authorization: bearer eyJhbGciOiJIUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJjMThjOWZlNS1lODQ0LTQxZWEtYjhmNi1mYjdhN2VkMWMyNDYifQ.eyJleHAiOjE3MDM3OTI1NDQsImlhdCI6MTcwMTIwMDU0NCwianRpIjoiNzQzYTYxMzQtZTU1My00YWY2LWIxZTEtY2RiNDY3ZTBmYTkyIiwiaXNzIjoiaHR0cDovL2xvY2FsaG9zdDo4MTgwL3JlYWxtcy9kZW1vIiwiYXVkIjoiaHR0cDovL2xvY2FsaG9zdDo4MTgwL3JlYWxtcy9kZW1vIiwidHlwIjoiSW5pdGlhbEFjY2Vzc1Rva2VuIn0.YJOUusM5up_Z-ZlD9lihzlbxKq0aiztifXgH7F9uhjY' \
//   --data '{
//         "clientId": "maquina2",
//         "clientAuthenticatorType": "client-x509",
//         "surrogateAuthRequired": false,
//         "enabled": true,
//         "alwaysDisplayInConsole": false,
//         "redirectUris": [],
//         "webOrigins": [],
//         "notBefore": 0,
//         "bearerOnly": false,
//         "consentRequired": false,
//         "standardFlowEnabled": false,
//         "implicitFlowEnabled": false,
//         "directAccessGrantsEnabled": false,
//         "serviceAccountsEnabled": true,
//         "publicClient": false,
//         "frontchannelLogout": false,
//         "protocol": "openid-connect",
//         "attributes": {
//             "x509.subjectdn": "C = BR, ST = Para, L = Belem, O = Red Hat, OU = RHSSO, CN = client"
//     }
// }'

Route::get('/register-dcr', function (Request $request) {
    
    $endpoint = "http://keycloak:8180/realms/demo/clients-registrations/default";

    $client = new \GuzzleHttp\Client();

    $authToken = "eyJhbGciOiJIUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJjMThjOWZlNS1lODQ0LTQxZWEtYjhmNi1mYjdhN2VkMWMyNDYifQ.eyJleHAiOjE3MDM3OTI1NDQsImlhdCI6MTcwMTIwMDU0NCwianRpIjoiNzQzYTYxMzQtZTU1My00YWY2LWIxZTEtY2RiNDY3ZTBmYTkyIiwiaXNzIjoiaHR0cDovL2xvY2FsaG9zdDo4MTgwL3JlYWxtcy9kZW1vIiwiYXVkIjoiaHR0cDovL2xvY2FsaG9zdDo4MTgwL3JlYWxtcy9kZW1vIiwidHlwIjoiSW5pdGlhbEFjY2Vzc1Rva2VuIn0.YJOUusM5up_Z-ZlD9lihzlbxKq0aiztifXgH7F9uhjY";
    try {
        $response = $client->request('POST', $endpoint, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'bearer ' . $authToken,
            ],
            'json' => '{
                "clientId": "maquina2",
                "clientAuthenticatorType": "client-x509",
                "surrogateAuthRequired": false,
                "enabled": true,
                "alwaysDisplayInConsole": false,
                "redirectUris": [],
                "webOrigins": [],
                "notBefore": 0,
                "bearerOnly": false,
                "consentRequired": false,
                "standardFlowEnabled": false,
                "implicitFlowEnabled": false,
                "directAccessGrantsEnabled": false,
                "serviceAccountsEnabled": true,
                "publicClient": false,
                "frontchannelLogout": false,
                "protocol": "openid-connect",
                "attributes": {
                    "x509.subjectdn": "C = BR, ST = Para, L = Belem, O = Red Hat, OU = RHSSO, CN = client"
                }
            }',
        ]);

        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        return response()->json([
            'status_code' => $statusCode,
            'body' => json_decode($body, true),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
        ], 500);
    }
});
