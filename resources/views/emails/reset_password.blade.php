<!DOCTYPE html>
<html>
<head>
    <title>OTP Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="color: #2c3e50; text-align: center;">Reset Password Akun</h2>
        
        <p>Halo,</p>
        <p>Kami menerima permintaan untuk mengatur ulang kata sandi akun <b>Nganjuk Abirupa</b> Anda. Berikut adalah kode OTP Anda:</p>
        
        <!-- INI BAGIAN PENTINGNYA: Memanggil variabel $otp -->
        <div style="text-align: center; margin: 20px 0;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 5px; background-color: #f4f4f4; padding: 10px 20px; border-radius: 5px; color: #e74c3c;">
                {{ $otp }}
            </span>
        </div>

        <p>Kode ini hanya berlaku selama <b>15 menit</b>. Jangan berikan kode ini kepada siapa pun, termasuk admin Nganjuk Abirupa.</p>
        
        <p>Jika Anda tidak merasa meminta reset password, abaikan saja email ini.</p>
        <br>
        <p>Terima kasih,<br><b>Tim Nganjuk Abirupa</b></p>
    </div>
</body>
</html>