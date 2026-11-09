<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;
 use Illuminate\Support\Facades\DB;


class SiteController extends Controller
{
    public function index(Request $request)
    {
        //dd($request->all());
        $announcement=Announcement::all();
        //dd($announcement);
        $site = Site::first();

        return view('admin.settings.settings', compact('site','announcement'));
    }

   


public function store(Request $request)
{
    $site = Site::first(); 

    $site->site_name = $request->input('site_name');

    if ($request->hasFile('banner_image')) {
        $bannerImage = $request->file('banner_image')->store('banner_images', 'public');
        $site->banner_image = $bannerImage;
    } elseif ($request->input('existing_banner_image')) {
        $site->banner_image = $request->input('existing_banner_image');
    }

    if ($request->hasFile('favicon')) {
        $favicon = $request->file('favicon')->store('favicon', 'public');
        $site->favicon = $favicon;
    } elseif ($request->input('existing_favicon')) {
        $site->favicon = $request->input('existing_favicon');
    }

    $site->hide_sitename = $request->input('hide_sitename');
    $site->save();

    return redirect()->back()->with('message', 'Settings updated successfully!');
}

    /**
     * Pull the website logo to external API for use in other applications. This method retrieves the latest site settings and returns the logo URL in a JSON response.
     */
    public function apiSettings()
    {
        $site = Site::first();

        return response()->json([
            'site_name'      => $site->site_name,
            'banner_image'   => $site->banner_image ? url('storage/'.$site->banner_image) : null,
            'favicon'        => $site->favicon ? url('storage/'.$site->favicon) : null,
            'hide_sitename'  => (bool) $site->hide_sitename,
        ]);
    }


    public function delete_header_logo(Request $request)
    {
        
    
        $site = Site::latest()->first();
    
        if (!is_null($site->banner_image)) {
            Storage::disk('public')->delete($site->banner_image); 
        }
        
        $site->banner_image = null;
        $site->save();
    
        return redirect()->back()->with('success', 'Logo deleted successfully');
    }

    public function delete_favicon(Request $request)
    {
        
        $site = Site::latest()->first();
    
        if (!is_null($site->favicon)) {
            Storage::disk('public')->delete($site->favicon); 
        }
        
        $site->favicon = null;
        $site->save();
    
        return redirect()->back()->with('success', 'Favicon deleted successfully');
    }

   
    public function updateHideSiteName(Request $request)
    {
        $hideSiteName = $request->input('hide_sitename');
        
        $site = Site::latest()->first();
    
        if ($site) {
            $site->hide_sitename = $hideSiteName;
            $site->save();
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false, 'message' => 'No site settings found']);
    }
    public function store_announcement(Request $request){
        //dd($request->all());
        $validatedData = $request->validate([
            'announcement' => 'required|string|max:1000',
            'announcement_from' => 'required|string|max:255',
        ]);
        
        Announcement::updateorcreate(['id'=>$request->id],$request->except(['_token']));
        return redirect('settings')->withSuccess('announcement Edited Successfully');
    }
    
    public function delete_announcement(Request $request)
     {
        announcement::destroy($request->id);
        return redirect('settings')->withSuccess('announcement Deleted Successfully');
    }   
    
    
    public function get_userannouncement(Request $request) {
        //dd($request->all());
        $announcement = Announcement::get();
       // dd($announcement);
        return view('user.user_announcement', compact('announcement'));
    }
    

    // get site logo and favicon details for for external API.
    public function getSiteDetails()
    {
        $site = Site::select(
            'site_name',
            'banner_image',
            'favicon',
            'hide_sitename'
        )
        ->latest('updated_at')
        ->first();

        if (!$site) {
            return response()->json([
                'success' => false,
                'message' => 'Site settings not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'site_name' => $site->site_name,
            'logo' => $site->banner_image
                ? asset('storage/' . $site->banner_image)
                : null,
            'favicon' => $site->favicon
                ? asset('storage/' . $site->favicon)
                : null,
        ]);
    }

    /**
     * API to retrieve certificate and signature details based on course_id and/or category_id.
     * Can be consumed by external applications (e.g., assessment.digicat.ai) for certificate PDF generation.
     */
    public function getCertificateSignature(Request $request)
    {
        $courseId = $request->query('course_id') ?? $request->input('course_id');
        $categoryId = $request->query('category_id') ?? $request->input('category_id');
        $assignId = $request->query('assign_id') ?? $request->input('assign_id');
        $quizSlug = $request->query('quiz_slug') ?? $request->input('quiz_slug');

        $certificate = null;
        $course = null;
        $category = null;

        // 1. If quiz_slug is provided, resolve course_id from assessment documents first
        if (!empty($quizSlug)) {
            $doc = \App\Models\Course_documents::where('file_path', 'like', "%{$quizSlug}%")->first();
            if ($doc && !empty($doc->course_id)) {
                $courseId = $doc->course_id;
            }
        }

        // 2. If assign_id is provided, resolve course_id
        if (empty($courseId) && !empty($assignId)) {
            $assignedUser = \App\Models\Asigneduser::find($assignId);
            if ($assignedUser && !empty($assignedUser->course_id)) {
                $courseId = $assignedUser->course_id;
            }
        }

        // 3. If course_id was passed, check if it's actually a course_document_id
        if (!empty($courseId)) {
            $course = \App\Models\Courses::with(['certificate_data', 'category_details'])->find($courseId);
            if (!$course) {
                $docCheck = \App\Models\Course_documents::find($courseId);
                if ($docCheck && !empty($docCheck->course_id)) {
                    $courseId = $docCheck->course_id;
                    $course = \App\Models\Courses::with(['certificate_data', 'category_details'])->find($courseId);
                }
            }

            if ($course) {
                if ($course->certificate_data && (!empty($course->certificate_data->signature_image) || !empty($course->certificate_data->signature_drawn))) {
                    $certificate = $course->certificate_data;
                }
                if (empty($categoryId) && !empty($course->category_id)) {
                    $categoryId = $course->category_id;
                }
            }
        }

        // 4. If certificate with signature is not found yet, search by category_id or its parent_id
        if (!$certificate && !empty($categoryId)) {
            $category = \App\Models\Category::find($categoryId);

            $certificate = \App\Models\Certificate::where(function ($q) use ($categoryId, $category) {
                $q->where('category_id', $categoryId);
                if ($category && !empty($category->parent_id)) {
                    $q->orWhere('parent_id', $category->parent_id);
                    $q->orWhere('category_id', $category->parent_id);
                }
            })
            ->where('status', 1)
            ->where(function ($q) {
                $q->where(function($sq) {
                    $sq->whereNotNull('signature_drawn')->where('signature_drawn', '!=', '');
                })->orWhere(function($sq) {
                    $sq->whereNotNull('signature_image')->where('signature_image', '!=', '');
                });
            })
            ->latest('id')
            ->first();

            if (!$certificate) {
                $certificate = \App\Models\Certificate::where('category_id', $categoryId)
                    ->where('status', 1)
                    ->latest('id')
                    ->first();
            }
        }

        // 5. If still not found, check if course has any certificate assigned (even if empty signature)
        if (!$certificate && $course && $course->certificate_data) {
            $certificate = $course->certificate_data;
        }

        // 6. If still not found, fallback to the latest active certificate with signature, or latest certificate
        if (!$certificate) {
            $certificate = \App\Models\Certificate::where('status', 1)
                ->where(function ($q) {
                    $q->where(function($sq) {
                        $sq->whereNotNull('signature_drawn')->where('signature_drawn', '!=', '');
                    })->orWhere(function($sq) {
                        $sq->whereNotNull('signature_image')->where('signature_image', '!=', '');
                    });
                })
                ->latest('id')
                ->first()
                ?? \App\Models\Certificate::where('status', 1)->latest('id')->first()
                ?? \App\Models\Certificate::latest('id')->first();
        }

        if (!$certificate) {
            return response()->json([
                'status' => false,
                'success' => false,
                'message' => 'No certificate or signature found.',
                'signature_url' => null,
                'signature_base64' => null,
                'signature_type' => 'none'
            ], 404);
        }

        $signatureUrl = null;
        $signatureBase64 = null;
        $signatureType = 'none';

        // Check for uploaded signature image file
        if (!empty($certificate->signature_image)) {
            $possiblePaths = [
                storage_path('app/public/signature_images/' . $certificate->signature_image),
                public_path('storage/signature_images/' . $certificate->signature_image),
                public_path('storage/app/public/signature_images/' . $certificate->signature_image),
                storage_path('app/public/' . $certificate->signature_image),
            ];
            $signatureUrl = url('storage/signature_images/' . $certificate->signature_image);
            $signatureType = 'image';

            foreach ($possiblePaths as $filePath) {
                if (file_exists($filePath)) {
                    $ext = pathinfo($filePath, PATHINFO_EXTENSION);
                    $mimeType = in_array(strtolower($ext), ['jpg', 'jpeg']) ? 'image/jpeg' : (strtolower($ext) === 'png' ? 'image/png' : 'image/' . $ext);
                    $signatureBase64 = 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($filePath));
                    break;
                }
            }
        }
        // Check for drawn signature (canvas data URL)
        elseif (!empty($certificate->signature_drawn)) {
            $signatureUrl = $certificate->signature_drawn;
            $signatureBase64 = $certificate->signature_drawn;
            $signatureType = 'drawn';
        }

        return response()->json([
            'status' => true,
            'success' => true,
            'message' => 'Certificate signature details retrieved successfully.',
            'data' => [
                'certificate_id' => $certificate->id,
                'certificate_name' => $certificate->certificate_name,
                'certificate_issue_name' => $certificate->cerificate_issue_name ?? $certificate->certificate_name,
                'course_id' => $course ? $course->id : $courseId,
                'course_name' => $course ? $course->course_name : null,
                'category_id' => $certificate->category_id ?: ($category ? $category->id : $categoryId),
                'category_name' => $category ? $category->category_name : ($course && $course->category_details ? $course->category_details->category_name : null),
                'signature_type' => $signatureType,
                'signature_image_name' => $certificate->signature_image,
                'signature_url' => $signatureUrl,
                'signature_base64' => $signatureBase64,
            ]
        ]);
    }


   

public function getSiteLogo(Request $request)
{
    $site = DB::table('tbl_logo_application')->first();

    if (!$site || empty($site->banner_image)) {
        return response()->json([
            'status' => false,
            'success' => false,
            'message' => 'No site logo found.',
            'logo_url' => null,
            'logo_base64' => null,
        ], 404);
    }

    $logoUrl = url('storage/' . $site->banner_image);
    $logoBase64 = null;

    $filePath = storage_path('app/public/' . $site->banner_image);
    if (file_exists($filePath)) {
        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        $mimeType = in_array(strtolower($ext), ['jpg', 'jpeg']) ? 'image/jpeg' : (strtolower($ext) === 'png' ? 'image/png' : 'image/' . $ext);
        $logoBase64 = 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($filePath));
    }

    return response()->json([
        'status' => true,
        'success' => true,
        'message' => 'Site logo retrieved successfully.',
        'data' => [
            'logo_url' => $logoUrl,
            'logo_base64' => $logoBase64,
        ]
    ]);
}

}