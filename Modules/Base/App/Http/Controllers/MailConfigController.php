<?php

namespace Modules\Base\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class MailConfigController extends Controller
{
    public function mailSetup()
    {
        return view('base::mail.mail_setup');
    }

    public function updateMailSettings(Request $request)
    {
        $request->validate([
            'MAIL_MAILER' => 'required|string',
            'MAIL_ENCRYPTION' => 'required|string',
            // 'MAIL_FROM_NAME' => 'required|string',
            'MAIL_FROM_ADDRESS' => 'required|email',
            'MAIL_HOST' => 'required|string',
            'MAIL_PORT' => 'required|numeric',
            'MAIL_USERNAME' => 'required|string',
            'MAIL_PASSWORD' => 'required|string',
        ]);

        $envPath = base_path('.env');
        $envBackupPath = base_path('.env.backup');

        // Create a backup of the current .env file
        if (File::exists($envPath) && !File::exists($envBackupPath)) {
            File::copy($envPath, $envBackupPath);
        }

        $envContent = File::get($envPath);

        $settings = [
            'MAIL_MAILER' => $request->MAIL_MAILER,
            'MAIL_ENCRYPTION' => $request->MAIL_ENCRYPTION,
            // 'MAIL_FROM_NAME' => $request->MAIL_FROM_NAME,
            'MAIL_FROM_ADDRESS' => $request->MAIL_FROM_ADDRESS,
            'MAIL_HOST' => $request->MAIL_HOST,
            'MAIL_PORT' => $request->MAIL_PORT,
            'MAIL_USERNAME' => $request->MAIL_USERNAME,
            'MAIL_PASSWORD' => $request->MAIL_PASSWORD,
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

    public function testMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $toEmail = $request->email;
        $body = $request->message;

        try {
            $mailData = [
                'from_name' => config('mail.from.name'),
                'from_address' => config('mail.from.address'),
                'subject' => 'Test Email',
                'body' => $body ?: 'This is a test email sent from ' . config('app.name') . '.',
            ];

            Mail::to($toEmail)->send(new TestMail($mailData));

            return redirect()->back()->with('success', 'Email sent successfully.');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Failed to send email: ' . $exception->getMessage());
        }
    }
}
