<?php

namespace Modules\Base\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Modules\Base\App\Models\GeneralSetting;

class GeneralSettingController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['settings'] = GeneralSetting::pluck('value', 'type')->toArray(); // ['site_name' => 'My Site', ...]

        return view('base::settings.general_setting', $data);
    }

    public function donationSetting()
    {
        $data['settings'] = GeneralSetting::pluck('value', 'type')->toArray();

        return view('base::settings.donation_setting', $data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'site_name' => 'nullable|string|max:255',
                'site_short_name' => 'nullable|string|max:100',
                'phone' => 'nullable|string|max:255',
                'email' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'linkedin' => 'nullable|string|max:255',
                'x' => 'nullable|string|max:255',
                'instagram' => 'nullable|string|max:255',
                'pinterest' => 'nullable|string|max:255',
                'youtube' => 'nullable|string|max:255',
                'pinterest' => 'nullable|string|max:255',
                'meta_title' => 'nullable|string|max:255',
                'meta_tag' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:255',
                'primary_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'secondary_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'meta_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'cookies_allow' => 'nullable|string|max:3',
                'privacy_policy' => 'nullable|string',
                'terms_and_condition' => 'nullable|string',
                'event_pass_qr' => 'nullable|in:Yes,No',
                'is_per_person_wise_qr' => 'nullable|in:Yes,No',
                'is_event_activity_wise_qr' => 'nullable|in:Yes,No',
                'member_prefix' => 'nullable|string|max:20',
                'member_digit' => 'nullable|string|max:10',
                'member_registration_active_email_template' => 'nullable|string',
                'member_registration_cancel_email_template' => 'nullable|string',
                'member_donation_pending_email_template' => 'nullable|string',
                'member_donation_pay_success_email_template' => 'nullable|string',
                'member_donation_pay_fail_email_template' => 'nullable|string',
            ]);

            if ($request->hasFile('primary_logo')) {
                $data['primary_logo'] = $this->uploadFile($request->file('primary_logo'), 'images');
            }
            if ($request->hasFile('secondary_logo')) {
                $data['secondary_logo'] = $this->uploadFile($request->file('secondary_logo'), 'images');
            }
            if ($request->hasFile('favicon')) {
                $data['favicon'] = $this->uploadFile($request->file('favicon'), 'images');
            }
            if ($request->hasFile('meta_image')) {
                $data['meta_image'] = $this->uploadFile($request->file('meta_image'), 'images');
            }

            // Save each key-value pair into GeneralSetting table
            foreach ($data as $key => $value) {
                GeneralSetting::updateOrCreate(
                    ['type' => $key], // Search by 'type'
                    ['value' => $value] // Update or create with 'value'
                );
            }
            return back()->with('success', 'Setting Data Updated Successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function privacyPolicy()
    {
        $data['settings'] = GeneralSetting::pluck('value', 'type')->toArray();
        return view('base::settings.privacy_policy', $data);
    }

    public function termsAndCondition()
    {
        $data['settings'] = GeneralSetting::pluck('value', 'type')->toArray();
        return view('base::settings.terms_and_condition', $data);
    }

    public function qrCodeSetting()
    {
        $data['settings'] = GeneralSetting::pluck('value', 'type')->toArray();
        return view('base::settings.qr_code_config', $data);
    }

    public function payPalSetup()
    {
        return view('base::mail.paypal_setup');
    }

    public function updatePayPalSettings(Request $request)
    {
        $request->validate([
            'PAYPAL_MODE' => 'required|string',
            'PAYPAL_CLIENT_ID' => 'required|string',
            'PAYPAL_CLIENT_SECRET' => 'required|string',
            'PAYPAL_WEBHOOK_ID' => 'required|string',
        ]);

        $envPath = base_path('.env');
        $envBackupPath = base_path('.env.backup');

        // Create a backup of the current .env file
        if (File::exists($envPath) && !File::exists($envBackupPath)) {
            File::copy($envPath, $envBackupPath);
        }

        $envContent = File::get($envPath);

        $settings = [
            'PAYPAL_MODE' => $request->PAYPAL_MODE,
            'PAYPAL_CLIENT_ID' => $request->PAYPAL_CLIENT_ID,
            'PAYPAL_CLIENT_SECRET' => $request->PAYPAL_CLIENT_SECRET,
            'PAYPAL_WEBHOOK_ID' => $request->PAYPAL_WEBHOOK_ID,
        ];

        foreach ($settings as $key => $value) {
            // wrap values containing spaces or special chars in double quotes
            if (preg_match('/\s/', $value) || preg_match('/[()]/', $value)) {
                $value = '"' . addslashes($value) . '"';
            }

            $pattern = "/^" . preg_quote($key, '/') . "=(.*)$/m";
            $replacement = $key . '=' . $value;

            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $replacement, $envContent);
            } else {
                $envContent .= "\n" . $replacement;
            }
        }

        File::put($envPath, $envContent);

        return redirect()->back()->with('success', 'Mail setting updated successfully.');
    }
}
