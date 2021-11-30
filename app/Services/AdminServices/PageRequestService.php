<?php


namespace App\Services\AdminServices;


use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Page\Entities\Page;
use Yajra\DataTables\DataTables;

class PageRequestService
{
    public function index()
    {
        $pagesIds = DB::table('verification_requests')->where('status', 0)->where('node_type', 'page')->select('node_id')->get()->toArray();
        $pagesIds = array_column($pagesIds, 'node_id');
        $pages = Page::whereIn('id', $pagesIds)->whereHas('verificationRequest')->with('verificationRequest')->get();
        return DataTables::of($pages)->only(['id','page_title'])->toJson();
    }

    public function verifyPage($id)
    {
        $page = Page::whereId(decrypt($id))->whereHas('verificationRequest')->first();
        $page->page_verified = "1";
        $page->save();
        $page->verificationRequest()->update(['verification_requests.status'=> 1]);

        //send notification to page admins
        $pageAdmins = $page->admins()->get();
        foreach ($pageAdmins as $admin) {
            Notification::Create([
                'to_user_id' => (int)$admin->id,
                'from_user_id' => auth()->id(),
                'action' => 'page_verified',
                'node_type' => '',
                'node_url' => $page->page_title,
                'notify_id' => '',
            ]);
            /* update notifications counter +1 */
            $user = User::whereId($admin->id)->first();
            $user->user_live_notifications_counter = $user->user_live_notifications_counter + 1;
            $user->save();
        }
        return array(
            'status' => 200,
            'message' => "Page has been successfully verified."
        );
    }

    public function rejectVerificationRequest($id)
    {
        $page = Page::whereId(decrypt($id))->whereHas('verificationRequest')->first();
        $page->verificationRequest()->delete();
        //send notification to page admins
        $pageAdmins = $page->admins()->get();
        foreach ($pageAdmins as $admin) {
            Notification::Create([
                'to_user_id' => (int)$admin->id,
                'from_user_id' => auth()->id(),
                'action' => 'page_verification_rejected',
                'node_type' => '',
                'node_url' => $page->page_title,
                'notify_id' => '',
            ]);
            /* update notifications counter +1 */
            $user = User::whereId($admin->id)->first();
            $user->user_live_notifications_counter = $user->user_live_notifications_counter + 1;
            $user->save();
        }
        return array(
            'status' => 200,
            'message' => "Page verification has been rejected."
        );
    }
}
