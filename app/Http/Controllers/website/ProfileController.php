<?php

namespace App\Http\Controllers\website;

use App\Models\Profile;


use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\Role;
use App\Models\Roleuser;
use App\Models\Skill;
use App\Models\user;
use App\Models\userSkill;
use App\Models\UserWork;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfileController extends Controller
{

    public function index()
    {
        $profiles = Roleuser::with(['user.sal_review_to'])->where([['role_id', 3]])->paginate(8);
        foreach ($profiles as $profile) {
            $profile->user['ratings'] = $profile->user->sal_review_to()->avg('rate');
        }

        return view('website.users.profile.index')->with('data', $profiles);
    }

    public function provider_data($id)
    {
        $data = user::with('sal_review_to')->find($id);

        $data['ratings'] = $data->sal_review_to()->avg('rate');

        return view('website.users.profile.provider_details', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Profile::where('user_id', Auth::user()->id)->value('id') == "") {
            return view('website.users.profile.create', ['skills' => Skill::all(), 'roles' => Role::where('name', '<>', 'admin')->get()]);
        } else {
            $profile = Profile::find(Auth::user()->id);

            return redirect('profiles/' . Auth::user()->id)->with('completed', 'it has been saved!');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        Validator::validate($request->all(), [
            'phone' => ['required', 'min:9', 'numeric'],
            'country' => ['required'],
            'major' => [''],
            'role' => ['required'],
            'birth_date' => ['required'],
            'Job_title' => [''],
            'describe' => ['required']
        ], [
            'phone.required' => 'يرجى ادخال رقم التلفون ',
            'phone.numeric' => 'يرجى ادخال رقم  ',
            'phone.min' => '  لا يقل رقم التلفون عن 9 أرقام  ',
            'birth_date.required' => '  يجب ادخال تأريخ الميلاد ',
            'country.required' => 'يرجى ادخال الدولة ',
            'role.required' => 'يرجى ادخال نوع الاستخدام ',
            'describe.required' => 'يرجى ادخال وصف عنك',
            'phone.required' => ' يرجى ادخال رقم التلفون بشكل صحيح حجمه 14رقم   ',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = 'user_avatar.png';
        }

        user::where('id', Auth::user()->id)->update(['image' => $imageName]);
        $profile = new Profile;
        $profile->phone = $request->phone;
        $profile->birth_date = $request->birth_date;
        $profile->country = $request->country;
        $profile->major = $request->major;
        $profile->user_id = Auth::user()->id;
        $profile->Job_title = $request->Job_title;
        if ($request->gander) {
            $profile->gander = $request->gander;
        }
        $profile->description = $request->describe;
        if ($request->facebook) {
            $profile->facebook = $request->facebook;
        }
        if ($request->tweeter) {
            $profile->tweeter = $request->tweeter;
        }
        if ($profile->github) {
            $profile->github = $request->github;
        }
        if ($profile->save()) {
            if ($request->skills[0] != '') {
                foreach ($request->skills as $skill) {
                    $userSkill = new userSkill;
                    $userSkill->user_id = Auth::user()->id;
                    $userSkill->skill_id = $skill;
                    $userSkill->save();
                }
            }
            if (sizeof($request->role) > 0) {
                foreach ($request->role as $r) {
                    Auth::user()->attachRole($r);
                }
                return redirect('profiles/' . Auth::user()->id)->with('success', 'تم حفظ البيانات');
            }
            return redirect()->route('profiles.show', Auth::user()->id)->with('success', '  تم اضافة ملفك الشخصي  ');
        } else {
            return response($profile);
        }
    }


    public function show($id)
    {
        try {

            $data = user::with(['sal_profile'])->find($id);
            if ($data->sal_profile != null) {
                return view('website.users.profile.show', ['data' => $data]);
            } else {
                abort(404);
            }
        } catch (Exception $e) {
            abort(404);
        }
    }

    public function edit($id)
    {
        //
        $profile = Profile::find($id);

        return view('website.users.profile.edit', ['data' => $profile, 'skills' => Skill::all(), 'roles' => Role::where('name', '<>', 'admin')->get()]);
    }

    public function update(Request $request, $id)
    {
        Validator::validate($request->all(), [
            'phone' => ['required', 'min:9', 'numeric'],
            'country' => ['required'],
            'major' => [''],
            'role' => ['required'],
            'birth_date' => ['required'],
            'Job_title' => [''],
        ], [
            'phone.required' => 'يرجى ادخال رقم التلفون ',
            'phone.numeric' => 'يرجى ادخال رقم  ',
            'phone.min' => '  لا يقل رقم التلفون عن 9 أرقام  ',
            'phone.max' => '  لا يزيد رقم التلفون عن 14 أرقام  ',
            'birth_date.required' => '  يجب ادخال تأريخ الميلاد ',

            'country.required' => 'يرجى ادخال الدولة ',
            'role.required' => 'يرجى ادخال نوع الاستخدام ',
            'phone.required' => ' يرجى ادخال رقم التلفون بشكل صحيح حجمه 14رقم   ',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            user::where('id', Auth::user()->id)->update(['name' => $request->name, 'image' => $imageName]);
        }

        Profile::where('id', $id)->update([
            'phone' => $request->phone, 'gander' => $request->gander, 'birth_date' => $request->birth_date,
            'country' => $request->country, 'major' => $request->major, 'user_id' => Auth::user()->id,
            'Job_title' => $request->Job_title, 'facebook' => $request->facebook, 'tweeter' => $request->tweeter, 'github' => $request->github, 'description' => $request->describe
        ]);
        if ($request->skills[0] != '') {
            if ($request->has('skills')) {
                userSkill::where('user_id', Auth::user()->id)->delete();
                foreach ($request->skills as $skill) {
                    $userSkill = new userSkill;
                    $userSkill->user_id = Auth::user()->id;
                    $userSkill->skill_id = $skill;
                    $userSkill->save();
                }
            }
        }
        return redirect('profiles/' . Auth::user()->id)->with('success', 'تم تعديل الملف الشخصي ');
    }

    public function destroy($id)
    {
        userSkill::where('id', $id)->delete();
        return redirect()->back()->with(['success' => ' تم حذف المهاره ']);
    }
}
