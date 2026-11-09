<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuthorizedSignature;
use App\Models\Asigneduser;

class AuthorizedSignatureController extends Controller
{

    public function store_authorized_signature(Request $request)
    {
        $request->validate([
            'authorised_sign' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'nullable|in:0,1',
        ]);

        $file = $request->file('authorised_sign');

        $fileName = time() . '_' . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();

        $signatureImage = 'images/authorised_sign';

        $destinationPath = public_path($signatureImage);

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Store image
        $file->move($destinationPath, $fileName);

        // Get existing signature
        $signature = AuthorizedSignature::first();

        // Remove old image
        if ($signature && $signature->authorised_sign) {

            $oldFile = $destinationPath . '/' . $signature->authorised_sign;

            if (file_exists($oldFile)) {
                unlink($oldFile);
            }

            $signature->update([
                'authorised_sign' => $fileName,
                // 'status' => $request->status,
            ]);

        } else {

            $signature = AuthorizedSignature::create([
                'authorised_sign' => $fileName,
                // 'status' => $request->status,
            ]);
        }


        return response()->json([
            'status' => true,
            'message' => 'Signature saved successfully.',
            'signature_id' => $signature->id,
            'signature_url' => asset('public/'. $signatureImage . '/' . $fileName),
            'signature_status' => $signature->status,
        ]);
    }

    public function get_authorized_signature()
    {
        $signature = AuthorizedSignature::latest('id')->first();

        $signatureImage = 'images/authorised_sign';

        return response()->json([
            'status' => true,

            'signature' => $signature ? [
                'id' => $signature->id,
                'authorised_sign' => $signature->authorised_sign,
                // 'status' => $signature->status,
                'signature_url' => asset(
                    'public/'. $signatureImage. '/' . $signature->authorised_sign
                ),
            ] : null
        ]);
    }

    public function remove_authorized_signature(Request $request)
    {
        $signature = AuthorizedSignature::first();

        if ($signature) {

            $filePath = public_path(
                'images/authorised_sign/' . $signature->authorised_sign
            );

            if ($signature->authorised_sign && file_exists($filePath)) {
                unlink($filePath);
            }

            $signature->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Signature removed successfully.'
        ]);
    }


    // NEW — public API for assessment to pull the active signature
    public function apiAuthorizedSignature()
    {
        $signature = AuthorizedSignature::latest()->first();

        if (!$signature || !$signature->authorised_sign) {
            return response()->json([
                'signature_url' => null,
            ]);
        }

        return response()->json([
            'signature_url' => url('public/images/authorised_sign/' . $signature->authorised_sign),
        ]);
    }

}
