<?php

namespace App\Http\Controllers\V1\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileUpdateRequest;
use App\Models\Notification;
use App\Models\User;
use App\Services\AdminServices\PageRequestService;
use Illuminate\Http\Request;
use Modules\Page\Entities\Page;


class AdminController extends Controller
{
    public function adminProfile(){
        $user = auth()->user();
        return view('backend.content.admin.profile.admin_profile', compact('user'));
    }
    public function saveProfile(AdminProfileUpdateRequest $request){
        $user = auth()->user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->religious_beliefs = $request->religious_beliefs;
        $user->dob = $request->datetimepicker;
        $user->marital_status = $request->marital_status;
        $user->save();
        $request->session()->flash('alert-success', 'Profile data Saved!');
        return redirect()->route('admin.adminProfile');
    }
    public function pagesVerifications (Request $request) {
        $list = new PageRequestService();
        if ($request->ajax()) {
            return $list->index();
        }
        return view('backend.content.admin.page_verification.verification');
    }
    public function showPageVerification ($id) {
        $page = Page::whereId($id)->whereHas('verificationRequest')->with('verificationRequest', function ($q) {$q->where('verification_requests.status', 0);})->select(['pages.id', 'page_title'])->first();
        return view('backend.content.admin.page_verification.show', compact('page'));
    }
    public function verifyPage ($id) {
        $serviece = new PageRequestService();
        $data = $serviece->verifyPage($id);
        return response()->json($data);
    }
    public function rejectPage ($id) {
        $service = new PageRequestService();
        $data = $service->rejectVerificationRequest($id);
        return response()->json($data);
    }
}
