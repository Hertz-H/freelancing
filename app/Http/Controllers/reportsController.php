<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Project;
use App\Models\Role;
use App\Models\Roleuser;
use App\Models\Skill;
use App\Models\user;
use App\Models\userSkill;
use App\Models\UserWork;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class reportsController extends Controller
{
    public function index()
    {
        try {
            $seeker_project_success =
                Project::with(['sal_created_by', 'sal_handel_by', 'sal_skills_by.sal_skill'])->where([['user_id', Auth::user()->id]])->get();

            $provider_project_success =
                Project::with(['sal_created_by', 'sal_handel_by', 'sal_skills_by.sal_skill'])->where([['handled_by', Auth::user()->id]])->get();
            // $offer = Offer::with(['sal_provider_by', 'sal_project_id'])->where([['user_id', Auth::user()->id]]);
            $offer = Offer::with(['sal_provider_by', 'sal_project_id', 'sal_project_id.sal_created_by'])->where([['provider_id', Auth::user()->id]]);


            $result_offer = $offer->get();
            return view('website.users.reports.reports')->with(["seeker_project_success" => $seeker_project_success, "provider_project_success" => $provider_project_success, 'offers' => $result_offer]);
        } catch (Exception $e) {
            abort(401);
        }
    }
    public function offers()
    {
        try {
            $offers = Offer::with(['sal_provider_by', 'sal_project_id'])->where([['user_id', Auth::user()->id]])->get();
            return view('website.users.reports.offer_reports')->with('offers', $offers);
        } catch (Exception $e) {
            abort(401);
        }
    }
    public function filterdate(Request $request)
    {
        $provider_project = project::with(['sal_created_by', 'sal_handel_by', 'sal_skills_by.sal_skill'])->where([['handled_by', Auth::user()->id]]);

        $seeker_project = project::with(['sal_created_by', 'sal_handel_by', 'sal_skills_by.sal_skill'])->where([['user_id', Auth::user()->id]]);
        if ($request->has('nearest')) {
            $provider_project->whereBetween(
                'created_at',
                [Carbon::now()->subDays(60), Carbon::now()]
            );
            $seeker_project->whereBetween(
                'created_at',
                [Carbon::now()->subDays(60), Carbon::now()]
            );
        }
        if ($request->has('lastest')) {
            $provider_project->whereBetween(
                'created_at',
                [Carbon::now()->subDays(1000), Carbon::now()->subDays(60)]
            );
            $seeker_project->whereBetween(
                'created_at',
                [Carbon::now()->subDays(1000), Carbon::now()->subDays(60)]
            );
        }

        $result_seeker = $seeker_project->get();
        $result_provider = $provider_project->get();
        return view('website.users.reports.reports')->with(["seeker_project_success" => $result_seeker, "provider_project_success" => $result_provider]);
    }
    public function filter(Request $request)
    {
        $provider_project = project::with(['sal_created_by', 'sal_handel_by', 'sal_skills_by.sal_skill'])->where([['handled_by', Auth::user()->id]]);

        $seeker_project = project::with(['sal_created_by', 'sal_handel_by', 'sal_skills_by.sal_skill'])->where([['user_id', Auth::user()->id]]);

        if ($request->has('project_status') && $request->project_status != -1) {

            $provider_project->where('status', $request->project_status);
            $seeker_project->where('status', $request->project_status);
        }
        if ($request->has('nearest')) {
            $provider_project->whereBetween(
                'created_at',
                [Carbon::now()->subDays(60), Carbon::now()]
            );
            $seeker_project->whereBetween(
                'created_at',
                [Carbon::now()->subDays(60), Carbon::now()]
            );
        }
        if ($request->has('lastest')) {
            $provider_project->whereBetween(
                'created_at',
                [Carbon::now()->subDays(1000), Carbon::now()->subDays(60)]
            );
            $seeker_project->whereBetween(
                'created_at',
                [Carbon::now()->subDays(1000), Carbon::now()->subDays(60)]
            );
        }
        $offer = Offer::with(['sal_provider_by', 'sal_project_id', 'sal_project_id.sal_created_by'])->where([['provider_id', Auth::user()->id]]);
        if ($request->has('offer_status') && $request->offer_status != -1) {
            $offer->where('status', $request->offer_status);
        }
        $result_offer = $offer->get();
        // return response($result_offer);
        $result_seeker = $seeker_project->get();
        $result_provider = $provider_project->get();

        return response(['offer' => $result_offer, 'project' => $result_seeker]);
        // return view('website.users.reports.reports')->with(["seeker_project_success" => $result_seeker, "provider_project_success" => $result_provider, "offers" => $result_offer]);
    }

    public function filteroffer(Request $request)
    {
        $offer = Offer::with(['sal_provider_by', 'sal_project_id'])->where([['provider_id', Auth::user()->id]]);
        if ($request->has('offer_status')) {
            $offer->where('status', $request->offer_status);
        }
        if ($request->has('neer')) {
            $offer->whereBetween(
                'created_at',
                [Carbon::now()->subDays(60), Carbon::now()]
            );
        }
        if ($request->has('last')) {
            $offer->whereBetween(
                'created_at',
                [Carbon::now()->subDays(1000), Carbon::now()->subDays(60)]
            );
        }


        $result_offer = $offer->get();
        return view('website.users.reports.offer_reports')->with(["offers" => $result_offer]);
    }
}
