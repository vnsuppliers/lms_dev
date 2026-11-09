<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Roles;
use App\Models\Permission;
use App\Models\Subcategory;
use App\Models\Courses;
use App\Models\User;
use App\Models\Asigneduser;
use App\Models\Group;
use App\Models\Mail_templates;
use App\Models\Goal;
use App\Models\Level;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\Certificate;
use App\Models\Certificate_template;
use App\Models\FeedbackRatingsSetting;
use DB;



class IndexController extends Controller
{
    public function category_create(Request $request){
       // Retrieve Category and Subcategory Data
$data_id = Category::find($request->id);
$sub_id = Subcategory::find($request->id);
$sub_data = Subcategory::with('cat')->get();

// Build the Category Query
$category_list = Category::query()
    ->when($request->filled('status'), fn($query) => $query->where('status', $request->status), fn($query) => $query->where('status', 1))
    ->when($request->filled('category_created_date'), function ($query) use ($request) {
        switch ($request->input('category_created_date')) {
            case '1': $query->whereDate('created_at', today()); break;
            case '2': $query->whereDate('created_at', today()->subDay()); break;
            case '3': $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]); break;
            case '4': $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year); break;
            case '5': 
                $fromDate = $request->input('from_date');
                $toDate = $request->input('to_date');
                if ($fromDate && $toDate) {
                    $query->whereBetween('created_at', [$fromDate, $toDate]);
                }
                break;
        }
    })
    ->when($request->filled('search_name_category'), fn($query) => $query->where('category_name', 'like', '%' . $request->search_name_category . '%'))
    ->when($request->filled('category_department_filter'), fn($query) => $query->where('department_id', $request->category_department_filter))
    ->withCount(['courses_of_category as active_courses_count' => fn($q) => $q->where('active', 1)])
    ->get();

// Get Additional Static Lists
$sub_category_list = Subcategory::get();
$departments = Department::get();
$designations = Designation::get();
$certificates = Certificate::get();
$roles = Roles::get();

    // Build Courses Query
    $courses_lists = Courses::withCount('Assigned_usersdetails')->with([
        'category_details',
        'documents_details' => function ($q) {
            $q->where('type', 6)
            ->where('is_active', 1)
            ->where('is_delete', 0);
        }
    ])
    ->when(!empty($request->input('category_id', [])), function ($query) use ($request) {
        $query->whereHas('category_details', fn($q) => $q->whereIn('id', $request->input('category_id')));
    })
    ->when($request->filled('status'), fn($query) => $query->where('active', $request->status), fn($query) => $query->where('active', 1))
    ->when($request->filled('course_status'), fn($query) => $query->whereHas('Assign_userdetails'))
    ->when($request->filled('search_name'), function ($query) use ($request) {
        $query->where('course_name', 'like', '%' . $request->search_name . '%')
              ->orWhereHas('category_details', fn($q) => $q->where('category_name', 'like', '%' . $request->search_name . '%'));
    })
    ->when($request->filled('course_created_date'), function ($query) use ($request) {
        switch ($request->input('course_created_date')) {
            case '1': $query->whereDate('created_at', today()); break;
            case '2': $query->whereDate('created_at', today()->subDay()); break;
            case '3': $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]); break;
            case '4': $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year); break;
            case '5': 
                $fromDate = $request->input('from_date');
                $toDate = $request->input('to_date');
                if ($fromDate && $toDate) {
                    $query->whereBetween('created_at', [$fromDate, $toDate]);
                }
                break;
        }
    })
    ->when($request->filled('course_name_sort'), fn($query) => $query->orderBy('course_name', $request->input('course_name_sort') == '1' ? 'asc' : 'desc'))
    ->when($request->filled('created_at_sort'), fn($query) => $query->orderBy('created_at', $request->input('created_at_sort') == '1' ? 'asc' : 'desc'))
    ->when($request->filled('assessment_filter'), fn($query) => $query->where(function ($q) {
        $q->whereHas('assessments')->orWhereHas('assignment_exam');
    }))
    ->where('is_delete', 0)
    ->get();

// Handle Cloned or Specific Course
$courses_id = Courses::with('category_details')->find($request->clone_course ?? $request->id);
$course_category_id = $courses_id->category_id ?? '';
$category_department = Category::where('id', $course_category_id)->pluck('department_id')->first();

// Build Users Query
$users_lists = User::where('user_type', '!=', 1)
    ->with(['departmentdetails', 'designationdetails', 'assigned_users' => fn($q) => $q->where('course_id', $request->id)])
    ->when($category_department > 0 && empty($request->department) && empty($request->department_check), fn($query) => $query->where('department', $category_department))
    ->when($request->filled('department'), fn($query) => $query->whereIn('department', $request->department))
    ->when($request->filled('designation'), fn($query) => $query->whereIn('designation', $request->designation))
    ->when(isset($request->add_course_assigned_status) && $request->add_course_assigned_status == 0, fn($query) => $query->whereDoesntHave('assigned_users', fn($q) => $q->where('course_id', $request->id)))
    ->when($request->add_course_assigned_status == 1, fn($query) => $query->whereHas('assigned_users', fn($q) => $q->where('course_id', $request->id)))
    ->when(!empty($request->add_course_user_search_data), function ($query) use ($request) {
        $query->where(function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->add_course_user_search_data . '%')
              ->orWhere('last_name', 'like', '%' . $request->add_course_user_search_data . '%')
              ->orWhere('username', 'like', '%' . $request->add_course_user_search_data . '%')
              ->orWhereHas('designationdetails', fn($q) => $q->where('designation_name', 'like', '%' . $request->add_course_user_search_data . '%'))
              ->orWhereHas('departmentdetails', fn($q) => $q->where('department_name', 'like', '%' . $request->add_course_user_search_data . '%'))
              ->orWhereHas('roles', fn($q) => $q->where('role', 'like', '%' . $request->add_course_user_search_data . '%'));
        });
    })
    ->get();

// foreach ($users_lists as $user) {
//     $userTypes = json_decode($user->user_type, true);
//     $roles = Roles::whereIn('id', $userTypes)->pluck('role')->toArray();
//     $user->role_names = $roles;
// }

// Additional Data Retrieval
$lastCourse = Courses::latest()->first();
$trainers_data = User::where('user_type', 'like', '%[%"6"%]')->orWhere('user_type', 'like', '%"6"%')->get();
$goals = Goal::get();
$levels = Level::get();
$groups_lists = Group::get();
$category_all_list = Category::get();


       //dd('hii');
   
        return view('admin.coursecatalog.course_catalog',compact('category_list','data_id','sub_id','sub_data','courses_lists','users_lists','lastCourse','sub_category_list','courses_id','request','goals','levels','designations','departments','trainers_data','certificates','groups_lists','roles','category_department','category_all_list'));
    }
    public function category_store(Request $request){
        //dd($request->all());
        if ($request->hasFile('category_image')) {

        $imageFile = $request->file('category_image');
        $imageFileName = uniqid() . '_' . $imageFile->getClientOriginalName();
        $imageFilePath = $imageFile->storeAs('category_image', $imageFileName, 'public');
        
        $request['image'] = 'category_image/' . $imageFileName;
    }
       Category::updateorcreate(['id'=>$request->id],$request->except(['_token','category_image']));
        return redirect('/coursecatalog?tab=4')->withSuccess('Category Created / Edited Successfully');

    }

      public function category_destroy(Request $request)
     {
          Category::destroy($request->id);
        return redirect('/coursecatalog?tab=4')->withSuccess('Category Deleted Successfully');
    }




    //Roles

     public function role_create(Request $request){
        $list = Roles::all();
        $permission_data = Permission::with('role')->get();
          $permision_id = Permission::where('id', $request->id)->first();
          $list_id = Roles::where('id', $request->id)->first();
          //dd($list_id);
        return view('admin.Roles_Permissions.roles_permission',compact('list','list_id','permission_data','permision_id'));
    }
  public function role_store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'role' => 'required|string|max:255',
            'permission_id' => 'nullable|array', // Nullable and should be an array
            'permission_id.*' => 'exists:tbl_permissions,id', // Ensure all IDs exist in 'permissions' table
            'status' => 'required|boolean',
        ]);

        try {
            // Update or create the role record
            $role = Roles::updateOrCreate(
                ['id' => $request->id], // Update if ID exists, otherwise create new
                [
                    'role' => $validatedData['role'],
                    'permission_id' => json_encode($validatedData['permission_id']), // Store permissions as JSON array
                    'status' => $validatedData['status']
                ]
            );

            return redirect('roles?tab=2')->withSuccess('Role Created / Edited Successfully');
        } catch (\Exception $e) {
            // Handle any exceptions
            return back()->withErrors([$e->getMessage()]); // Return specific error message for debugging
        }
    }


      public function role_destroy(Request $request)
     {
          Roles::destroy($request->id);
        return redirect('roles?tab=2')->withSuccess('Role Deleted Successfully');
    }
    
  
//permissions
    public function permission_store(Request $request)
    {

        Permission::updateorcreate(['id'=>$request->id],$request->except(['_token']));
        return redirect('roles?tab=3')->withSuccess('Permission added/edited Successfully');
  
    }
 public function permission_destroy(Request $request)
     {
          Permission::destroy($request->id);
        return redirect('roles?tab=4')->withSuccess('Permission Deleted Successfully');
    }


    public function subcategory_store(Request $request)
    {
        Subcategory::updateorcreate(['id'=>$request->id],$request->except(['_token']));
        return redirect('/coursecatalog?tab=5')->withSuccess('Subcategory added/edited Successfully');
        
    }
 public function subcategory_destroy(Request $request)
     {
          Subcategory::destroy($request->id);
        return redirect('coursecatalog?tab=6')->withSuccess('Subcategory Deleted Successfully');
    }

 public function getSubcategories(Request $request)
    {
        $categoryId = $request->input('categoryId');
        $subcategories = SubCategory::where('category_id', $categoryId)->get();

        return response()->json(['subcategories' => $subcategories]);
    }

  public function group_store(Request $request){
       Group::updateorcreate(['id'=>$request->id],$request->except(['_token']));
        return redirect('users?tab=4')->withSuccess('group Created / Edited Successfully');

    }

      public function group_destroy(Request $request)
     {
          Group::destroy($request->id);
        return redirect('users?tab=4')->withSuccess('Category Deleted Successfully');
    }
    public function mail_templates(Request $request)
    {
        $lists = Mail_templates::get();
        $data = Mail_templates::where('id',$request->id??0)->first();
        return view('admin.mail_templates.template',compact('request','lists','data'));
    }
    public function add_mail_template(Request $request)
    {
        Mail_templates::updateOrCreate(['id'=>$request->id],$request->except(['_token']));
        if(!empty($request->id)){
            return redirect('mail_templates')->withSuccess('Mail Template Added Successfully');
        }else{
            return redirect('mail_templates')->withSuccess('Mail Template Edited Successfully');
        }
    }
    public function delete_mail_template(Request $request)
    {
        Mail_templates::where('id',$request->id)->delete();
        return redirect('mail_templates')->withSuccess('Mail Template Deleted Successfully');
    }


    //goals
    public function masters(Request $request)
    {
        $goal = Goal::all();
        $level_data = Level::get();
        $level_id = Level::where('id', $request->id)->first();
        $goal_id = Goal::where('id', $request->id)->first();
        $templates = Certificate_template::where('status', 1)->get();
        $certificates = Certificate::get();
        $feedbackRatings = FeedbackRatingsSetting::with(['category', 'course'])
            ->where(function ($query) {
                $query->where('type', 1)
                    ->orWhere(function ($q) {
                        $q->where('type', 2)
                            ->whereHas('category', function ($catQuery) {
                                $catQuery->where('status', 1);
                            })
                            ->whereHas('course', function ($courseQuery) {
                                $courseQuery->where('active', 1);
                            });
                    });
            })
            ->orderBy('id', 'desc')
            ->get();
        $categories = Category::where('status', 1)->orderBy('id', 'desc')->get();
        // dd($categories);

        // Get all active categories
        $category_list = Category::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();
        // dd($category_list);

        $courses = Courses::where('active', 1)->orderBy('course_name')->get();
        // dd($courses);

        return view(
            'admin.masters.masters',
            compact(
                'goal',
                'goal_id',
                'level_data',
                'level_id',
                'templates',
                'certificates',
                'category_list',
                'feedbackRatings',
                'courses'
            )
        );
    }

    public function goal_store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        try {
    
            $goal = Goal::updateOrCreate(


                ['id' => $request->id], 
                [
                    'name' => $validatedData['name'],
                
                    'status' => $validatedData['status']
                ]
            );

            return redirect('masters?tab=2')->withSuccess('Goal Created / Edited Successfully');
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }


      public function goal_destroy(Request $request)
     {
          Goal::destroy($request->id);
        return redirect('masters?tab=2')->withSuccess('Goal Deleted Successfully');
    }
    
  
//permissions
    public function level_store(Request $request)
    {

        Level::updateorcreate(['id'=>$request->id],$request->except(['_token']));
        return redirect('masters?tab=3')->withSuccess('Goal added/edited Successfully');
  
    }
 public function level_destroy(Request $request)
     {
          Level::destroy($request->id);
        return redirect('masters?tab=4')->withSuccess('Permission Deleted Successfully');
    }
    // public function store_certificates(Request $request)
    // {
    //     Certificate::create($request->except(['_token']));
    //     return redirect('masters?tab=6')->withSuccess('Certificate Added Successfully');
    // }

    private function getCategoryAndDescendantIds($categoryId)
    {
        if (empty($categoryId)) {
            return [];
        }

        $categoryIds = [(int) $categoryId];
        $childIds = Category::where('parent_id', $categoryId)->pluck('id')->toArray();
        foreach ($childIds as $childId) {
            $categoryIds = array_merge($categoryIds, $this->getCategoryAndDescendantIds($childId));
        }
        return array_values(array_unique($categoryIds));
    }

    public function store_certificates(Request $request)
    {
      
            $request->validate([
                'signature_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'signature_drawn' => 'nullable|string',
                'category_id'    => 'required|integer',
                'parent_id'     => 'nullable|integer',
            ]);

            $category = Category::findOrFail($request->category_id);
            $certificateParentId = $category->parent_id ?: $category->id;

            if (!$request->hasFile('signature_image') && empty($request->signature_drawn)) {
                return back()->withErrors(['signature_image' => 'Please upload or draw a signature'])->withInput();
            }

            $imageName = null;
            $drawnData = null;

            if ($request->hasFile('signature_image')) {
                $image = $request->file('signature_image');
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/signature_images', $imageName);
            }


            if (!empty($request->signature_drawn)) {
                $drawnData = $request->signature_drawn;
            }

            $type = (int) ($request->type ?? ($request->signature_type == 'draw' ? 2 : ($request->signature_type == 'input' ? 3 : 1)));

            $certificate = Certificate::create(array_merge(
                $request->except(['_token', 'signature_image']),
                [
                    'signature_image' => $imageName,
                    'signature_drawn' => $drawnData,
                    'type'            => $type,
                    'category_id'     => $request->category_id,
                    'parent_id'       => $certificateParentId,
                ]
            ));

            // Automatically assign this certificate to all courses related to this category & its descendant subcategories
            $relatedCategoryIds = $this->getCategoryAndDescendantIds($request->category_id);
            if (!empty($certificateParentId) && $certificateParentId != $request->category_id) {
                $relatedCategoryIds = array_merge($relatedCategoryIds, $this->getCategoryAndDescendantIds($certificateParentId));
            }
            $relatedCategoryIds = array_values(array_unique($relatedCategoryIds));
            Courses::whereIn('category_id', $relatedCategoryIds)->update(['certificate' => $certificate->id]);

            return redirect('masters?tab=6')->withSuccess('Certificate Added Successfully');
    }


    public function edit_certificate(Request $request, $id = null)
    {
        $certId = $id ?? $request->id;
        $certificate = Certificate::find($certId) ?? DB::table('tbl_certificates')->where('id', $certId)->first();

        if (!$certificate) {
            return redirect('masters?tab=6')->with('error', 'Certificate not found');
        }

        $category_list = Category::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.masters.edit_certificate', compact('certificate', 'category_list'));
    }

    public function update_certificate(Request $request, $id = null)
    {
        $certId = $id ?? $request->id;
        $certificate = Certificate::find($certId);

        if (!$certificate) {
            return redirect('masters?tab=6')->with('error', 'Certificate not found');
        }

        $request->validate([
            'certificate_name' => 'required|string|max:255',
            'category_id'     => 'required|integer',
            'parent_id'       => 'nullable|integer',
            'signature_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'signature_drawn' => 'nullable|string',
        ]);

        $category = Category::find($request->category_id);
        $certificateParentId = $request->parent_id ?: ($category ? ($category->parent_id ?: $category->id) : null);

        $type = (int) ($request->type ?? ($request->signature_type == 'draw' ? 2 : ($request->signature_type == 'input' ? 3 : ($certificate->type ?? 1))));

        $imageName = $certificate->signature_image;
        $drawnData = $certificate->signature_drawn;

        if ($type === 1) {
            if ($request->hasFile('signature_image')) {
                $image = $request->file('signature_image');
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/signature_images', $imageName);
            }
            $drawnData = null;
        } elseif ($type === 2 || $type === 3) {
            if (!empty($request->signature_drawn)) {
                $drawnData = $request->signature_drawn;
            }
            $imageName = null;
        }

        $certificate->certificate_name = $request->certificate_name;
        $certificate->category_id = $request->category_id;
        $certificate->parent_id = $certificateParentId;
        $certificate->code = $request->code;
        $certificate->template_id = $request->template_id ?? 1;
        $certificate->type = $type;
        $certificate->signature_image = $imageName;
        $certificate->signature_drawn = $drawnData;
        $certificate->save();

        // Automatically assign this certificate to all courses related to this category & its descendant subcategories
        $relatedCategoryIds = $this->getCategoryAndDescendantIds($certificate->category_id);
        if (!empty($certificateParentId) && $certificateParentId != $certificate->category_id) {
            $relatedCategoryIds = array_merge($relatedCategoryIds, $this->getCategoryAndDescendantIds($certificateParentId));
        }
        $relatedCategoryIds = array_values(array_unique($relatedCategoryIds));
        Courses::whereIn('category_id', $relatedCategoryIds)->update(['certificate' => $certificate->id]);

        return redirect('masters?tab=6')->withSuccess('Certificate Updated Successfully');
    }


    public function delete_certificate(Request $request) {
        $certificate = Certificate::find($request->id);
        if ($certificate) {
            Courses::where('certificate', $certificate->id)->update(['certificate' => null]);
            $certificate->delete();
            return back()->with('success', 'Certificate deleted successfully');
        }
        return back()->with('error', 'Certificate not found'); 
    }

    public function download_certificate(Request $request, $id = null)
    {
        $certId = $id ?? $request->id;
        $certificate = Certificate::find($certId) ?? DB::table('tbl_certificates')->where('id', $certId)->first();

        if (!$certificate) {
            return redirect('masters?tab=6')->with('error', 'Certificate not found');
        }

        $template = Certificate_template::find($certificate->template_id ?? 1) ?? Certificate_template::first();
        $siteLogo = DB::table('tbl_logo_application')->latest()->first();

        $html = $template ? $template->template_pdf_html : '';

        if (empty($html)) {
            return redirect('masters?tab=6')->with('error', 'Certificate template not configured');
        }

        // Helper to convert any local image path to a base64 data URI for reliable DomPDF embedding
        $resolveImageBase64 = function ($paths) {
            foreach ((array)$paths as $path) {
                if (empty($path)) continue;

                if (strpos($path, 'data:image') === 0) {
                    return $path;
                }

                if (file_exists($path) && is_file($path)) {
                    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    $mime = in_array($ext, ['jpg', 'jpeg']) ? 'image/jpeg' : ($ext === 'png' ? 'image/png' : ($ext === 'svg' ? 'image/svg+xml' : 'image/' . $ext));
                    return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($path));
                }
            }
            return null;
        };

        // Resolve Website / Site Banner Logo to Base64
        $logoCandidates = [];
        if ($siteLogo && !empty($siteLogo->banner_image)) {
            $logoCandidates[] = storage_path('app/public/' . $siteLogo->banner_image);
            $logoCandidates[] = public_path('storage/' . $siteLogo->banner_image);
        }
        // Fallback banner images in storage if specific path changed
        $storedBanners = glob(storage_path('app/public/banner_images/*'));
        if (!empty($storedBanners)) {
            foreach ($storedBanners as $bannerFile) {
                $logoCandidates[] = $bannerFile;
            }
        }
        $logoCandidates[] = public_path('images/tas-logo.png');
        $logoCandidates[] = public_path('images/ats-logo.png');

        $logoDataUri = $resolveImageBase64($logoCandidates) ?: asset('public/images/tas-logo.png');

        // Resolve Certificate Right Logo to Base64
        $certLogoCandidates = [
            public_path('images/certificate-logo.png'),
            public_path('images/certificate-logo.jpg.png'),
        ];
        $certLogoDataUri = $resolveImageBase64($certLogoCandidates) ?: asset('public/images/certificate-logo.png');

        $formattedDate = !empty($certificate->created_at) ? date('d/m/Y', strtotime($certificate->created_at)) : date('d/m/Y');

        $content = str_replace('[Learner_name]', $certificate->cerificate_issue_name ?: '[Learner_name]', $html);
        $content = str_replace('[Course_name]', $certificate->certificate_name ?: 'Course Name', $content);
        $content = str_replace('[first_image]', $logoDataUri, $content);
        $content = str_replace('[second_image]', $certLogoDataUri, $content);
        $content = str_replace('[first_link]', asset('public/vendors/css/bootstrap.min.css'), $content);
        $content = str_replace('[second_link]', asset('public/css/horizontal-layout/style.css'), $content);
        $content = str_replace('[third_link]', asset('public/css/horizontal-layout/lms.css'), $content);
        $content = str_replace('[issue_date]', $formattedDate, $content);

        $signatureImage = $certificate->signature_image ?? null;
        $signatureDrawn = $certificate->signature_drawn ?? null;

        $signatureHtml = '';

        if (!empty($signatureDrawn)) {
            // Enhanced enlarged signature stamp / drawing for landscape mode
            $signatureHtml = '<img src="' . $signatureDrawn . '" alt="Signature Stamp" style="max-width: 300px; max-height: 120px; width: auto; height: auto; display: block; margin: 0 auto; object-fit: contain;">';

            $alignedFooter = '
                <table class="certificate-footer" align="center" style="width: 660px; margin: 30px auto 15px; border-collapse: collapse; table-layout: fixed; font-family: Arial, sans-serif;">
                    <colgroup>
                        <col style="width: 280px;" />
                        <col style="width: 100px;" />
                        <col style="width: 280px;" />
                    </colgroup>
                    <tr>
                        <td style="width: 280px; text-align: center; vertical-align: middle; padding: 0;">
                            ' . $signatureHtml . '
                        </td>
                        <td style="width: 100px; padding: 0;"></td>
                        <td style="width: 280px; text-align: center; vertical-align: middle; padding: 0;">
                            <div style="font-size: 18px; font-weight: 700; color: #000; padding-bottom: 6px; font-family: Arial, sans-serif;">
                                ' . $formattedDate . '
                            </div>
                            <div style="width: 200px; border-top: 2px solid #000; margin: 0 auto;"></div>
                            <div style="font-size: 18px; font-weight: 700; color: #000; padding-top: 6px; font-family: Arial, sans-serif;">
                                Issued Date
                            </div>
                        </td>
                    </tr>
                </table>
            ';

            $content = preg_replace('/<table\s+class=["\']certificate-footer["\'][\s\S]*?<\/table>/i', $alignedFooter, $content);
        } elseif (!empty($signatureImage)) {
            $sigImageCandidates = [
                storage_path('app/public/signature_images/' . $signatureImage),
                public_path('storage/signature_images/' . $signatureImage),
            ];
            $sigImageDataUri = $resolveImageBase64($sigImageCandidates) ?: asset('storage/app/public/signature_images/' . $signatureImage);

            // Enhanced enlarged uploaded signature for landscape mode
            $signatureHtml = '
                <div style="text-align: center;">
                    <img src="' . $sigImageDataUri . '" alt="Signature" style="max-width: 250px; max-height: 90px; width: auto; height: auto; display: block; margin: 0 auto 6px; object-fit: contain;">
                    <div style="width: 220px; border-top: 2px solid #000; margin: 0 auto;"></div>
                    <div style="font-size: 18px; font-weight: 700; color: #000; padding-top: 6px; font-family: Arial, sans-serif;">Signature</div>
                </div>
            ';

            $alignedFooter = '
                <table class="certificate-footer" align="center" style="width: 660px; margin: 30px auto 15px; border-collapse: collapse; table-layout: fixed; font-family: Arial, sans-serif;">
                    <colgroup>
                        <col style="width: 280px;" />
                        <col style="width: 100px;" />
                        <col style="width: 280px;" />
                    </colgroup>
                    <tr>
                        <td style="width: 280px; text-align: center; vertical-align: middle; padding: 0;">
                            ' . $signatureHtml . '
                        </td>
                        <td style="width: 100px; padding: 0;"></td>
                        <td style="width: 280px; text-align: center; vertical-align: middle; padding: 0;">
                            <div style="font-size: 18px; font-weight: 700; color: #000; padding-bottom: 6px; font-family: Arial, sans-serif;">
                                ' . $formattedDate . '
                            </div>
                            <div style="width: 200px; border-top: 2px solid #000; margin: 0 auto;"></div>
                            <div style="font-size: 18px; font-weight: 700; color: #000; padding-top: 6px; font-family: Arial, sans-serif;">
                                Issued Date
                            </div>
                        </td>
                    </tr>
                </table>
            ';

            $content = preg_replace('/<table\s+class=["\']certificate-footer["\'][\s\S]*?<\/table>/i', $alignedFooter, $content);
        } else {
            $signatureHtml = '
                <div style="text-align: center;">
                    <div style="font-size: 18px; font-weight: 600; color: #555; padding-bottom: 12px;">No Signature</div>
                    <div style="width: 200px; border-top: 2px solid #000; margin: 0 auto;"></div>
                    <div style="font-size: 18px; font-weight: 700; color: #000; padding-top: 6px; font-family: Arial, sans-serif;">Signature</div>
                </div>
            ';

            $alignedFooter = '
                <table class="certificate-footer" align="center" style="width: 660px; margin: 30px auto 15px; border-collapse: collapse; table-layout: fixed; font-family: Arial, sans-serif;">
                    <colgroup>
                        <col style="width: 280px;" />
                        <col style="width: 100px;" />
                        <col style="width: 280px;" />
                    </colgroup>
                    <tr>
                        <td style="width: 280px; text-align: center; vertical-align: middle; padding: 0;">
                            ' . $signatureHtml . '
                        </td>
                        <td style="width: 100px; padding: 0;"></td>
                        <td style="width: 280px; text-align: center; vertical-align: middle; padding: 0;">
                            <div style="font-size: 18px; font-weight: 700; color: #000; padding-bottom: 6px; font-family: Arial, sans-serif;">
                                ' . $formattedDate . '
                            </div>
                            <div style="width: 200px; border-top: 2px solid #000; margin: 0 auto;"></div>
                            <div style="font-size: 18px; font-weight: 700; color: #000; padding-top: 6px; font-family: Arial, sans-serif;">
                                Issued Date
                            </div>
                        </td>
                    </tr>
                </table>
            ';

            $content = preg_replace('/<table\s+class=["\']certificate-footer["\'][\s\S]*?<\/table>/i', $alignedFooter, $content);
        }

        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $options = $pdf->getDomPDF()->getOptions();
        $options->set('isRemoteEnabled', true);
        $options->set('isFontSubsettingEnabled', false);
        $options->set('defaultFont', 'DejaVu Sans');

        $pdf->getDomPDF()->setOptions($options);
        $pdf->setPaper('a4', 'landscape');
        $pdf->loadHTML($content);

        $safeFileName = \Illuminate\Support\Str::slug($certificate->certificate_name ?: 'Certificate') . '.pdf';

        return $pdf->download($safeFileName, ["Attachment" => false]);
    }


} 
